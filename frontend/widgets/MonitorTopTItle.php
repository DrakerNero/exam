<?php

namespace frontend\widgets;

use frontend\models\QuestionSet;
use yii\web\View;

class MonitorTopTItle extends \yii\bootstrap\Widget {

  public $icon;
  public $count;
  public $topic;
  public $detail;

  public function run() {
    ?>
    <div class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="tile-stats">
        <div class="icon"><i class="fa <?= $this->icon ?>"></i></div>
        <div class="count"><?= $this->count ?></div>
        <h3><?= $this->topic ?></h3>
        <p><?= $this->detail ?></p>
      </div>
    </div>
    <?php
  }

}
