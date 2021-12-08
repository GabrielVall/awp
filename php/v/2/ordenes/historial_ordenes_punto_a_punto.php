<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ordenes_punto_a_punto = $sql->obtenerResultado("CALL sp_select_ordenes_punto_a_punto3('".$_POST['tipo_fecha']."','".$_POST['fecha']."');");
$total_row_ordenes_punto_a_punto = count($row_ordenes_punto_a_punto);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

?>
<div class="card-header d-flex justify-content-between align-items-center">
    <strong class="card-title float-left">Historial de ordenes (punto a punto)</strong>
    <div>
        <ul class="pagination pagination-sm">
            <?php
            if ($total_row_ordenes_punto_a_punto > 0) {
                $limite_paginacion = 10;
                $last_page = ($total_row_ordenes_punto_a_punto / $limite_paginacion);
                $bolean = false;

                if (is_float($last_page)) {
                    $fin_for = ($last_page + 1);
                } else {
                    $fin_for = $last_page;
                }

                echo
                '<li class="page-item paginate_button" id="prev_page">
                    <a class="page-link"><span aria-hidden="true">Ant.</span></a>
                </li>';
                for ($i = 0; $i < intval($fin_for); $i++) {

                    if (($i + 1) <= 5) {
                        echo
                        '<li class="page-item paginate_button page-item-' . ($i + 1) . ' ';
                        if ($i == 0) {
                            echo 'active';
                        }
                        echo '" id="new_page" data-page="' . ($i + 1) . '"><a class="page-link">' . ($i + 1) . '</a></li>';
                    } else {
                        $bolean = true;
                    }
                }
                if ($bolean == true) {

                    echo
                    '<li class="page-item paginate_button">
                            <a class="page-link">...</a>
                        </li>';
                }
                echo
                '<li class="page-item paginate_button" id="next_page" data-last="' . intval($fin_for) . '">
                        <a class="page-link"><span aria-hidden="true">Sig.</span></a>
                    </li>';
            }
            ?>
        </ul>
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