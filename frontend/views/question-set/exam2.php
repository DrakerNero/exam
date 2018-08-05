<?php

use frontend\widgets\LoadViewQuestion2;
use frontend\widgets\ExamMenuLeftProgressBar;
use frontend\widgets\HeaderMenuRight;
use frontend\widgets\BottomMenuCenter;
use frontend\widgets\LoadQuestionSave;
use yii\web\View;

$this->title = $model->name;
$disableChoice = (isset($disableChoice) && !empty($disableChoice)) ? $disableChoice : false;

if (isset($isAdmin) && !empty($isAdmin) && $isAdmin == true) {
//  $stringScript = "$('.wrapper-disable-click-choice').hide();";
//  echo $questionSave->module_part;
  $questionSaveParts = $questionSave->module_part;
//  $test = json_encode($test);
  $stringScript = "adminTrue(); ";
} else {
  $stringScript = ""
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
        <h5 style="font-weight: bold">Case 1 </h5>
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
$modulePart = '';
$checkModulePart = '';
$conutQuestionWithModule = 1;
foreach ($questions as $question) {
  $marginTop = '';
  $isNewCase = false;
  $i++;
  $arrQuestionPart[$question->part] = $i;
//  $modulePart = (!empty($modulePart) && isset($modulePart) && $modulePart)
  if (isset($modulePart) && $modulePart == '') {
    $modulePart = 1;
    $checkModulePart = $question->part;
  } else if ($checkModulePart != $question->part) {
    $isNewCase = true;
    $marginTop = 'margin-top: 100px !important;';
    $modulePart = $modulePart + 1;
    $checkModulePart = $question->part;
    $conutQuestionWithModule = 1;
  } else {
    
  }
  if (!empty($question)) {
    echo LoadViewQuestion2::widget([
        'question' => $question,
        'countDiv' => $question->id,
        'questionSetID' => $model->id,
        'countQuestion' => $i,
        'questionNumber' => $modulePart . '.' . $conutQuestionWithModule,
        'modelQuestion' => $model,
        'isAdmin' => $isAdmin,
        'marginTop' => $marginTop,
        'isNewCase' => $isNewCase
    ]);
  } else {
    
  }
  $conutQuestionWithModule++;
}

foreach ($arrQuestionPart as $key => $value) {
  $getKeyArrQuestionPart[$countKey] = $key;
  $countKey++;
}

$newQuestionPart = array_values($arrQuestionPart);

echo HeaderMenuRight::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to, 'disableChoice' => $disableChoice, 'questions' => $questions]);
echo BottomMenuCenter::widget(['countQuestion' => $i, 'questionSet' => $model, 'from' => $model->from, 'to' => $model->to, 'disableChoice' => $disableChoice, 'questions' => $questions]);

$elapseTime = (!empty($questionSave->elapse_time) && isset($questionSave->elapse_time)) ? $questionSave->elapse_time : 0;

$js = "   
        $('numQuestionAll').text('" . $i . "');
        $('numQuestion').text('0');
        display = document.querySelector('time');
        displayM = document.querySelector('time-m');
        countDown(" . ($model->total_time * 60 - $elapseTime) . ",display, displayM);
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
        <?= ((!empty($questionSave->answer) && isset($questionSave->answer) && $questionSave->answer == '' ) || $model->mode == 2) ? 'style="display: none"' : '' ?>
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


<?php
if ($questionSave->status > 1) {
  echo LoadQuestionSave::widget(['questionSave' => $questionSave, 'isAdmin' => $isAdmin]);
} else if ($model->mode == 1) {
//  echo LoadQuestionSave::widget(['questionSave' => $questionSave, 'isAdmin' => $isAdmin]);
} else {
  
}
?>
<?= ExamMenuLeftProgressBar::widget(['countQuestion' => $i, 'from' => $model->from, 'to' => $model->to, 'questionSet' => $model, 'disableChoice' => $disableChoice, 'questions' => $questions, 'questionSave' => $questionSave]) ?>
<a class="question-from" data-id="<?= $model->from ?>"></a>
<a class="question-to" data-id="<?= $model->to ?>"></a>
<a class="question-set-id" data-id="<?= $model->id ?>"></a>
<a class="question-type" data-id="<?= $model->question_type ?>"></a>
<a class="question-set-mode" data-mode="<?= $model->mode ?>"></a>
<a class="max-question-data" data-max="<?= sizeof($questions) ?>"></a>
<a class="is-multi-select-choice" data-multi="<?= (!empty($model->multi_select_choice) && isset($model->multi_select_choice)) ? $model->multi_select_choice : '0' ?>"></a>
<a class="render-force-question-id" data-id=""></a>
<a class="question-save" data-id="<?= $questionSave->id ?>" ></a>
<a class="question-save-status" data-id="<?= $questionSave->status ?>" ></a>
<a class="question-save-score" data-id="<?= $questionSave->score ?>"></a>
<?php
if ($model->mode == 2 && $isAdmin == true) {
  
} else if ($model->mode == 2) {
  ?>
  <a class="doing-question-section" data-present-question="1" ></a>
  <?php
} else if ($model->mode == 1) {
  ?>
  <a class="doing-question-section" data-present-question="<?= $questionSave->present_question ?>" data-question-last="<?= $newQuestionPart[0] ?>" data-key-part="<?= $getKeyArrQuestionPart[1] ?>" data-render=""></a>
  <?php
} else {
  
}
?>
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


?>
  
<div class="over-img" style="text-align: center; display: none;">
  <img src="<?= Yii::$app->getUrlManager()->getBaseUrl() ?>/uploads/static/over.jpg" />
</div>