/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//var presentQuestion = $('.start-exam-2').attr('data-question-present');

$(document).ready(function () {
  var startExam2 = $('.start-exam-2').attr('data-on');

  if (startExam2 !== undefined && startExam2 == 1) {
    renderQuestion();
  }

});

function onClickSaveChoiceExam2() {
//  console.log(questionMasterId + ' ' + questionSetId + ' ' + questionId + ' ' + choice);
  $('.btn-next-present-2').show();


}

function handleClickNextQuestion() {
  $('.btn-next-present-2').hide();
  var presentQuestion = $('.start-exam-2').attr('data-question-present');
  var nextQuestion = parseInt(presentQuestion) + 1;
  for (var i = 1; i <= presentQuestion; i++) {
    $('#wrapper-question2-section-' + i).css("display", "block");
  }

  $('.start-exam-2').attr('data-question-present', nextQuestion);
  renderQuestion(nextQuestion);
  getMultiChoiceSelect(presentQuestion);
}

function getMultiChoiceSelect(presentQuestion) {
  var choices = [];
  var questionMasterId = ('#question-no-' + presentQuestion).attr('data-question-master-id');
  var questionSetId = ('#question-no-' + presentQuestion).attr('data-question-set-id');
  var questionId = ('#question-no-' + presentQuestion).attr('data-question-id');
  
  $("[class^='choice-question-" + presentQuestion + "']").each(function () {
    if ($(this).is(':checked')) {
      choices.push($(this).val());
    } else {

    }
  });
  console.log(choices);
}


function renderQuestion(nextQuestion = null) {
  var totalQuestion = $('.start-exam-2').attr('data-total-question');
  var startQuestionNO = $('.start-exam-2').attr('data-start-question-no');
  var totalRenderQuestion = 1;
  if (nextQuestion === null) {
    totalRenderQuestion = startQuestionNO;
  } else {
    totalRenderQuestion = nextQuestion;
  }

  for (var i = 1; i <= totalRenderQuestion; i++) {
    $('.exam2-question-frame-' + i).show();
  }
}