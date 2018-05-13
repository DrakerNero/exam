<?php

namespace frontend\widgets;

use yii\web\View;

class LoadQuestionSave extends \yii\bootstrap\Widget {

  public $status;
  public $questionSave;
  public $isAdmin = false;

  public function run() {

    $i = 0;
    if (!is_null($this->questionSave->answer)) {
      $arraySaves = array();
      $arraySaves = json_decode($this->questionSave->answer);
      foreach ($arraySaves as $save) {
        ?>
        <?php
        if (!empty($this->questionSave->multi_select_choice) && isset($this->questionSave->multi_select_choice) && $this->questionSave->multi_select_choice == 1) {
          $multiSelectChoice = json_decode($save->value);
          $js = "
              autoSelectChoice('" . $save->key . "','" . implode(",", $multiSelectChoice) . "');
              $('.scroll_" . $save->key . "').css({'background': '#3c8dbc', 'color': '#fff'});
              ";
        } else {
          $js = "
                    $(function () {
                        $('#radio_" . $save->key . "_" . $save->value . "').prop('checked', true);
                        $('.scroll_" . $save->key . "').css({'background': '#3c8dbc', 'color': '#fff'});
                            
                    });
                        ";
        }
        //
        $this->view->registerJs($js, View::POS_READY);
        $i++;
      }
    }
    if ($this->questionSave->status == 3 || $this->isAdmin == true) {
      $jsLoadAns = "
                    ShowAnswer();
                    ";
      $this->view->registerJs($jsLoadAns, View::POS_END);
//      
    } else {
      
    }
    ?>
    <a class="count-select-question" data-id="<?= $i ?>"></a>
    <a class="question-save-id" data-id="<?= $this->questionSave->id ?>"></a>
    <a class="question-save-status" data-id="<?= $this->questionSave->status ?>"></a>
    <?php
  }

}
