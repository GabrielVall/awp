<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_complementos = $sql->obtenerResultado("CALL sp_select_ingredientes1('".$_SESSION['id_sucursal_bxpress']."')");
$total_complementos = count($row_complementos);
?>
<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha de registro</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Inicio</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Terminado</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Detalle</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if($total_complementos > 0){
                foreach($row_complementos as $complemento){
                    $extras = '[';
                    $row_extra = $sql->obtenerResultado("CALL sp_select_ingredientes_extras1('".$complemento['id_ingrediente']."')");
                    foreach ($row_extra as $extra){
                        $extras .= '{';
                        $row_detalle = $sql->obtenerResultado("CALL sp_select_detalle_ingrediente_sub1('".$extra[0]."')");
                        $extras .= '"id_extra":'.$extra[0].',"nombre":"'.$extra[1].'","precio":"'.$extra[2].'","ids":"';
                        foreach ($row_detalle as $detalle) {
                            $extras .= $detalle[1].',';
                        }
                        if(count($row_detalle) > 0){
                            $extras = substr($extras, 0, -1);
                        }
                        $extras .= '"';
                        $extras .= '},';
                    }
                    if(count($row_extra) > 0){
                        $extras = substr($extras, 0, -1);
                    }
                    $extras .= ']';
                    ?>
                    <tr class="text-center my-1">
                        <td>
                            <p class="mb-0 text-sm nombre_ingrediente"><?php echo $complemento['nombre_ingrediente']; ?></p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0 cantidad_minima"><?php echo $complemento['cantidad_minima_ingrediente']; ?></p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0 cantidad_maxima"><?php echo $complemento['cantidad_maxima_ingrediente']; ?></p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0" data-multiple="<?php echo $complemento['multiple_ingrediente']; ?>">
                            <?php echo $complemento['multiple_ingrediente']; ?>
                            </p>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">
                                <button type="button" class="btn btn-secondary btn-sm mb-0 py-1 px-3" id="btn_editar_complemento" 
                                data-id="<?php echo $complemento['id_ingrediente']; ?>"
                                data-complementos='<?php echo $extras; ?>'>
                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                </button>
                                <button type="button" data-id="<?php echo $complemento['id_ingrediente']; ?>" class="btn btn-danger btn-sm mb-0 py-1 px-3" id="btn_eliminar_complemento">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                            </p>
                        </td>
                    </tr>
                <?php }
            }else{ echo sinResultados('servicios',5); } ?>
        </tbody>
    </table>
</div>