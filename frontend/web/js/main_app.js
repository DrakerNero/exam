function handleClickToggleClassActive(className) {
  $('.' + className).toggleClass('active');
}
function hideExamDoctor(hide) {
  if (hide == 1) {
    $('.not-exam-doctor').show();
    $('.exam-doctor').hide();
  } else if (hide == 2) {
    $('.exam-doctor').show();
    $('.not-exam-doctor').hide();

  } else {

  }
}


$('.select-type-question').change(function (e) {
  var dataSelect = e.target.value;
  hideExamDoctor(dataSelect);
});
var formQuestionType = $('.form-data-question-type').attr('data-question-type-value');
//alert(formQuestionType);
$(document).ready(function () {
//  console.log('hello  ', $('.select-type-question input[name="Question[type_question]"]').val());
  hideExamDoctor(formQuestionType);

});

function searchUserWithData(url, newWindow) {
  var academic = $('#input-academic-data').val();
  var rotation = $('#input-rotation-data').val();
  var newUrl = url;
  if (academic == null && rotation != null) {
    newUrl = url + '&rotation=' + rotation;
  } else if (rotation == null && academic != null) {
    newUrl = url + '&academic=' + academic;
  } else if (academic == null && rotation == null) {
    newUrl = url;
  } else {
    newUrl = url + '&academic=' + academic + '&rotation=' + rotation;
  }
  if (newWindow == 'true') {
    window.open(newUrl, '_blank');
  } else {
    window.location.href = newUrl;

  }
  console.log(newUrl);
}