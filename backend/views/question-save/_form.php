<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSave */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="question-save-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'question_set_id')->textInput() ?>

    <?php echo $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'score')->textInput() ?>

    <?php echo $form->field($model, 'elapse_time')->textInput() ?>

    <?php echo $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
