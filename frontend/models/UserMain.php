<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $oauth_client
 * @property string $oauth_client_user_id
 * @property string $email
 * @property int $status
 * @property int $user_status 1: admin,  0 or null user
 * @property int $created_at
 * @property int $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $student_id
 * @property string $start_study ปีที่เข้ารับการศึกษา
 * @property int $rotation กลุ่มเรียน
 * @property string $support_password
 * @property int $logged_at
 *
 * @property UserProfile $userProfile
 */
class UserMain extends \yii\db\ActiveRecord {

  /**
   * {@inheritdoc}
   */
  public static function tableName() {
    return 'user';
  }

  /**
   * {@inheritdoc}
   */
  public function rules() {
    return [
        [['auth_key', 'password_hash', 'email', 'user_status'], 'required'],
        [['status', 'user_status', 'created_at', 'updated_at', 'rotation', 'logged_at'], 'integer'],
        [['username', 'auth_key'], 'string', 'max' => 32],
        [['password_hash', 'password_reset_token', 'oauth_client', 'oauth_client_user_id', 'email'], 'string', 'max' => 255],
        [['first_name', 'last_name'], 'string', 'max' => 100],
        [['student_id', 'start_study', 'support_password'], 'string', 'max' => 20],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels() {
    return [
        'id' => 'ID',
        'username' => 'Username',
        'auth_key' => 'Auth Key',
        'password_hash' => 'Password Hash',
        'password_reset_token' => 'Password Reset Token',
        'oauth_client' => 'Oauth Client',
        'oauth_client_user_id' => 'Oauth Client User ID',
        'email' => 'Email',
        'status' => 'Status',
        'user_status' => 'User Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'student_id' => 'Student ID',
        'start_study' => 'Start Study',
        'rotation' => 'Rotation',
        'support_password' => 'Support Password',
        'logged_at' => 'Logged At',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUserProfile() {
    return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
  }

  public function getRotation() {
    return $this->hasOne(Rotation::className(), ['rotation' => 'id']);
  }

}
