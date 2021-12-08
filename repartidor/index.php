<?php
   session_start();
   if(isset($_SESSION['id_usuario'])){
      ?>
      <!DOCTYPE html>
      <html lang="es">
         <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mis ordenes</title>
            <link href="btsp/css/bootstrap.min.css" rel="stylesheet">
            <link href="css/estilo.css" rel="stylesheet">
            <script src="btsp/js/bootstrap.bundle.min.js"></script>
            <script src="js/jquery.min.js"></script>
            <script src="js/funciones_repartidor.js"></script>
            <script src="js/nprogress.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="css/animate.min.css"/>
            <link rel="stylesheet" href="css/nprogress.css"/>
            <link rel="stylesheet" href="input_tel/css/intlTelInput.css">
            <link rel="stylesheet" href="assets/css/alertify.min.css"/>
            <script src="assets/js/alertify.min.js"></script>
         </head>
         <body>
            <style>
               .alert-yo{
                  display: none; 
                  position: fixed; 
                  z-index: 1000; 
                  left:0; 
                  right:0; 
                  top:5%; 
                  margin:auto;
                  width:50%; 
                  text-align: center;}
            </style>
            <div id="alert-primary" class="alert alert-primary mt-5 alert-yo" role="alert"></div>
            <div id="alert-danger" class="alert alert-danger mt-5 alert-yo" role="alert"></div>
            <div id="alert-warning" class="alert alert-warning mt-5 alert-yo" role="alert"></div>
            <div id="alert-success" class="alert alert-success mt-5 alert-yo" role="alert"></div>
            <div id="alert-info" class="alert alert-info mt-5 alert-yo" role="alert"></div>
            <div id="contenedor_vista" class="animate__animated ">
               <!-- Contenido a imprimir -->
            </div>
            <div class="row justify-content-center align-items-center menu-contain">
               <div class="col-2 mt-1 pad-l">
                  <div class="text-center">
                     <h3>
                        <a href="#historial">
                        <i class="fas fa-history icon-men"></i>
                        </a>
                     </h3>
                  </div>
               </div>
               <div class="col-8" style="margin-top: -5%;">
                  <div class="text-center">
                     <a href="#" class="btn btn-ligth btn-rounded main-btn-orden orden-pendiente">
                        <i class="fas fa-concierge-bell px-1 text-white"></i>
                           <span class="badge badge-danger nuevo-pedido">4</span>
                     </a>
                  </div>
               </div>
               <div class="col-2 mt-1 pad-r">
                  <div class="text-center">
                     <h3>
                        <a href="#menu">
                              <i class="fas fa-align-right icon-men"></i>
                        </a>
                     </h3>
                  </div>
               </div>
            </div>
            <script src="input_tel/js/intlTelInput.min.js"></script>
            <script src="input_tel/js/intlTelInput-jquery.min.js"></script>
            <script src="assets/js/core/bootstrap.min.js"></script>
         </body>
      </html>
      <?php
   }else{
      $_SESSION['id_usuario'] = 5;
      header("Location: index.php");
   }
?>