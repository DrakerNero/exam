<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use yii\web\Controller;
use frontend\models\QuestionSet;
use frontend\models\Question;
use frontend\models\QuestionSave;
use frontend\models\QuestionSaveSearch;
use frontend\models\User;
use frontend\models\UserSearch;
use common\models\User as CommonUser;

/**
 * Site controller
 */
class SiteController extends Controller {

  /**
   * @inheritdoc
   */
  public function actions() {
    return [
        'error' => [
            'class' => 'yii\web\ErrorAction'
        ],
        'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
        ],
        'set-locale' => [
            'class' => 'common\actions\SetLocaleAction',
            'locales' => array_keys(Yii::$app->params['availableLocales'])
        ]
    ];
  }

  protected function popupModal() {
    $session = Yii::$app->session;
    $popup = false;
    if (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != null) {
      if ($session->get('dateFirstLogin') == date('Ymd')) {
        
      } else {
        $popup = true;
        $session->set('dateFirstLogin', date('Ymd'));
      }
    } else {
      
    }

    return $popup;
  }

  public function actionIndex() {
    $popup = $this->popupModal();
//    $session = Yii::$app->session;
//    $popup = false;
//    if (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != null) {
//      if ($session->get('dateFirstLogin') == date('Ymd')) {
//        
//      } else {
//        $popup = true;
//        $session->set('dateFirstLogin', date('Ymd'));
//      }
//    } else {
//      
//    }

    $subject_id = 'all';
    $pageEnd = 12;
    if (isset($_GET['subject_id'])) {
      $subject_id = $_GET['subject_id'];
    }

    if ($subject_id != 'all') {
      $questionSet = QuestionSet::findAll(['subject_id' => $subject_id, 'status' => 1]);
      $countPage = sizeof($questionSet) / $pageEnd;
      if (isset($_GET['page'])) {
        $pageStart = ($_GET['page'] * $pageEnd) - $pageEnd;
        $models = QuestionSet::find()->where(['subject_id' => $subject_id, 'status' => 1])->limit($pageEnd)->offset($pageStart)->all();
      } else {
        $models = QuestionSet::find()->where(['subject_id' => $subject_id, 'status' => 1])->limit($pageEnd)->offset(0)->all();
      }
    } else {
      $questionSet = QuestionSet::find()->all();
      $countPage = sizeof($questionSet) / $pageEnd;
      if (isset($_GET['page'])) {
        $pageStart = ($_GET['page'] * $pageEnd) - $pageEnd;
        $models = QuestionSet::find()->where(['status' => 1])->limit($pageEnd)->offset($pageStart)->all();
      } else {
        $models = QuestionSet::find()->where(['status' => 1])->limit($pageEnd)->offset(0)->all();
      }
    }

    return $this->render('index', [
                'models' => $models,
                'countPage' => $countPage,
                'subject_id' => $subject_id,
                'popup' => $popup
    ]);
  }

  public function actionContact() {
    $model = new ContactForm();
    if ($model->load(Yii::$app->request->post())) {
      if ($model->contact(Yii::$app->params['adminEmail'])) {
        Yii::$app->getSession()->setFlash('alert', [
            'body' => Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
            'options' => ['class' => 'alert-success']
        ]);
        return $this->refresh();
      } else {
        Yii::$app->getSession()->setFlash('alert', [
            'body' => \Yii::t('frontend', 'There was an error sending email.'),
            'options' => ['class' => 'alert-danger']
        ]);
      }
    }

    return $this->render('contact', [
                'model' => $model
    ]);
  }

  public function actionMonitor($academic = null, $rotation = null) {
    $this->layout = 'main_backend';
    $arrWhere = ['status' => 1];
    ($academic != null) ? $arrWhere['start_study'] = $academic : null;
    ($rotation != null) ? $arrWhere['rotation'] = $rotation : null;

    $modelUsers = User::find()->where($arrWhere)->all();
    $usersActives = User::find()->where(['status' => 1])->all();
    $userCount = count($modelUsers);
    $examCount = QuestionSet::find()->where(['status' => 1])->count();
    $questionCount = Question::find()->count();
    $questionSaveCount = QuestionSave::find()->count();
    $arrAcademics = [];
    foreach ($usersActives as $usersActives) {
      array_push($arrAcademics, $usersActives->start_study);
    }

    $resultAcademics = array_unique($arrAcademics);

    $searchUser = new UserSearch();
    $dataProvider = $searchUser->searchMonitor(Yii::$app->request->queryParams, $academic, $rotation);




    return $this->render('monitor', [
                'searchUser' => $searchUser,
                'dataProvider' => $dataProvider,
                'userCount' => $userCount,
                'examCount' => $examCount,
                'questionCount' => $questionCount,
                'questionSaveCount' => $questionSaveCount,
                'resultAcademics' => $resultAcademics,
                'usersActives' => $usersActives,
                'academic' => $academic,
                'rotation' => $rotation,
    ]);
  }

  public function actionMonitorProfileUser($userId) {
    $this->layout = 'main_backend';
    $user = User::findOne($userId);
    $questionSets = QuestionSet::find()->where(['status' => 1])->all();
//    $questonSaves = QuestionSave::find()->where(['user_id' => $userId])->all();
    $searchModel = new QuestionSaveSearch();
    $dataProvider = $searchModel->searchByUserId(Yii::$app->request->queryParams, $userId);

    return $this->render('monitor_profile_user', [
                'user' => $user,
                'userId' => $userId,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'questionSets' => $questionSets,
    ]);
  }

  public function actionEditProfileUser($id) {
    $this->layout = 'main_backend';
    $model = User::find()->where(['id' => $id])->one();
    if ($model->load(Yii::$app->request->post())) {
//      $model->updated_at = date('Y-m-d H:i:s');
      $model->save();
      return $this->redirect(['monitor-profile-user', 'userId' => $id]);
    }
    return $this->render('edit_profile_user', ['model' => $model, 'id' => $id]);
  }

  public function actionExamSuccessPage() {
    $iconName = 'ic-3.png';
    $colorClass = 'wsq-green';
    $userId = (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != null) ? Yii::$app->user->identity->id : null;
    if (!empty($userId) && isset($userId) && $userId != null) {
      $popup = $this->popupModal();
//      $models = QuestionSet::find()->where(['status' => 1])->all();
      $arrQuestionSave = [];
      $checkUnique = null;
      $questionSaves = QuestionSave::find()->where(['user_id' => $userId, 'status' => 3])->andWhere(['>=', 'score', '80'])->all();

      foreach ($questionSaves as $questionSave) {
        if ($checkUnique != $questionSave->question_set_id) {
          $checkUnique = $questionSave->question_set_id;
          array_push($arrQuestionSave, $questionSave);
        } else {
          
        }
      }

      return $this->render('_exam_status_page', ['models' => $arrQuestionSave, 'popup' => $popup, 'iconName' => $iconName, 'colorClass' => $colorClass]);
    } else {
      return $this->redirect(['index']);
    }
  }

  public function actionExamDoingPage() {
    $iconName = 'ic-2.png';
    $colorClass = 'wsq-orange';
    $userId = (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != null) ? Yii::$app->user->identity->id : null;
    if (!empty($userId) && isset($userId) && $userId != null) {
      $getQuestionSuccessIds = [];
      $popup = $this->popupModal();
      $arrQuestionSave = [];
      $checkUnique = null;
      $questionSaves = QuestionSave::find()->where(['user_id' => $userId])->all();
      $questionSaveSuccess = QuestionSave::find()->where(['user_id' => $userId, 'status' => 3])->andWhere(['>=', 'score', '80'])->all();

      foreach ($questionSaveSuccess as $model) {
        array_push($getQuestionSuccessIds, $model->questionSet->id);
      }

      foreach ($questionSaves as $questionSave) {
        if (!in_array($questionSave->questionSet->id, $getQuestionSuccessIds)) {

          if ($checkUnique != $questionSave->question_set_id) {
            $checkUnique = $questionSave->question_set_id;
            array_push($arrQuestionSave, $questionSave);
          } else {
            
          }
        }
      }


      return $this->render('_exam_status_page', ['models' => $arrQuestionSave, 'popup' => $popup, 'iconName' => $iconName, 'colorClass' => $colorClass]);
    } else {
      return $this->redirect(['index']);
    }
  }

  public function actionExamNotDoPage() {
    $notDo = true;
    $iconName = 'ic-1.png';
    $colorClass = 'wsq-gray';
    $userId = (!empty(Yii::$app->user->identity->id) && isset(Yii::$app->user->identity->id) && Yii::$app->user->identity->id != null) ? Yii::$app->user->identity->id : null;
    if (!empty($userId) && isset($userId) && $userId != null) {
      $popup = $this->popupModal();
      $questionSetIds = [];
      $questionSaves = QuestionSave::find()->where(['user_id' => $userId])->all();

      foreach ($questionSaves as $questionSave) {
        array_push($questionSetIds, $questionSave->question_set_id);
      }

      $questionSets = QuestionSet::find()->where(['status' => 1])->all();
      $arrQuestionSets = [];
      foreach ($questionSets as $questionSet) {
        if (!in_array($questionSet->id, $questionSetIds)) {
          array_push($arrQuestionSets, $questionSet);
        } else {
          
        }
      }

//      echo '<pre>';
//      print_r($arrQuestionSets);
//      print_r(array_unique($questionSetIds));
      return $this->render('_exam_status_page', ['models' => $arrQuestionSets, 'popup' => $popup, 'iconName' => $iconName, 'colorClass' => $colorClass, 'notDo' => $notDo]);
    } else {
      return $this->redirect(['index']);
    }
  }

  public function actionTestAuth() {
    $username = 'mdcutest08';
    $password = 'MDcu0853!';
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
//    $getAttr = radius_get_attr($radius);
//    $putAttr = radius_put_attr($radius);
    radius_close($radius);
    if ($status == RADIUS_ACCESS_ACCEPT) {
//      print_r($getAttr);
//      print_r($putAttr);
//      echo $putAttr;
      echo ' radius: ' . $radius;
      echo ' status: ' . $status;
      echo ' : true';
      return;
    }
    echo 'false';
  }

  public function actionTestQuestion() {
    $questionSaves = QuestionSave::find()->where(['id' => 20])->all();
    echo '<pre>';

    foreach ($questionSaves as $questionSave) {
      $choices = json_decode($questionSave->answer, true);

      foreach ($choices as $choice) {
        if (!empty($choice) && isset($choice)) {
          $choice = array_values($choice);
//          print_r($choice);
          $key = 0;
          if (!empty($choice[$key]) && isset($choice[$key])) {
//          print_r($choices[$key]['part']);
            for ($i = 0; $i <= 14; $i++) {
              $choiceCheck = (!empty($choice[$i][2]) && isset($choice[$i][2])) ? $choice[$i][2] : 0;
              echo $choiceCheck . ',';
            }
          } else {
//          
          }
        } else {
          
        }
        echo ' <br />';
      }
    }
  }

//  public function actionTestLdap() {
////    $ldap_dn = 'cn=read-only-admin,dc=example,dc=com';
////    $ldap_password = 'password';
////    
////    $ldap_con = ldap_connect('ldap.forumsys.com');
////    
////    ldap_set_option($ldap_con, LDAP_OTP_PROTOCOL_VERSION, 30);
////    
////    if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {
////      echo 'TRUE';
////    } else {
////      echo 'FALSE';
////    }
////  }
//    $con = @ldap_connect('ldaps://the.ldap.server', 636);
//    ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
//    ldap_set_option($con, LDAP_OPT_REFERRALS, 0);
//    var_dump(@ldap_bind($con, 'user@sub.domain.com', 'password'));
//  }
}
