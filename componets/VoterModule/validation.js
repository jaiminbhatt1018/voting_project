
$("#spid").blur(function() {

    if (!/^([0-9]{10})$/.test($("#spid").val())) {

      $("#spid").val("");
      $("#spid").attr("placeholder", "* Invailid Spid");
      $("#spid").css({
        "border":"2px solid red",
        "border-radius":"2px"
      })
    } else {
      $("#spid").css({
        "border":"none",
        "border-bottom":"2px solid green",
      })
    }
  })

  $("#student_name").blur(() => {

    if (!/^([a-zA-Z ]{5,50})$/.test($("#student_name").val())) {
      $("#student_name").val("");
      $("#student_name").attr("placeholder", "*Write Full Name");
      $("#student_name").css({
        "border":"2px solid red",
        "border-radius":"2px"
      })
    } else {
      $("#student_name").css({
        "border":"none",
        "border-bottom":"2px solid green",
      })
    }
  })

  $("#course").blur(() => {

    if ($("#course").val()!=0) {
      $("#course").css({
        "border-bottom":"2px solid green",
      })
    } else {
      
    }
  })
  $("#sem").blur(() => {

    if ($("#sem").val()!=0) {
      $("#sem").css({
        "border-bottom":"2px solid green",
      })
    } else {
      
    }
  })
  $("#email").blur(() => {

    if (!/^([a-zA-Z]{1,15})+([.mscit]+[0-9]{2})+([@vnsgu.ac.in]{12})$/.test($("#email").val())) {
      $("#email").val("");
      $("#email").attr("placeholder", "*Write Email ends with @vnsgu.ac.in");
      $("#email").css({
        "border":"2px solid red",
        "border-radius":"3px"
      })
    } else {
      $("#email").css({
        "border":"none",
        "border-bottom":"2px solid green",
      })
    }
  })

  
  $("#password").change(function() {
  
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test($("#password").val())) {

      if(/(?=.*[A-Z])[A-Za-z\d@$!%*?&]{1,}/.test($("#password").val())){
      
        $("#UpperCase").css({
          "color":"green",
          "font-weight":"bold"
        })
      }
      else{
        $("#UpperCase").css({
          "color":"red",
          "font-weight":"bold"
        })
      }
      if(/(?=.*\d)[A-Za-z\d@$!%*?&]{1,}/.test($("#password").val())){
       
        $("#Digit").css({
          "color":"green",
          "font-weight":"bold"
        })
      }
      else{
        $("#Digit").css({
          "color":"red",
          "font-weight":"bold"
        })
      }
      
      if(/(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{1,}/.test($("#password").val())){
        $("#SpChar").css({
          "color":"green",
          "font-weight":"bold"
        })
      }
      else{
        $("#SpChar").css({
          "color":"red",
          "font-weight":"bold"
        })
      }
     
      $(".pass-alert").empty();
$(".pass-alert").append(`<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
<strong>Weak Password!</strong>
<button type="button" class="btn-close" data-dismiss="alert" aria-label="">
  <span aria-hidden="true">&times;</span>
</button>
</div>
`)
     
      $("#password").val("");
      $("#password").attr("placeholder", "ex. Weak Password");
      $("#password").css({
        "border-bottom":"2px solid red",
        "border-radius":"3px"
      })
     
    } else {
    
      $("#UpperCase").css({
        "color":"green",
        "font-weight":"bold"
      })
      $("#Digit").css({
        "color":"green",
        "font-weight":"bold"
      })
      $("#SpChar").css({
        "color":"green",
        "font-weight":"bold"
      })
      $("#password").css({
        "Border":"none",
        "border-bottom":"2px solid green",
      })
    }
  })