<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes5('".$_POST['id_estado']."',10);");
$total_row_ordenes = count($row_ordenes);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

?>
<div class="card-header d-flex justify-content-between align-items-center" data-text="<?php echo $_POST['text']; ?>" data-estado="<?php echo $_POST['id_estado']; ?>">
    <div>
        <div class="form-group my-0 py-0 text-right">
            <label class="font-weight-bold text-dark"><?php echo $_POST['text']; ?></label>
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
        <table class="table table-hover">
            <thead>
                <tr>
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
                                <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_detail_'.$row_ordenes[$i]['id_orden'].'">Ver detalles</a>
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