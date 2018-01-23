<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'question_topic') ?>

    <?= $form->field($model, 'type_question') ?>

    <?php // $form->field($model, 'choices_1') ?>

    <?php // echo $form->field($model, 'choices_2') ?>

    <?php // echo $form->field($model, 'choices_3') ?>

    <?php // echo $form->field($model, 'choices_4') ?>

    <?php // echo $form->field($model, 'choices_5') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'answer_detail') ?>

    <?php // echo $form->field($model, 'mp3') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'txt') ?>

    <?php // echo $form->field($model, 'created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
