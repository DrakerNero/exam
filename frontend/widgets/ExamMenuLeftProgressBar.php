<?php

namespace frontend\widgets;

use yii\helpers\Url;

class ExamMenuLeftProgressBar extends \yii\bootstrap\Widget {

  public $from;
  public $to;
  public $countQuestion;
  public $questionSet;
  public $disableChoice;
  public $questions;
  public $questionSave;

  public function run() {
    ?>

    <aside class="main-sidebar" id="frameLeftMenu">
      <section class="sidebar">

        <div class="frameClickAnswer">


          <table class="tb-ex-left">
            <tr>
              <td class="td-ex-body">
                <div id="headbarTime" style="padding-bottom: 20px;">
                  <i class="fa  fa-clock-o"></i>&nbsp;&nbsp;<time>--:--</time>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="tr-ex-head" style="padding-bottom: 0"> <numQuestion></numQuestion> / <numQuestionAll></numquestionAll></td>
            </tr>
          </table>

          <div>
            <center><title-ex-left>Score</title-ex-left></center>
            <div class="load-score"></div>
            <table class="tb2-ex-left">
              <tr class="board-option">
                <td class="td-ex-body" style="border-right: 1px solid #dcdee3">
                  <h6 style="font-weight: bold;">คะแนนของท่านไม่ผ่านเกณฑ์</h6>
                  <h6 style="font-size: 11px !important">
                    กลับสู่หน้าหลัก | ทำข้อสอบอีกครับ
                  </h6>
                  <table style="width: 100%">
                    <tr>
                      <td style="width: 50%"><a href="<?= Url::home(); ?>">Home <i class="fa fa-home"><i/></a></td>
                      <td id="rescore-exam" style="border-right: 1px solid #dcdee3; width: 50%;">Restart  &nbsp;&nbsp;<i class="fa fa-repeat"></i>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr class="board-success" style="display: none;">
                <td>
                  <h6 style="font-weight: bold;">ยินดีด้วยคุณผ่านข้อสอบชุดนี้แล้ว</h6>
                  <table style="width: 100%">
                    <tr>
                      <td style="text-align: center"><a href="<?= Url::home(); ?>"><i class="fa fa-home"><i/>กลับสู่หน้าหลัก</a></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          <?php
          if ($this->questionSave->status == 1) {
            ?>
            <div class="progress" style="margin-bottom: 0; margin-top: 20px;">
              <div id="exam-progress-bar" class="progress-bar progress-bar-striped active" style="width: 1%; background-color: #2bb12b;">

              </div>
            </div>



            <?php
          } else {
            
          }
          ?>
        </div>
        <!--</ul>-->
      </section>
    </aside>

    <?php
  }

}
