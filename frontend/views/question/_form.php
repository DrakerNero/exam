<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\QuestionPNG;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model frontend\models\Question */
/* @var $form yii\widgets\ActiveForm */
$typeQuestion = (!empty($model->type_question) && isset($model->type_question) && $model->type_question != null) ? $model->type_question : 1;
$maxSelectChoice = (!empty($model->max_select_choice) && isset($model->max_select_choice) && $model->max_select_choice != null) ? $model->max_select_choice : 1;
?>

<div class="question-form">
  <div class="x_panel">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput()->label('ID') ?>    

    <?= $form->field($model, 'part')->textInput(['placeholder' => 'Part'])->label('Part') ?>

    <?=
    $form->field($model, 'question_topic')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'standard'
    ])->label('Topic *')
    ?>

    <?=
    $form->field($model, 'question')->widget(CKEditor::className(), [
        'options' => ['rows' => 4],
        'preset' => 'standard'
    ])->label('Question *')
    ?>

    <?php
    echo ($model->png == 1) ? QuestionPNG::widget(['model' => $model]) : '';
    ?>

    <?= $form->field($model, 'file_upload')->fileInput()->label(false); ?>

    <?=
    $form->field($model, 'type_question')->radioList([1 => 'พื้นฐาน', 2 => 'แต่ละตัวเลือกมีคะแนน'], [
        'class' => 'select-type-question',
    ])->label('เลือกการประเภทคำถาม')
    ?>
    <?php
//    $form->field($model, 'is_mission_tree')->radioList([0 => 'No', 1 => 'Yes'], [
//    ])->label('Mission Tree')
    ?>



    <div class="exam-doctor">
      <div class="row">
        <div class="col-md-4">
          <?= $form->field($model, 'max_select_choice')->textInput(['type' => 'number', 'value' => $maxSelectChoice, 'min' => 1])->label('จำนวนสูงสุดที่เลือกได้') ?>
        </div>
      </div>
    </div>

    <div class="wrapper-choice-input">
      <b>Choice</b>
      <div class="row">
        <div class="col-md-8">
          <div class="input-choice">
            <?= $form->field($model, 'choice_1')->textInput(['placeholder' => 'Choice 1'])->label(false) ?>

            <?= $form->field($model, 'choice_2')->textInput(['placeholder' => 'Choice 2'])->label(false) ?>

            <?= $form->field($model, 'choice_3')->textInput(['placeholder' => 'Choice 3'])->label(false) ?>

            <?= $form->field($model, 'choice_4')->textInput(['placeholder' => 'Choice 4'])->label(false) ?>

            <div class="exam-doctor">

              <?= $form->field($model, 'choice_5')->textInput(['placeholder' => 'Choice 5'])->label(false) ?>

              <?= $form->field($model, 'choice_6')->textInput(['placeholder' => 'Choice 6'])->label(false) ?>

              <?= $form->field($model, 'choice_7')->textInput(['placeholder' => 'Choice 7'])->label(false) ?>

              <?= $form->field($model, 'choice_8')->textInput(['placeholder' => 'Choice 8'])->label(false) ?>

              <?= $form->field($model, 'choice_9')->textInput(['placeholder' => 'Choice 9'])->label(false) ?>

              <?= $form->field($model, 'choice_10')->textInput(['placeholder' => 'Choice 10'])->label(false) ?>

              <?= $form->field($model, 'choice_11')->textInput(['placeholder' => 'Choice 11'])->label(false) ?>

              <?= $form->field($model, 'choice_12')->textInput(['placeholder' => 'Choice 12'])->label(false) ?>

              <?= $form->field($model, 'choice_13')->textInput(['placeholder' => 'Choice 13'])->label(false) ?>

              <?= $form->field($model, 'choice_14')->textInput(['placeholder' => 'Choice 14'])->label(false) ?>

              <?= $form->field($model, 'choice_15')->textInput(['placeholder' => 'Choice 15'])->label(false) ?>

            </div>
          </div>
        </div>
        <div class="col-md-1 exam-doctor">
          <div class="input-choice" style="padding-left: 0;">
            <?= $form->field($model, 'answer_1')->textInput(['placeholder' => 'Answer Score 1'])->label(false) ?>
            <?= $form->field($model, 'answer_2')->textInput(['placeholder' => 'Answer Score 2'])->label(false) ?>
            <?= $form->field($model, 'answer_3')->textInput(['placeholder' => 'Answer Score 3'])->label(false) ?>
            <?= $form->field($model, 'answer_4')->textInput(['placeholder' => 'Answer Score 4'])->label(false) ?>
            <?= $form->field($model, 'answer_5')->textInput(['placeholder' => 'Answer Score 5'])->label(false) ?>
            <?= $form->field($model, 'answer_6')->textInput(['placeholder' => 'Answer Score 6'])->label(false) ?>
            <?= $form->field($model, 'answer_7')->textInput(['placeholder' => 'Answer Score 7'])->label(false) ?>
            <?= $form->field($model, 'answer_8')->textInput(['placeholder' => 'Answer Score 8'])->label(false) ?>
            <?= $form->field($model, 'answer_9')->textInput(['placeholder' => 'Answer Score 9'])->label(false) ?>
            <?= $form->field($model, 'answer_10')->textInput(['placeholder' => 'Answer Score 10'])->label(false) ?>
            <?= $form->field($model, 'answer_11')->textInput(['placeholder' => 'Answer Score 11'])->label(false) ?>
            <?= $form->field($model, 'answer_12')->textInput(['placeholder' => 'Answer Score 12'])->label(false) ?>
            <?= $form->field($model, 'answer_13')->textInput(['placeholder' => 'Answer Score 13'])->label(false) ?>
            <?= $form->field($model, 'answer_14')->textInput(['placeholder' => 'Answer Score 14'])->label(false) ?>
            <?= $form->field($model, 'answer_15')->textInput(['placeholder' => 'Answer Score 15'])->label(false) ?>
          </div>
        </div>
        <?php
        /*
          <div class="col-md-3 exam-mission-tree">
          <div class="input-choice" style="padding-left: 0;">
          <div class="input-tree">
          <?= $form->field($model, 'tree_1')->textInput(['placeholder' => 'Mission Tree Input 1'])->label(false) ?>
          <?= $form->field($model, 'tree_2')->textInput(['placeholder' => 'Mission Tree Input 2'])->label(false) ?>
          <?= $form->field($model, 'tree_3')->textInput(['placeholder' => 'Mission Tree Input 3'])->label(false) ?>
          <?= $form->field($model, 'tree_4')->textInput(['placeholder' => 'Mission Tree Input 4'])->label(false) ?>
          <?= $form->field($model, 'tree_5')->textInput(['placeholder' => 'Mission Tree Input 5'])->label(false) ?>
          <?= $form->field($model, 'tree_6')->textInput(['placeholder' => 'Mission Tree Input 6'])->label(false) ?>
          <?= $form->field($model, 'tree_7')->textInput(['placeholder' => 'Mission Tree Input 7'])->label(false) ?>
          <?= $form->field($model, 'tree_8')->textInput(['placeholder' => 'Mission Tree Input 8'])->label(false) ?>
          <?= $form->field($model, 'tree_9')->textInput(['placeholder' => 'Mission Tree Input 9'])->label(false) ?>
          <?= $form->field($model, 'tree_10')->textInput(['placeholder' => 'Mission Tree Input 10'])->label(false) ?>
          <?= $form->field($model, 'tree_11')->textInput(['placeholder' => 'Mission Tree Input 11'])->label(false) ?>
          <?= $form->field($model, 'tree_12')->textInput(['placeholder' => 'Mission Tree Input 12'])->label(false) ?>
          <?= $form->field($model, 'tree_13')->textInput(['placeholder' => 'Mission Tree Input 13'])->label(false) ?>
          <?= $form->field($model, 'tree_14')->textInput(['placeholder' => 'Mission Tree Input 14'])->label(false) ?>
          <?= $form->field($model, 'tree_15')->textInput(['placeholder' => 'Mission Tree Input 15'])->label(false) ?>

          </div>
          </div>
          </div>
         */
        ?>


      </div>
    </div>

    <div class="row not-exam-doctor">
      <div class="col-lg-4 col-xs-12">
        <?= $form->field($model, 'answer')->textInput(['value' => 0]) ?>
      </div>
    </div>

    <?php // $form->field($model, 'answers')->textarea(['rows' => 6])      ?>

    <?php // $form->field($model, 'answer_score')->textarea(['rows' => 6])    ?>

    <?= $form->field($model, 'answer_detail')->textarea(['rows' => 4]) ?>

    <?php //  $form->field($model, 'mp3')->radioList([0 => 'False', 1 => 'True'])    ?>

    <?php //  $form->field($model, 'png')->radioList([0 => 'False', 1 => 'True'])    ?>

    <?php //  $form->field($model, 'txt')->radioList([0 => 'False', 1 => 'True'])    ?>



    <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>


<a class="form-data-question-type" data-question-type-value="<?= $typeQuestion ?>"></a>