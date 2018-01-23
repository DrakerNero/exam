<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QuestionSet */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="question-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'subject_id')->textInput() ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'explanation')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'from')->textInput() ?>

    <?php echo $form->field($model, 'to')->textInput() ?>

    <?php echo $form->field($model, 'total_time')->textInput() ?>

    <?php echo $form->field($model, 'total_score')->textInput() ?>

    <?php echo $form->field($model, 'question_type')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'created_at')->textInput() ?>

    <?php echo $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
