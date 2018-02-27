<?php

namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\MethodNotAllowedHttpException;

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
    print_r($this);
    if ($this->validate()) {
      echo ' 1 ';
      $user = $this->getUser();
      if ($user->status == User::STATUS_ACTIVE) {
        echo ' 2 ';
        if (Yii::$app->user->login($user, $this->rememberMe ? Time::SECONDS_IN_A_MONTH : 0)) {
          echo ' 3 ';
          return true;
        }
        echo ' 4 ';
        return false;
      } else {
        echo ' 5 ';
        throw new MethodNotAllowedHttpException("ผู้ใช้ยังไม่ได้ยืนยันอีเมล์ กรุณาตรวจสอบที่อีเมล์ของท่าน");
      }//The user is not active. Please activate your account
    } else {
      echo ' 6 ';
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
