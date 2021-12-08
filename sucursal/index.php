<!-- Boton agregar en todas las sucursales, -->
<?php
  session_start();
  if( isset($_SESSION['id_usuario_bxpress']) ){
    if( $_SESSION['nivel_bxpress'] != (5 || 2)) {
      header('Location: ../auth/');
      exit();
    }
  }else{
    header('Location: ../auth/');
    exit();
  }
  include_once("../php/m/SQLConexion.php");
  $sql = new SQLConexion();
  $row_empresa = $sql->obtenerResultado("CALL sp_select_empresa_comida('".$_SESSION['id_usuario_bxpress']."')");
  if($row_empresa){
    $_SESSION['id_empresa_comida_bxpress'] = $row_empresa[0]['id_empresa_comida'];
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="manifest" href="manifest.json">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Compatibility test</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet"/>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet"/>
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
  <link href="assets/css/estilos.css" rel="stylesheet"/>
  <link href="assets/css/slimselect.min.css" rel="stylesheet"></link>
  <link rel="stylesheet" href="assets/css/alertify.min.css"/>
  <link rel="stylesheet" href="assets/css/animate.min.css"/>
  <link rel="stylesheet" href="assets/css/autoComplete.min.css">
  <link rel="stylesheet" href="assets/css/introjs.min.css">
  <link rel="stylesheet" href="input_tel/css/intlTelInput.css">
</head>
<audio class="audio notify" src=""></audio>
<audio class="audio success" src=""></audio>
<audio class="audio error" src=""></audio>
<input class="form-check-input mt-1 ms-auto d-none" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)" checked="true">
<body class="g-sidenav-show bg-gray-100">
  <?php include('../php/v/5/menu.php'); ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg p-2">
    <?php include('../php/v/5/top_menu.php'); ?>
    <div id="contenedor_inicio">
      
    </div>
  </main>
  <span id="helper">
    
  </span>
  <div class="water-mark">
    <!-- <h6 class="mb-0" style="color: #cdcdcd !important;">Versión en desarrollo, BorderExpress 2.0<br> Por: BorderBytes -->
    </h6>
  </div>
  <?php include('../php/v/0/modales/modal_sucursal.html'); ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrc4t-zWOMoqOfuh1C0yP9TrF2IFDUijc&libraries=places" async defer></script>
  <script src="assets/js/kit.js" crossorigin="anonymous"></script>
  <script src="assets/js/alertify.min.js"></script>
  <script src="assets/js/slimselect.min.js"></script>
  <script src="js/skeleton.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/funciones.js"></script>
  <script src="js/autoComplete.min.js"></script>
  <script src="js/intro.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/main.js"></script>
  <script src="assets/js/dropzone.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script async defer src="assets/js/buttons.js"></script>
  <script src="input_tel/js/intlTelInput.min.js"></script>
  <script src="input_tel/js/intlTelInput-jquery.min.js"></script>
  <script src="assets/js/soft-ui-dashboard.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="app.js"></script>
  <script src="sw.js"></script>
</body>

</html>