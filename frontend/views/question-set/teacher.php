<?php ?>

<div class="bg-teacher">
  <div class="circle-teacher"></div>
  <div class="wrapper-teacher">
    <div class="teacher-header">
      <img class="teacher-img" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/teacher.png" />
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
        <div class="teacher-detail">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
        </div>
      </div>
    </div>
  </div>
</div>
