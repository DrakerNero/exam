$(function () {
  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    handle: ".box-header, .nav-tabs",
    forcePlaceholderSize: true,
    zIndex: 999999
  }).disableSelection();
  $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");



  var popup = $('#check-popup-open').attr('data-popup');

  if (popup == 'true' || popup == true || popup == '1' || popup == 1) {
    $('#exampleModal').modal('show');
  } else {

  }
});

function goToToScoreWihtId(url) {
  var questionSetId = $('#select-question-top-score').val();
  var newUrl = url + '' + questionSetId;
  window.location.replace(newUrl);
}

$('#select-question-top-score').change(function () {
  var value = $(this).val();

  window.open("../site/top-score?questionSetId=" + value, "_self");
});


function onCloseModal() {
  $('#exampleModal').modal('hide');
}

function passExam() {
  $('.div-submit-exam-mobile').show();
  $('.div-rescore-exam-mobile').hide();
  $('.rescore-exam-header-bar-mobile').hide();
}

function failExam() {
  $('.div-submit-exam-mobile').hide();
  $('.div-rescore-exam-mobile').hide();
  $('.rescore-exam-header-bar-mobile').show();
}
//function cloneLeftMenu() {
//  $('.frameClickAnswer').clone().prependTo('.wrapper-clone-left-menu');
//}
$('.frameClickAnswer').clone().prependTo('.wrapper-clone-left-menu');

$('.sidebar-toggle').click(function () {
  $(".wrapper-clone-left-menu").toggleClass("active");
});

$('.content-wrapper').click(function () {
  $('.wrapper-clone-left-menu').removeClass('active');
});
$('.main-sidebar').click(function () {
  $('.wrapper-clone-left-menu').removeClass('active');
});
