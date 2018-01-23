<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-save-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_set_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?php // $form->field($model, 'question_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
