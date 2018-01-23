<?php

use frontend\models\QuestionSet;
use frontend\widgets\LoadViewQuestion;
use frontend\widgets\HeaderMenuLeft;
use frontend\widgets\HeaderMenuRight;
use frontend\widgets\BottomMenuCenter;

//use frontend\widgets\HeaderBar;
//print_r($model);


$this->title = 'Chula Interactive Medical Case';
$i = 0;
for ($id = $model->from; $id < $model->to; $id++) {
  $i++;
  $question = QuestionSet::LoadQuestion($id);
  echo LoadViewQuestion::widget(['question' => $question, 'countDiv' => $i]);
}
echo HeaderMenuLeft::widget();
echo HeaderMenuRight::widget(['countQuestion' => $i, 'questionSet' => $questionSet]);
echo BottomMenuCenter::widget(['countQuestion' => $i, 'questionSet' => $questionSet]);
?>




<script>
  function ScrollOnClick(scroll) {
    $('html, body').animate({
      scrollTop: $("#scroll_" + scroll).offset().top - 50
    }, 1000);
  }

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



  function HideBottomMenu() {

    $(".examButtonMenu").slideToggle("slow");
    $('.showBottomMenu').hide();
    $('.onclickShowBottomMenu').slideToggle("slow");

  }

  function ShowBottomMenu() {
    $('.onclickShowBottomMenu').hide();
    $('.showBottomMenu').hide();
    $(".examButtonMenu").slideToggle("slow");

    setTimeout(function () {
      $('.showBottomMenu').show();
    }, 1500);
  }



</script>