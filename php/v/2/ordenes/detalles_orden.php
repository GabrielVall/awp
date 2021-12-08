<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes2('" . $_POST['id_orden'] . "');");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_ordenes_productos1('" . $_POST['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

$row_repartidores_activos = $sql->obtenerResultado("CALL sp_select_repartidores_activos1();");
$total_row_repartidores_activos = count($row_repartidores_activos);

$estados_orden = array('4','6','8');
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title"><small class="text-muted text-uppercase">Detalles de orden</small><br>#<?php echo $_POST['id_orden']; ?></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#inicio" class="text-decoration-none text-muted">Panel de control</a></li>
                            <li class="breadcrumb-item"><a href="#order_detail_<?php echo $_POST['id_orden'] ?>" class="text-decoration-none text-muted">Detalles de orden</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-sm-12 col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Orden #<?php echo $_POST['id_orden']; ?></strong>
                            <button class="btn btn-sm btn-dark d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exportar <span class="material-icons-round">expand_more</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_orden_excel" data-id="<?php echo $_POST['id_orden']; ?>"><span class="material-icons text-success">description</span>&nbspFormato Excel</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_orden_pdf" data-id="<?php echo $_POST['id_orden']; ?>"><span class="material-icons text-danger">picture_as_pdf</span>&nbspFormato PDF</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_orden_ticket" data-id="<?php echo $_POST['id_orden']; ?>"><span class="material-icons">receipt_long</span>&nbsp Imprimir Ticket</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <dl class="row align-items-center mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Comprador:</dt>
                                <dd class="col-sm-4 mb-3">
                                    <strong><?php echo $row_orden[0]['nombre_cliente'] . ' ' . $row_orden[0]['apellido_cliente']; ?></strong>
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Repartidor:</dt>
                                <dd class="col-sm-4 mb-3">
                                    <strong class="d-block" id="nombre_repartidor_detalle"><?php echo $row_orden[0]['nombre_repartidor'] . ' ' . $row_orden[0]['apellido_repartidor']; ?></strong>
                                    <?php
                                    if(in_array($row_orden[0]['id_estado_orden'],$estados_orden,true)){
                                        echo '<a class="text-muted" href="javascript:void(0);" data-toggle="modal" data-target="#modal_repartidores">Asignar repartidor</a>';
                                    }
                                    ?>
                                </dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Sucursal:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_sucursal']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Método de pago:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_metodo_pago']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Tipo de orden:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_tipo_orden']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Estado de orden:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_estado_orden']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Fecha de registro:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['fecha_registro_orden']; ?> hrs.</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Generada por:</dt>
                                <dd class="col-sm-4 mb-3 font-weight-bold text-dark"><?php echo $row_orden[0]['nombre_origen_orden']; ?></dd>
                                <?php
                                if($row_orden[0]['id_tipo_orden']==1){
                                    echo
                                    '<dt class="col-sm-12 text-muted">Dirección:</dt>
                                    <dd class="col-sm-12">'.$row_orden[0]['direccion_orden'].'</dd>';
                                }
                                ?>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Comprador</strong>
                        </div>
                        <div class="card-body text-center">
                            <div class="avatar avatar-lg mt-4">
                                <a href="#customer_<?php echo $row_orden[0]['id_cliente']; ?>">
                                    <?php
                                    if (file_exists('../../../../img/usuarios/' . $row_orden[0]['id_usuario_cliente']) && count(glob('../../../../img/usuarios/' . $row_orden[0]['id_usuario_cliente'] . '/*')) > 0) {
                                        $directorio = opendir('../../../../img/usuarios/' . $row_orden[0]['id_usuario_cliente']);
                                        while ($archivo = readdir($directorio)) {
                                            if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                echo '<img src="../img/usuarios/' . $row_orden[0]['id_usuario_cliente'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                            }
                                        }
                                    } else {
                                        echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="card-text my-2">
                                <strong class="card-title my-0"><?php echo $row_orden[0]['nombre_cliente']; ?></strong>
                                <p class="small text-muted mb-0"><?php echo $row_orden[0]['apellido_cliente']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 mt-4">
                    <div class="card shadow" id="tabla_ordenes_productos">
                        <div class="card-header">
                            <strong class="card-title">Productos de la orden</strong>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Observaciones</th>
                                        <th scope="col" class="text-right">Precio</th>
                                        <th scope="col" class="text-right">Cantidad</th>
                                        <th scope="col" class="text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $subtotal_ing = 0;
                                    if ($total_ordenes_productos > 0) {
                                        for ($i = 0; $i < $total_ordenes_productos; $i++) {
                                            echo
                                            '<tr>
                                                <td>' . $row_ordenes_productos[$i]['nombre_producto'] . '
                                                    <br>
                                                    <span class="small text-muted">';
                                            $row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $row_ordenes_productos[$i]['id_orden_producto'] . "');");
                                            $total_ordenes_ingredientes = count($row_ordenes_ingredientes);

                                            if ($total_ordenes_ingredientes > 0) {
                                                $span_ing = '<br><span class="small text-muted">';
                                                for ($j = 0; $j < $total_ordenes_ingredientes; $j++) {
                                                    if ($j == 0) {
                                                        echo '<a href="javascript:void(0);" class="text-muted" data-orden="' . $_POST['id_orden'] . '" data-id="' . $row_ordenes_productos[$i]['id_orden_producto'] . '" id="ver_ordenes_ingredientes">Ver ingredientes</a>';
                                                    }
                                                    $subtotal_ing += $row_ordenes_ingredientes[$i]['importe_orden_ingrediente'];
                                                }
                                                $span_ing .= '+$' . number_format($subtotal_ing, 2, '.', ',') . '</span>';
                                            } else {
                                                $span_ing = '';
                                            }
                                            echo
                                            '</span>
                                                </td>
                                                <td>' . $row_ordenes_productos[$i]['comentarios_orden_producto'] . '</td>
                                                <td class="text-right">' . $row_ordenes_productos[$i]['simbolo_tipo_cambio'] . $row_ordenes_productos[$i]['precio_orden_producto'] . '</td>
                                                <td class="text-right">' . $row_ordenes_productos[$i]['cantidad_orden_producto'] . '</td>
                                                <td class="text-right">' . $row_ordenes_productos[$i]['simbolo_tipo_cambio'] . $row_ordenes_productos[$i]['importe_orden_producto'] . $span_ing . '</td>
                                            </tr>';
                                            $subtotal += str_replace(",", "", $row_ordenes_productos[$i]['importe_orden_producto']);
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row mt-5">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="text-right mr-2">
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Subtotal : </span>
                                            <strong><?php echo $row_orden[0]['simbolo_tipo_cambio'] . number_format(($subtotal + $subtotal_ing), 2, '.', ','); ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Descuento: </span>
                                            <strong class="text-danger">-<?php echo $row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['descuento_cupon'] ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total de orden : </span>
                                            <span><?php echo $row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['costo_total_orden']; ?></span>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Costo de envío : </span>
                                            <strong><?php echo $row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['costo_envio_orden']; ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Servicio de app : </span>
                                            <strong><?php echo $row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['servicio_app']; ?></strong>
                                        </p>
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total a pagar : </span>
                                            <span><?php echo $row_orden[0]['simbolo_tipo_cambio'] . number_format((str_replace(",", "", $row_orden[0]['servicio_app']) + str_replace(",", "", $row_orden[0]['costo_total_orden']) + str_replace(",", "", $row_orden[0]['costo_envio_orden'])),2,'.',','); ?></span>
                                        </p>
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

<!-- REPARTIDORES -->
<div class="modal fade" id="modal_repartidores" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Repartidores disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y:auto; max-height:70vh;">
                <div class="row" id="content_repartidores">
                    <?php
                    if($total_row_repartidores_activos>0){
                        foreach($row_repartidores_activos as $dato){
                            echo
                            '<div class="col-sm-12 col-md-3">
                                <div class="card shadow mb-4" id="detalle_repartidor_disponible" data-id="'.$dato['id_repartidor'].'" data-select="0" style="cursor:pointer;">
                                    <div class="card-body text-center">
                                        <div class="avatar avatar-lg mt-4">';
                                            if (file_exists('../../../../img/usuarios/' . $dato['id_usuario_repartidor']) && count(glob('../../../../img/usuarios/' . $dato['id_usuario_repartidor'] . '/*')) > 0) {
                                                $directorio = opendir('../../../../img/usuarios/' . $dato['id_usuario_repartidor']);
                                                while ($archivo = readdir($directorio)) {
                                                    if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                        echo '<img src="../img/usuarios/' . $dato['id_usuario_repartidor'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                                    }
                                                }
                                            } else {
                                                echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                            }
                                        echo
                                        '</div>
                                        <div class="card-text my-2">
                                            <strong class="card-title my-0" id="card_nombre_repartidor">'.$dato['nombre_repartidor'].'</strong>
                                            <p class="small text-muted mb-0" id="card_apellido_repartidor">'.$dato['apellido_repartidor'].'</p>
                                            <p class="small"><span class="badge badge-light text-success">'.$dato['nombre_estado_usuario'].'</span></p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto">
                                                <small><span class="dot dot-lg bg-secondary mr-1"></span> Seleccionar</small>
                                            </div>
                                            <div class="col-auto"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_asignar_repartidor_detalle_orden" data-id="<?php echo $_POST['id_orden']; ?>">Asignar repartidor</button>
            </div>
        </div>
    </div>
</div>