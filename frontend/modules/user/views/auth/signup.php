<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('frontend', 'Sign Up');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username', [
              'inputOptions'=>[
                'placeholder'=>'Enter your email'
                ]]) ?>
            <?php echo $form->field($model, 'password', [
              'inputOptions'=>[
                'placeholder'=>'Password'
              ]])
              ->passwordInput()
              ->hint('password must longer than 6 characters') ?>
            <?php echo $form->field($model, 'confirm_password',[
              'inputOptions'=>[
                'placeholder'=>'Re-enter password'
              ]])
              ->passwordInput() ?>
        </div>
        <div class="login-box-footer">
            <?php echo Html::submitButton(Yii::t('frontend', 'Sign Up'), [
                'class' => 'btn btn-primary',
                'name' => 'signup-button'
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="login-page-link text-center">
      Already has account?<a href="<?= Url::to(['auth/login']) ?>"> Log in</a>
    </div>
</div>
