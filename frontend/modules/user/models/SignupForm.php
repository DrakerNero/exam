<?php

namespace frontend\modules\user\models;

use common\commands\command\SendEmailCommand;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model {

  public $username;
  public $password;
  public $confirm_password;

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        ['username', 'filter', 'filter' => 'trim'],
        ['username', 'required'],
        ['username', 'email'],
        ['username', 'unique',
            'targetClass' => '\common\models\User',
            'message' => Yii::t('frontend', 'This username has already been taken.')
        ],
        ['username', 'string', 'min' => 2, 'max' => 255],
        ['password', 'required'],
        ['password', 'string', 'min' => 6],
        ['confirm_password', 'compare', 'compareAttribute' => 'password'],
    ];
  }

  public function attributeLabels() {
    return [
        'username' => Yii::t('frontend', 'Username'),
        'password' => Yii::t('frontend', 'Password'),
        'confirm_password' => Yii::t('frontend', 'Confirm password'),
    ];
  }

  /**
   * Signs user up.
   *
   * @return User|null the saved model or null if saving fails
   */
  public function signup() {
    if ($this->validate()) {
      $user = new User();
      $user->username = $this->username;
      $user->email = $this->email;
      $user->setPassword($this->password);
      $user->generatePasswordResetToken();
      if ($user->save()) {
        Yii::$app->commandBus->handle(new SendEmailCommand([
            'from' => [Yii::$app->params['adminEmail'] => Yii::$app->name],
            'to' => $this->username,
            'subject' => Yii::t('frontend', '[{name}] Pleae activate your account', ['name' => Yii::$app->name]),
            'view' => 'accountActivateToken',
            'params' => ['user' => $user]
        ]));
      }
      $user->afterSignup();
      return $user;
    }

    return null;
  }

  public function signupWithRadius() {
    $user = new User();
    $user->username = $this->username;
    $user->email = date('YmdHis').'@mail.com';
    $user->setPassword($this->password);
    $user->generatePasswordResetToken();
    $user->user_status = 0;
    if ($user->save()) {
      Yii::$app->commandBus->handle(new SendEmailCommand([
          'from' => [Yii::$app->params['adminEmail'] => Yii::$app->name],
          'to' => $this->username,
          'subject' => Yii::t('frontend', '[{name}] Pleae activate your account', ['name' => Yii::$app->name]),
          'view' => 'accountActivateToken',
          'params' => ['user' => $user]
      ]));
    }
    $user->afterSignup();
    return $user;
  }

}
