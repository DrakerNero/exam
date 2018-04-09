<?php

use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\widgets\SubjectwidgetWithQuestionSave;
use frontend\widgets\HeaderMenuLeft;
use yii\helpers\Url;

$this->title = 'Chula Interactive Medical Case';
?>
<div id="w0">
  <?php
  foreach ($models as $model) {
    ?>

    <a href="<?= Url::to(['question-set/teacher', 'id' => (!empty($notDo) && isset($notDo) && $notDo == true) ? $model->id : $model->questionSet->id]) ?>" onmouseover="ShowOtherData(<?= $model->id ?>)" onmouseout="NotShowOtherData(<?= $model->id ?>)">
      <div class="col-md-4">
        <div class="wrapper-select-question <?= $colorClass ?>">
          <div class="flex-select-question">
            <div class="left">
              <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/static/<?= $iconName ?>" alt="" />
            </div>
            <div class="right">
              <?= (!empty($notDo) && isset($notDo) && $notDo == true) ? $model->name : $model->questionSet->name ?>
            </div>
          </div>
        </div>
      </div>
    </a>

    <?php
  }
  ?>
</div>
<!--Modal -->
<div class = "modal fade" id = "exampleModal" tabindex = "-1" role = "dialog" aria-labelledby = "exampleModalLabel" aria-hidden = "false" >
  <div class = "modal-dialog col-md-12" role = "document" style = "color: #d53c31; font-weight: bold; text-align: center; font-size: 20px; width: 750px; left: 50%;
       transform: translate(-50%, 20%);">
    <div class = "modal-content" style = "border-radius: 3px;">
      <div class = "modal-body" style = "padding: 30px;">
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

<a id = "check-popup-open" data-popup = "<?= $popup ?>"></a>