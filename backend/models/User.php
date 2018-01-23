<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $oauth_client
 * @property string $oauth_client_user_id
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $logged_at
 *
 * @property UserProfile $userProfile
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at', 'logged_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'oauth_client', 'oauth_client_user_id', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'logged_at' => 'Logged At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'id']);
    }
}
