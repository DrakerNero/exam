<?php

?>

<div class="wrapper-teacher">
  <div class="teacher-header">
    <img class="teacher-img" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/teacher.jpg" />
  </div>
  <div class="teacher-body">
    <div class="teacher-body-content">
      <a class="button-teacher" href="<?= Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $id]) ?>" role="button">
        <span>Start</span>
        <div class="icon">
          <i class="fa fa-caret-square-o-right"></i>
          <!--<i class="fa fa-check"></i>-->
        </div>
      </a>
    </div>
  </div>
</div>
