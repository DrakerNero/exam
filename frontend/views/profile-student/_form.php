<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileStudent */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="x_content">
  <div class="row">
    <div class="col-sm-8">
      <div class="profile-student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id')->textInput(['maxlength' => true]) ?>
        <div class="row">
          <div class="col-lg-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-lg-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <?= $form->field($model, 'start_study')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-lg-6">
            <?= $form->field($model, 'rotation')->textInput(['maxlength' => true]) ?>
          </div>
        </div>

        <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
</div>
