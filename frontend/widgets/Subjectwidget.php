<?php

namespace frontend\widgets;

use Yii;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;

class Subjectwidget extends \yii\bootstrap\Widget {

  public $models;

  public function run() {

    function QuestionUrl($model) {
      $arrUrl = [
          1 => Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->id]),
          2 => Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->id]),
//                2 => Yii::$app->urlManager->createUrl(['question-set/scholarship-exam', 'questionSetId' => $model->id ]),
          3 => Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->id]),
          4 => Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->id]),
      ];
      return $arrUrl[$model->question_type];
    }

    if (empty(Yii::$app->user->identity->id)) {
      $user_id = 0;
    } else {
      $user_id = Yii::$app->user->identity->id;
    }
    ?>        
    <script type="text/javascript">
      function ShowOtherData(id) {
        document.getElementById(id).style.display = 'block';
      }
      function NotShowOtherData(id) {
        document.getElementById(id).style.display = 'none';
      }
    </script>
    <?php
    if ($this->models != null) {
      $month = 2;
      $dateEndNew = $month * (2592000); // 2592000 => 1 เดือน
      foreach ($this->models as $model) {
        $dataSubject = Subjectwidget::getStatusSubject($user_id, $model->questionSaves);
        if ((!empty($dataSubject['status']) && isset($dataSubject['status'])) ||(!empty($dataSubject['score']) && isset($dataSubject['score']))) {
          if ($dataSubject['score'] >= 80) {
            $heager_subject = "bg-green";
          } else if ($dataSubject['status'] == 1 || $dataSubject['status'] = 3) {
            $heager_subject = "bg-orange";
          } else {
            $heager_subject = "bg-aqua";
          }
        } else {
          $heager_subject = "bg-aqua";
        }
        ?>       
        <a href="<?= Url::to(['question-set/teacher', 'id' => $model->id]) ?>" onmouseover="ShowOtherData(<?= $model->id ?>)" onmouseout="NotShowOtherData(<?= $model->id ?>)">
          <div class="col-md-4">
            <div class="info-box subject">
              <span class="header-box <?= $heager_subject ?>" >
                <div class="subject-new">
                  <?php
                  if (date("Y/m/d") <= date("Y/m/d", $model->created_at + $dateEndNew)) {
                    ?>
                    <img src="<?= Url::to('@frontendUrl/uploads/images/new.png') ?>" />
                  <?php } ?>

                </div> 
                <div class="logo-subject">
                  <img class="img-exam-cover" style="height: 50px; margin-top: 5px;" src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/exam.png" />
                </div> 
              </span>
              <div class="info-box show-data">
                <span class="info-box-text"><?= $model->subject->exam_subclass ?>(<?= $model->subject->exam_class ?> : <?= $model->name ?>) </span>
                <span class="other" id="<?= $model->id ?>"><?= $model->total_score ?>  ข้อ <?= $model->total_time ?> นาที </span>
              </div>
            </div>
          </div>
        </a>
        <?php
      }
    } else {
      ?>
      <div class="comingsoon"> 
        <img src="<?= Url::to('@frontendUrl/uploads/images/comingsoon.png') ?>"/>
      </div>

      <?php
    }
  }

  private function getStatusSubject($user_id, $models) {
    $arr = [];
    if (empty($models)) {
      return 0;
    } else {
      $arr['status'] = 0;
      foreach ($models as $value) {
        if ($value->user_id == $user_id) {
          $arr['status'] = $value->status;
          $arr['score'] = $value->score;
        }
      }
      return $arr;
    }
  }

}
