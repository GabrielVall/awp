<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ubicacion = $sql->obtenerResultado("CALL sp_select_ubicaciones_repartidores1('" . $_POST['id_repartidor'] . "');");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title">Ubicación acual del repartidor</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#inicio" class="text-decoration-none text-muted">Panel de control</a></li>
                            <li class="breadcrumb-item"><a href="#ubicacion_repartidor_<?php echo $_POST['id_repartidor'] ?>" class="text-decoration-none text-muted">Ubicación actual: <?php echo $row_ubicacion[0]['nombre_repartidor']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row my-4" id="main_ubicacion">
                <div class="col-sm-12 col-md-9">
                    <div class="card shadow mb-4" id="content_map">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Ubicación actual</strong>
                        </div>
                        <div class="card-body m-0 p-0">
                            <div class="form-group m-0 p-0">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d3500.3782232967733!2d<?php echo $row_ubicacion[0]['longitud_ubicacion_repartidor'] ?>!3d<?php echo $row_ubicacion[0]['latitud_ubicacion_repartidor'] ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e0!4m0!4m3!3m2!1d<?php echo $row_ubicacion[0]['latitud_ubicacion_repartidor'] ?>!2d<?php echo $row_ubicacion[0]['longitud_ubicacion_repartidor'] ?>!5e0!3m2!1ses-419!2smx!4v1592322142262!5m2!1ses-419!2smx" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow mb-4" id="content_repartidor">
                        <div class="card-header">
                            <strong class="card-title">Repartidor</strong>
                        </div>
                        <div class="card-body text-center">
                            <div class="avatar avatar-lg mt-4">
                                <?php
                                if (file_exists('../../../../img/repartidores/' . $_POST['id_repartidor']) && count(glob('../../../../img/repartidores/' . $_POST['id_repartidor'] . '/*')) > 0) {
                                    $directorio = opendir('../../../../img/repartidores/' . $_POST['id_repartidor']);
                                    while ($archivo = readdir($directorio)) {
                                        if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                            echo '<img src="../img/repartidores/' . $_POST['id_repartidor'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                        }
                                    }
                                } else {
                                    echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                }
                                ?>
                            </div>
                            <div class="card-text my-2">
                                <strong class="card-title my-0"><?php echo $row_ubicacion[0]['nombre_repartidor'] ?></strong>
                                <p class="small text-muted mb-0"><?php echo $row_ubicacion[0]['apellido_repartidor'] ?></p>
                                <p class="small text-muted mb-0 mt-5">Dirección actual</p>
                                <strong class="card-title my-0"><?php echo $row_ubicacion[0]['direccion_ubicacion_repartidor'] ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>