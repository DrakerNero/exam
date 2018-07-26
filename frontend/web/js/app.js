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
  var newUrl = url + 'index.php?r=site%2Ftop-score&questionSetId=' + questionSetId;
  window.location.replace(newUrl);
}