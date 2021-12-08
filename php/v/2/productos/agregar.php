<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_producto1('" . $_SESSION['id_sucursal_producto'] . "');");
$total_row_categorias = count($row_categorias);

$row_ingredientes = $sql->obtenerResultado("CALL sp_select_ingredientes1('" . $_SESSION['id_sucursal_producto'] . "');");
$total_row_ingredientes = count($row_ingredientes);

$row_menus = $sql->obtenerResultado("CALL sp_select_menus1('" . $_SESSION['id_sucursal_producto'] . "');");
$total_row_menus = count($row_menus);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nuevo producto</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_SESSION['id_sucursal_producto']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#productos_sucursal_<?php echo $_SESSION['id_sucursal_producto']; ?>" class="text-decoration-none text-muted">Productos</a></li>
                            <li class="breadcrumb-item"><a href="#nuevo_producto" class="text-decoration-none text-muted">Nuevo producto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nuevo producto</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-info-tab" data-toggle="pill" href="#v-info" role="tab" aria-controls="v-info" aria-selected="true">Información del producto</a>
                                <a class="nav-link" id="v-ingredientes-tab" data-toggle="pill" href="#v-ingredientes" role="tab" aria-controls="v-ingredientes" aria-selected="false">Ingredientes</a>
                                <a class="nav-link" id="v-menus-tab" data-toggle="pill" href="#v-menus" role="tab" aria-controls="v-menus" aria-selected="false">Schedule</a>
                                <a class="nav-link" id="v-imagenes-tab" data-toggle="pill" href="#v-imagenes" role="tab" aria-controls="v-imagenes" aria-selected="false">Imágenes</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content mb-4" id="v-pills-tabContent">
                                <!-- INFO DEL PRODUCTO -->
                                <div class="tab-pane fade show active" id="v-info" role="tabpanel" aria-labelledby="v-info-tab">
                                    <div class="row" id="content_info">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control name_format" id="nombre_producto">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Descripción</label>
                                                <textarea id="descripcion_producto" rows="5" class="form-control string_format"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Categoría</label>
                                                <select id="id_categoria_producto">
                                                    <?php
                                                    if ($total_row_categorias > 0) {
                                                        foreach ($row_categorias as $dato) {
                                                            echo '<option value="' . $dato['id_categoria_producto'] . '">' . $dato['nombre_categoria_producto'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tiempo de preparación</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control price_format" id="tiempo_preparacion_producto">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">min</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Precio</label>
                                                        <input type="text" class="form-control form-control-sm price_format" id="precio_producto">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Precio por kg</label>
                                                        <input type="text" class="form-control form-control-sm price_format" id="precio_kg_producto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- INGREDIENTES -->
                                <div class="tab-pane fade mb-4" id="v-ingredientes" role="tabpanel" aria-labelledby="v-ingredientes-tab">
                                    <div class="row" id="content_ingredientes" style="overflow-y: auto; max-height: 600px;">
                                        <?php
                                        if($total_row_ingredientes>0){
                                            foreach($row_ingredientes as $dato){
                                                echo
                                                '<div class="col-sm-12 col-md-6 my-4">
                                                    <div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;">
                                                        <div class="list-group-item">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                                    <strong>'.$dato['nombre_ingrediente'].'</strong>
                                                                    <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" style="display:none;" type="checkbox" data-id="'.$dato['id_ingrediente'].'">
                                                                        <label>Agregar</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<div class="col-sm-12">
                                                <h5 class="text-center">Por el momento no se han agregado ingredientes con anterioridad</h5>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- MENUS -->
                                <div class="tab-pane fade mb-4" id="v-menus" role="tabpanel" aria-labelledby="v-menus-tab">
                                    <div class="row" id="content_menus" style="overflow-y: auto; max-height: 600px;">
                                        <?php
                                        if($total_row_menus>0){
                                            foreach($row_menus as $dato){
                                                echo
                                                '<div class="col-sm-12 col-md-6 my-4">
                                                    <div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;">
                                                        <div class="list-group-item">
                                                            <div class="row align-items-center">
                                                                <div class="col-auto">
                                                                    <span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                                    <strong>'.$dato['nombre_menu'].'</strong>
                                                                    <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" style="display:none;" type="checkbox" data-id="'.$dato['id_menu'].'">
                                                                        <label>Agregar</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<div class="col-sm-12">
                                                <h5 class="text-center">Por el momento no se han agregado schedules con anterioridad</h5>
                                            </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- IMÁGENES -->
                                <div class="tab-pane fade mb-4" id="v-imagenes" role="tabpanel" aria-labelledby="v-imagenes-tab">
                                    <div class="form-group">
                                        <div class="dropzone" id="myDropzone"></div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-outline-dark" id="btn_agregar_producto" data-id="<?php echo $_SESSION['id_sucursal_producto']; ?>">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- CROPPER -->
<div class="modal fade" id="modal_cropper" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recorte de imagen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_cropper" data-id="">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // CROPPER
    cropper_dropzone('.dropzone', '.jpg, .jpeg', 10, 'cropper_dropzone', 'productos', <?php echo $_SESSION['id_empresa_reparto_bexpress'];?>, 800, 600);

    // SLIMSELECT
    var select_id_categoria_producto = new SlimSelect({
        select: '#id_categoria_producto',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría',
    });
</script>