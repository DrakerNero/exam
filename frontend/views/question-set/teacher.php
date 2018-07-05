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
        <div class="teacher-detail" style="text-align: center; font-size: 20px; margin-top: 20px;">
          คะแนนของผู้ป่วยจำลองนี้ไม่มีผลต่อการตัดเกรด <br />
          สำคัญคือคุณหมอต้องถามตัวเองว่า รู้หรือไม่รู้ จะออกไปรักษาผู้คนได้จริงหรือไม่ <br />
          แค่ลอกคำตอบตามกันให้ผ่านอาจทำให้คุณหมอเสียเวลาเปล่า <br />
        </div>
      </div>
    </div>
  </div>
</div>
