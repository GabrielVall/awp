<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_producto = $sql->obtenerResultado("CALL sp_select_producto1('" . $_POST['id_producto'] . "');");

$row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_producto1('" . $row_producto[0]['id_sucursal'] . "');");
$total_row_categorias = count($row_categorias);

$_SESSION['nombre_producto_sucursal']=$row_producto[0]['nombre_producto'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Información del producto: <?php echo $row_producto[0]['nombre_producto']; ?></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $row_producto[0]['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $_SESSION['nombre_sucursal']; ?></a></li>
                            <li class="breadcrumb-item"><a href="#productos_sucursal_<?php echo $row_producto[0]['id_sucursal']; ?>" class="text-decoration-none text-muted">Productos</a></li>
                            <li class="breadcrumb-item"><a href="#producto_info_<?php echo $_POST['id_producto'] ?>" class="text-decoration-none text-muted"><?php echo $row_producto[0]['nombre_producto']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- INFORMACIÓN -->
                <div class="col-sm-12 col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Información del producto</strong>
                        </div>
                        <div class="card-body" id="content_info">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control name_format" value="<?php echo $row_producto[0]['nombre_producto']; ?>" id="nombre_producto">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Descripción</label>
                                        <textarea id="descripcion_producto" rows="5" class="form-control string_format"><?php echo $row_producto[0]['descripcion_producto']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Categoría</label>
                                        <select id="id_categoria_producto">
                                            <?php
                                            if ($total_row_categorias > 0) {
                                                $selected='';
                                                foreach ($row_categorias as $dato) {
                                                    if($dato['id_categoria_producto']==$row_producto[0]['id_categoria_producto']){
                                                        $selected='selected';
                                                    }
                                                    else{
                                                        $selected='';
                                                    }
                                                    echo '<option '.$selected.' value="' . $dato['id_categoria_producto'] . '">' . $dato['nombre_categoria_producto'] . '</option>';
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
                                            <input type="text" class="form-control price_format" value="<?php echo $row_producto[0]['tiempo_preparacion_producto']; ?>" id="tiempo_preparacion_producto">
                                            <div class="input-group-append">
                                                <span class="input-group-text">min</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Precio</label>
                                                <input type="text" class="form-control form-control-sm price_format" value="<?php echo $row_producto[0]['precio_producto']; ?>" id="precio_producto">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Precio por kg</label>
                                                <input type="text" class="form-control form-control-sm price_format" value="<?php echo $row_producto[0]['precio_kg_producto']; ?>" id="precio_kg_producto">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-outline-dark" id="btn_guardar_producto" data-id="<?php echo $_POST['id_producto']; ?>">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="row">
                        <!-- IMÁGENES -->
                        <div class="col-sm-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-0 py-0">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">collections</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp;</p>
                                            <h3 class="h5 mt-4 ml-2">Imágenes</h3>
                                            <p class="text-muted">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#imagenes_productos_<?php echo $_POST['id_producto']; ?>" class="text-muted">
                                        <span>Ver ingredientes del producto</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- INGREDIENTES -->
                        <div class="col-sm-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-0 py-0">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">add_box</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp;</p>
                                            <h3 class="h5 mt-4 ml-2">Ingredientes</h3>
                                            <p class="text-muted">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#ingredientes_productos_<?php echo $_POST['id_producto'].'_'.$row_producto[0]['id_sucursal']; ?>" class="text-muted">
                                        <span>Ver ingredientes del producto</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- SCHEDULE -->
                        <div class="col-sm-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-0 py-0">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">date_range</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp;</p>
                                            <h3 class="h5 mt-4 ml-2">Schedule</h3>
                                            <p class="text-muted">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#menus_productos_<?php echo $_POST['id_producto'].'_'.$row_producto[0]['id_sucursal']; ?>" class="text-muted">
                                        <span>Agregar producto a un schedule</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // SLIMSELECT
    var select_id_categoria_producto = new SlimSelect({
        select: '#id_categoria_producto',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría',
    });
</script>