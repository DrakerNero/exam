<?php

namespace frontend\widgets;

use frontend\models\QuestionSet;
use yii\web\View;

class AnswerQuestion extends \yii\bootstrap\Widget {

  public $name;
  public $question;
  public $multiChoice;

  public function run() {
    ?>

    <div class="col-sm-12">
      <div id="showAnswer" class="class_<?= $this->name ?>">
        <?php
        if ($this->multiChoice == true) {
          
        } else {
          ?>
          &nbsp;&nbsp;&nbsp;<b>คำต้องที่ถูกต้อง : <?= $this->question->answer ?> </b><br>
          <?php
        }
        ?>
        <?= nl2br($this->question->answer_detail) ?>
      </div>
    </div>

    <?php
  }

}
