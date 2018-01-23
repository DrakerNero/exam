<?php

namespace frontend\widgets;

use yii\helpers\Url;
use yii\helpers\BaseUrl;
use frontend\models\QuestionSet;

class HeaderMenuRight extends \yii\bootstrap\Widget {

  public $from;
  public $to;
  public $countQuestion;
  public $questionSet;
  public $disableChoice;
  public $questions;

  public function run() {
    //$i = 1;
    ?>
    <div class="frameAsideRight">
      <aside id="AsideRight" class="control-sidebar control-sidebar-dark">                
        <div class="tab-content" >
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <?php
            $i = $this->from;
            $numQuestion = 1;
            foreach ($this->questionSet as $questionID) {
              ?>
              <div class="scrollDiv" id="name_<?= $i ?>"  onclick="ScrollOnClick(<?= $i ?>)">
                <center>  
                  <input type="button" id="btnScrollLeft" class="scroll_<?= $i ?>" value="<?= $numQuestion ?>">
                </center>
              </div>

              <?php
              $numQuestion++;
              $i++;
            }
            ?>


          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->

          <!-- Settings tab content -->

        </div>
      </aside><!-- /.control-sidebar -->
    </div>

    <?php
  }

}
