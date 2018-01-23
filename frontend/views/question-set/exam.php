<?php

use frontend\widgets\LoadViewQuestion;
use frontend\widgets\ExamMenuLeft;
use frontend\widgets\ExamMenuLeftProgressBar;
use frontend\widgets\HeaderMenuRight;
use frontend\widgets\BottomMenuCenter;
use frontend\widgets\LoadQuestionSave;
use yii\web\View;

$this->title = $model->subject->exam_class . ' > ' . $model->subject->exam_subclass . ' > ' . $model->name;
$disableChoice = (isset($disableChoice) && !empty($disableChoice)) ? $disableChoice : false;

if (isset($onAdmin) && !empty($onAdmin) && $onAdmin == true) {
//  $stringScript = "$('.wrapper-disable-click-choice').hide();";
  $stringScript = "adminTrue();";
} else {
  $stringScript = "hidingSectionPart('" . $doPart . "');"
          . "adminFalse();"
  ;
}
?>
<?= ($disableChoice) ? '<div class="wrapper-disable-click-choice"></div>' : '' ?>


<?php
if ($model->explanation != '') {
  ?>
  <div class="frame-exam">
    <div class="col-md-10" >
      <div class="box box-primary" id="explanation-exam">
        <?= $model->explanation ?>
      </div>
    </div>
  </div>
  <?php
}
?>

<?php
$i = 0;
$countKey = 0;
$arrQuestionPart = [];
$getKeyArrQuestionPart = [];
foreach ($questions as $question) {
  $i++;
  $arrQuestionPart[$question->part] = $i;
  if (!empty($question)) {

    echo LoadViewQuestion::widget(['question' => $question, 'countDiv' => $question->id, 'questionSetID' => $model->id, 'countQuestion' => $i, 'modelQuestion' => $model]);
  }
}

foreach ($arrQuestionPart as $key => $value) {
  $getKeyArrQuestionPart[$countKey] = $key;
  $countKey++;
}

$newQuestionPart = array_values($arrQuestionPart);

echo HeaderMenuRight::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to, 'disableChoice' => $disableChoice, 'questions' => $questions]);
echo BottomMenuCenter::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to, 'disableChoice' => $disableChoice, 'questions' => $questions]);



$js = "   
        $('numQuestionAll').text('" . $i . "');
        $('numQuestion').text('0');
        display = document.querySelector('time');
        displayM = document.querySelector('time-m');
        countDown(" . ($model->total_time * 60 - $questionSave->elapse_time) . ",display, displayM);
        $stringScript
        renderProgressBar();
         ";
if (!$disableChoice) {
  $this->registerJs($js, View::POS_END);
} else {
  null;
}
?>
<?php
if ($questionSave->status == 1) {
  ?>
  <div class="col-md-10">
    <center>
      <button 
        class="btn-next-present" 
        id="btn-next-question"
        <?= ($questionSave->answer == '') ? 'style="display: none"' : '' ?>
        >
        Next
      </button>

      <div class="wrapper-send-exam">
        <a href="javascript:;" id="insert-answer btn-send-exam" onclick="return SaveState(3)" class="btn-big-red">SEND</a> 
      </div>

    </center>
    <br />
    <br />
  </div>
  <?php
} else {
  
}
?>

<script>
  function insertChoicesToHeadbar() {
    var numChoices = 0;
    for (var i = <?= $model->from ?>; i <= <?= $model->to ?>; i++) {
      var checkValue = $('input[name="name_' + i + '"]');
      if ($('input[name="name_' + i + '"]').is(':checked')) {
        numChoices++;
      }
    }
    $('numQuestion').text(numChoices);
  }


</script>
<br><br>


<?= LoadQuestionSave::widget(['questionSave' => $questionSave]); ?>
<?= ExamMenuLeftProgressBar::widget(['countQuestion' => $i, 'from' => $model->from, 'to' => $model->to, 'questionSet' => $model, 'disableChoice' => $disableChoice, 'questions' => $questions, 'questionSave' => $questionSave]) ?>
<a class="question-from" data-id="<?= $model->from ?>"></a>
<a class="question-to" data-id="<?= $model->to ?>"></a>
<a class="question-set-id" data-id="<?= $model->id ?>"></a>
<a class="question-type" data-id="<?= $model->question_type ?>"></a>
<a class="question-save" data-id="<?= $questionSave->id ?>" ></a>
<a class="doing-question-section" data-present-question="<?= $questionSave->present_question ?>" data-question-last="<?= $newQuestionPart[0] ?>" data-key-part="<?= $getKeyArrQuestionPart[1] ?>" data-render-=""></a>
<a class="max-question-data" data-max="<?= sizeof($questions) ?>"></a>
<a class="is-multi-select-choice" data-multi="<?= (!empty($model->multi_select_choice) && isset($model->multi_select_choice)) ? $model->multi_select_choice : '0' ?>"></a>
<?php
if ($disableChoice) {
  ?>
  <script>
    //    $('#insert-answer').css("background-color", "yellow");
    document.getElementById('insert-answer').style.display = 'none';
  </script>

  <?php
} else {
  
}

//print_r($arrQuestionPart);
?>
<div class="wrapper-restart-temporary">
  <button id="btn-restart-temporary" >Restart</button>
</div>
