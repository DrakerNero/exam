<?php

namespace frontend\widgets;

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
              <tr>
                <td class="td-ex-body" id="rescore-exam" style="border-right: 1px solid #dcdee3">Restart  &nbsp;&nbsp;<i class="fa fa-repeat"></i></td>
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
