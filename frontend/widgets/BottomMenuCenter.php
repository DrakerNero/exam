<?php

namespace frontend\widgets;

use frontend\models\QuestionSet;
use yii\web\View;

class BottomMenuCenter extends \yii\bootstrap\Widget {

  public $from;
  public $to;
  public $countQuestion;
  public $questionSet;
  public $disableChoice;
  public $questions;

  public function run() {
    ?>
    <div class="jump-panel collapse">

      <!--<div class="jump-panel-toggle">^</div>-->
      <div class="jump-panel-toggle"><time-m></time-m><score-m></score-m></div>
      <div class="jump-panel-table-wrapper">
        <!--                <div class="jump-panel-title" id="insert-answer">ส่ง</div>-->
        <table class="jump-panel-table">

          <tr>
            <?php
            $numChoices = 1;
//    $i = $this->from;
            foreach ($this->questions as $question) {
//    for ($i = $this->questionSet->from; $i <= $this->questionSet->to; $i++) {
//              $question = QuestionSet::LoadQuestion($i);
              if (($numChoices - 1 ) % 5 == 0) {
                echo '<tr>';
              }
              ?>
              <td onclick="ScrollOnClick(<?= $question->id ?>)">
                <div class="examDivBottonMenu text-center" id="name_<?= $question->id ?>"  >
                  <input type="button" class="question scroll_<?= $question->id ?>" value="<?= $numChoices ?>">
                </div>
              </td>

              <?php
              $numChoices++;
            }
            ?>
        </table>
      </div>
    </div>

    <?php
//    $this->view->registerJs('$(".jump-panel-toggle").click(function(){
//          $(".jump-panel").toggleClass("collapse");
//        });', VIEW::POS_READY);
  }

}
