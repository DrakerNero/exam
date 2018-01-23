<?php

namespace frontend\widgets;

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;
use frontend\widgets\QuestionAudio;
use frontend\widgets\QuestionPNG;
use frontend\widgets\AnswerQuestion;

class LoadViewQuestion extends \yii\bootstrap\Widget {

  public $question;
  public $countDiv;
  public $questionSetID;
  public $countQuestion;
  public $modelQuestion;

  public function run() {
    $name = $this->countDiv;
    $idPart = (!empty($this->question->part) || isset($this->question->part)) ? 'frame-question-section-' . $this->question->part : '';
    $multiChoice = (!empty($this->question->max_select_choice) && isset($this->question->max_select_choice)) ? true : false;
    ?>
    <div class="frame-exam " id="<?= $idPart ?>" >
      <div  class="col-md-10" disabled>
        <div id="render-question-no-<?= $this->countQuestion ?>">
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

                  <h3 class="box-title">

                    <?= $this->countQuestion . '. ' ?><?= nl2br($this->question['question']) ?>
                  </h3>
                </div>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="col-sm-12">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >

                    <?php
                    if (is_array($this->question) || is_object($this->question)) {
                      $choices = json_decode($this->question->choices, true);
                      $answers = json_decode($this->question->answers, true);
                      $qid = $this->question->id;
                      $i = 0;
                      $myContent = "";
                      if (is_array($choices) || is_object($choices)) {
                        foreach ($choices as $key => $value) {
                          $i++;
                          echo $myContent;
                          $IDradio = "radio_" . $qid . "_" . $i;
                          if (!empty($key)) {
                            if ($this->question->type_question == 2 && $answers[$key] == '') {
                              
                            } else {
                              ?>
                              <input
                                data-id="<?= $this->question->id ?>"
                                onclick="autoCheckSideLeftBar(<?= $this->questionSetID ?>,<?= $this->countDiv; ?>,<?= $i ?>, <?= $this->question->part ?>)" 
                                id="<?= Html::encode($IDradio) ?>" 
                                name="name_<?= Html::encode($this->countDiv) ?>"
                                value="<?= $i ?>" 
                                <?= ($multiChoice) ? 'type="checkbox"' : 'type="radio"' ?>
                                <?= ($multiChoice) ? 'class="choice-question-' . $this->question->id . '"' : '' ?>
                                style="display: none;"
                                >
                              <label id="inputRadio"  for="<?= Html::encode($IDradio) ?>" ><?php echo $key . ".  " . $value ?>  </label>
                              <?php
                              ?>
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
                if ($this->modelQuestion->question_type == 2) {
                  
                } else {

                  echo AnswerQuestion::widget(['name' => $name, 'question' => $this->question, 'multiChoice' => $multiChoice]);
                }
                ?>

                <div class="wrapper-not-choice" id="wrapper-question-section-<?= $this->countQuestion ?>"></div>

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
