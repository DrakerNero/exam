<?php

namespace frontend\widgets;

use Yii;
use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\models\Subject;
use frontend\models\QuestionSet;

class HeaderMenuLeft extends \yii\bootstrap\Widget {

  public $countQuestion;

  public function run() {
    $subjects = Subject::find()->where(['status' => 1])->all();
    $exam_arr = [];
    foreach ($subjects as $subject) {
      if (!in_array($subject->exam_class, $exam_arr)) {
        $exam_arr[] = $subject->exam_class;
      }
    }
    ?>     

    <script type="text/javascript">
      function ShowOtherMenu(key) {
        var id = 'menu' + key;
        if (document.getElementById(id).style.display == 'none') {
          document.getElementById(id).style.display = 'block';
        } else {
          document.getElementById(id).style.display = 'none';
        }
      }
    </script>

    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu">
          <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/index', 'subject_id' => 'all']) ?>" >
              <h6> All</h6>
            </a>                            
          </li>
          <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-success-page']) ?>" >
              <h6> Passed</h6>
            </a>                            
          </li>
          <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-doing-page']) ?>" >
              <h6> Doing</h6>
            </a>                            
          </li>
          <li>
            <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-not-do-page']) ?>" >
              <h6> Not done</h6>
            </a>                            
          </li>
          </li>
        </ul>
      </section>                
    </aside>

    <?php
  }

}
