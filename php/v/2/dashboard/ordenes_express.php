<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes_express = $sql->obtenerResultado("CALL sp_select_ordenes_express1();");
$total_row_ordenes_express = count($row_ordenes_express);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

?>
<div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <div class="form-group my-0 py-0 text-right">
            <label class="font-weight-bold text-dark">Ordenes (sucursales express)</label>
        </div>
        <p class="card-text">Últimas 10</p>
    </div>
    <div>
        <div class="form-group my-0 py-0 text-right">
            <label class="font-weight-bold text-dark">Origen de orden</label>
        </div>
        <div class="form-group my-0 py-0">
            <?php
            if($total_row_origenes_orden>0){
                foreach($row_origenes_orden as $dato){
                    echo '<label class="mr-2"><span class="dot dot-md '.$dato['color_origen_orden'].'"></span> '.$dato['nombre_origen_orden'].'</label>';
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="card-body m-0 p-0">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="2" class="text-center">No.</th>
                    <th>Comprador</th>
                    <th>Sucursal</th>
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
                if($total_row_ordenes_express>0){
                    for ($i=0; $i < $total_row_ordenes_express; $i++) { 
                        echo
                        '<tr id="row_orden_'.$row_ordenes_express[$i]['id_orden_express'].'">
                            <td><span class="dot dot-md '.$row_ordenes_express[$i]['color_origen_orden'].'"></span></td>
                            <td>#'.$row_ordenes_express[$i]['id_orden_express'].'</td>
                            <td style="max-width:200px;">
                                <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_express[$i]['nombre_cliente'].'</strong></p>
                                <small class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['apellido_cliente'].'</small>
                            </td>
                            <td style="max-width:250px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_sucursal_express'].'</p>
                            </td>
                            <td style="max-width:350px;"
                                ><p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_metodo_pago'].'</p>
                            </td>
                            <td style="max-width:350px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_estado_orden'].'</p>
                            </td>
                            <td style="max-width:350px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['direccion_orden_express'].'</p>
                            </td>
                            <td style="max-width:350px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['fecha_registro_orden_express'].' hrs.</p>
                            </td>
                            <td class="max-width:200px;">
                                <p class="mb-0 text-success text-truncate">'.$row_ordenes_express[$i]['simbolo_tipo_cambio']. $row_ordenes_express[$i]['total_orden_express'].'</p>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_express_detail_'.$row_ordenes_express[$i]['id_orden_express'].'">Ver detalles</a>
                            </td>
                        </tr>';
                    }
                }
                else{
                    echo
                    '<tr>
                        <td colspan="10">No se encontraron resultados</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
