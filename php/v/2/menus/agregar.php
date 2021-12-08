<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_productos = $sql->obtenerResultado("CALL sp_select_productos2('" . $_SESSION['id_sucursal_menu'] . "');");
$total_row_productos = count($row_productos);

$row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_producto1('" . $_SESSION['id_sucursal_menu'] . "');");
$total_row_categorias = count($row_categorias);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nuevo schedule</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nuevo schedule</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 border-right" id="content_menu">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control form-control-sm name_format" id="nombre_menu">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">Hora inicio</label>
                                        <input type="text" id="hora_inicio_menu" class="form-control hora-menu bg-white" value="00:00">
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">Hora inicio</label>
                                        <input type="text" id="hora_fin_menu" class="form-control hora-menu bg-white" value="00:00">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Día(s) de activación</label>
                                <select id="dia_semana" multiple>
                                    <option value="0">Domingo</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="form-group d-flex justify-content-between">
                                <p class="mb-2"><strong>Productos que se mostrarán en el schedule</strong></p>
                                <a class="text-muted" href="javascript:void(0);" data-toggle="modal" data-target="#modal_categorias">
                                    <span class="material-icons-round">filter_list</span>
                                </a>
                            </div>
                            <div class="row" id="content_productos" style="overflow-y: auto; max-height: 600px;">
                                <?php
                                if ($total_row_productos > 0) {
                                    foreach ($row_productos as $dato) {
                                        echo
                                        '<div class="col-sm-12 col-md-6 my-4">
                                            <div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;" data-categoria="'.$dato['id_categoria_producto'].'">
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                            <strong>' . $dato['nombre_producto'] . '</strong>
                                                            <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="form-check">
                                                                <input class="form-check-input" style="display:none;" type="checkbox" data-id="' . $dato['id_producto'] . '">
                                                                <label>Agregar</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo
                                    '<div class="col-sm-12">
                                        <h5 class="text-center">Por el momento no se han agregado productos con anterioridad</h5>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_menu">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- CATEGORÍAS -->
<div class="modal fade modal-right modal-slide" id="modal_categorias" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Seleccionar por categorías</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y:auto;">
                <div class="list-group list-group-flush my-n3" id="content_filtro_categorias">
                    <?php
                    if($total_row_categorias>0){
                        foreach ($row_categorias as $dato) {
                            echo
                            '<div class="list-group-item border-bottom" id="filtro_categoria_schedule" data-id="'.$dato['id_categoria_producto'].'" style="cursor:pointer;">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="material-icons-round icon">radio_button_unchecked</span>
                                    </div>
                                    <div class="col">
                                        <small><strong>'.$dato['nombre_categoria_producto'].'</strong></small>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // FLATPICKR
    $(".hora-menu").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    // SLIMSELECT
    var select_dia_semana = new SlimSelect({
        select: '#dia_semana',
        showSearch: false,
        closeOnSelect: false,
        placeholder: 'Seleccione día(s) de activación',
    });
</script>