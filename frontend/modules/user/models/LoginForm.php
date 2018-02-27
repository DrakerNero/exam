<?php

namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\MethodNotAllowedHttpException;
use frontend\modules\user\models\SignupForm;

/**
 * Login form
 */
class LoginForm extends Model {

  public $username;
  public $password;
  public $rememberMe = true;
  private $user = false;

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
        // username and password are both required
        [['username', 'password'], 'required'],
        // username must be email
        ['username', 'string'],
        // rememberMe must be a boolean value
        ['rememberMe', 'boolean'],
        // password is validated by validatePassword()
        ['password', 'validatePassword'],
    ];
  }

  public function attributeLabels() {
    return [
        'username' => Yii::t('frontend', 'Username'),
        'password' => Yii::t('frontend', 'Password'),
        'rememberMe' => Yii::t('frontend', 'Remember Me'),
    ];
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   */
  public function validatePassword() {
    if (!$this->hasErrors()) {
      $user = $this->getUser();
      if (!$user || !$user->validatePassword($this->password)) {
        $this->addError('password', Yii::t('frontend', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง
                  หรือท่านยังไม่ได้ทำการ Activate บัญชีผู้ใช้นี้ (โปรดตรวจสอบอีเมล์ที่ได้รับจาก e-pretest)'));
        //Incorrect username or password.
      }
    }
  }

  /**
   * Logs in a user using the provided username and password.
   *
   * @return boolean whether the user is logged in successfully
   */
  public function login() {
    if ($this->validate()) {
      $user = $this->getUser();
      if ($user->status == User::STATUS_ACTIVE) {
        if (Yii::$app->user->login($user, $this->rememberMe ? Time::SECONDS_IN_A_MONTH : 0)) {
          return true;
        }
        return false;
      } else {
        throw new MethodNotAllowedHttpException("ผู้ใช้ยังไม่ได้ยืนยันอีเมล์ กรุณาตรวจสอบที่อีเมล์ของท่าน");
      }//The user is not active. Please activate your account
    }
  }

  public function radiusLogin() {
    $user = $this->getOrNewUser();
    if ($user->status == User::STATUS_ACTIVE) {
      if (Yii::$app->user->login($user, $this->rememberMe ? Time::SECONDS_IN_A_MONTH : 0)) {
        return true;
      }
      return false;
    } else {
      throw new MethodNotAllowedHttpException("ผู้ใช้ยังไม่ได้ยืนยันอีเมล์ กรุณาตรวจสอบที่อีเมล์ของท่าน");
    }//The user is not active. Please activate your account
  }

  public function getOrNewUser() {
    $user = User::find()->where(['username' => $this->username])->one();
    if (!empty($user) && isset($user)) {
      return $user;
    } else {
      $signup = new SignupForm();
      $signup->username = $this->username;
      $signup->password = $this->password;
      $signup->email = '';
      $user = $signup->signup();

      return $user;
    }
  }

  /**
   * Finds user by [[username]]
   *
   * @return User|null
   */
  public function getUser() {
    if ($this->user === false) {
      $this->user = User::find()->where(['username' => $this->username])->one();
    }

    return $this->user;
  }

}
