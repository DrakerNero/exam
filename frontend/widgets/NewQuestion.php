<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\QuestionSet;
class NewQuestion extends \yii\bootstrap\Widget
{
    public function run()
    {
      ?>        
       <script type="text/javascript">
          function ShowOtherData(id){
             document.getElementById(id).style.display = 'block';
          }
          function NotShowOtherData(id){
             document.getElementById(id).style.display = 'none';
          }
       </script>
<?php
      $models = QuestionSet::find()->all();
      if($models!= null)
      {
        $month =2;
        $dateEndNew = $month *(2592000); // 2592000 => 1 เดือน
       foreach ($models as $model)
       {
        if(date("Y/m/d")<=date("Y/m/d", $model->created_at+$dateEndNew)){
        $i = $model->subject_id;
        ?>       
         <a href="<?=Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->id])?>" title="<?=$model->subject->exam_subclass?>(<?=$model->subject->exam_class?> : <?=$model->name?>)" onmouseover="ShowOtherData(<?=$model->id?>)" onmouseout="NotShowOtherData(<?=$model->id?>)">
            <div class="col-md-4">
              <div class="info-box subject">
                <span class="header-box bg-aqua" >
                  <div class="subject-new">
                    <img src="<?= Url::to('@frontendUrl/uploads/images/new.png') ?>" />
                  </div> 
                  <div class="logo-subject">
                    <img src="<?= Url::to('@frontendUrl/uploads/images/'.ereg_replace('[[:space:]]+', '', trim($model->subject->exam_class)).'.png') ?>" />
                  </div> 
                </span>
               <div class="info-box show-data">
                  <span class="info-box-text"><?=$model->subject->exam_subclass?>(<?=$model->subject->exam_class?> : <?=$model->name?>)</span>
                  <span class="other" id="<?=$model->id?>"><?=$model->total_score?>  ข้อ <?=$model->total_time ?> นาที</span>
                </div>
              </div>
             </div>
          </a>
        <?php
          }
        }
      } 
    }

}
