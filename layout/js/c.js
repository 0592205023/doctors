function start(error) {
  var id = $("#errors").children().length +1;
  $("#errors").append('<div id="box'+id+'" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;opacity: 1;"><div class="toast-header"><strong>تم ارسال الرساله</strong></div><div class="progress"><div id="progress'+id+'" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div></div><div class="toast-body" id="error_body">'+error+'</div></div>');
  ST(id);
}
// Assuming that you want the progress to finish in 10 seconds
function ST(n) {
      $('#box'+n).fadeIn();
  $('#progress'+n).animate({
          width:   '100%'
   }, 4000);
   setTimeout(function() {s(n)}, 5000);
}

function s(n) {
  $('#box'+n).fadeOut();
  $("#box"+n).remove();
}
