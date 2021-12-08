<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_horarios_sucursal = $sql->obtenerResultado("CALL sp_select_horarios_sucursales1('" . $_POST['id_sucursal'] . "');");
$total_row_horarios_sucursal = count($row_horarios_sucursal);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Horarios</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#horarios_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Horarios</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col"></div>
                <div class="col-auto">
                    <button class="btn btn-dark" data-toggle="modal" data-target="#modal_agregar">Agregar horario</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table border table-hover bg-white">
                            <thead>
                                <tr role="row">
                                    <th>Día</th>
                                    <th>Abierto</th>
                                    <th>Cerrado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_horarios_sucursal">
                                <?php
                                if ($total_row_horarios_sucursal > 0) {
                                    for ($i = 0; $i < $total_row_horarios_sucursal; $i++) {
                                        echo
                                        '<tr id="row_horario_' . $row_horarios_sucursal[$i]['id_horario_sucursal'] . '">
                                            <td>' . $row_horarios_sucursal[$i]['dia'] . '</td>
                                            <td>' . $row_horarios_sucursal[$i]['hora_abierto_sucursal'] . 'hrs.</td>
                                            <td>' . $row_horarios_sucursal[$i]['hora_cerrado_sucursal'] . 'hrs.</td>
                                            <td>
                                                <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_horarios_sucursal[$i]['id_horario_sucursal'] . '" id="editar_horario_sucursal">Editar</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-id="' . $row_horarios_sucursal[$i]['id_horario_sucursal'] . '" id="eliminar_horario_sucursal">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>';
                                    }
                                }
                                else{
                                    echo
                                    '<tr id="horarios_empty">
                                        <td colspan="4">No se encontraron resultados</td>
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

<!-- AGREGAR -->
<div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Agregar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_horario">
                <div class="col-form-group">
                    <label class="form-label">Día</label>
                    <select id="agregar_dia" class="form-control form-control-sm">
                        <option value="0">Domingo</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miércoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sábado</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Abierto</label>
                        <input type="time" class="form-control form-control-sm" id="agregar_hora_abierto">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Abierto</label>
                        <input type="time" class="form-control form-control-sm" id="agregar_hora_cerrado">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_horario_sucursal" data-id="<?php echo $_POST['id_sucursal']; ?>">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_editar_horario">
                <div class="col-form-group">
                    <label class="form-label">Día</label>
                    <select id="editar_dia" class="form-control form-control-sm">
                        <option value="0">Domingo</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miércoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sábado</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Abierto</label>
                        <input type="time" class="form-control form-control-sm" id="editar_hora_abierto">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Abierto</label>
                        <input type="time" class="form-control form-control-sm" id="editar_hora_cerrado">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_horario_sucursal">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el horario? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_horario_sucursal">Confirmar</button>
            </div>
        </div>
    </div>
</div>