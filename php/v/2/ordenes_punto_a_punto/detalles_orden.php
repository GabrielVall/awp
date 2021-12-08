<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_orden_punto_a_punto1('" . $_POST['id_orden'] . "');");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_historial_venta_punto_a_punto1('" . $_POST['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title"><small class="text-muted text-uppercase">Detalles de orden punto a punto</small><br>#<?php echo $_POST['id_orden']; ?></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#inicio" class="text-decoration-none text-muted">Panel de control</a></li>
                            <li class="breadcrumb-item"><a href="#order_punto_detail_<?php echo $_POST['id_orden'] ?>" class="text-decoration-none text-muted">Detalles de orden</a></li>
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
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_orden_punto_a_punto_excel" data-id="<?php echo $_POST['id_orden']; ?>"><span class="material-icons text-success">description</span>&nbspFormato Excel</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_orden_punto_a_punto_pdf" data-id="<?php echo $_POST['id_orden']; ?>"><span class="material-icons text-danger">picture_as_pdf</span>&nbspFormato PDF</a>
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
                                </dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Recibe:</dt>
                                <dd class="col-sm-4 mb-3"><strong><?php echo $row_orden[0]['nombre_recibe_orden_punto_a_punto']; ?></strong></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Tel. destinatario:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['telefono_orden_punto_a_punto']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Método de pago:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_metodo_pago']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Estado de orden:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['nombre_estado_orden']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Fecha de registro:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_orden[0]['fecha_registro_orden_punto_a_punto']; ?> hrs.</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Generada por:</dt>
                                <dd class="col-sm-4 mb-3 font-weight-bold text-dark"><?php echo $row_orden[0]['nombre_origen_orden']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Los productos:</dt>
                                <dd class="col-sm-4 mb-3 font-weight-bold text-dark"><?php echo $row_orden[0]['tipo_orden']; ?></dd>
                                <dt class="col-sm-12 text-muted">Dirección del remitente:</dt>
                                <dd class="col-sm-12"><?php echo $row_orden[0]['direccion_envio_orden_punto_a_punto'] ?></dd>
                                <dt class="col-sm-12 text-muted">Dirección del destinatario:</dt>
                                <dd class="col-sm-12"><?php echo $row_orden[0]['direccion_entrega_orden_punto_a_punto'] ?></dd>
                                <dt class="col-sm-12 text-muted">Observaciones:</dt>
                                <dd class="col-sm-12"><?php echo $row_orden[0]['descripcion_orden_punto_a_punto'] ?></dd>
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
                                        <th scope="col" class="text-right">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total_ordenes_productos > 0) {
                                        for ($i = 0; $i < $total_ordenes_productos; $i++) {
                                            echo
                                            '<tr>
                                                <td>' . $row_ordenes_productos[$i]['nombre_producto_punto_a_punto'] . '</td>
                                                <td class="text-right">' . $row_ordenes_productos[$i]['simbolo_tipo_cambio'] . $row_ordenes_productos[$i]['precio_producto_punto_a_punto'] . '</td>
                                            </tr>';
                                        }
                                    }
                                    else{
                                        echo
                                        '<tr>
                                            <td colspan="2">No se encontraron productos</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="row mt-5">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="text-right mr-2">
                                        <p class="mb-2 h6">
                                            <span class="text-muted">Total a pagar : </span>
                                            <span><?php echo $row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['total_orden_punto_a_punto']; ?></span>
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