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

//$('#id-support_password').change(function () {
//  if ($(this).val() != $('#id-again_password').val()) {
//    $('#btn-submit-profile-user').attr("disabled", true);
//  } else {
//    $('#btn-submit-profile-user').attr("disabled", false);
//  }
//});
//$('#id-again_password').change(function () {
//  if ($(this).val() != $('#id-support_password').val()) {
//    $('#btn-submit-profile-user').attr("disabled", true);
//  } else {
//    $('#btn-submit-profile-user').attr("disabled", false);
//  }
//});