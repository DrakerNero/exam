<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\LoginForm */

$this->title = Yii::t('frontend', 'Request password reset');
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'login-page';
?>
<div class="login-box">
    <div class="login-logo">
        <?php echo Html::encode($this->title) ?>
    </div><!-- /.login-logo -->
    <div class="header"></div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <div class="body">
            <?php echo $form->field($model, 'username') ?>
        </div>
        <div class="login-box-footer">
            <?php echo Html::submitButton(Yii::t('frontend', 'Send'), [
                'class' => 'btn btn-primary',
            ]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
