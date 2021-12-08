<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ingredientes = $sql->obtenerResultado("CALL sp_select_ingredientes1('" . $_SESSION['id_sucursal_ingrediente'] . "')");
$total_row_ingredientes = count($row_ingredientes);

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$row_ingrediente = $sql->obtenerResultado("CALL sp_select_ingrediente1('" . $_POST['id_ingrediente'] . "')");

$row_ingredientes_extras = $sql->obtenerResultado("CALL sp_select_ingredientes_extras1('" . $_POST['id_ingrediente'] . "')");
$total_row_ingredientes_extras = count($row_ingredientes_extras);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Ingrediente: <?php echo $row_ingrediente[0]['nombre_ingrediente']; ?></h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Actualizar información</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 border-right" id="content_ingrediente">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" value="<?php echo $row_ingrediente[0]['nombre_ingrediente']; ?>" class="form-control name_format form-control-sm" id="nombre_ingrediente">
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Cantidad mínima</label>
                                        <input type="text" value="<?php echo $row_ingrediente[0]['cantidad_minima_ingrediente']; ?>" class="form-control form-control-sm price_format" id="cantidad_minima_ingrediente">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Cantidad máxima</label>
                                        <input type="text" value="<?php echo $row_ingrediente[0]['cantidad_maxima_ingrediente']; ?>" class="form-control form-control-sm price_format" id="cantidad_maxima_ingrediente">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Selección múltiple</label>
                                <select id="seleccion_multiple_ingrediente" class="form-control form-control-sm">
                                    <option value="0" <?php if ($row_ingrediente[0]['multiple_ingrediente'] == 0) { echo 'selected'; } ?>>No</option>
                                    <option value="1" <?php if ($row_ingrediente[0]['multiple_ingrediente'] == 1) { echo 'selected'; } ?>>Si</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group text-right">
                                <a href="javascript:void(0)" class="text-muted" data-toggle="modal" data-target="#modal_ing_extra">Agregar adicional</a>
                            </div>
                            <div class="form-group">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th class="text-center">Precio</th>
                                            <th>Subcomplementos</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_ingredientes_extras">
                                        <?php
                                        if ($total_row_ingredientes_extras > 0) {
                                            foreach ($row_ingredientes_extras as $dato) {

                                                $row_detalle_ing_extra = $sql->obtenerResultado("CALL sp_select_detalle_ingrediente_sub1('" . $dato['id_ingrediente_extra'] . "')");
                                                $total_row_detalle_ing_extra = count($row_detalle_ing_extra);
                                                $detalle_ing_extra = '';
                                                $id_detalle_ing_extra = '';
                                                $id_ingrediente_ing_extra = '';

                                                if ($total_row_detalle_ing_extra > 0) {
                                                    foreach ($row_detalle_ing_extra as $detalle) {
                                                        $detalle_ing_extra .= $detalle['nombre_ingrediente'] . ', ';
                                                        $id_detalle_ing_extra .= $detalle['id_ingrediente_sub'] . ',';
                                                        $id_ingrediente_ing_extra .= $detalle['id_ingrediente'] . ',';
                                                    }
                                                    $detalle_ing_extra=substr($detalle_ing_extra, 0, -2);
                                                    $id_detalle_ing_extra=substr($id_detalle_ing_extra, 0, -1);
                                                    $id_ingrediente_ing_extra=substr($id_ingrediente_ing_extra, 0, -1);
                                                }

                                                echo
                                                '<tr id="tr_row_ing_adicional_' . $dato['id_ingrediente_extra'] . '">
                                                    <th scope="col">' . $dato['nombre_ingrediente_extra'] . '</th>
                                                    <td class="text-center">'. $dato['simbolo'] . $dato['precio_ingrediente_extra'] . '</td>
                                                    <td data-ids="">' . $detalle_ing_extra . '</td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-detalle="' . $detalle_ing_extra . '" data-ingrediente="' . $id_ingrediente_ing_extra . '" data-id_detalle="' . $id_detalle_ing_extra . '" data-id="' . $dato['id_ingrediente_extra'] . '" data-simbolo="'.$simbolo[0]['simbolo_tipo_cambio'].'" id="editar_ing_extra" class="text-muted mr-2">Editar</a>
                                                        <a href="javascript:void(0);" data-id="' . $dato['id_ingrediente_extra'] . '" id="quitar_ing_extra" class="text-muted">Eliminar</a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group text-right mt-4">
                        <button class="btn btn-outline-dark" id="btn_guardar_ingrediente" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>" data-id="<?php echo $_POST['id_ingrediente']; ?>">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- AGREGAR INGREDIENTE EXTRA -->
<div class="modal fade" id="modal_ing_extra" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Agregar adicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_ing_adicional">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" id="nombre_adicional" class="form-control name_format form-control-sm">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label">Precio</label>
                        <input type="text" id="precio_adicional" class="form-control price_format form-control-sm">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label class="form-label">Agregar subcomplementos</label>
                    <select multiple id="id_sub_complementos">
                        <?php
                        if ($total_row_ingredientes > 0) {
                            foreach ($row_ingredientes as $dato) {
                                echo '<option name="' . $dato['nombre_ingrediente'] . '" value="' . $dato['id_ingrediente'] . '">' . $dato['nombre_ingrediente'] . '</option>';
                            }
                        } else {
                            echo '<option value="0">No se encontraron resultados</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_ingrediente_adicional" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>">Agregar</button>
            </div>
        </div>
    </div>
</div>
<!-- ELIMIANR INGREDIENTE EXTRA -->
<div class="modal fade" id="modal_eliminar_ing_extra" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar adicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de eliminar el ingrediente adicional? De click en Confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_ingrediente_extra">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- EDITAR INGREDIENTE EXTRA -->
<div class="modal fade" id="modal_editar_ing_extra" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Editar adicional</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4" id="content_editar_ing_extra">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control name_format form-control-sm" id="editar_nombre_ing_adicional">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Precio</label>
                                    <input type="text" class="form-control form-control-sm price_format" id="editar_precio_ing_adicional">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subcomplementos</label>
                            <select multiple id="editar_id_sub_complementos">
                                <?php
                                if ($total_row_ingredientes > 0) {
                                    foreach ($row_ingredientes as $dato) {
                                        echo '<option name="' . $dato['nombre_ingrediente'] . '" value="' . $dato['id_ingrediente'] . '">' . $dato['nombre_ingrediente'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="0">No se encontraron resultados</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Subcomplementos</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_editar_ingredientes_extras"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_editar_ing_extra" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_editar_id_sub_complementos = new SlimSelect({
        select: '#editar_id_sub_complementos',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un subcomplemento',
        closeOnSelect: false,
    });
    var select_id_sub_complementos = new SlimSelect({
        select: '#id_sub_complementos',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un subcomplemento',
        closeOnSelect: false,
    });
</script>