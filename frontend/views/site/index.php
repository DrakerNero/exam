<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\widgets\Subjectwidget;
use frontend\widgets\HeaderMenuLeft;

$this->title = 'Chula Interactive Medical Case';
?>
<?php
Pjax::begin();
if (!empty($models)) {
  ?>
  <div class="col-lg-8 guide">
    <div class="box guide-box">
      <div class="col-md-4"><i class="btn bg-green"></i><span> Success</span></div>
      <div class="col-md-4"><i class="btn bg-orange"></i><span> Doing</span></div>
      <div class="col-md-4"><i class="btn bg-aqua"></i><span> Blank</span></div>
      <br><br>
    </div>
  </div>
  <?php
}
if ($countPage >= 2) {
  ?>
  <div class="col-md-12 ">
    <nav >
      <ul class="pagination">
        <?php
        for ($i = 1; $i <= ceil($countPage); $i++) {
          ?>
          <li><a href="<?= Yii::$app->urlManager->createUrl(['site/index', 'subject_id' => $subject_id, 'page' => $i]) ?>"><?= $i ?></a></li>   
        <?php } ?>
      </ul>
    </nav>
  </div>
<?php } ?>
<?= Subjectwidget::widget(['models' => $models]) ?>
<?php Pjax::end(); ?>


