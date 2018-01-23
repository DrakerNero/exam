<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubjectSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="subject-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'exam_class') ?>

    <?php echo $form->field($model, 'exam_subclass') ?>

    <?php echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
