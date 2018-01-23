<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSet */
/* @var $form yii\widgets\ActiveForm */
$model->select_question_type = 1;
echo $model->id;
?>

<div class="question-set-form">
  <div class="x_panel">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explanation')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'subject_id')->textInput(['type' => 'number']) ?>

    <?php
//    $form->field($model, 'select_question_type')->radioList(
//            [
//        1 => 'From - To',
//        2 => 'comma style (,)'
//            ], [
//        'class' => 'btn-select-question-type',
//            ]
//    )
    ?>

    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Question From </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <?= $form->field($model, 'from')->textInput(['maxlength' => true])->label(false) ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Question To </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <?= $form->field($model, 'to')->textInput(['maxlength' => true])->label(false) ?>
          </div>
        </div>
      </div>
    </div>

    <?= $form->field($model, 'total_time')->textInput()->label('Total Time (นาที)') ?>

    <?= $form->field($model, 'total_score')->textInput() ?>

    <?php //  $form->field($model, 'question_type')->dropDownList([1 => '1', 2 => '2']) ?>

    <?= $form->field($model, 'status')->dropDownList([ '1' => 'Active', '0' => 'Inactive',], ['prompt' => '']) ?>

    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>

</div>
