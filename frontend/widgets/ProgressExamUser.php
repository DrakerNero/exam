<?php

namespace frontend\widgets;

use frontend\models\QuestionSave;
use yii\web\View;

class ProgressExamUser extends \yii\bootstrap\Widget {

  public $questionSet;
  public $userId;

  public function run() {
    $questionSet = $this->questionSet;
    $questionSaves = QuestionSave::find()->where(['question_set_id' => $questionSet->id, 'user_id' => $this->userId])->orderBy(['id' => SORT_DESC])->all();
//$
    $score = 0;
    foreach ($questionSaves as $questionSave) {
      if (!empty($questionSave->score) && isset($questionSave->score) && $questionSave->score > $score) {
        $score = $questionSave->score;
      } else {
        
      }
    }
//    $score = (!empty($questionSave->score) && isset($questionSave->score) && $questionSave->score > 0) ? $questionSave->score : 0;
    ?>

    <p><?= $questionSet->name ?></p>
    <div class="progress progress_sm" title="<?= $questionSet->name . ' ' . $score . '%' ?>">
      <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?= $score ?>" aria-valuenow="<?= $score - 1 ?>" ></div>
    </div>
    <?php
  }

}
