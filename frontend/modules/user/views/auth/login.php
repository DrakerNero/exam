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
                <center><b>Chula Account</b></center>
                <?php echo $form->field($model, 'username')->label('Student ID') ?>
                <?php echo $form->field($model, 'password')->passwordInput()->label('Password') ?>
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

    <div class="login-page-link text-center">
      <!--<a href="<?= Url::to(['auth/signup']) ?>">Sign Up</a> |-->
        <a style="color: #1f683a; font-weight: bold;" href="https://userportal.it.chula.ac.th/Login.aspx">>> Forgot password <<</a>
    </div>
</div>

