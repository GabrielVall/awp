
$(document).ready(function(){
  
const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

$(document).on("click","#btn_login", function(){
  var usuario = $('#usuario').val();
  var pass = $("#pass").val();
  $.ajax({
    type: "POST",
    url: '../php/c/0/login.php',
    type: "POST",
    data: "usuario=" +  usuario + "&pass=" + pass,
    success: function(respuesta) {
      if(respuesta.status == 'success'){
        window.location.reload();
      }else{
        Swal.fire({
          title: respuesta.title,
          text: respuesta.msg,
          icon: respuesta.status,
          timer: 1500,
          showConfirmButton:false,
          timerProgressBar: true,
        })
      }
    }
  });
});

});
