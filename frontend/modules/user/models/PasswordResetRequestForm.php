<?php
namespace frontend\modules\user\models;

use common\commands\command\SendEmailCommand;
use Yii;
use common\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'email'],
            ['username', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'ไม่มีผู้ใช้นี้ในระบบ
หรือท่านยังไม่ได้ทำการ Activate บัญชีผู้ใช้นี้ (โปรดตรวจสอบอีเมล์ที่ได้รับจาก e-pretest.com)',
                //'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $this->username,
        ]);

        if ($user) {
            $user->generatePasswordResetToken();
            if ($user->save()) {
                return Yii::$app->commandBus->handle(new SendEmailCommand([
                    'from' => [Yii::$app->params['adminEmail'] => Yii::$app->name],
                    'to' => $this->username,
                    'subject' => Yii::t('frontend', 'Password reset for {name}', ['name'=>Yii::$app->name]),
                    'view' => 'passwordResetToken',
                    'params' => ['user' => $user]
                ]));
            }
        }

        return false;
    }

    public function attributeLabels()
    {
        return [
            'username'=>Yii::t('frontend', 'E-mail')
        ];
    }
}
