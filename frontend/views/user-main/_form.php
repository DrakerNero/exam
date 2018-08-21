<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\helpers\MainHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserMain */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
      <div class="user-main-form">
        <br />
        <h3>Student ID: <?= $model->username; ?></h3>
        <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'start_study')->textInput(['maxlength' => true])->label('Academic Year') ?>

        <?= $form->field($model, 'rotation')->dropDownList(MainHelper::setLotation()) ?>

        <?= $form->field($model, 'status')->dropDownList([1 => 'Active', 0 => 'Inactive']) ?>

        <div class="form-group">
          <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>
</div>
