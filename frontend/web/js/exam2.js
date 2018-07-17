var csrfToken = $('meta[name="csrf-token"]').attr("content");
var dataMultiChoice = $('.is-multi-select-choice').attr('data-multi');
var multiChoice = (dataMultiChoice == 1) ? true : false;
var questionSetMode = $('.question-set-mode').attr('data-mode'); // 1: ปกติ,  2: มีข้อกระโดด
var questionFrom = $('.question-from').attr('data-id');
var questionTo = $('.question-to').attr('data-id');
var questionSaveStatus = $('.question-save-status').attr('data-id');
var questionSaveScore = $('.question-save-score').attr('data-id');

var percentPass = 80;

function InsertQuestion(from, to) {
  var value = $('#SSAnswer').val();
  var questionType = $('.question-type').attr('data-id');
  var answer = value.split(',');
  var numLoop = 0;
  var agree = 0;
  for (var i = from; i <= to; i++) {
    var question = $('input:radio[name="name_' + i + '"]:checked').val();
    if (question) {
      // alert(answer[0]);

      if (question === answer[numLoop]) {
//                alert(answer[numLoop]);
        numLoop++;
        $('.class_' + i).css({"background-color": "#00A65A", "color": "#fff"});
        $('.class_' + i).show();
        agree++;

      } else {
        $('.class_' + i).css({"background-color": "#DD4B39", "color": "#fff"});

        $('.class_' + i).show();
      }
      $('.loadScore').text(agree);

    }

  }
//  $('.frameClickAnswer').css('height', '300px');
}

function autoCheckSideLeftBar(subjectId, questionId, choices, part) {
  var checkInput = $('input[name="name_' + questionId + '"]:checked').val();
  var maxChoice = $('.max-select-choice-question-' + questionId).attr('data-max-choice');

  if (checkInput !== null) {
    $('.scroll_' + questionId).css({"background": "#3c8dbc", "color": "#fff"});
    insertChoicesToHeadbar();
    if (maxChoice !== undefined && maxChoice !== '' && maxChoice > 0) {
      if (questionSetMode == 2) {
        $('.btn-next-present').show();

      } else {
        clickSaveMultiChoice(questionId, part);

      }
    } else {
      ClickSave(questionId, choices);
    }
  } else {

  }
  $('.btn-next-present').show();
  renderProgressBar();
}
function clickSaveMultiChoice(questionId, part) {
  var choices = [];
  $("[class^='choice-question-" + questionId + "']").each(function () {
    if ($(this).is(':checked')) {
      choices.push($(this).val());
    } else {

    }
  });

  ClickSave(questionId, choices, part);
}

function ClickSave(questionId, choices, part) {
  var questionSaveId = $('.question-save-id').attr('data-id');
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    type: "POST",
//    url: "../../question-save/click-save",
    url: "index.php?r=question-save/click-save",
    data: ({
      questionSaveId: questionSaveId,
      questionId: questionId,
      choices: choices,
      multiChoice: multiChoice,
      part: part,
      _csrf: csrfToken
    }),
    success: function (data) {
    },
    error: function (data) {
      console.log("ไม่มีการส่งข้อมูล" + questionSaveId);
    }
  });
}

function ScrollOnClick(scroll) {
  $('html, body').animate({
    scrollTop: $("#scroll_" + scroll).offset().top - 50
  }, 1000);
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

function LoadAnswer(value) {
  var answer = $('#SSAnswer').val();
  answer = answer + value + ',';
  $('#SSAnswer').val(answer);
//    alert();

}

function countDown(duration, display1, display2) {
  var timer = duration, minutes, seconds;
  var myCountDown = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display1.textContent = minutes + ":" + seconds;
    display2.textContent = minutes + ":" + seconds;
    var questionSaveStatus = $('.question-save-status').attr('data-id');
    if (timer < 300) {
      //display.css("color","red");
    }
    if (--timer < 0 || questionSaveStatus == 3) {
//            alert("หมดเวลาทำข้อสอบแล้วคะ");
      clearInterval(myCountDown);
      ShowAnswer();
    }
  }, 1000);
}

$(window).load(function () {

  $('#rescore-exam').click(function () {
    Rescore('');
  });
  $('#btn-restart-temporary').click(function () {
    Rescore('index.php?r=question-save/rescore-all-status');
  });
  $('.div-rescore-exam-mobile').click(function () {
    Rescore('');
  });
  $('numQuestion').html($('.count-select-question').attr('data-id'));
});


function ShowTitleAnswer(point, questionType) {
  var questionType = $('.question-type').attr('data-id');
  if (point === 100) {
    return '!! คุณนี้มันอัจฉริยะโดยแท้ เราไม่ได้เห็นคะแนนเต็มมานานแล้ว ขอให้ตั้งใจต่อไป...';
  } else if (point > 89 && point <= 99) {
    return 'นี้มันคะแนนเทพเลยนะขอบอก คะแนนนี้มันบอกถึงความตั้งใจจริงและศักยภาพของคุณ...';
  } else if (point > 79 && point <= 89) {
    return 'คุณนี้มันสุดยอดมาก อีกแค่นิดเดียวเองพยายามให้มากว่านี้นะ...';
  } else if (point > 69 && point <= 79) {
    return 'เรารู้ว่าคุณตั้งใจ และความตั้งใจของคุณมันใกล้ที่จะสัมฤทธิ์ผลแล้ว พยายามต่อไปน่ะ...';
  } else if (point > 59 && point <= 69) {
    return 'คุณนี้ก็ใช้ได้นะ เรารู้ว่าคุณต้องเป็นอัจฉริยะในอนาคตอันใกล้...';
  } else if (point > 49 && point <= 59) {
    return 'ถึงคะแนนคุณได้ไม่มากเท่าไหร่ แต่สมาธิคุณก็เพิ่มขึ้นมากเลยทีเดียว...';
  } else if (point > 39 && point <= 49) {
    return 'คุณยังต้องฝึกอีกหน่อยนะ ไม่เป็นไรเราจะเป็นตัวช่วยคุณให้เป็นอัจฉริยะเอง...';
  } else if (point > 29 && point <= 39) {
    return 'ถึงคะแนนจะออกมาไม่สวยเท่าไหร่ แต่ถ้าคุณมีความตั้งใจ อะไรๆมันก็จะดีขึ้น สู้ๆ';
  } else if (point > 19 && point <= 29) {
    return 'อืมมมม เชื่อไหมเมื่อก่อนเราก็เคย แต่แล้ววันร้ายๆ ก็ผ่านไป คุณทำได้';
  } else if (point <= 19) {
    return 'คุณมาถูกทางแล้ว ถึงวันนี้จะไม่ใช่วันของคุณ แต่เราจะทำให้คุณเป็นอัจฉริยะได้แน่นอน...';
  }
}


function renderScoreBoard(score, totalScore) {
  var title = '';
  var percent = (100 * score) / totalScore;
  percent = (percent <= 0) ? 0 : percent;
  if (percent >= 80) {
    title = 'ยินดีด้วยท่านผ่านเกณฑ์ 80% ของข้อสอบชุดนี้';
  } else {
    title = 'ท่านไม่ผ่านเกณฑ์คะแนนขั้นต่ำ กรุณากดปุ่ม Reset เพื่อทำใหม่อีกครั้ง';

  }
  $('.td-ex-body>h6').text(title);
  $('.load-score').html(percent.toFixed(0) + "% <br>");

  return percent.toFixed(0);
}

function handleQuestionSetJumpModeSaveScore() {
  var questionIds = [];
  var totalScore = 0;
  var myScore = 0;
  var questionSelectChoices = [];
  var stringSelectChoice = '';
  for (var i = questionFrom; i <= questionTo; i++) {
    var check = $("input[name^='name_" + i + "']").is(':checked');
    if (check != undefined && check == 1) {
      questionIds.push(i);
    } else {

    }
  }
  console.log(questionIds);
  questionIds.forEach(function (questionId) {
    var selectChoices = [];
    var stringChoice = '';
    var maxSelectChoice = $('.max-select-choice-question-' + questionId).attr('data-max-choice');
    var maxScoreQuestion = 0;
    for (var i2 = 1; i2 <= 15; i2++) {
      var getScoreChoice = $('#answer-point-' + questionId + '-' + i2).attr('data-point');
      var getSelectChoice = $('#radio_' + questionId + '_' + i2 + ':checked');
      var scoreChoice = 0;
      if (getSelectChoice.val() != undefined) { // รวมคะแนนจาก choice ที่เราเลือก
        myScore = myScore + parseInt(getScoreChoice);

        selectChoices.push(i2);
        stringChoice = (stringChoice === '') ? '' + i2 : stringChoice + ',' + i2;
      } else {

      }
      if (getScoreChoice > 0) { // รวมคะแนนสูงสูด
        if (maxSelectChoice == 1) {
          maxScoreQuestion = (parseInt(getScoreChoice) > maxScoreQuestion) ? parseInt(getScoreChoice) : maxScoreQuestion;
        } else {
          totalScore = totalScore + parseInt(getScoreChoice);
        }
      } else {
        //
      }
    }
    totalScore = totalScore + maxScoreQuestion;
    stringSelectChoice = (stringSelectChoice === '') ? '' + questionId + ',' + stringChoice : stringSelectChoice + '&' + questionId + ',' + stringChoice;
    questionSelectChoices[questionId] = selectChoices;

  });


  var finishScore = renderScoreBoard(myScore, totalScore);
  console.log(finishScore);
  postSaveExam(finishScore, stringSelectChoice);
}

function postSaveExam(score, stringSelectChoice) {
  var questionSaveId = $('.question-save').attr('data-id');
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    type: "POST",
    url: "index.php?r=question-save/handle-post-submit-exam",
    cache: false,
    data: ({
      stringSelectChoice: stringSelectChoice,
      questionSaveId: questionSaveId,
      score: score,
      _csrf: csrfToken
    }),
    success: function (data) {
//      location.reload();
    },
    error: function (data) {
      return "ไม่มีการส่งข้อมูล";
    }
  });
}

function SaveState(state) {
  $('.wrapper-send-exam').remove();
  if (questionSetMode == 2) {
    if (state == 2) {
      if (confirm('ข้อสอบชุดนี้จะไม่บันทึกการเลือกข้อสอบ คุณต้องออกจากการทำข้อสอบ?')) {
        return true;
      } else {
        return false;
      }
    } else if (state == 3) {
      handleQuestionSetJumpModeSaveScore();

    } else {

    }
  } else {
    var questionSaveStatus = $('.question-save-status').attr('data-id');
    var questionType = $('.question-type').attr('data-id');
    if (questionSaveStatus == 3) {
      return true;
    } else if (state == 2) {
      if (confirm('ออกจากการทำข้อสอบ?')) {
        SaveStateDoing();
        return true;
      } else {
        return false;
      }
    } else if (state == 3) {
      if (confirm('Confirm?')) {
        var score = ShowAnswer();

        if (multiChoice == true) {
          score = handleOnShowAnswer();
//        handleOnSumScore();
        } else {

        }
        SaveStateDone(score);
      } else {
        return false;
      }
    }
  }
}

function handleOnSumScore() {
  var from = $('.question-from').attr('data-id');
  var to = $('.question-to').attr('data-id');
  var sumPoint = 0;
  var totalPoint = 0;
  while (from <= to) {
    var selectChoice = [];
    $("[class^='choice-question-" + from + "']").each(function () {
      if ($(this).is(':checked')) {
        console.log("[class^='choice-question-" + from + "']", $(this).val());
        selectChoice.push(parseInt($(this).val()));
      } else {

      }
    });
    for (var i = 1; i <= 15; i++) {
      var point = $('#answer-point-' + from + '-' + i).attr('data-point');
      if (point !== undefined && selectChoice != []) {
        if (parseInt(point) >= 1) {
          totalPoint = totalPoint + parseInt(point);
        } else {

        }
//        console.log(totalPoint, ' : ', parseInt(point), ' : ', '#answer-point-' + from + '-' + i);
        if (selectChoice.includes(i)) {
          sumPoint = sumPoint + parseInt(point);
        }

      }
    }
    from++;
  }
  var resute = (sumPoint * 100) / totalPoint;
//  alert(sumPoint + ' : ' + totalPoint);
  $('.progress').remove();
  (parseInt(resute) >= percentPass) ? handlePercentPass() : null;
//  console.log('resute.toFixed(0): ' + resute.toFixed(0));
  return resute.toFixed(0);
//  console.log(from, to);
}
function handleOnShowAnswer() {
  $('.btn-next-present').hide();
  $('[id*="render-question-no-"]').show();
  $('[id*=showAnswer]').show();
  $('[id*=showAnswer]').css({'background': '#006100', 'color': '#fff'});
//  console.log('handleOnSumScore: ', handleOnSumScore());
  return handleOnSumScore();
}

function SaveStateDoing() {

  var questionSaveId = $('.question-save-id').attr('data-id');
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    type: "POST",
    url: "../../question-save/save-state-doing",
    data: ({
      questionSaveId: questionSaveId,
      _csrf: csrfToken
    }),
    success: function (data) {
    },
    error: function (data) {
      return "ไม่มีการส่งข้อมูล";
    }
  });
}

function SaveStateDone(score) {
  var questionSaveId = $('.question-save-id').attr('data-id');
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  $.ajax({
    type: "POST",
    url: "index.php?r=question-save/save-state-done",
    data: ({
      questionSaveId: questionSaveId,
      score: score,
      _csrf: csrfToken
    }),
    success: function (data) {
    },
    error: function (data) {
      return "ไม่มีการส่งข้อมูล";
    }
  });
}

function openAnswerWithFromTo() {
  var numQuestion = 0;
  var questionType = $('.question-type').attr('data-id');
  var arrColor = {
    1: "rgb(0, 166, 90)",
    2: "rgb(221, 75, 57)",
    3: ""
  };
  var answerCorrect = "";
  var answerWrong = "";
  if (questionType !== "2") {
    answerCorrect = arrColor[1];
    answerWrong = arrColor[2];

  } else {
    answerCorrect = arrColor[0];
    answerWrong = arrColor[0];
//        $('.frame-submit-mobile').css({'opacity': '0'});
    $('.frame-submit-mobile').css({'opacity': '0'});
  }

  while (from <= to) {
    var answer = $('#qa-' + from).attr('data-id');
    var question = $('input:radio[name="name_' + from + '"]:checked').val();
    if (question) {
      if (question === answer) {
        $('.class_' + from).css({"background-color": "#00A65A", "color": "#fff"});
        $('.scroll_' + from).css({'background': answerCorrect});
        $('.class_' + from).show();
        agree++;
        numQuestion++;
      } else {
        $('.class_' + from).css({"background-color": "#DD4B39", "color": "#fff"});
        $('.scroll_' + from).css({'background': answerWrong});
        $('.class_' + from).show();
        numQuestion++;
      }
    }
    from++;
  }
}

function ShowAnswer() {

  $('.question-save-status').attr('data-id', '3');
  var questionType = $('.question-type').attr('data-id');
  var questionSaveId = $('.question-save-id').attr('data-id');
  var agree = 0;
  var questionSetId = $('.question-set-id').attr('data-id');
  var from = $('.question-from').attr('data-id');
  var to = $('.question-to').attr('data-id');
  var countQuestion = to - (from - 1);
  var numQuestion = 0;
  var title = '';

  var arrColor = {
    1: "rgb(0, 166, 90)",
    2: "rgb(221, 75, 57)",
    3: ""
  };
  var answerCorrect = "";
  var answerWrong = "";
  if (questionType !== "2") {
    answerCorrect = arrColor[1];
    answerWrong = arrColor[2];

  } else {
    answerCorrect = arrColor[0];
    answerWrong = arrColor[0];
//        $('.frame-submit-mobile').css({'opacity': '0'});
    $('.frame-submit-mobile').css({'opacity': '0'});
  }

  while (from <= to) {
    var answer = $('#qa-' + from).attr('data-id');
    var question = $('input:radio[name="name_' + from + '"]:checked').val();
    if (question) {
      if (question === answer) {
        $('.class_' + from).css({"background-color": "#00A65A", "color": "#fff"});
        $('.scroll_' + from).css({'background': answerCorrect});
        $('.class_' + from).show();
        agree++;
        numQuestion++;
      } else {
        $('.class_' + from).css({"background-color": "#DD4B39", "color": "#fff"});
        $('.scroll_' + from).css({'background': answerWrong});
        $('.class_' + from).show();
        numQuestion++;
      }
    }
    from++;
  }

  if (numQuestion === countQuestion) {
    $('.div-submit-exam-mobile').hide();
    $('.div-rescore-exam-mobile').show();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
      type: "POST",
      url: "../../question-save/finish-question",
      data: ({
        questionSetId: questionSetId,
        _csrf: csrfToken
      })
    });
  } else {

  }
  if (multiChoice) {
    var agree = handleOnShowAnswer();

  } else {
//    title = ShowTitleAnswer(percent);

  }
  var percent = (agree * 100) / countQuestion;
  percent = (percent <= 0) ? 0 : percent;
  if (questionSaveStatus > 1) {
    percent = questionSaveScore;
    agree = questionSaveScore;
  } else {

  }

  if (percent >= 80) {
    title = 'ยินดีด้วยท่านผ่านเกณฑ์ 80% ของข้อสอบชุดนี้';
  } else {
    title = 'ท่านไม่ผ่านเกณฑ์คะแนนขั้นต่ำ กรุณากดปุ่ม Reset เพื่อทำใหม่อีกครั้ง';

  }

  if (questionType !== '2') {
    $('.load-score').html(agree + "% <br>");
  } else {
    $('.load-score').html("## <br>");
  }


  $('title-ex-left').show();
  if (questionType === "2") {
//    $('.frameClickAnswer').css('height', '235px');
    $('.load-score').append('<div class="an-ti-show"<br>กรุณารอฟังประกาศผลการคัดเลือก</div>');
    $('#ShowAnswerDiv').css({"display": "none"});
//        agree = '##';
    $('score-m').html('## คะแนน');
  } else {

    (!multiChoice) ? $('.load-score').append('<div class="an-ti-show"><br>' + percent + '% ' + title + '</div>') : null;

    $('.tb2-ex-left').show();
//    $('.frameClickAnswer').css('height', '315px');
    $('score-m').html(agree + ' คะแนน');
  }

  $('.tb-ex-left').css({'border-bottom': ' 1px solid #dcdee3'});
  $('#insert-answer').css({
    'cursor': 'not-allowed'
  });

  $('#insert-answer').text('ส่งสำเร็จ');

  $('time-m').hide();
//        $("#inputRadio").attr('disabled','disabled');
  $("#inputRadio").prop('disabled', true);
  $("#carousel-example-generic input").prop('disabled', true);

  (parseInt(handleOnShowAnswer()) >= percentPass) ? handlePercentPass() : null;
  return agree;
//  }
}

function handlePercentPass() {
  $('.tb2-ex-left').remove();
  $('#btn-send-exam').remove();
  $('#exam-progress-bar').remove();
}

function Rescore(getUrl) {
  var urlPost = (getUrl == null || getUrl == undefined || getUrl == '') ? 'index.php?r=question-save/rescore' : getUrl;
  var csrfToken = $('meta[name="csrf-token"]').attr("content");
  var questionSetId = $('.question-set-id').attr('data-id');
  var questionSaveId = $('.question-save').attr('data-id');
  $.ajax({
    type: "POST",
    url: urlPost,
    data: ({
      questionSaveId: questionSaveId,
      questionSetId: questionSetId,
      _csrf: csrfToken
    }),
    success: function (data) {
      if (data === '1') {
        location.reload();
      } else if (data === '0') {
        console.log('เกิดข้อผิดพลาด');
      }
    },
    error: function (data) {
      console.log("ไม่มีการส่งข้อมูล");
    }
  });
}

function LoadMonitor() {
  var email = $('.insert-email-monitor').val();
  window.location.replace("../question-save/monitor?email=" + email);
}

var activeSectionQuestion = 0;
var sectionQuestionMin = $('.doing-question-section').attr('data-min');
var sectionQuestionMax = $('.doing-question-section').attr('data-max');
var presentQuestion = $('.doing-question-section').attr('data-present-question');
var endFirstQuestion = $('.doing-question-section').attr('data-question-last');
var keyEndPart = $('.doing-question-section').attr('data-key-part');
var questionSaveId = $('.question-save-id').attr('data-id');
var maxQuestion = $('.max-question-data').attr('data-max');
//var questionSectionActive = $('.question-save').attr('data-question-section-active');

function hidingSectionPart(doPart) { // ทำให้ display: none
  for (var i = doPart - 1; i >= 0; i--) {
    $('[id*="frame-question-section-' + i + '"]').hide();
  }
}

$('.btn-next-present').click(function () {
  if (presentQuestion > endFirstQuestion) {
//    hidingSectionPart(keyEndPart); // ทำให้ display: none
  } else {

  }
  $('.doing-question-section').attr('data-present-question', presentQuestion);
  if (questionSetMode == 2) {
    handleRenderQuestionJumpType();
  } else {
    presentQuestion = parseInt(presentQuestion) + 1;
    $.ajax({
      type: "POST",
//    url: "../../question-save/update-present-question",
      url: "index.php?r=question-save/update-present-question",
      data: ({
        presentQuestion: presentQuestion,
        id: questionSaveId,
        _csrf: csrfToken
      }),
      success: function (data) {
//      hidingSectionPart(data);
      }
    });
    renderProgressBar(); // คำนวน progress bar ใหม่
    renderPreSentQuestion(); // เปิดข้อสอบข้อต่อไป
  }
  $(this).hide();
});

function handleRenderQuestion(renderQuestionId) {
  $('.render-force-question-id').attr('data-id', renderQuestionId);
  $('.question-id-' + renderQuestionId).show();
}

function handleSumScoreQuestion(quesitonId) {
  var selectChoice = [];
  var scores = [];
  $("[class*='choice-question-" + quesitonId + "']").each(function () {
    if ($(this).is(':checked')) {
      selectChoice.push(parseInt($(this).val()));
    } else {

    }
  });
  selectChoice.forEach(function (element) {
    var score = $('#answer-point-' + quesitonId + '-' + element).attr('data-point');
    scores.push(parseInt(score));
  });
  if (selectChoice.length > 1) {
    var sumScore = 0;
    scores.forEach(function (element) {
      sumScore = sumScore + parseInt(element);
    });
    return sumScore;
  } else {
    return scores[0];
  }
}

function handleRenderQuestionJumpType() {
  var forceQuestion = $('.render-force-question-id').attr('data-id');
  var selectEl = '';
  if (forceQuestion != undefined && forceQuestion != '') {
    selectEl = '#no-question-data-question-id-' + forceQuestion;
  } else {
    selectEl = '.no-question-data-' + presentQuestion;

  }

  var typeQuestion = $(selectEl).attr('data-question-type');
  var questionId = $(selectEl).attr('data-question-id');
  var jumpType = $(selectEl).attr('data-jump-type');
  var jumpConstraint = $(selectEl).attr('data-jump-constraint');
  var jumpScore = $(selectEl).attr('data-jump-score');
  var jumpConstraintTrue = $(selectEl).attr('data-jump-constraint-true');
  var jumpConstraintFalse = $(selectEl).attr('data-jump-constraint-false');

  var successScore = true;

  if (typeQuestion == 3) {
    if (jumpType == 1) {
      var radioCheck = $('.radio-preset-' + questionId + ':checked').val();
      var renderQuestionId = $('.jump-question-' + questionId + '-' + radioCheck).attr('data-jump-question');
      handleRenderQuestion(renderQuestionId);
//      $('.render-force-question-id').attr('data-id', renderQuestionId);
//      $('.question-id-' + renderQuestionId).show();

      if (renderQuestionId == '' || renderQuestionId == undefined || renderQuestionId == null) {
        $('.wrapper-send-exam').show();
      }

    } else if (jumpType == 2) {
      var checkScore = handleSumScoreQuestion(questionId);
      if (jumpConstraint == 1) {
        successScore = (checkScore >= jumpScore);
      } else if (jumpConstraint == 2) {
        successScore = (checkScore <= jumpScore);
      } else if (jumpConstraint == 3) {
        successScore = (checkScore == jumpScore);
      } else {

      }
      if (successScore === true) {
        handleRenderQuestion(jumpConstraintTrue);
      } else {
        handleRenderQuestion(jumpConstraintFalse);
      }


    } else {

    }

  } else {
    presentQuestion = parseInt(presentQuestion) + 1;
    renderPreSentQuestion();
  }
}

function renderPreSentQuestion() {
  var disable = 0;
  for (var i = 1; i <= presentQuestion; i++) {
    disable = i - 1;
//    console.log('#render-question-no-' + i, ' : ', disable);
    $('#render-question-no-' + i).css("display", "block");
    $('#wrapper-question-section-' + disable).css("display", "block");
  }

}
function renderProgressBar() {
  var doQuestion = $('numquestion').text();
  if (doQuestion == 0) {
    doQuestion = $('.count-select-question').attr('data-id');
  } else {
    null;
  }
  var maxQuestion = $('.max-question-data').attr('data-max');
  var progress = (100 * parseInt(doQuestion)) / maxQuestion;
  $('#exam-progress-bar').text(progress.toFixed(0) + '%');
  $('#exam-progress-bar').css({'width': progress.toFixed(0) + '%'});

  (progress >= 100) ? renderBtnSendExam() : null;
}

function renderBtnSendExam() {
  var btnSendExam = $('.wrapper-send-exam');
  var btnNextQuestion = $('.btn-next-present');
  btnSendExam.show();
  btnNextQuestion.hide();
}

function handleOnNextSection() {
  if ($('.question-save') !== undefined) {
    var questionSaveId = $('.question-save').attr('data-id');
    $.ajax({
      type: "POST",
      url: "../../question-save/save-present-section",
      data: ({
        questionSaveId: questionSaveId,
        sectionQuestionMax: sectionQuestionMax,
        presentSection: activeSectionQuestion,
        _csrf: csrfToken
      }),
      success: function (data) {
        if (data === '1') {
          location.reload();
        } else if (data === '0') {
          console.log('เกิดข้อผิดพลาด');
        }
      },
      error: function (data) {
        console.log("ไม่มีการส่งข้อมูล");
      }
    });

  } else {
  }
}

function onDisableChoiceWithSectionQuestion(activeSection) {
  for (var i = sectionQuestionMin; i < activeSection; i++) {
    $('[id^=wrapper-question-section-' + i + ']').css("display", "block");
  }
}

function nextSectionQuestion() {
  var sectionQuestion = parseInt(activeSectionQuestion) + 1;
  if (sectionQuestion <= sectionQuestionMax) {
    activeSectionQuestion++;
//    onDisableChoiceWithSectionQuestion(activeSectionQuestion);
    handleSectionQuestion();
    handleOnNextSection();
  } else {
//    alert(sectionQuestion + ' : ' + sectionQuestionMax);
  }
}

$('[class*="choice-question-"]').click(function () {
  var choiceId = $(this).attr('data-id');
  handleClickChoice(choiceId);
});

function handleClickChoice(choiceId) {
  var maxChoice = $('.max-select-choice-question-' + choiceId).attr('data-max-choice');
  var bol = $(".choice-question-" + choiceId + ":checked").length >= maxChoice;
  $("[class*='choice-question-" + choiceId + "']").not(":checked").attr("disabled", bol);
}

function autoSelectChoice(choiceId, multiSelectChoice) {
  var arrayMultiSelectChoice = multiSelectChoice.split(',');
  $("[class*='choice-question-" + choiceId + "']").each(function (i) {
    if (arrayMultiSelectChoice.includes($(this).val())) {
      $(this).attr('checked', true);
    }
  });
  handleClickChoice(choiceId);
}

function handleHidingQuestion(parts) {
//  parts.forEach(function (val) {
  for (var i = 1; i <= 50; i++) {
    if (parts[0] == i || parts[1] == i) {
    } else {
//      $('[id^="frame-question-section-' + i + '"]').hide();
    }
  }
//  });
}

function adminTrue() {
  $('#rescore-exam').remove();
  $('#btn-restart-temporary').remove();
  $('.btn-next-present').remove();
}

function adminFalse() {
  $('[id^="showAnswer"]').remove();
  $('[class^="edit-question-on-exam"]').remove();
}

function handleMissionTree() {
  var isMissionTree = $('.active-question .is-mission-tree').attr('data-status');
//  console.log(isMissionTree);
  if (isMissionTree != null && isMissionTree != undefined && isMissionTree == 'true') {
    var questionId = $('.active-question .is-mission-tree').attr('data-id');
    var checkInput = $('input[name="name_' + questionId + '"]:checked').val();
    var questionTreeId = $('#mission-tree-question-' + questionId + '-' + checkInput).html();
    questionTreeId = questionTreeId.replace(/\s+/g, '');

    $.ajax({
      type: "POST",
      url: "index.php?r=question/get-mission-tree-question",
      data: ({
        questionTreeId: questionTreeId,
        _csrf: csrfToken
      }),
      success: function (data) {
        console.log(data);

      },
      error: function (data) {
        console.log("ไม่มีการส่งข้อมูล");
      }
    });

    console.log('Yes' + isMissionTree + ' : ' + questionId + ' : ' + checkInput + ' : ' + questionTreeId);

  } else {
    console.log('No' + isMissionTree);
  }
}

function removeQuestionEl(questionId) {
  $('.question-id-' + questionId).remove();
}

function handleRemoveQuestionEl() {
  for (var i = questionFrom; i <= questionTo; i++) {
    var check = $("input[name^='name_" + i + "']").is(':checked');
    console.log(i + ' : ' + check);
    if (check != undefined && check == 1) {
//      questionIds.push(i);
    } else { // ถ้าไม่มีให้ remove ทิ่ง
      removeQuestionEl(i);
    }
  }
}

function renderScore() {
  var title = '';
  if (questionSaveScore >= 80) {
    title = 'ยินดีด้วยท่านผ่านเกณฑ์ 80% ของข้อสอบชุดนี้';
    overScore();
  } else {
    title = 'ท่านไม่ผ่านเกณฑ์คะแนนขั้นต่ำ กรุณากดปุ่ม Reset เพื่อทำใหม่อีกครั้ง';

  }
//  $('.td-ex-body>h6').text(title);
  $('.load-score').html(score.toFixed(0) + "% <br>");
}

$(document).ready(function () {
  renderPreSentQuestion();
  renderProgressBar();
  $('.popup-link').magnificPopup({
    type: 'image'
            // other options
  });
  $('.tr-ex-head').remove();


});

$(window).load(function () {
  $('.progress').remove();
  if (questionSaveStatus > 1) {
    handleRemoveQuestionEl();
    renderScore();
  } else {

  }
});

