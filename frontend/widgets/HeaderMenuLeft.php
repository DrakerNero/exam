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
          <?php
          $i = 0;
          foreach ($exam_arr as $key) {
            ?>
            <li>
              <a href="#" onclick="ShowOtherMenu(<?= $i ?>)">
                <span><h6><?= $key ?></h6></span>
                <i class="fa fa-angle-left pull-right" ></i>
              </a>
              <div style="display:none;" id="menu<?= $i ?>">
                <?php
                $model = Subject::find()->where(['exam_class' => $key, 'status' => 1])->all();
                foreach ($model as $key => $value) {
                  $questionSet = QuestionSet::find()->where(['subject_id' => $value->id])->all();
                  ?>
                  <ul class="list-menu" title="<?= $value->exam_subclass ?>">                           
                    <li>
                      <a href="<?= Yii::$app->urlManager->createUrl(['site/index', 'subject_id' => $value->id]) ?>" >
                        <i class="fa fa-angle-double-right"></i><span><?= $value->exam_subclass ?> (<?= sizeof($questionSet) ?>)</span>
                      </a>
                    </li>
                  </ul>
                <?php } ?>
              </div>
              <?php
              $i++;
            }
            ?>
          </li>
        </ul>
      </section>                
    </aside>

    <?php
  }

}
