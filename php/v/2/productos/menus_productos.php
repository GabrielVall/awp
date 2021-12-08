<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_detalle_menus = $sql->obtenerResultado("CALL sp_select_detalle_menu1('" . $_POST['id_producto'] . "');");
$total_row_detalle_menus = count($row_detalle_menus);

$row_menus = $sql->obtenerResultado("CALL sp_select_menus2('" . $_POST['id_sucursal'] . "','" . $_POST['id_producto'] . "');");
$total_row_menus = count($row_menus);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Schedules del producto</h2>
                </div>
                <div class="col-auto">
                    <div class="col-auto">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb bg-light">
                                <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                                <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                                <li class="breadcrumb-item"><a href="#productos_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Productos</a></li>
                                <li class="breadcrumb-item"><a href="#producto_info_<?php echo $_POST['id_producto'] ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_producto_sucursal']; ?></a></li>
                                <li class="breadcrumb-item"><a href="#menus_productos_<?php echo $_POST['id_producto'].'_'.$_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Schedules</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- SCHEDULES DEL PRODUCTO -->
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Schedules donde se encuentra el producto</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-hover bg-white">
                                    <thead>
                                        <tr role="row">
                                            <th>Schedule</th>
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_detalle_productos_menus">
                                        <?php
                                        if ($total_row_detalle_menus > 0) {
                                            for ($i = 0; $i < $total_row_detalle_menus; $i++) {
                                                echo
                                                '<tr id="row_detalle_menu_' . $row_detalle_menus[$i]['id_menu'] . '">
                                                        <td>' . $row_detalle_menus[$i]['nombre_menu'] . '</td>
                                                        <td class="d-flex justify-content-end">
                                                            <button class="btn btn-light" id="eliminar_detalle_producto_menu" data-producto="'.$_POST['id_producto'].'" data-id="' . $row_detalle_menus[$i]['id_menu'] . '">Quitar schedule</button>
                                                        </td>
                                                    </tr>';
                                            }
                                        } else {
                                            echo
                                            '<tr id="detalle_menu_empty">
                                                <td colspan="2">No se encontraron resultados</td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SCHEDULES -->
                <div class="col-sm-12">
                    <div class="card shadow my-4">
                        <div class="card-header">
                            <strong class="card-title">Agregar a más schedules</strong>
                        </div>
                        <div class="card-body">
                            <div class="row" id="content_menus" style="overflow-y: auto; max-height: 600px;">
                                <?php
                                if ($total_row_menus > 0) {
                                    foreach ($row_menus as $dato) {
                                        echo
                                        '<div class="col-sm-12 col-md-4 my-4">
                                            <div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;">
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="my-0 text-muted small">&nbsp</div>
                                                            <strong>' . $dato['nombre_menu'] . '</strong>
                                                            <div class="my-0 text-muted small">&nbsp</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="display:none;" type="checkbox" data-id="' . $dato['id_menu'] . '">
                                                                <label>Agregar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                    echo
                                    '<div class="col-sm-12" id="card_button">
                                        <div class="form-group text-right">
                                            <button class="btn btn-outline-dark" id="btn_agregar_detalle_producto_menus" data-id="'.$_POST['id_producto'].'">Agregar schedules</button>
                                        </div>
                                    </div>';
                                } else {
                                    echo
                                    '<div class="col-sm-12" id="card_menu_empty">
                                        <h5 class="text-center">No se encontraron resultados</h5>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- ELIMINAR DETALLE -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Quitar ingrediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de quitar el ingrediente del producto? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_detalle_producto_menu">Confirmar</button>
            </div>
        </div>
    </div>
</div>