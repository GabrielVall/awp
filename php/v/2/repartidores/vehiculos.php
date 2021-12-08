<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_transportes = $sql->obtenerResultado("CALL sp_select_detalle_transporte_repartidor1('" . $_POST['id_repartidor'] . "');");
$total_row_transportes = count($row_transportes);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Transportes del repartidor</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#repartidores" class="text-decoration-none text-muted">Repartidores</a></li>
                            <li class="breadcrumb-item"><a href="#info_conductor_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_repartidor']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#vehiculos_repartidor_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted">Vehículos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <strong class="card-title">Transportes del repartidor</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo de transporte</th>
                                            <th>Modelo</th>
                                            <th>Color</th>
                                            <th>Detalles adicionales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($total_row_transportes>0){
                                            for ($i=0; $i < $total_row_transportes; $i++) { 
                                                echo
                                                '<tr id="row_transporte_'.$row_transportes[$i]['id_detalle_transporte'].'">
                                                    <th scope="row">'.$row_transportes[$i]['nombre_tipo_transporte'];
                                                        if($row_transportes[$i]['estado_detalle_transporte_repartidor']==1){
                                                            echo '<br><span class="badge badge-light text-success">En uso</span>';
                                                        }
                                                    echo
                                                    '</th>
                                                    <td class="text-muted">'.$row_transportes[$i]['modelo'].'</td>
                                                    <td class="text-muted">'.$row_transportes[$i]['color'].'</td>
                                                    <td class="text-muted">'.$row_transportes[$i]['descripcion_detalle_transporte_repartidor'].'</td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
                                                <td colspan="4">No se encontraron resultados</td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- IMAGEN -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar al repartidor? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_repartidor">Confirmar</button>
            </div>
        </div>
    </div>
</div>