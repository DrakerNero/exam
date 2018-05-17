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
          CU Interactive Medical Cases are designed for 6th year medical student
          practicing crucial management in Medicine.
          You were a doctor at a primary care hospital. Two random cases form 
          each module would be your patients. You have 10 minutes to take care
          each of them. Your score will depend on the impact of your decision.
          Your patients would be defined as safe if you could manage them
          properly over 80%.
          Please be honest with yourself and make the most of this simulation.
        </div>
      </div>
    </div>
  </div>
</div>
