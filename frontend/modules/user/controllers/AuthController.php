<?php

namespace frontend\modules\user\controllers;

use common\commands\command\SendEmailCommand;
use common\models\User;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AuthController extends \yii\web\Controller {

  public $layout = 'base';

  public function actions() {
    return [
        'oauth' => [
            'class' => 'yii\authclient\AuthAction',
            'successCallback' => [$this, 'successOAuthCallback']
        ]
    ];
  }

  public function behaviors() {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['signup', 'activate-account', 'login', 'request-password-reset', 'reset-password', 'oauth'],
                    'allow' => true,
                    'roles' => ['?']
                ],
                [
                    'actions' => ['signup', 'activate-account', 'login', 'request-password-reset', 'reset-password', 'oauth'],
                    'allow' => false,
                    'roles' => ['@'],
                    'denyCallback' => function () {
              return Yii::$app->controller->redirect(['/user/default/profile']);
            }
                ],
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ]
            ]
        ],
            /* 'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
              'logout' => ['post']
              ]
              ] */
    ];
  }

  public function handleAuthenWithRadius($model) {
    $username = $model->username;
    $password = $model->password;
    $host = '161.200.98.35';
    $key = 'MDCUacs1#';
    $timeout = 10;
    $retry = 3;
    $radius = radius_auth_open();
    radius_add_server($radius, $host, 0, $key, $timeout, $retry);
    radius_create_request($radius, RADIUS_ACCESS_REQUEST);
    radius_put_attr($radius, RADIUS_USER_NAME, $username);
    radius_put_attr($radius, RADIUS_USER_PASSWORD, $password);
    $status = radius_send_request($radius);
    radius_close($radius);
    if ($status == RADIUS_ACCESS_ACCEPT) {
      return true;
    } else {
      return false;
    }
  }

  public function actionLogin() {
    $model = new LoginForm();
    if (Yii::$app->request->isAjax) {
      $model->load($_POST);
      Yii::$app->response->format = Response::FORMAT_JSON;
      return ActiveForm::validate($model);
    }
    if ($model->load(Yii::$app->request->post())) {
      if ($this->handleAuthenWithRadius($model) == true) {
//        $model->login();
        echo 'true';
      } else {
        echo 'false';
      }

//      return $this->goBack();
    } else {
      return $this->render('login', [
                  'model' => $model
      ]);
    }
  }

  public function actionLogout() {
    Yii::$app->user->logout();
    return $this->goHome();
  }

  public function actionSignup() {
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      $user = $model->signup();
      Yii::$app->getSession()->setFlash('alert', [
          'title' => Yii::t('frontend', 'อีกขั้นตอนเดียวเท่านั้น!'),
          'body' => Yii::t('frontend', 'กรุณาตรวจสอบอีเมล์ของท่านเพื่อยืนยันการสมัคร'),
      ]);

      return $this->goHome();
    }

    return $this->render('signup', [
                'model' => $model
    ]);
  }

  public function actionActivateAccount($token) {
    if (empty($token) || !is_string($token)) {
      throw new BadRequestHttpException('Activate token cannot be blank.');
    }
    $user = User::findByActivateToken($token);
    if (!$user) {
      throw new BadRequestHttpException('Wrong activate token.');
    }

    $user->removePasswordResetToken();
    $user->status = User::STATUS_ACTIVE;
    if ($user->save()) {
      // Log user in and redirect to home
      if (Yii::$app->user->login($user)) {
        return $this->goHome();
      } else {
        return $this->render('login', [
                    'model' => $model
        ]);
      }
    } else {
      throw new ServerErrorHttpException('Internal error cannot activate user. Please contact administrator');
    }
  }

  public function actionRequestPasswordReset() {
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      if ($model->sendEmail()) {
        Yii::$app->getSession()->setFlash('alert', [
            'title' => Yii::t('frontend', 'ท่านกำลังแก้ไขรหัสผ่าน'),
            'body' => Yii::t('frontend', 'กรุณาตรวจสอบอีเมล์ของท่านเพื่อดำเนินการตั้งรหัสผ่านใหม่'),
        ]);

        return $this->goHome();
      } else {
        Yii::$app->getSession()->setFlash('alert', [
            'title' => Yii::t('frontend', 'เกิดข้อผิดพลาด'),
            'body' => Yii::t('frontend', 'ขออภัยค่ะ ระบบไม่สามารถแก้ไขพาสเวิ์ดตามอีเมล์ที่ระบุได้'),
        ]);
      }
    }

    return $this->render('requestPasswordResetToken', [
                'model' => $model,
    ]);
  }

  public function actionResetPassword($token) {
    try {
      $model = new ResetPasswordForm($token);
    } catch (InvalidParamException $e) {
      throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
      Yii::$app->getSession()->setFlash('alert', [
          'title' => Yii::t('frontend', 'สำเร็จ'),
          'body' => Yii::t('frontend', 'ท่านได้ตั้งค่ารหัสผ่านใหม่เรียบร้อย'),
          'options' => ['class' => 'alert-success']
      ]);
      return $this->goHome();
    }

    return $this->render('resetPassword', [
                'model' => $model,
    ]);
  }

  /**
   * @param $client \yii\authclient\BaseClient
   * @return bool
   * @throws Exception
   */
  public function successOAuthCallback($client) {
    // use BaseClient::normalizeUserAttributeMap to provide consistency for user attribute`s names
    $attributes = $client->getUserAttributes();
    $user = User::find()->where([
                'oauth_client' => $client->getName(),
                'oauth_client_user_id' => ArrayHelper::getValue($attributes, 'id')
            ])
            ->one();
    if (!$user) {
      $user = new User();
      $user->scenario = 'oauth_create';
      $user->username = ArrayHelper::getValue($attributes, 'login');
      $user->email = ArrayHelper::getValue($attributes, 'email');
      $user->oauth_client = $client->getName();
      $user->oauth_client_user_id = ArrayHelper::getValue($attributes, 'id');
      $password = Yii::$app->security->generateRandomString(8);
      $user->setPassword($password);
      if ($user->save()) {
        $user->afterSignup();
        $sentSuccess = Yii::$app->commandBus->handle(new SendEmailCommand([
            'view' => 'oauth_welcome',
            'params' => ['user' => $user, 'password' => $password],
            'subject' => Yii::t('frontend', '{app-name} | Your login information', ['app-name' => Yii::$app->name]),
            'to' => $user->email
        ]));
        if ($sentSuccess) {
          Yii::$app->session->setFlash(
                  'alert', [
              'options' => ['class' => 'alert-success'],
              'body' => Yii::t('frontend', 'Welcome to {app-name}. Email with your login information was sent to your email.', [
                  'app-name' => Yii::$app->name
              ])
                  ]
          );
        }
      } else {
        // We already have a user with this email. Do what you want in such case
        if (User::find()->where(['email' => $user->email])->count()) {
          Yii::$app->session->setFlash(
                  'alert', [
              'options' => ['class' => 'alert-danger'],
              'body' => Yii::t('frontend', 'We already have a user with email {email}', [
                  'email' => $user->email
              ])
                  ]
          );
        } else {
          Yii::$app->session->setFlash(
                  'alert', [
              'options' => ['class' => 'alert-danger'],
              'body' => Yii::t('frontend', 'Error while oauth process.')
                  ]
          );
        }
      };
    }
    if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
      return true;
    } else {
      throw new Exception('OAuth error');
    }
  }

}
