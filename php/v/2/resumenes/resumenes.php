<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

isset($_POST['mes']) ? $mes_filtro=$_POST['mes'] : $mes_filtro=date("m-Y");

$row_totales_ordenes = $sql->obtenerResultado("CALL sp_select_resumen1('" . $mes_filtro . "');");
$total_row_totales_ordenes = count($row_totales_ordenes);

$row_metodos_pago = $sql->obtenerResultado("CALL sp_select_metodos_pago1('" . $mes_filtro . "');");
$total_row_metodos_pago = count($row_metodos_pago);

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales3('" . $mes_filtro . "');");
$total_row_sucursales = count($row_sucursales);

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores5('" . $mes_filtro . "');");
$total_row_repartidores = count($row_repartidores);

$row_cliente = $sql->obtenerResultado("CALL sp_select_cliente2('" . $mes_filtro . "');");

$row_dia_frecuente = $sql->obtenerResultado("CALL sp_select_dia_frecuente_ordenes1('" . $mes_filtro . "');");

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h5 page-title">Resumen de ventas <?php echo $mes_filtro; ?></h2>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-between">
                        <div class="form-group mr-2">
                            <select id="filtro_resumen" class="form-control">
                                <?php
                                for ($i=0; $i < 12; $i++) {
    
                                    ($i+1)<10 ? $mes_option='0'.($i+1).'-'.date("Y") : $mes_option=($i+1).'-'.date("Y");
                                    $mes_option==$mes_filtro ? $selected='selected' : $selected='';
    
                                    echo '<option '.$selected.' value="'.$mes_option.'">'.$meses[$i].' - '.date("Y").'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-sm btn-dark d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exportar <span class="material-icons-round">expand_more</span></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_resumen_excel"><span class="material-icons text-success">description</span>&nbspFormato Excel</a>
                                <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);" id="exportar_detalle_resumen_pdf"><span class="material-icons text-danger">picture_as_pdf</span>&nbspFormato PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <!-- TOTAL ORDENES -->
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-primary mr-2"></span>Ordenes ordinarias</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="card-title mb-0"><?php echo $row_totales_ordenes[0]['total'] ?></h3>
                                    <!-- <p class="small text-muted mb-0"><span class="fe fe-arrow-down fe-12 text-danger"></span><span>-18.9% Last week</span></p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TOTAL ORDENES EXPRESS -->
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-success mr-2"></span>Ordenes express</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="card-title mb-0"><?php echo $row_totales_ordenes[1]['total'] ?></h3>
                                    <!-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-warning"></span><span>+1.9% Last week</span></p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TOTAL ORDENES PUNTO A PUNTO -->
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-danger mr-2"></span>Ordenes punto a punto</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="card-title mb-0"><?php echo $row_totales_ordenes[2]['total'] ?></h3>
                                    <!-- <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>37.7% Last week</span></p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DÍAS CON MÁS DEMANDA ORDENES -->
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-primary mr-2"></span>Día con más demanda</span>
                        </div>
                        <div class="card-body my-n2">
                            <div class="d-flex">
                                <div class="flex-fill">
                                    <h4 class="mb-0"><?php echo $row_dia_frecuente[0]['dia_frecuente']; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DÍAS CON MÁS DEMANDA ORDENES EXPRESS -->
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-success mr-2"></span>Día con más demanda</span>
                        </div>
                        <div class="card-body my-n2">
                            <div class="d-flex">
                                <div class="flex-fill">
                                    <h4 class="mb-0"><?php echo $row_dia_frecuente[1]['dia_frecuente']; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- DÍAS CON MÁS DEMANDA ORDENES PUNTO A PUNTO -->
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <span class="card-title"><span class="dot dot-md bg-danger mr-2"></span>Día con más demanda</span>
                        </div>
                        <div class="card-body my-n2">
                            <div class="d-flex">
                                <div class="flex-fill">
                                    <h4 class="mb-0"><?php echo $row_dia_frecuente[2]['dia_frecuente']; ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- TOP SUCURSALES -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Top 5 sucursales</strong>
                        </div>
                        <div class="card-body" style="min-height:335px;">
                            <div class="list-group list-group-flush my-n3">
                                <?php
                                if($total_row_sucursales>0){
                                    foreach($row_sucursales as $dato){
                                        echo
                                        '<div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <a href="#sucursal_'.$dato['id_sucursal'].'" class="text-decoration-none"><strong>'.$dato['nombre_sucursal'].'</strong></a>
                                                    <div class="my-0 text-muted small">'.$dato['sum_ventas'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <strong>'.$dato['porcentaje_uso'].'%</strong>
                                                    <div class="progress mt-2" style="height: 4px;">
                                                        <div class="progress-bar" role="progressbar" style="width: '.$dato['porcentaje_uso'].'%" aria-valuenow="'.$dato['porcentaje_uso'].'" aria-valuemin="0" aria-valuemax="'.$dato['total_ordenes'].'"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                                else{
                                    echo
                                    '<div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong>No se encontraron resultados</strong>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TOP REPARTIDORES -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong class="card-title">Top 5 repartidores</strong>
                        </div>
                        <div class="card-body" style="min-height:335px;">
                            <div class="list-group list-group-flush my-n3">
                                <?php
                                if($total_row_repartidores>0){
                                    foreach($row_repartidores as $dato){
                                        echo
                                        '<div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <a href="#info_conductor_'.$dato['id_repartidor'].'" class="text-decoration-none"><strong>'.$dato['nombre_repartidor'].' '.$dato['apellido_repartidor'].'</strong></a>
                                                    <div class="my-0 text-muted small">Ordenes finalizadas: '.$dato['total_ordenes_repartidor'].'</div>
                                                </div>
                                                <div class="col-auto">
                                                    <strong>'.$dato['porcentaje_uso'].'%</strong>
                                                    <div class="progress mt-2" style="height: 4px;">
                                                        <div class="progress-bar" role="progressbar" style="width: '.$dato['porcentaje_uso'].'%" aria-valuenow="'.$dato['porcentaje_uso'].'" aria-valuemin="0" aria-valuemax="'.$dato['total_ordenes'].'"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                                else{
                                    echo
                                    '<div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong>No se encontraron resultados</strong>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- METODOS DE PAGO -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <strong>Uso de los métodos de pago</strong>
                        </div>
                        <div class="card-body px-4">
                            <div class="list-group list-group-flush my-n3">
                                <?php
                                if($total_row_metodos_pago>0){
                                    foreach($row_metodos_pago as $dato){
                                        echo
                                        '<div class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <strong>'.$dato['nombre_metodo_pago'].'</strong>
                                                    <div class="my-0 text-muted small">Utilizado: '.$dato['num_usos'].' veces</div>
                                                </div>
                                                <div class="col-auto">
                                                    <strong>'.$dato['porcentaje_uso'].'%</strong>
                                                    <div class="progress mt-2" style="height: 4px;">
                                                        <div class="progress-bar" role="progressbar" style="width: '.$dato['porcentaje_uso'].'%" aria-valuenow="'.$dato['porcentaje_uso'].'" aria-valuemin="0" aria-valuemax="'.$dato['total_ordenes'].'"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                }
                                else{
                                    echo
                                    '<div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong>No se encontraron resultados</strong>
                                            </div>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MEJOR CLIENTE -->
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row items-align-center">
                                <div class="col-md-6 my-4">
                                    <p class="mb-0"><strong class="mb-0 text-muted">Mejor comprador</strong></p>
                                    <h3><?php echo $row_cliente[0]['nombre_cliente'].' '.$row_cliente[0]['apellido_cliente']; ?></h3>
                                </div>
                                <div class="col-md-6 my-4 text-center">
                                    <div lass="chart-box mx-4">
                                        <div id="radialbarWidget"></div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-top pt-3">
                                    <p class="mb-1"><strong class="text-muted">Número de ordenes</strong></p>
                                    <h4 class="mb-0"><?php echo $row_cliente[0]['total_ordenes_cliente'] ?></h4>
                                </div>
                                <div class="col-md-6 border-top pt-3">
                                    <p class="mb-1"><strong class="text-muted">Frecuencia de uso en la aplicación</strong></p>
                                    <h4 class="mb-0"><?php echo $row_cliente[0]['porcentaje_uso']; ?>%</h4>
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
    var options = {
        series: [<?php echo $row_cliente[0]['porcentaje_uso']; ?>],
        chart: {
            height: 250,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '70%',
                }
            },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: ['#003dbe'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          }
        },
        labels: ['Frecuencia'],
    };

    var chart = new ApexCharts(document.querySelector("#radialbarWidget"), options);
    chart.render();
</script>