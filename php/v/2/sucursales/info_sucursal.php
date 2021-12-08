<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_sucursal = $sql->obtenerResultado("CALL sp_select_sucursal1('" . $_POST['id_sucursal'] . "');");

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$row_horarios_sucursal = $sql->obtenerResultado("CALL sp_select_horarios_sucursales1('" . $_POST['id_sucursal'] . "');");
$total_row_horarios_sucursal = count($row_horarios_sucursal);

$row_metodos_pago = $sql->obtenerResultado("CALL sp_select_sucursales_metodos_pago1('" . $_POST['id_sucursal'] . "');");
$total_row_metodos_pago = count($row_metodos_pago);

$row_totales = $sql->obtenerResultado("CALL sp_select_ordenes_sucursal1('" . $_POST['id_sucursal'] . "');");

$row_ordenes_totales = $sql->obtenerResultado("CALL sp_select_ordenes_sucursal2('" . $_POST['id_sucursal'] . "','5');");
$total_row_ordenes_totales = count($row_ordenes_totales);

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes4('" . $_POST['id_sucursal'] . "');");
$total_row_ordenes = count($row_ordenes);

$row_puntuaciones = $sql->obtenerResultado("CALL sp_select_puntuaciones_usuarios2('" . $_POST['id_sucursal'] . "');");
$total_row_puntuaciones = count($row_puntuaciones);

$row_zonas_horarias = $sql->obtenerResultado("CALL sp_select_zonas_horarias1();");
$total_row_zonas_horarias = count($row_zonas_horarias);

$row_categorias_sucursales = $sql->obtenerResultado("CALL sp_select_categorias_disponibles();");
$total_row_categorias_sucursales = count($row_categorias_sucursales);

$row_paises = $sql->obtenerResultado("CALL sp_select_paises();");
$total_row_paises = count($row_paises);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$_SESSION['nombre_sucursal']=$row_sucursal[0]['nombre_sucursal'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Información de sucursal: <?php echo $row_sucursal[0]['nombre_sucursal']; ?></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted"><?php echo $row_sucursal[0]['nombre_sucursal']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row align-items-center mb-2">
                <div class="col"></div>
                <div class="col-auto">
                    <a href="javascript:void(0);" class="text-muted mr-2" id="cambiar_imagen_sucursal" data-id="1"><span class="material-icons-round">photo</span></a>
                    <a href="javascript:void(0);" class="text-muted" data-toggle="modal" data-target="#modal_configuraciones_sucursal"><span class="material-icons-round">tune</span></a>
                </div>
            </div>
            <div class="row">
                <!-- INFORMACIÓN -->
                <div class="col-sm-12 col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Información de la sucursal</strong>
                        </div>
                        <div class="card-body" id="content_info">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control name_format form-control-sm" value="<?php echo $row_sucursal[0]['nombre_sucursal']; ?>" id="nombre_sucursal">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">Descripción</label>
                                        <textarea id="descripcion_sucursal" rows="5" class="form-control"><?php echo $row_sucursal[0]['descripcion_sucursal']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tel. contacto</label>
                                        <input type="text" class="form-control phone_format form-control-sm" value="<?php echo $row_sucursal[0]['telefono_sucursal']; ?>" id="telefono_sucursal">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tel. WhatsApp</label>
                                        <input type="text" class="form-control phone_format form-control-sm" value="<?php echo $row_sucursal[0]['telefono_whatsapp_sucursal']; ?>" id="telefono_whatsapp_sucursal">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <p class="mb-1 d-flex align-items-center justify-content-between">Dirección<span id="expandir_mapa" style="cursor:pointer;" data-map="#mapa_sucursal" class="material-icons-round">expand_more</span></p>
                                        <input type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row_sucursal[0]['direccion_sucursal']; ?>" data-limit="2000" id="direccion_sucursal">
                                        <input type="hidden" id="lat_sucursal" value="<?php echo $row_sucursal[0]['latitud_sucursal']; ?>">
                                        <input type="hidden" id="lon_sucursal" value="<?php echo $row_sucursal[0]['longitud_sucursal']; ?>">
                                        <div id="mapa_sucursal" style="height:300px; display: none; margin: auto; "></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <button type="button" class="btn mb-2 btn-outline-dark" data-id="<?php echo $_POST['id_sucursal']; ?>" id="btn_editar_info_sucursal">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4" id="group_horarios">
                    <!-- HORARIOS -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <strong>Horarios</strong>
                            <a class="text-muted" href="#horarios_sucursal_<?php echo $_POST['id_sucursal']; ?>">Editar</a>
                        </div>
                        <div class="card-body px-4" style="max-height:290px; overflow-y:auto;">
                            <table class="table mb-1 mx-n1 table-sm">
                                <thead>
                                    <tr>
                                        <th class="w-50">Día</th>
                                        <th class="text-right">Abierto</th>
                                        <th class="text-right">Cerrado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_row_horarios_sucursal > 0) {
                                        $prev = '';
                                        foreach ($row_horarios_sucursal as $dato) {
                                            if ($prev != $dato['dia']) {
                                                $dia = $dato['dia'];
                                            } else {
                                                $dia = '';
                                            }
                                            echo
                                            '<tr>
                                                <td>' . $dia . '</td>
                                                <td class="text-right">' . $dato['hora_abierto_sucursal'] . 'hrs.</td>
                                                <td class="text-right">' . $dato['hora_cerrado_sucursal'] . 'hrs.</td>
                                            </tr>';
                                            $prev = $dato['dia'];
                                        }
                                    } else {
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
                    <!-- CLIENTES BLOQUEADOS -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Clientes bloqueados</strong>
                                <a href="#ban_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-decoration-none text-muted">Ver clientes</a>
                            </div>
                        </div>
                        <div class="card-body my-n2">
                            <div class="d-flex">
                                <div class="flex-fill">
                                    <h4 class="mb-0 text-center"><?php echo $row_sucursal[0]['total_clientes_bloqueados']; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- IMÁGEN -->
                <div class="col-sm-12 col-md-4" id="group_img" style="display:none;">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <strong>Imagen de sucursal</strong>
                            <a class="text-muted" href="javascript:void(0);" id="cambiar_imagen_sucursal" data-id="0">Cancelar</a>
                        </div>
                        <div class="card-body px-4">
                            <div class="form-group content_dropzone">
                                <div class="dropzone" id="myDropzone"></div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-block btn-outline-dark" id="btn_cambiar_imagen_sucursal" data-id="<?php echo $_POST['id_sucursal']; ?>">Cambiar imagen</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MÉTODOS DE PAGO -->
                <div class="col-sm-12 col-md-6 mt-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Métodos de pago</strong>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush my-n3">
                                <?php
                                if ($total_row_metodos_pago > 0) {
                                    foreach ($row_metodos_pago as $dato) {
                                        echo
                                        '<div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <strong>' . $dato['nombre_metodo_pago'] . '</strong>
                                                    <div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_' . $dato['id_sucursal_metodo_pago'] . '">' . $dato['nombre_estado'] . '</div>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="javascript:void(0);" data-value="1" data-text="Activado" data-id="' . $dato['id_sucursal_metodo_pago'] . '" id="activar_desactivar_metodo_pago_sucursal">Activar</a>
                                                    <a class="dropdown-item" href="javascript:void(0);" data-value="0" data-text="Desactivado" data-id="' . $dato['id_sucursal_metodo_pago'] . '" id="activar_desactivar_metodo_pago_sucursal">Desactivar</a>
                                                    </div>
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
                <!-- CATEGORÍAS, PRODUCTOS, ETC -->
                <div class="col-sm-12 col-md-6 mt-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">summarize</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Categorías</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#categorias_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-muted">
                                        <span>Ver categorías</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">ballot</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Productos</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#productos_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-muted">
                                        <span>Ver productos</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">add_box</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Ingredientes</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#ingredientes_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-muted">
                                        <span>Ver ingredientes</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">date_range</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Schedule</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#schedules_sucursal_<?php echo $_POST['id_sucursal']; ?>" class="text-muted">
                                        <span>Ver schedules</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GRAFICA  -->
            <div class="card shadow my-4">
                <div class="card-body">
                    <div class="row align-items-center my-4">
                        <div class="col-md-4">
                            <div class="mx-4">
                                <strong class="mb-0 text-uppercase text-muted">Ganancias</strong><br />
                                <h3><?php echo $simbolo[0]['simbolo_tipo_cambio'].$row_totales[0]['total']; ?></h3>
                                <p class="text-muted">Ganancias generadas durante el mes.</p>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="p-4">
                                        <p class="small text-muted mb-0">Ordenes entregadas</p>
                                        <span class="h2 mb-0"><?php echo $row_totales[1]['total']; ?></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-4">
                                        <p class="small text-muted mb-0">Ordenes canceladas</p>
                                        <span class="h2 mb-0"><?php echo $row_totales[2]['total']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <div class="p-4">
                                        <p class="small text-uppercase text-muted mb-0">Puntuación</p>
                                        <span class="h2 mb-0 d-flex align-items-center"><span class="material-icons-round mr-2">grade</span><?php echo $row_totales[3]['total']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mr-4">
                                <div class="form-group">
                                    <p>Ordenes entregadas de este mes - <strong><?php echo $row_sucursal[0]['nombre_sucursal']; ?></strong></p>
                                    <div id="chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- HISTORIAL DE ORDENES -->
                <div class="col-sm-12 col-md-8">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Historial de ordenes durante el mes</strong>
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
                        <div class="table-responsive">
                            <table class="table border table-hover bg-white">
                                <thead>
                                    <tr role="row">
                                        <th colspan="2" class="text-center">No.</th>
                                        <th>Comprador</th>
                                        <th>Repartidor</th>
                                        <th>Tipo de orden</th>
                                        <th>Método de pago</th>
                                        <th>Estado de orden</th>
                                        <th>Dirección</th>
                                        <th>Fecha</th>
                                        <th>Total de orden</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_row_ordenes > 0) {
                                        for ($i = 0; $i < $total_row_ordenes; $i++) {
                                            echo
                                            '<tr>
                                                <td><span class="dot dot-md '.$row_ordenes[$i]['color_origen_orden'].'"></span></td>
                                                <td>#' . $row_ordenes[$i]['id_orden'] . '</td>
                                                <td style="max-width:200px;">
                                                    <p class="mb-0 text-muted text-truncate"><strong>' . $row_ordenes[$i]['nombre_cliente'] . '</strong></p>
                                                    <small class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['apellido_cliente'] . '</small>
                                                </td>
                                                <td style="max-width:250px;">
                                                    <p class="mb-0 text-muted text-truncate"><strong>' . $row_ordenes[$i]['nombre_repartidor'] . '</strong></p>
                                                    <small class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['apellido_repartidor'] . '</small>
                                                </td>
                                                <td>' . $row_ordenes[$i]['nombre_tipo_orden'] . '</td>
                                                <td style="max-width:350px;"
                                                    ><p class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['nombre_metodo_pago'] . '</p>
                                                </td>
                                                <td style="max-width:350px;">
                                                    <p class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['nombre_estado_orden'] . '</p>
                                                </td>
                                                <td style="max-width:350px;">
                                                    <p class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['direccion_orden'] . '</p>
                                                </td>
                                                <td style="max-width:350px;">
                                                    <p class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['fecha_registro_orden'] . ' hrs.</p>
                                                </td>
                                                <td class="max-width:200px;">
                                                    <p class="mb-0 text-success text-truncate">'.$row_ordenes[$i]['simbolo_tipo_cambio']. $row_ordenes[$i]['costo_total_orden'] . '</p>
                                                </td>
                                                <td>
                                                    <a href="#order_detail_' . $row_ordenes[$i]['id_orden'] . '" class="btn btn-sm btn-outline-dark" style="width:90px;" type="button">Ver detalles</a>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                    else{
                                        echo
                                        '<tr>
                                            <td colspan="11">No se encontraron resultados</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- PUNTUACIONES -->
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow eq-card timeline">
                        <div class="card-header">
                            <strong class="card-title">Últimas opiniones</strong>
                        </div>
                        <div class="card-body" data-simplebar style="height: 360px; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            if ($total_row_puntuaciones > 0) {
                                foreach ($row_puntuaciones as $dato) {
                                    echo
                                    '<div class="row align-items-center py-2">                                    
                                        <div class="col pr-0">
                                            <strong>' . $dato['comentarios_puntuacion_usuario'] . '</strong>
                                            <p class="small text-muted mb-0">Putuación: ' . $dato['puntuacion_usuario'] . '</p>
                                            <p class="small text-muted mb-0">' . $dato['fecha_puntuacion'] . '</p>
                                        </div>
                                        <div class="col-auto px-0">
                                            <ul class="avatars-list m-0">
                                                <li>
                                                    <a href="#customer_' . $dato['id_cliente'] . '" class="avatar avatar-sm">';
                                                    if (file_exists('../../../../img/clientes/' . $dato['id_cliente']) && count(glob('../../../../img/clientes/' . $dato['id_cliente'] . '/*')) > 0) {
                                                        $directorio = opendir('../../../../img/clientes/' . $dato['id_cliente']);
                                                        while ($archivo = readdir($directorio)) {
                                                            if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                                echo '<img src="../img/clientes/' . $dato['id_cliente'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                                            }
                                                        }
                                                    } else {
                                                        echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                                    }
                                                    echo
                                                    '</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <small class="fe fe-more-vertical fe-16 text-muted"></small>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo
                                '<div class="row align-items-center py-2">  
                                    <div class="col pr-0">
                                        <strong>No se encontraron resultados</strong>
                                    </div>
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
<!-- MODALES -->

<!-- ACTIVAR O DESACTIVAR METODOS DE PAGO -->
<div class="modal fade" id="modal_estado_metodo_pago" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Método de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Desea pasar el metodo de pago a <span></span>? De click en Confirmar</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_activar_desactivar_metodo_pago_sucursal">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- CONFIGURACIONES -->
<div class="modal fade modal-right modal-slide" id="modal_configuraciones_sucursal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Configuraciones de la sucursal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y:auto;">
                <div class="list-group list-group-flush my-n3">
                    <div class="form-group mt-4">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?php if($row_sucursal[0]['schedule_sucursal']==1){ echo 'checked'; } ?> class="custom-control-input" id="schedule_sucursal">
                            <label class="custom-control-label" for="schedule_sucursal">Utilizar schedule</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?php if($row_sucursal[0]['proceso_auto_sucursal']==1){ echo 'checked'; } ?> class="custom-control-input" id="proceso_auto_sucursal">
                            <label class="custom-control-label" for="proceso_auto_sucursal">Proceso automático</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" <?php if($row_sucursal[0]['metodo_pago_obligatorio_sucursal']==1){ echo 'checked'; } ?> class="custom-control-input" id="metodo_pago_obligatorio_sucursal">
                            <label class="custom-control-label" for="metodo_pago_obligatorio_sucursal">Centralizar ganancias</label>
                        </div>
                    </div>
                    <div class="form-group border-top mt-4 pt-4">
                        <label class="form-label">Zona horaria</label>
                        <select id="id_zona_horaria">
                            <?php
                            if($total_row_zonas_horarias>0){
                                foreach ($row_zonas_horarias as $dato) {
                                    
                                    $row_sucursal[0]['id_zona_horaria']==$dato['id_zona_horaria'] ? $selected='selected' : $selected='';

                                    echo '<option '.$selected.' value="'.$dato['id_zona_horaria'].'">'.$dato['nombre_zona_horaria'].' - ('.$dato['valor_zona_horaria'].')</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Categoría de la sucursal</label>
                        <select id="id_categoria_sucursal">
                            <?php
                            if($total_row_categorias_sucursales>0){
                                foreach ($row_categorias_sucursales as $dato) {
                                    
                                    $row_sucursal[0]['id_categoria_sucursal']==$dato['id_categoria_sucursal'] ? $selected='selected' : $selected='';

                                    echo '<option '.$selected.' value="'.$dato['id_categoria_sucursal'].'">'.$dato['nombre_categoria_sucursal'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ciudad</label>
                        <select id="id_ciudad">
                            <?php
                            if($total_row_paises>0){
                                foreach ($row_paises as $dato_pais) {
                                    
                                    $row_estados = $sql->obtenerResultado("CALL sp_select_estados2('".$dato_pais['id_pais']."');");
                                    $total_row_estados = count($row_estados);
                                    
                                    echo
                                    '<optgroup label="'.$dato_pais['nombre_pais'].'">';
                                        if($total_row_estados>0){
                                            foreach ($row_estados as $dato_estado) {

                                                $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades2('".$dato_estado['id_estado']."');");
                                                $total_row_ciudades = count($row_ciudades);

                                                echo
                                                '<optgroup label="&nbsp&nbsp&nbsp'.$dato_estado['nombre_estado'].'">';
                                                    if($total_row_ciudades>0){
                                                        foreach($row_ciudades as $dato_ciudad){
                                                            echo '<option value="'.$dato_ciudad['id_ciudad'].'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato_ciudad['nombre_ciudad'].'</option>';
                                                        }
                                                    }
                                                echo
                                                '</optgroup>';
                                            }
                                        }
                                    echo
                                    '</optgroup>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estado de la sucursal</label>
                        <select id="id_estado_usuario">
                            <option <?php if($row_sucursal[0]['id_estado_usuario']==3){ echo 'selected'; } ?> value="3">Activada</option>
                            <option <?php if($row_sucursal[0]['id_estado_usuario']==4){ echo 'selected'; } ?> value="4">Desactivada</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_guardar_configuracion_sucursal" data-id="<?php echo $_POST['id_sucursal']; ?>">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
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
<style>
    .pac-container {
        z-index: 1051 !important;
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrc4t-zWOMoqOfuh1C0yP9TrF2IFDUijc&libraries=places&callback=create_map" async defer></script>
<script>
    // CROPPER
    cropper_dropzone('.dropzone', '.jpg, .jpeg', 10, 'cropper_dropzone', 'sucursales', <?php echo $_SESSION['id_empresa_reparto_bexpress'];?>, 1200, 800);
    // APEXCHART
    var options = {
        series: [{
            name: 'Ordenes entregadas',
            data: [
                <?php
                if ($total_row_ordenes_totales > 0) {
                    foreach ($row_ordenes_totales as $dato) {
                        echo $dato['total_orden'] . ',';
                    }
                }
                ?>
            ]
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                tools: {
                    download: false,
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true | '<img src="/static/icons/reset.png" width="20">',
                },
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: [
                <?php
                if ($total_row_ordenes_totales > 0) {
                    foreach ($row_ordenes_totales as $dato) {
                        echo '"' . $dato['fecha_orden'] . '.000Z' . '",';
                    }
                }
                ?>
            ]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // MAPA
    var place_map = "";

    function create_map() {
        var map = new google.maps.Map(document.getElementById('mapa_sucursal'), {
            center: {
                lat: <?php echo $row_sucursal[0]['latitud_sucursal']; ?>,
                lng: <?php echo $row_sucursal[0]['longitud_sucursal']; ?>
            },
            zoom: 17,
            disableDefaultUI: true,
            streetViewControl: false,
            mapTypeControl: false,
        });
        var input_map = document.getElementById('direccion_sucursal');
        var autocomplete = new google.maps.places.Autocomplete(input_map);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            place_map = autocomplete.getPlace();
            if (!place_map.geometry) {
                window.alert("Por favor, asegurate de utilizar el autocompletado");
                return;
            }

            if (place_map.geometry.viewport) {
                map.fitBounds(place_map.geometry.viewport);
            } else {
                map.setCenter(place_map.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place_map.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place_map.geometry.location);
            marker.setVisible(true);
            var address = '';
            if (place_map.address_components) {
                address = [
                    (place_map.address_components[0] && place_map.address_components[0].short_name || ''),
                    (place_map.address_components[1] && place_map.address_components[1].short_name || ''),
                    (place_map.address_components[2] && place_map.address_components[2].short_name || '')
                ].join(' ');
            }
            infowindow.setContent('Punto central: <div><strong>' + place_map.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            document.getElementById('lat_sucursal').value = place_map.geometry.location.lat();
            document.getElementById('lon_sucursal').value = place_map.geometry.location.lng();

        });
    }

    // SLIMSELECT
    var select_id_zona_horaria = new SlimSelect({
        select: '#id_zona_horaria',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una zona horaria',
    });
    var select_id_categoria_sucursal = new SlimSelect({
        select: '#id_categoria_sucursal',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría de sucursal',
    });
    var select_id_ciudad = new SlimSelect({
        select: '#id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
    var select_id_estado_usuario = new SlimSelect({
        select: '#id_estado_usuario',
        placeholder: 'Seleccione una estado',
        showSearch: false,
    });
</script>