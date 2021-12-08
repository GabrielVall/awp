<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes5('4,6,8',0);");
$total_row_ordenes = count($row_ordenes);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title">Ordenes disponibles para asignar</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#inicio" class="text-decoration-none text-muted">Panel de control</a></li>
                            <li class="breadcrumb-item"><a href="#asignar_orden_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted">Asignar orden</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span></span>
                            <div>
                                <div class="form-group my-0 py-0 text-right">
                                    <label class="font-weight-bold text-dark">Origen de orden</label>
                                </div>
                                <div class="form-group my-0 py-0">
                                    <?php
                                    if($total_row_origenes_orden>0){
                                        for($i=1; $i<$total_row_origenes_orden; $i++){
                                            echo '<label class="mr-2"><span class="dot dot-md '.$row_origenes_orden[$i]['color_origen_orden'].'"></span> '.$row_origenes_orden[$i]['nombre_origen_orden'].'</label>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body m-0 p-0">
                            <div class="table-responsive">
                                <table class="table border-borderless table-hover bg-white">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="2" class="text-center">No.</th>
                                            <th>Comprador</th>
                                            <th>Sucursal</th>
                                            <th>Tipo de orden</th>
                                            <th>Método de pago</th>
                                            <th>Estado de orden</th>
                                            <th>Dirección</th>
                                            <th>Fecha</th>
                                            <th>Total de orden</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($total_row_ordenes>0){
                                            for ($i=0; $i < $total_row_ordenes; $i++) { 
                                                echo
                                                '<tr id="row_orden_'.$row_ordenes[$i]['id_orden'].'">
                                                    <td><span class="dot dot-md '.$row_ordenes[$i]['color_origen_orden'].'"></span></td>
                                                    <td>#'.$row_ordenes[$i]['id_orden'].'</td>
                                                    <td style="max-width:200px;">
                                                        <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes[$i]['nombre_cliente'].'</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['apellido_cliente'].'</small>
                                                    </td>
                                                    <td style="max-width:250px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_sucursal'].'</p>
                                                    </td>
                                                    <td>'.$row_ordenes[$i]['nombre_tipo_orden'].'</td>
                                                    <td style="max-width:350px;"
                                                        ><p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_metodo_pago'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_estado_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['direccion_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['fecha_registro_orden'].' hrs.</p>
                                                    </td>
                                                    <td class="max-width:200px;">
                                                        <p class="mb-0 text-success text-truncate">'.$row_ordenes[$i]['simbolo_tipo_cambio']. $row_ordenes[$i]['costo_total_orden'].'</p>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-dark d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item d-flex align-items-center" href="#order_detail_'.$row_ordenes[$i]['id_orden'].'">Ver detalles</a>
                                                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="asignar_orden_repartidor" data-id="'.$row_ordenes[$i]['id_orden'].'" data-repartidor="'.$_POST['id_repartidor'].'">Asignar orden</a>
                                                        </div>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
                                                <td colspan="11">No se encontraron resultados</td>
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

<!-- ASIGNAR ORDEN -->
<div class="modal fade" id="modal_asignar_orden" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Asignar orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de asignar la orden al repartidor? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_asignar_orden_repartidor">Confirmar</button>
            </div>
        </div>
    </div>
</div>