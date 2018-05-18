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
<div class="row" id="wrapper-module-exam">
  <?= Subjectwidget::widget(['models' => $models]) ?>
</div>
<?php Pjax::end(); ?>



<!-- Modal -->
<div class="modal fade title-modal-exam" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false"     >
  <div class="modal-dialog col-md-12 date-modal" role="document" style="">
    <div class="modal-content" style="border-radius: 3px;">
      <div class="modal-body" style="padding: 30px;">
        CU Interactive Medical Cases are designed for 6th year medical student <br />
        practicing crucial management in Medicine. <br />
        You were a doctor at a primary care hospital. Two random cases form <br />
        each module would be your patients. You have 10 minutes to take care<br />
        each of them. Your score will depend on the impact of your decision.<br />
        Your patients would be defined as safe if you could manage them<br />
        properly over 80%.<br />
        Please be honest with yourself and make the most of this simulation.<br />
      </div>
    </div>
  </div>
</div>

<a id="check-popup-open" data-popup="<?= $popup ?>"></a>


