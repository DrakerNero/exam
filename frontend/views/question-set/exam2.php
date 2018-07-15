<?php

use frontend\widgets\ExamMenuLeftProgressBar;
use frontend\widgets\LoadViewQuestion2;
?>

<?= ExamMenuLeftProgressBar::widget([ 'questionSave' => $questionSave]) ?>


<?php
$i = 0;
$conutQuestionWithModule = 1;
$modulePart = 1;
foreach ($models as $model) {
  $questionSet = (object) $model['questionSet'];
  foreach ($model['questions'] as $question) {
    $model = (object) $question;
    $marginTop = '';
    $i++;
    $arrQuestionPart[$model->part] = $i;
//  $modulePart = (!empty($modulePart) && isset($modulePart) && $modulePart)

    if (!empty($model)) {
      echo LoadViewQuestion2::widget([
          'question' => $model,
          'countDiv' => $model->id,
          'questionSetID' => $questionSet->id,
          'countQuestion' => $i,
          'questionNumber' => $modulePart . '.' . $conutQuestionWithModule,
          'modelQuestion' => $questionSet,
          'isAdmin' => false,
          'marginTop' => $marginTop,
          'questionMasterId' => $questionMaster->id,
          'count' => $conutQuestionWithModule,
      ]);
    } else {
      
    }
    $conutQuestionWithModule++;
  }
  $modulePart++;
}
?>
<div class="col-md-10" style="text-align: center; margin: 20px 0 50px 0;">
  <button class="btn-exam2-next btn-next-present-2" onclick="handleClickNextQuestion();" style="display: none;">
    Next
  </button>
</div>
<a class="start-exam-2" data-on="1" data-total-question="<?= $conutQuestionWithModule ?>" data-start-question-no="1" data-question-present="1"></a>