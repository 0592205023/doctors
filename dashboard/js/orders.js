$("#checkdate").change(function () {
  var inputString = $("#checkdate").val();
  var i = '1';
  $.ajax({
    url: "check.php",
    type: "post",
    data: {Date:i,datenew:inputString} ,
    success: function (data) {
      response = JSON.parse(data);
      if(response['error']==""){
        $(".remove1").remove();
        $("tr").remove(".items");
        for (let a = 0;  a < response['data'].length; a++) {
          $("#additem").append('<tr class="items"><td>'+a+'</td><td>'+response['data'][a].fullName+'</td><td>'+response['data'][a].mobile+'</td><td>'+response['data'][a].address+'</td><td>'+response['data'][a].postNum+'</td><td>'+response['data'][a].doctorname+'</td><td>'+response['data'][a].orderDate+'</td><td><a href="order1.php?id="'+response['data'][a].id+'" class="custom-btn confirm">حذف الطلب</a></tr>');
        }
      }else{
        start(response['error']);
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert("contact admin");
    }
  });
});

$("#HOSPITALNAME").change(function () {
  var name = $("#HOSPITALNAME").val();
  var i = '1';
  $.ajax({
    url: "check.php",
    type: "post",
    data: {Hospital:i,Hospitalname:name} ,
    success: function (data) {
      response = JSON.parse(data);
      if(response['error']==""){
        $(".remove1").remove();
        $("tr").remove(".items");
        for (let a = 0;  a < response['data'].length; a++) {
          $("#additem").append('<tr class="items"><td>'+a+'</td><td>'+response['data'][a].fullName+'</td><td>'+response['data'][a].mobile+'</td><td>'+response['data'][a].address+'</td><td>'+response['data'][a].postNum+'</td><td>'+response['data'][a].doctorname+'</td><td>'+response['data'][a].orderDate+'</td><td><a href="order1.php?id="'+response['data'][a].id+'" class="custom-btn confirm">حذف الطلب</a></tr>');
        }
      }else{
        start(response['error']);
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
      alert("contact admin");
    }
  });
});

$("#DoctorNAME").change(function () {
  var name = $("#DoctorNAME").val();
  var i = '1';
  $.ajax({
    url: "check.php",
    type: "post",
    data: {Doctor:i,Doctorname:name} ,
    success: function (data) {
      response = JSON.parse(data);
      if(response['error']==""){
        $(".remove1").remove();
        $("tr").remove(".items");
        for (let a = 0;  a < response['data'].length; a++) {
          $("#additem").append('<tr class="items"><td>'+a+'</td><td>'+response['data'][a].fullName+'</td><td>'+response['data'][a].mobile+'</td><td>'+response['data'][a].address+'</td><td>'+response['data'][a].postNum+'</td><td>'+response['data'][a].doctorname+'</td><td>'+response['data'][a].orderDate+'</td><td><a href="order1.php?id="'+response['data'][a].id+'" class="custom-btn confirm">حذف الطلب</a></tr>');

        }
      }else{
        start(response['error']);
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    alert("contact admin");
    }
  });
});
function start(error) {
  var id = $("#errors").children().length +1;
  $("#errors").append('<div id="box'+id+'" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;opacity: 1;"><div class="toast-header"><strong>تحذير</strong></div><div class="progress"><div id="progress'+id+'" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div></div><div class="toast-body" id="error_body">'+error+'</div></div>');
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
