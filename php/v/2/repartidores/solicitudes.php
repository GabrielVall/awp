<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores1();");
$total_row_repartidores = count($row_repartidores);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center my-4">
                <div class="col">
                    <h2 class="h3 mb-0 page-title">Solicitudes de repartidores</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="row">
                <?php
                if($total_row_repartidores>0){
                    for ($i=0; $i < $total_row_repartidores; $i++) { 
                        echo 
                        '<div class="col-md-3" id="row_solicitud_'.$row_repartidores[$i]['id_repartidor'].'">
                            <div class="card shadow mb-4">
                                <div class="card-body text-center">
                                    <div class="avatar avatar-lg mt-4">';
                                        if (file_exists('../../../../img/repartidores/' . $row_repartidores[$i]['id_repartidor']) && count(glob('../../../../img/repartidores/' . $row_repartidores[$i]['id_repartidor'] . '/*')) > 0) {
                                            $directorio = opendir('../../../../img/repartidores/' . $row_repartidores[$i]['id_repartidor']);
                                            while ($archivo = readdir($directorio)) {
                                                if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                    echo '<img src="../img/repartidores/' . $row_repartidores[$i]['id_repartidor'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                                }
                                            }
                                        } else {
                                            echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                        }
                                    echo
                                    '</div>
                                    <div class="card-text my-2">
                                        <strong class="card-title my-0">'.$row_repartidores[$i]['nombre_repartidor'].'</strong>
                                        <p class="small text-muted mb-0">'.$row_repartidores[$i]['apellido_repartidor'].'</p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto"></div>
                                        <div class="col-auto">
                                            <div class="file-action">
                                                <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted sr-only">Action</span>
                                                </button>
                                                <div class="dropdown-menu m-2">
                                                    <a class="dropdown-item d-flex align-items-center" href="#documentos_repartidor_'.$row_repartidores[$i]['id_repartidor'].'"><span class="material-icons-round mr-2">description</span>Ver documentos</a>
                                                    <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="aceptar_repartidor" data-id="'.$row_repartidores[$i]['id_repartidor'].'"><span class="material-icons-round mr-2">check_circle_outline</span>Aceptar</a>
                                                    <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="rechazar_repartidor" data-id="'.$row_repartidores[$i]['id_repartidor'].'"><span class="material-icons-round mr-2">highlight_off</span>Rechazar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                }
                else{
                    echo
                    '<div class="col-12">
                        <div class="w-50 mx-auto text-center justify-content-center py-5 my-5">
                            <h2 class="page-title mb-0">No se encontraron resultados</h2>
                            <p class="lead text-muted mb-4">Por el momento no tienes nuevas solicitudes de repartidores</p>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- ACEPTAR -->
<div class="modal fade" id="modal_aceptar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Aceptar repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de aceptar la solicitud del repartidor? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_aceptar_repartidor">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- RECHAZAR -->
<div class="modal fade" id="modal_rechazar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Rechazar repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de rechazar la solicitud del repartidor? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_rechazar_repartidor">Confirmar</button>
            </div>
        </div>
    </div>
</div>