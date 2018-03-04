<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('frontend', 'Log In');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
  <div class="login-logo">
    <img src="<?= Yii::$app->urlManager->baseUrl . '/uploads/static/logo-2.png' ?>" alt="">
  </div><!-- /.login-logo -->
  <div class="header"></div>
  <div class="wrapper-login-box">

    <div class="login-box-body">
      <?php
      $form = ActiveForm::begin([
                  'id' => 'login-form',
      ]);
      ?>
      <div class="body">
        <?php echo $form->field($model, 'username')->label('ล็อคอินเข้าระบบทำข้อสอบโดยใช้แอคเคาท์ภายในจุฬา') ?>
        <?php echo $form->field($model, 'password')->passwordInput()->label('รหัสผ่าน') ?>
        <?php echo $form->field($model, 'rememberMe')->checkbox(['class' => 'simple']) ?>
      </div>
      <div class="login-box-footer">
        <?php
        echo Html::submitButton(Yii::t('backend', 'Log me in'), [
            'class' => 'btn btn-primary btn-flat btn-block',
            'name' => 'login-button'
        ])
        ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>

  <!--    <div class="login-page-link text-center">
        <a href="<?= Url::to(['auth/signup']) ?>">Sign Up</a> |
        <a href="<?= Url::to(['auth/request-password-reset']) ?>">Forgot password</a>
      </div>-->
</div>

