<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_menus = $sql->obtenerResultado("CALL sp_select_menus3('" . $_POST['id_sucursal'] . "');");
$total_row_menus = count($row_menus);

$_SESSION['id_sucursal_menu']=$_POST['id_sucursal'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Schedules de la sucursal</h2>
                </div>
                <div class="col-auto">
                    <a href="#nuevo_schedule" class="btn btn-dark">Agregar schedule</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table border table-hover bg-white">
                            <thead>
                                <tr role="row">
                                    <th>Schedule</th>
                                    <th class="text-center">Inicia a las</th>
                                    <th class="text-center">Termina a las</th>
                                    <th class="text-center">Próx. dia de activación</th>
                                    <th class="text-right">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_menus_sucursal">
                                <?php
                                if ($total_row_menus > 0) {
                                    for ($i = 0; $i < $total_row_menus; $i++) {
                                        echo
                                        '<tr id="row_menu_' . $row_menus[$i]['id_menu'] . '">
                                            <td>' . $row_menus[$i]['nombre_menu'] . '</td>
                                            <td class="text-center">' . $row_menus[$i]['hora_inicio_menu'] . 'hrs.</td>
                                            <td class="text-center">' . $row_menus[$i]['hora_fin_menu'] . 'hrs.</td>
                                            <td class="text-center">' . $row_menus[$i]['dia_activacion'] . '</td>
                                            <td class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#schedule_info_'.$row_menus[$i]['id_menu'].'">Editar</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_menus[$i]['id_menu'] . '" id="eliminar_menu">Eliminar</a>
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
                <h5 class="modal-title" id="defaultModalLabel">Eliminar schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el schedule? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_menu">Confirmar</button>
            </div>
        </div>
    </div>
</div>