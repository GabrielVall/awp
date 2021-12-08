<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $_POST['id_orden_producto'] . "');");
$total_ordenes_ingredientes = count($row_ordenes_ingredientes);

?>
<div class="card-header d-flex justify-content-between align-items-center">
    <strong class="card-title">Ingredientes</strong>
    <button class="btn btn-sm btn-light" id="volver_ordenes_productos" data-orden="<?php echo $_POST['id_orden']; ?>">Volver</button>
</div>
<div class="card-body table-responsive">
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th scope="col">Ingrediente</th>
                <th scope="col" class="text-right">Precio</th>
                <th scope="col" class="text-right">Cantidad</th>
                <th scope="col" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subtotal = 0;
            if ($total_ordenes_ingredientes > 0) {
                for ($i = 0; $i < $total_ordenes_ingredientes; $i++) {
                    echo
                    '<tr>
                        <td>' . $row_ordenes_ingredientes[$i]['nombre_ingrediente_extra'] . '</td>
                        <td class="text-right">'.$row_ordenes_ingredientes[$i]['simbolo_tipo_cambio'] . $row_ordenes_ingredientes[$i]['precio_orden_ingrediente'] . '</td>
                        <td class="text-right">' . $row_ordenes_ingredientes[$i]['cantidad_orden_ingrediente'] . '</td>
                        <td class="text-right">'.$row_ordenes_ingredientes[$i]['simbolo_tipo_cambio'] . $row_ordenes_ingredientes[$i]['importe_orden_ingrediente'] . '</td>
                    </tr>';
                    $subtotal+=str_replace(",","",$row_ordenes_ingredientes[$i]['importe_orden_ingrediente']);
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
                    <span class="text-muted">Total : </span>
                    <strong><?php echo $row_ordenes_ingredientes[0]['simbolo_tipo_cambio'].number_format($subtotal, 2, '.', ','); ?></strong>
                </p>
            </div>
        </div>
    </div>
</div>