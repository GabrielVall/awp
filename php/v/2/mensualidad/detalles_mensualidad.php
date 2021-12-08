<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_detalles_historial_pago = $sql->obtenerResultado("CALL sp_select_panel_detalles_pago1('" . $_POST['id_historial_pago'] . "');");

$row_mejoras_plus = $sql->obtenerResultado("CALL sp_select_panel_mejoras_plus1('" . $_POST['id_historial_pago'] . "');");
$total_mejoras_plus = count($row_mejoras_plus);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h2 class="h5 page-title"><small class="text-muted text-uppercase">Detalles de mensualidad</small></h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#pagar_servicio" class="text-decoration-none text-muted">Pagar servicio</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);" class="text-decoration-none text-muted">Detalles de mensualidad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-sm-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Detalles de mensualidad</strong>
                        </div>
                        <div class="card-body">
                            <dl class="row align-items-center mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Negocio:</dt>
                                <dd class="col-sm-4 mb-3">
                                    <strong><?php echo $row_detalles_historial_pago[0]['nombre_comercial']; ?></strong>
                                </dd>
                                <dt class="col-sm-2 mb-3 text-muted">Pagado a:</dt>
                                <dd class="col-sm-4 mb-3">
                                    <strong class="d-block">Border bytes</strong>
                                </dd>
                            </dl>
                            <dl class="row mb-0">
                                <dt class="col-sm-2 mb-3 text-muted">Correo:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_detalles_historial_pago[0]['correo']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Correo de contacto:</dt>
                                <dd class="col-sm-4 mb-3">ventas@borderbytes.mx</dd>
                                <dt class="col-sm-2 mb-3 text-muted">Fecha de vencimiento:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_detalles_historial_pago[0]['fecha_pago']; ?></dd>
                                <dt class="col-sm-2 mb-3 text-muted">Estado de pago:</dt>
                                <dd class="col-sm-4 mb-3"><?php echo $row_detalles_historial_pago[0]['nombre_estado_pago']; ?></dd>
                            </dl>
                            <div class="table-responsive mt-5">
                                <?php
                                if($row_detalles_historial_pago[0]['estado_pago']==0){
                                    echo
                                    '<div class="form-group text-right">
                                        <button class="btn btn-sm btn-dark" id="proceder_pago_mensualidad" data-id="'.$_POST['id_historial_pago'].'">Proceder a pagar</button>
                                    </div>';
                                }
                                ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Concepto</th>
                                            <th class="text-center">Mes(es)</th>
                                            <th class="text-right">Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="mb-0 text-dark font-weight-bold">Sistema Bexpress nivel: <?php echo $row_detalles_historial_pago[0]['nombre_nivel']; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <p class="mb-0 text-muted"><?php echo $row_detalles_historial_pago[0]['meses']; ?></p>
                                            </td>
                                            <td class="text-right">
                                                <p class="mb-0 text-dark">$<?php echo $row_detalles_historial_pago[0]['pago']; ?>MXN</p>
                                            </td>
                                        </tr>
                                        <?php
                                        $subtotal=(str_replace(",","",$row_detalles_historial_pago[0]['pago'])*$row_detalles_historial_pago[0]['meses']);
                                        if($total_mejoras_plus>0){
                                            foreach ($row_mejoras_plus as $key => $value) {
                                                echo
                                                '<tr>
                                                    <td>
                                                        <p class="mb-0 text-dark font-weight-bold">'.$value['nombre_plus'].'</p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p class="mb-0 text-muted">N/A</p>
                                                    </td>
                                                    <td class="text-right">
                                                        <p class="mb-0 text-dark">$'.$value['precio'].'MXN</p>
                                                    </td>
                                                </tr>';
                                                $subtotal+=str_replace(",","",$value['precio']);
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group text-right">
                                <p class="mb-2 h6">
                                    <span class="text-muted">Subtotal : </span>
                                    <strong>$<?php echo number_format($subtotal,2,'.',','); ?>MXN</strong>
                                </p>
                                <p class="mb-2 h6">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" data-total="<?php echo $subtotal; ?>" class="custom-control-input" id="factura_mensualidad">
                                        <label class="custom-control-label" for="factura_mensualidad">Factura (+16%)</label>
                                    </div>
                                </p>
                                <p class="mb-2 h6">
                                    <span class="text-muted">Total : </span>
                                    <strong id="text_factura">$<?php echo number_format($subtotal,2,'.',','); ?>MXN</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>