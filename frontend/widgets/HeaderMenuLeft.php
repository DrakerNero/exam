<?php

namespace frontend\widgets;

use Yii;
use yii\widgets\Pjax;
use yii\helpers\Html;
use frontend\models\Subject;
use frontend\models\QuestionSet;
use frontend\models\QuestionSave;

class HeaderMenuLeft extends \yii\bootstrap\Widget {

  public $countQuestion;

  public function renderCountMenu($data) {
    return (!empty($data) && isset($data) && $data != null) ? '(' . $data . ')' : '';
  }

  public function handleActiveMenu($str) {
    return ($_SERVER['REQUEST_URI'] == $str) ? 'class="active"' : '';
  }

  public function run() {
    echo $_SERVER['REQUEST_URI'];
    echo '888';
    $user = Yii::$app->user->identity;
    $countQuestionSuccess = 0;
    $arrQuestionSuccess = [];
    $arrQuestionDoing = [];
    $successUnique = [];
    $questionDoingUnique = [];
    $questionNotDoing = 0;
    $countQuestionAll = [];
    $countQuestionPass = [];
    $countQuestionNots = [];
    if (!empty($user) && isset($user) && $user != null) {
      $countQuestionAll = QuestionSet::find()->where(['status' => 1])->count();
      $countQuestionPass = QuestionSave::find()->where(['user_id' => $user->id])->andWhere(['>=', 'score', '80'])->all();
      $countQuestionNots = QuestionSave::find()->where(['user_id' => $user->id])->andWhere(['<', 'score', '80'])->all();
      foreach ($countQuestionPass as $countQuestion) {
        array_push($arrQuestionSuccess, $countQuestion->question_set_id);
        $countQuestionSuccess++;
      }
      foreach ($countQuestionNots as $countQuestionNot) {
        array_push($arrQuestionDoing, $countQuestionNot->question_set_id);
      }
      $successUnique = array_unique($arrQuestionSuccess);
      $questionDoingUnique = array_unique($arrQuestionDoing);
      $questionNotDoing = $countQuestionAll - (sizeof(array_diff($questionDoingUnique, $successUnique)) + sizeof($successUnique));
    } else {
      
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
                <li <?= $this->handleActiveMenu('/site/index?subject_id=all') ?>>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/index', 'subject_id' => 'all']) ?>" >
                        <h6> All<?= $this->renderCountMenu($countQuestionAll) ?></h6>
                    </a>                            
                </li>
                <li <?= $this->handleActiveMenu('/site/exam-success-page') ?>>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-success-page']) ?>" >
                        <h6> Passed<?= $this->renderCountMenu(sizeof($successUnique)) ?></h6>
                    </a>                            
                </li>
                <li <?= $this->handleActiveMenu('/site/exam-doing-page') ?>>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-doing-page']) ?>" >
                        <h6> Doing <?= $this->renderCountMenu(sizeof(array_diff($questionDoingUnique, $successUnique))) ?></h6>
                    </a>                            
                </li>
                <li <?= $this->handleActiveMenu('/site/exam-not-do-page') ?>>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/exam-not-do-page']) ?>" >
                        <h6> Not Doing <?= $this->renderCountMenu($questionNotDoing) ?></h6>
                    </a>                            
                </li>
                </li>
            </ul>
        </section>                
    </aside>

    <?php
  }

}
