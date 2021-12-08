<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_datos_pagos = $sql->obtenerResultado("CALL sp_select_panel_pagos1();");

$row_historial_pagos = $sql->obtenerResultado("CALL sp_select_panel_historial_pagos1();");
$total_row_historial_pagos=count($row_historial_pagos);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="h3 page-title">Pago de mensualidad</h2>
        </div>
        <div class="col-12">
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <span class="circle circle-md bg-primary d-flex justify-content-center align-items-center">
                                        <span class="material-icons-round text-white">class</span>
                                    </span>
                                </div>
                                <div class="col">
                                    <h3 class="h6 mb-0 text-uppercase">Paquete actual</h3>
                                    <p class="small text-muted mb-0"><?php echo $row_datos_pagos[0]['nombre_nivel']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <span class="circle circle-md bg-success d-flex justify-content-center align-items-center">
                                        <span class="material-icons-round text-white">attach_money</span>
                                    </span>
                                </div>
                                <div class="col">
                                    <h3 class="h6 mb-0 text-uppercase">$<?php echo $row_datos_pagos[0]['pago']; ?> MXN</h3>
                                    <p class="small text-muted mb-0">Precio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <span class="circle circle-md bg-warning d-flex justify-content-center align-items-center">
                                        <span class="material-icons-round text-white"><?php echo $row_datos_pagos[0]['icono_estado']; ?></span>
                                    </span>
                                </div>
                                <div class="col">
                                    <h3 class="h6 mb-0 text-uppercase">Estado</h3>
                                    <p class="small text-muted mb-0"><?php echo $row_datos_pagos[0]['nombre_estado']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3 text-center">
                                    <span class="circle circle-md bg-secondary d-flex justify-content-center align-items-center">
                                        <span class="material-icons-round text-white">event</span>
                                    </span>
                                </div>
                                <div class="col">
                                    <h3 class="h6 mb-0 text-uppercase">Vence</h3>
                                    <p class="small text-muted mb-0" fecha-hora="<?php echo $row_datos_pagos[0]['fecha_pago']; ?>"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-4">
            <div class="card shadow" id="content_ordenes_express">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <div class="form-group my-0 py-0 text-right">
                            <label class="font-weight-bold text-dark">Historial de pagos</label>
                        </div>
                    </div>
                </div>
                <div class="card-body m-0 p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mensualidad</th>
                                    <th>Fecha de vencimiento</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($total_row_historial_pagos>0){
                                    foreach ($row_historial_pagos as $key => $value) {
                                        echo
                                        '<tr>
                                            <td>
                                                <p class="mb-0 text-dark font-weight-bold">'.$value['fecha_periodo'].'</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-muted" fecha-hora="'.$value['fecha_pago'].'"></p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-dark font-weight-bold">'.$value['nombre_estado_pago'].'</p>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#mensualidad_detalles_'.$value['id_historial_pago'].'">Ver detalles</a>
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
        </div>
    </div>
</div>
<script>
    calcular_tiempo();
</script>