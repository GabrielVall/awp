<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_cliente = $sql->obtenerResultado("CALL sp_select_cliente1('" . $_POST['id_cliente'] . "');");

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes3('" . $_POST['id_cliente'] . "');");
$total_row_ordenes = count($row_ordenes);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$row_ordenes_express = $sql->obtenerResultado("CALL sp_select_ordenes_express3('" . $_POST['id_cliente'] . "');");
$total_row_ordenes_express = count($row_ordenes_express);

$row_productos_cliente = $sql->obtenerResultado("CALL sp_select_productos_cliente1('" . $_POST['id_cliente'] . "');");
$total_row_productos_cliente = count($row_productos_cliente);

$row_ordenes_punto_a_punto = $sql->obtenerResultado("CALL sp_select_ordenes_punto_a_punto2('".$_POST['id_cliente']."');");
$total_row_ordenes_punto_a_punto = count($row_ordenes_punto_a_punto);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Información del comprador</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#clientes" class="text-decoration-none text-muted">Clientes</a></li>
                            <li class="breadcrumb-item"><a href="#customer_<?php echo $_POST['id_cliente']; ?>" class="text-decoration-none text-muted"><?php echo $row_cliente[0]['nombre_cliente']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                    <div class="avatar avatar-xl">
                        <?php
                        if (file_exists('../../../../img/usuarios/' . $row_cliente[0]['id_usuario']) && count(glob('../../../../img/usuarios/' . $row_cliente[0]['id_usuario'] . '/*')) > 0) {
                            $directorio = opendir('../../../../img/usuarios/' . $row_cliente[0]['id_usuario']);
                            while ($archivo = readdir($directorio)) {
                                if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                    echo '<img src="../img/usuarios/' . $row_cliente[0]['id_usuario'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                }
                            }
                        } else {
                            echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                        }
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <h4 class="mb-1"><?php echo $row_cliente[0]['nombre_cliente'] . ' ' . $row_cliente[0]['apellido_cliente']; ?></h4>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <p class="small mb-0 text-muted">Correo: <?php echo $row_cliente[0]['correo_cliente']; ?></p>
                            <p class="small mb-0 text-muted">Teléfono: <?php echo $row_cliente[0]['telefono_cliente']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-1">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <h3 class="h5 mt-4 mb-1">Compras realizadas</h3>
                                    <p class="text-muted"><?php echo $row_cliente[0]['total_ordenes']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <h3 class="h5 mt-4 mb-1">Día más solicitado</h3>
                                    <p class="text-muted"><?php echo $row_cliente[0]['dia_semana']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-n3">
                                    <h3 class="h5 mt-4 mb-1">Compra más en</h3>
                                    <p class="text-muted"><?php echo $row_cliente[0]['nombre_sucursal']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <?php
                                    if($row_cliente[0]['nombre_sucursal']!='No se encontraron resultados'){
                                        echo
                                        '<a href="#sucursal_'.$row_cliente[0]['id_sucursal'].'" class="text-muted">
                                            <span>Ver sucursal</span>
                                        </a>';
                                    }
                                    else{
                                        echo '<span>&nbsp</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCTOS DEL CLIENTE -->
                <div class="col-sm-12 col-md-6">
                    <div class="col-sm-12">
                        <div class="card shadow mb-4" style="max-height:300px; min-height:300px;">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <strong class="card-title">Productos que ofrece</strong>
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_agregar_producto_cliente" class="text-muted">Agregar</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table border table-hover bg-white">
                                    <thead>
                                        <tr role="row">
                                            <th>Producto</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_productos_cliente">
                                        <?php
                                        if ($total_row_productos_cliente > 0) {
                                            for ($i = 0; $i < $total_row_productos_cliente; $i++) {
                                                echo
                                                '<tr id="row_producto_cliente_'.$row_productos_cliente[$i]['id_producto_cliente'].'">
                                                    <td>'.$row_productos_cliente[$i]['nombre_producto_cliente'].'</td>
                                                    <td class="text-right">
                                                        <a href="javascript:void(0);" data-id="' . $row_productos_cliente[$i]['id_producto_cliente'] . '" class="btn btn-sm btn-outline-dark" id="eliminar_producto_cliente" style="width:90px;" type="button">Eliminar</a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
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
            </div>
            <div class="row">
                <!-- HISTORIAL DE ORDENES -->
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Historial de ordenes</strong>
                            <div>
                                <div class="form-group my-0 py-0 text-right">
                                    <label class="font-weight-bold text-dark">Origen de orden</label>
                                </div>
                                <div class="form-group my-0 py-0">
                                    <?php
                                    if($total_row_origenes_orden>0){
                                        for($i=1; $i<$total_row_origenes_orden; $i++){
                                            echo '<label class="mr-2"><span class="dot dot-md '.$row_origenes_orden[$i]['color_origen_orden'].'"></span> '.$row_origenes_orden[$i]['nombre_origen_orden'].'</label>';
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
                                        <th>Repartidor</th>
                                        <th>Sucursal</th>
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
                                                    <p class="mb-0 text-muted text-truncate"><strong>' . $row_ordenes[$i]['nombre_repartidor'] . '</strong></p>
                                                    <small class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['apellido_repartidor'] . '</small>
                                                </td>
                                                <td style="max-width:250px;">
                                                    <p class="mb-0 text-muted text-truncate">' . $row_ordenes[$i]['nombre_sucursal'] . '</p>
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
                <!-- HISTORIAL DE ORDENES EXPRESS -->
                <div class="col-sm-12 mt-4">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <div class="form-group my-0 py-0 text-right">
                                    <label class="font-weight-bold text-dark">Historial de ordenes (sucursales express)</label>
                                </div>
                            </div>
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
                        <div class="card-body m-0 p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">No.</th>
                                            <th>Repartidor</th>
                                            <th>Sucursal</th>
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
                                        if($total_row_ordenes_express>0){
                                            for ($i=0; $i < $total_row_ordenes_express; $i++) { 
                                                echo
                                                '<tr id="row_orden_'.$row_ordenes_express[$i]['id_orden_express'].'">
                                                    <td><span class="dot dot-md '.$row_ordenes_express[$i]['color_origen_orden'].'"></span></td>
                                                    <td>#'.$row_ordenes_express[$i]['id_orden_express'].'</td>
                                                    <td style="max-width:200px;">
                                                        <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_express[$i]['nombre_repartidor'].'</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['apellido_repartidor'].'</small>
                                                    </td>
                                                    <td style="max-width:250px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_sucursal_express'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;"
                                                        ><p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_metodo_pago'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['nombre_estado_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['direccion_orden_express'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['fecha_registro_orden_express'].' hrs.</p>
                                                    </td>
                                                    <td class="max-width:200px;">
                                                        <p class="mb-0 text-success text-truncate">'.$row_ordenes_express[$i]['simbolo_tipo_cambio']. $row_ordenes_express[$i]['total_orden_express'].'</p>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_express_detail_'.$row_ordenes_express[$i]['id_orden_express'].'">Ver detalles</a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
                                                <td colspan="10">No se encontraron resultados</td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- HISTORIAL DE ORDENES PUNTO A PUNTO -->
                <div class="col-sm-12 mt-4">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <div class="form-group my-0 py-0 text-right">
                                    <label class="font-weight-bold text-dark">Historial de ordenes (punto a punto)</label>
                                </div>
                            </div>
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
                        <div class="card-body m-0 p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center">No.</th>
                                            <th>Repartidor</th>
                                            <th>Método de pago</th>
                                            <th>Estado de orden</th>
                                            <th>Fecha</th>
                                            <th>Total de orden</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($total_row_ordenes_punto_a_punto>0){
                                            for ($i=0; $i < $total_row_ordenes_punto_a_punto; $i++) { 
                                                echo
                                                '<tr id="row_orden_punto_a_punto_'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'">
                                                    <td><span class="dot dot-md '.$row_ordenes_punto_a_punto[$i]['color_origen_orden'].'"></span></td>
                                                    <td>#'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'</td>
                                                    <td style="max-width:200px;">
                                                        <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_punto_a_punto[$i]['nombre_repartidor'].'</strong></p>
                                                        <small class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['apellido_repartidor'].'</small>
                                                    </td>
                                                    <td style="max-width:350px;"
                                                        ><p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['nombre_metodo_pago'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['nombre_estado_orden'].'</p>
                                                    </td>
                                                    <td style="max-width:350px;">
                                                        <p class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['fecha_registro_orden_punto_a_punto'].' hrs.</p>
                                                    </td>
                                                    <td class="max-width:200px;">
                                                        <p class="mb-0 text-success text-truncate">'.$row_ordenes_punto_a_punto[$i]['simbolo_tipo_cambio']. $row_ordenes_punto_a_punto[$i]['total_orden_punto_a_punto'].'</p>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_punto_detail_'.$row_ordenes_punto_a_punto[$i]['id_orden_punto_a_punto'].'">Ver detalles</a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        else{
                                            echo
                                            '<tr>
                                                <td colspan="8">No se encontraron resultados</td>
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
    </div>
</div>
<!-- MODALES -->

<!-- AGREGAR PRODUCTO -->
<div class="modal fade" id="modal_agregar_producto_cliente" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Agregar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="content_agregar_producto">
                <div class="form-group">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control form control-sm" id="nombre_producto_cliente">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_agregar_producto_cliente" data-id="<?php echo $_POST['id_cliente']; ?>">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- ELIMINAR -->
<div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Eliminar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Está seguro de eliminar el producto? De click en confirmar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_eliminar_producto_cliente">Confirmar</button>
            </div>
        </div>
    </div>
</div>