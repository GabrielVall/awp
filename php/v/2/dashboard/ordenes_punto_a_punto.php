<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$row_ordenes_punto_a_punto = $sql->obtenerResultado("CALL sp_select_ordenes_punto_a_punto1();");
$total_row_ordenes_punto_a_punto = count($row_ordenes_punto_a_punto);

?>
<div class="card-header d-flex justify-content-between align-items-center">
    <div>
        <div class="form-group my-0 py-0 text-right">
            <label class="font-weight-bold text-dark">Ordenes (punto a punto)</label>
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
                    <th>Método de pago</th>
                    <th>Estado de orden</th>
                    <th>Fecha</th>
                    <th>Total de orden</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($total_row_ordenes_punto_a_punto>0){
                    for ($i=0; $i < $total_row_ordenes_punto_a_punto; $i++) { 
                        echo
                        '<tr id="row_orden_punto_a_punto_'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'">
                            <td><span class="dot dot-md '.$row_ordenes_punto_a_punto[$i]['color_origen_orden'].'"></span></td>
                            <td>#'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'</td>
                            <td style="max-width:200px;">
                                <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_punto_a_punto[$i]['nombre_cliente'].'</strong></p>
                                <small class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['apellido_cliente'].'</small>
                            </td>
                            <td style="max-width:350px;"
                                ><p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['nombre_metodo_pago'].'</p>
                            </td>
                            <td style="max-width:350px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['nombre_estado_orden'].'</p>
                            </td>
                            <td style="max-width:350px;">
                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['fecha_registro_orden_punto_a_punto'].' hrs.</p>
                            </td>
                            <td class="max-width:200px;">
                                <p class="mb-0 text-success text-truncate">'.$row_ordenes_punto_a_punto[$i]['simbolo_tipo_cambio']. $row_ordenes_punto_a_punto[$i]['total_orden_punto_a_punto'].'</p>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_punto_detail_'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'">Ver detalles</a>
                            </td>
                        </tr>';
                    }
                }
                else{
                    echo
                    '<tr>
                        <td colspan="8">No se encontraron resultados</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>