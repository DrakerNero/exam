<?php

namespace frontend\widgets;

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use frontend\widgets\QuestionAudio;
use frontend\widgets\QuestionPNG;
use frontend\widgets\AnswerQuestion;

class LoadViewQuestion2 extends \yii\bootstrap\Widget {

  public $question;
  public $countDiv;
  public $questionSetID;
  public $countQuestion;
  public $modelQuestion;
  public $questionNumber;
  public $isAdmin = false;
  public $marginTop;
  public $isNewCase;

  public function run() {
    $name = $this->countDiv;
    $idPart = (!empty($this->question->part) || isset($this->question->part)) ? 'frame-question-section-' . $this->question->part : '';
    $multiChoice = (!empty($this->question->max_select_choice) && isset($this->question->max_select_choice)) ? true : false;
    $jumpType = '';
    $jumpConstraint = '';
    $jumpScore = '';
    $jumpConstraintTrue = '';
    $jumpConstraintFalse = '';
    if (!empty($this->question->type_question) && isset($this->question->type_question) && $this->question->type_question == 3 && $this->question->jump_json != null) {
      $jumpJson = json_decode($this->question->jump_json);
      $jumpChoices = json_decode($this->question->jump_choices);
      $answers = json_decode($this->question->answers, true);

      $jumpType = $jumpJson->jump_type;
      $jumpConstraint = $jumpJson->jump_constraint;
      $jumpScore = $jumpJson->jump_score;
      $jumpConstraintTrue = $jumpJson->jump_constraint_true;
      $jumpConstraintFalse = $jumpJson->jump_constraint_false;

      $countChoice = 1;

      foreach ($jumpChoices as $jumpChoice) {
        if ($jumpChoice != '') {
          ?>
          <a class="jump-question-<?= $this->question->id ?>-<?= $countChoice ?>" data-score="<?= (!empty($answers[$countChoice - 1]) && isset($answers[$countChoice - 1])) ? $answers[$countChoice - 1] : '' ?>" data-jump-question="<?= $jumpChoice ?>"></a>

          <?php
        } else {
          
        }
        $countChoice++;
      }
    } else {
      
    }
    ?>
    <div class="frame-exam " id="<?= $idPart ?>"  >
      <a 
        class="no-question-data-<?= $this->countQuestion ?>" 
        id="no-question-data-question-id-<?= $this->question->id ?>"
        data-question-id="<?= $this->question->id ?>"
        data-question-type="<?= $this->question->type_question ?>"
        data-jump-type="<?= $jumpType ?>"
        data-jump-constraint="<?= $jumpConstraint ?>"
        data-jump-score="<?= $jumpScore ?>"
        data-jump-constraint-true="<?= $jumpConstraintTrue ?>"
        data-jump-constraint-false="<?= $jumpConstraintFalse ?>"
        ></a>
      <div  class="col-md-10" disabled>
        <div id="render-question-no-<?= $this->countQuestion ?>" class="question-id-<?= $this->question->id ?>" style="<?= $this->marginTop ?>">
          <?php
          if ($this->isNewCase == true) {
            ?>

            <div class="box box-primary" id="explanation-exam">
              <h5 style="font-weight: bold">Case <?= $this->questionNumber ?> </h5>
            </div>

            <?php
          }
          ?>
          <div class="frameExam" id="scroll_<?= $this->countDiv; ?>">
            <div class="box box-solid">
              <div class="box-header with-border" id="frameHeader">
                <div class="headerExam">
                  <div style="position: relative" class="edit-question-on-exam">
                    <a style="position: absolute; z-index: 100; color: #3F51B5; font-size: 25px; border-radius: 3px; padding: 5px;"
                       target="_blank" href="<?= Url::to(['question/update', 'id' => $this->question->id]) ?>"><i class="fa fa-pencil"></i>

                    </a>
                    <br>
                    <br>
                  </div>
                  <?php
                  echo ($this->question->mp3 == 1) ? QuestionAudio::widget(['model' => $this->question]) : '';
                  echo ($this->question->png == 1) ? QuestionPNG::widget(['model' => $this->question]) : '';
                  ?>

                  <h3 class="box-title" id="not-p">
                    <?= (!empty($this->question->question_topic) && isset($this->question->question_topic) && $this->question->question_topic != '') ? nl2br($this->question->question_topic) . '<br /><br />' : '' ?>
                    <table>
                      <tr>
                        <td><?= $this->questionNumber ?> &nbsp;&nbsp;</td>
                        <td><?= nl2br($this->question->question) ?></td>
                      </tr>
                    </table>
                  </h3>
                </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="col-sm-12">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
                    <div class="wrapper-not-choice" id="wrapper-question-section-<?= $this->countQuestion ?>"></div>

                    <?php
                    if (is_array($this->question) || is_object($this->question)) {
                      $choices = json_decode($this->question->choices, true);
                      $answers = json_decode($this->question->answers, true);
                      $qid = $this->question->id;
                      $i = 0;
                      if (is_array($choices) || is_object($choices)) {
                        foreach ($choices as $key => $value) {
                          $i++;
                          $IDradio = "radio_" . $qid . "_" . $i;
                          if (!empty($key)) {
                            if (($this->question->type_question == 2 || $this->question->type_question == 3) && $answers[$key] == '') {
                              
                            } else {
                              ?>
                              <input
                                data-id="<?= $this->question->id ?>"
                                onclick="autoCheckSideLeftBar(<?= $this->questionSetID ?>,<?= $this->countDiv; ?>,<?= $i ?>, <?= $this->question->part ?>)" 
                                id="<?= Html::encode($IDradio) ?>" 
                                name="name_<?= Html::encode($this->countDiv) ?>"
                                value="<?= $i ?>" 
                                class="radio-preset-<?= $this->countDiv ?> <?= ($multiChoice) ? 'choice-question-' . $this->question->id : '' ?>"
                                <?= ($multiChoice) ? 'type="checkbox"' : 'type="radio"' ?>

                                style="display: none;"
                                >
                              <label id="inputRadio"  for="<?= Html::encode($IDradio) ?>" ><?php echo $key . ".  " . $value ?>  <?= ($this->isAdmin == true) ? '&nbsp;&nbsp; [ ' . $answers[$key] . ' ]' : '' ?>  </label>
                              <?php ?>
                              <br>
                              <?php
                            }
                          }
                        }
                      }
                    }
                    ?>
                  </div>
                </div>
                <div id="qa-<?= $this->countDiv ?>" data-id="<?= $this->question->answer ?>"></div>
                <?php
                if ($this->modelQuestion->question_type == 3) {
                  
                } else if ($this->modelQuestion->question_type == 2) {
                  
                } else {

                  echo AnswerQuestion::widget(['name' => $name, 'question' => $this->question, 'multiChoice' => $multiChoice]);
                }
                ?>

                                                                                                <!--<div class="wrapper-not-choice" id="wrapper-question-section-<?= $this->countQuestion ?>"></div>-->

              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div>
      </div>
      <?php
      if (!empty($this->question->max_select_choice) && isset($this->question->max_select_choice)) {
        $stringAnswer = '';
        for ($i2 = 1; $i2 <= $i; $i2++) {
          if ($answers[$i2] != '') {
            ?>
            <a id="answer-point-<?= $this->question->id . '-' . $i2 ?>" data-point="<?= $answers[$i2] ?>"></a>
            <?php
          } else {
            
          }
        }
        ?>
        <a class="max-select-choice-question-<?= $this->question->id ?>" data-max-choice="<?= $this->question->max_select_choice ?>"></a>

        <?php
      }
      ?>
    </div>
    <?php
  }

}
