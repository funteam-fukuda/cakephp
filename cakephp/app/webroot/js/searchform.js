$(document).ready(function() {
  $('.searchArea').after().hide();
  $(".clickArea").click(function(){
    $(".searchArea").slideToggle();
  });
});