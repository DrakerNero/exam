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
    $iconName = 'ic-1.png';
    $colorClass = 'wsq-gray';
    $heager_subject = "bg-green";
    if ($this->models != null) {
      $month = 2;
      $dateEndNew = $month * (2592000); // 2592000 => 1 เดือน
      foreach ($this->models as $model) {
        $dataSubject = Subjectwidget::getStatusSubject($user_id, $model->questionSaves);
        if ((!empty($dataSubject['status']) && isset($dataSubject['status'])) || (!empty($dataSubject['score']) && isset($dataSubject['score']))) {
          if ($dataSubject['score'] >= 80) {
            $iconName = 'ic-3.png';
            $colorClass = 'wsq-green';
          } else if ($dataSubject['status'] == 1 || $dataSubject['status'] = 3) {
            $iconName = 'ic-2.png';
            $colorClass = 'wsq-orange';
          } else {
            $iconName = 'ic-1.png';
            $colorClass = 'wsq-gray';
          }
        } else {
          $iconName = 'ic-1.png';
          $colorClass = 'wsq-gray';
        }
        ?>       
        <a href="<?= Url::to(['question-set/teacher', 'id' => $model->id]) ?>" onmouseover="ShowOtherData(<?= $model->id ?>)" onmouseout="NotShowOtherData(<?= $model->id ?>)">
          <div class="col-md-4">
            <div class="wrapper-select-question <?= $colorClass ?>">
              <div class="flex-select-question">
                <div class="left">
                  <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/static/<?= $iconName ?>" alt="" />
                </div>
                <div class="right">
                  <?= $model->name ?>
                </div>
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
    ?>
    <!--    <div class="col-md-4">
          <div class="wrapper-select-question wsq-green">
            <div class="flex-select-question">
              <div class="left">
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/static/ic-3.png" alt="" />
              </div>
              <div class="right">
                MODULE 5 (DOUCTOR EXAM : INTERACTIVE 5)
              </div>
            </div>
          </div>
        </div>-->
    <?php
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
