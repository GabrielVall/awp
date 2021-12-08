<?php
session_start();
include_once("../php/m/SQLConexion.php");
$sql = new SQLConexion();

$_SESSION['id_empresa_reparto_bexpress'] = 1;
$_SESSION['id_usuario_bexpress'] = 2;

$row_notificaciones = $sql->obtenerResultado("CALL sp_select_notificaciones1('" . $_SESSION['id_usuario_bexpress'] . "');");
$total_row_notificaciones = count($row_notificaciones);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Bexpress</title>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/simplebar.css">
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/iziToast.css">
    <link rel="stylesheet" href="css/slimselect.css">
    <link rel="stylesheet" href="css/cropper.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/flatpickr.css">
</head>

<body class="vertical  light  ">
    <div class="wrapper">
        <!-- ENCABEZADO -->
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <span class="material-icons-round">menu</span>
            </button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="javascript:void(0);" data-toggle="modal" data-target="#modal_configuraciones">
                        <span class="material-icons-round">apps</span>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    <a class="nav-link text-muted my-2" href="javascript:void(0);" data-toggle="modal" data-target="#modal_notificaciones">
                        <span class="material-icons-round">notifications</span>
                        <span id="dot_notification" class="dot dot-md bg-success <?php if($total_row_notificaciones==0){ echo 'd-none';} ?>"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="../img/0/user-0.jpg" alt="..." class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#config_cuenta">Mi cuenta</a>
                        <a class="dropdown-item" href="#pagar_servicio">Pagar servicio</a>
                        <a class="dropdown-item" href="javascript:void(0);">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- FIN ENCABEZADO -->
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <!-- MENU -->
            <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#inicio">
                        <img src="../img/0/bexpress_logo.png" id="logo" class="navbar-brand-img brand-sm" alt="logo_menu_lateral">
                    </a>
                </div>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#inicio">
                            <i class="material-icons-round">dashboard</i>
                            <span class="ml-3 item-text">Panel de control</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#resumen_ventas">
                            <i class="material-icons-round">show_chart</i>
                            <span class="ml-3 item-text">Resumen de ventas</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#nav-ordenes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link d-flex align-items-center collapsed">
                            <i class="material-icons-round">note_alt</i>
                            <span class="ml-3 item-text">Ordenes</span>
                        </a>
                        <ul class="list-unstyled pl-4 w-100 collapse" id="nav-ordenes">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#nueva_orden_punto_a_punto"><span class="ml-1 item-text">Agregar orden punto a punto</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#nueva_orden_express"><span class="ml-1 item-text">Agregar orden express</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#historial_ordenes"><span class="ml-1 item-text">Historial</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#nav-sucursales" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link d-flex align-items-center collapsed">
                            <i class="material-icons-round">store</i>
                            <span class="ml-3 item-text">Sucursales</span>
                        </a>
                        <ul class="list-unstyled pl-4 w-100 collapse" id="nav-sucursales">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#categorias_sucursales"><span class="ml-1 item-text">Categorías</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#sucursales"><span class="ml-1 item-text">Sucursales</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#sucursales_express"><span class="ml-1 item-text">Sucursales express</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#nav-repartidores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link d-flex align-items-center collapsed">
                            <i class="material-icons-round">two_wheeler</i>
                            <span class="ml-3 item-text">Repartidores</span>
                        </a>
                        <ul class="list-unstyled pl-4 w-100 collapse" id="nav-repartidores">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#solicitudes_repartidores"><span class="ml-1 item-text">Solicitudes</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#repartidores"><span class="ml-1 item-text">Repartidores</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#nav-clientes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link d-flex align-items-center collapsed">
                            <i class="material-icons-round">people_alt</i>
                            <span class="ml-3 item-text">Clientes</span>
                        </a>
                        <ul class="list-unstyled pl-4 w-100 collapse" id="nav-clientes">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#clientes"><span class="ml-1 item-text">Clientes</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="#clientes_ban"><span class="ml-1 item-text">Bloquear clientes</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#tipos_transportes">
                            <i class="material-icons-round">local_shipping</i>
                            <span class="ml-3 item-text">Tipos de vehículos</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#empresas_comida">
                            <i class="material-icons-round">domain</i>
                            <span class="ml-3 item-text">Empresas de comida</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#costos_km">
                            <i class="material-icons-round">paid</i>
                            <span class="ml-3 item-text">Costos por km</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#areas_servicio">
                            <i class="material-icons-round">place</i>
                            <span class="ml-3 item-text">Áreas de servicio</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link d-flex align-items-center" href="#pagar_servicio">
                            <i class="material-icons-round">payment</i>
                            <span class="ml-3 item-text">Pagar servicio</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- FIN MENU -->
        </aside>
        <!-- MAIN -->
        <?php include_once('../php/v/0/modales/full_modal.php'); ?>
        <main role="main" class="main-content" id="main"></main>
        <!-- FIN MAIN -->
    </div>
    <!-- MODALES -->
    <!-- NOTIFICACIONES -->
    <div class="modal fade modal-shortcut modal-slide" id="modal_notificaciones" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Notificaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y:auto;">
                    <div class="list-group list-group-flush my-n3" id="content_notificaciones">
                        <?php
                        if($total_row_notificaciones>0){
                            foreach ($row_notificaciones as $key => $value) {
                                echo
                                '<div class="list-group-item bg-transparent"'; if($value['id_orden']>0){ echo 'data-dismiss="modal"'; } echo 'id="seleccionar_notificacion" data-orden="'.$value['id_orden'].'" style="cursor:pointer;">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="material-icons-round">note_alt</span>
                                        </div>
                                        <div class="col">
                                            <small><strong>'.$value['titulo_notificacion'].'</strong></small>
                                            <div class="my-0 text-muted small">'.$value['mensaje_notificacion'].'</div>
                                            <small fecha-hora="'.$value['fecha_notificacion'].'" class="badge badge-pill badge-light text-muted"></small>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                        else{
                            echo
                            '<div class="list-group-item bg-transparent">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="material-icons-round">remove</span>
                                    </div>
                                    <div class="col">
                                        <small><strong>No tienes notificaciones</strong></small>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONFIGURACIONES -->
    <div class="modal fade modal-shortcut modal-slide" id="modal_configuraciones" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Configuraciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">folder_shared</span>
                                </div>
                                <div class="col">
                                    <div class="my-0 text-muted small">&nbsp</div>
                                    <a href="#config_cuenta" class="text-decoration-none"><strong>Configuración de la cuenta</strong></a>
                                    <div class="my-0 text-muted small">&nbsp</div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">credit_score</span>
                                </div>
                                <div class="col">
                                    <div class="my-0 text-muted small">&nbsp</div>
                                    <a href="#config_metodo_pago" class="text-decoration-none"><strong>Métodos de pago</strong></a>
                                    <div class="my-0 text-muted small">&nbsp</div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item bg-transparent">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">read_more</span>
                                </div>
                                <div class="col">
                                    <div class="my-0 text-muted small">&nbsp</div>
                                    <a href="#config_avanzadas" class="text-decoration-none"><strong>Configuraciones avanzadas</strong></a>
                                    <div class="my-0 text-muted small">&nbsp</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/JQuery_3.3.1.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/funciones_empresa_reparto.js"></script>
    <script src="js/iziToast.min.js"></script>
    <script src="js/slimselect.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/cropper.js"></script>
    <script src="js/flatpickr.js"></script>
    <script src="js/apexChart.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/apps.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AbI25wxjIL0mgpIog-IXEZox5SC6QOlc-7R9ZcPtrHNwnVMSZZFZsdvBu7h4ffAynTYN5MlnUWpqJF2l&currency=MXN&disable-funding=credit,card"></script>

</body>

</html>