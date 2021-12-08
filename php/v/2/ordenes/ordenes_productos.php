<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes2('" . $_POST['id_orden'] . "');");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_ordenes_productos1('" . $_POST['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

?>
<div class="card-header">
    <strong class="card-title">Productos de la orden</strong>
</div>
<div class="card-body table-responsive">
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Observaciones</th>
                <th scope="col" class="text-right">Precio</th>
                <th scope="col" class="text-right">Cantidad</th>
                <th scope="col" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subtotal=0;
            $subtotal_ing=0;
            if ($total_ordenes_productos > 0) {
                for ($i = 0; $i < $total_ordenes_productos; $i++) {
                    echo
                    '<tr>
                        <td>' . $row_ordenes_productos[$i]['nombre_producto'].'
                            <br>
                            <span class="small text-muted">';
                            
                            $row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $row_ordenes_productos[$i]['id_orden_producto'] . "');");
                            $total_ordenes_ingredientes = count($row_ordenes_ingredientes);

                            if($total_ordenes_ingredientes>0){
                                $span_ing='<br><span class="small text-muted">';
                                for($j=0; $j<$total_ordenes_ingredientes; $j++){
                                    if($j==0){
                                        echo '<a href="javascript:void(0);" class="text-muted" data-orden="'.$_POST['id_orden'].'" data-id="'.$row_ordenes_productos[$i]['id_orden_producto'].'" id="ver_ordenes_ingredientes">Ver ingredientes</a>';
                                    }
                                    $subtotal_ing+=$row_ordenes_ingredientes[$i]['importe_orden_ingrediente'];
                                }
                                $span_ing.='+$'.number_format($subtotal_ing,2,'.',',').'</span>';
                            }
                            else{
                                $span_ing='';
                            }
                            echo
                            '</span>
                        </td>
                        <td>' . $row_ordenes_productos[$i]['comentarios_orden_producto'] . '</td>
                        <td class="text-right">$' . $row_ordenes_productos[$i]['precio_orden_producto'] . '</td>
                        <td class="text-right">' . $row_ordenes_productos[$i]['cantidad_orden_producto'] . '</td>
                        <td class="text-right">$' . $row_ordenes_productos[$i]['importe_orden_producto'] . $span_ing. '</td>
                    </tr>';
                    $subtotal+=str_replace(",","",$row_ordenes_productos[$i]['importe_orden_producto']);
                }
            }
            ?>
        </tbody>
    </table>
    <div class="row mt-5">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="text-right mr-2">
                <p class="mb-2 h6">
                    <span class="text-muted">Subtotal : </span>
                    <strong>$<?php echo number_format(($subtotal+$subtotal_ing), 2, '.', ','); ?></strong>
                </p>
                <p class="mb-2 h6">
                    <span class="text-muted">Descuento: </span>
                    <strong class="text-danger">-$<?php echo $row_orden[0]['descuento_cupon']?></strong>
                </p>
                <p class="mb-2 h6">
                    <span class="text-muted">Total de orden : </span>
                    <span>$<?php echo $row_orden[0]['costo_total_orden']; ?></span>
                </p>
                <p class="mb-2 h6">
                    <span class="text-muted">Costo de envío : </span>
                    <strong>$<?php echo $row_orden[0]['costo_envio_orden']; ?></strong>
                </p>
                <p class="mb-2 h6">
                    <span class="text-muted">Servicio de app : </span>
                    <strong>$<?php echo $row_orden[0]['servicio_app']; ?></strong>
                </p>
                <p class="mb-2 h6">
                    <span class="text-muted">Total a pagar : </span>
                    <span><?php echo $row_orden[0]['simbolo_tipo_cambio'] . number_format((str_replace(",", "", $row_orden[0]['servicio_app']) + str_replace(",", "", $row_orden[0]['costo_total_orden']) + str_replace(",", "", $row_orden[0]['costo_envio_orden'])),2,'.',','); ?></span>
                </p>
            </div>
        </div>
    </div>
</div>