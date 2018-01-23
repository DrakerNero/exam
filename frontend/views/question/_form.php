<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">
  <div class="x_panel">


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput()->label('ID') ?>    

    <?= $form->field($model, 'part')->textInput(['placeholder' => 'Part'])->label('Part') ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 4])->label('Topic') ?>


    <?=
    $form->field($model, 'type_question')->radioList([1 => 'พื้นฐาน', 2 => 'แต่ละตัวเลือกมีคะแนน'], [
        'class' => 'select-type-question',
    ])->label('เลือกการประเภทคำถาม')
    ?>



    <div class="exam-doctor">
      <div class="row">
        <div class="col-md-4">
          <?= $form->field($model, 'max_select_choice')->textInput(['type' => 'number', 'value' => 1, 'min' => 1])->label('จำนวนสูงสุดที่เลือกได้') ?>
        </div>
      </div>
    </div>

    <!--    <div class="wrapper-content-type-question-choice">
          <div class="type-input" id="type-1">
            <div class="wrapper-input" id="choice-input-1">
              <div class="row">
                <div class="col-md-1">
                  <div class="question-choice-label">Test</div>
                </div>
                <div class="col-md-11">
                  <div class="question-choice-input">
    <?php // $form->field($model, 'choice_1')->textInput()->label(false)     ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->

    <div class="wrapper-choice-input">
      <b>Choice</b>
      <div class="row">
        <div class="col-md-10">
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
        <div class="col-md-2 exam-doctor">
          <div class="input-choice" style="padding-left: 0;">
            <?= $form->field($model, 'answer_1')->textInput(['placeholder' => 'Answer Score 1', ['value' => 0]])->label(false) ?>

            <?= $form->field($model, 'answer_2')->textInput(['placeholder' => 'Answer Score 2', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_3')->textInput(['placeholder' => 'Answer Score 3', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_4')->textInput(['placeholder' => 'Answer Score 4', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_5')->textInput(['placeholder' => 'Answer Score 5', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_6')->textInput(['placeholder' => 'Answer Score 6', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_7')->textInput(['placeholder' => 'Answer Score 7', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_8')->textInput(['placeholder' => 'Answer Score 8', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_9')->textInput(['placeholder' => 'Answer Score 9', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_10')->textInput(['placeholder' => 'Answer Score 10', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_11')->textInput(['placeholder' => 'Answer Score 11', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_12')->textInput(['placeholder' => 'Answer Score 12', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_13')->textInput(['placeholder' => 'Answer Score 13', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_14')->textInput(['placeholder' => 'Answer Score 14', ['value' => 0]])->label(false) ?>
            <?= $form->field($model, 'answer_15')->textInput(['placeholder' => 'Answer Score 15', ['value' => 0]])->label(false) ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row not-exam-doctor">
      <div class="col-lg-4 col-xs-12">
        <?= $form->field($model, 'answer')->textInput(['value' => 0]) ?>
      </div>
    </div>

    <?php // $form->field($model, 'answers')->textarea(['rows' => 6])     ?>

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