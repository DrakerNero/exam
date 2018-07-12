<?php

use frontend\widgets\ExamMenuLeftProgressBar;
?>

<?= ExamMenuLeftProgressBar::widget([ 'questionSave' => $questionSave]) ?>


<?php

echo '<pre>';
$i = 0;
foreach ($questionMasters as $questionMaster) {
  foreach ($questionMaster['questions'] as $question) {
    $model = (object) $question;
    echo $model->id;
  }
  $i++;
}
?>

