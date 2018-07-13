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
      ]);
    } else {
      
    }
    $conutQuestionWithModule++;
  }
  $modulePart++;
}
?>

