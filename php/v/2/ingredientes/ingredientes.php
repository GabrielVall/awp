<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ingredientes = $sql->obtenerResultado("CALL sp_select_ingredientes3('" . $_POST['id_sucursal'] . "');");
$total_row_ingredientes = count($row_ingredientes);

$_SESSION['id_sucursal_ingrediente']=$_POST['id_sucursal'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Ingredientes de la sucursal</h2>
                </div>
                <div class="col-auto">
                    <a href="#nuevo_ingrediente" class="btn btn-dark">Agregar ingrediente</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table border table-hover bg-white">
                            <thead>
                                <tr role="row">
                                    <th>Ingrediente</th>
                                    <th class="text-center">Cantidad min.</th>
                                    <th class="text-center">Cantidad max.</th>
                                    <th class="text-center">Selección múltiple</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_ingredientes_sucursal">
                                <?php
                                if ($total_row_ingredientes > 0) {
                                    for ($i = 0; $i < $total_row_ingredientes; $i++) {
                                        echo
                                        '<tr id="row_ingrediente_' . $row_ingredientes[$i]['id_ingrediente'] . '">
                                            <td>' . $row_ingredientes[$i]['nombre_ingrediente'] . '</td>
                                            <td class="text-center">' . $row_ingredientes[$i]['cantidad_minima_ingrediente'] . '</td>
                                            <td class="text-center">' . $row_ingredientes[$i]['cantidad_maxima_ingrediente'] . '</td>
                                            <td class="text-center">' . $row_ingredientes[$i]['multiple_ingrediente'] . '</td>
                                            <td class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#ingrediente_info_'.$row_ingredientes[$i]['id_ingrediente'].'">Editar</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_ingredientes[$i]['id_ingrediente'] . '" id="eliminar_ingrediente">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo
                                    '<tr id="ingredientes_empty">
                                        <td colspan="5">No se encontraron resultados</td>
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
<!-- MODALES -->
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar ingrediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el ingrediente? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_ingrediente">Confirmar</button>
            </div>
        </div>
    </div>
</div>