<?php

namespace frontend\widgets;

class ExamMenuLeft extends \yii\bootstrap\Widget {

  public $from;
  public $to;
  public $countQuestion;
  public $questionSet;
  public $disableChoice;
  public $questions;

  public function run() {
    ?>
    <aside class="main-sidebar" id="frameLeftMenu">
      <section class="sidebar">
        <div class="frameClickAnswer">

          <table class="tb-ex-left">
            <tr>
              <td colspan="2" class="tr-ex-head"> จำนวนข้อ : <numQuestion></numQuestion> / <numQuestionAll></numquestionAll></td>
            </tr>
            <tr>
              <td class="td-ex-body">
                <div id="headbarTime">
                  <i class="fa  fa-clock-o"></i>&nbsp;&nbsp;<time>--:--</time>
                </div>
              </td>
              <?php
              if (!$this->disableChoice) {
                ?>
                <td class="btn btn-primary btn-flat btn-block" id="insert-answer"onclick="return SaveState(3)">
                  ส่ง
                </td>
                <?php
              } else {
                null;
              }
              ?>
            </tr>
            <tr>
              <td colspan="2"><br></td>
            </tr>
          </table>
          <div>
            <center><title-ex-left>คะแนนของคุณ</title-ex-left></center>
            <div class="load-score">


            </div>
            <table class="tb2-ex-left">
              <tr>
                <td class="td-ex-body" id="rescore-exam" style="border-right: 1px solid #dcdee3">ทำอีกครั้ง</td>
                <td class="td-ex-body">แชร์</td>
              </tr>
            </table>
          </div>
        </div>
        <div>
          <table class="jump-panel-table">
            <tr>
              <?php
              $i = $this->from;
              $numChoices = 1;
              foreach ($this->questions as $question) {
//              for ($i = $this->questionSet->from; $i <= $this->questionSet->to; $i++) {
                if (($numChoices - 1 ) % 5 == 0) {
                  echo '<tr>';
                }
                ?>
                <td onclick="ScrollOnClick(<?= $question->id ?>)">
                  <div class="examDivBottomMenu" id="name_<?= $question->id ?>"  >
                    <center>
                      <input type="button" id="btnLeftMenu" class="scroll_<?= $question->id ?>" value="<?= $numChoices ?>">
                    </center>
                  </div>
                </td>
                <?php
                $numChoices++;
              }
              ?>
          </table>
        </div>
        <!--</ul>-->
      </section>
    </aside>

    <?php
  }

}
