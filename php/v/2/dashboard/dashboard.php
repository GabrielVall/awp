<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_ultimas_acciones = $sql->obtenerResultado("CALL sp_select_ultimas_acciones1();");

$row_repartidores_activos = $sql->obtenerResultado("CALL sp_select_repartidores_activos1();");
$total_row_repartidores_activos = count($row_repartidores_activos);

$row_zonas = $sql->obtenerResultado("CALL sp_select_zonas2();");
$total_row_zonas = count($row_zonas);

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores3(1);");
$total_row_repartidores = count($row_repartidores);

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales2();");
$total_row_sucursales = count($row_sucursales);

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes5('6',10);");
$total_row_ordenes = count($row_ordenes);

$row_ordenes_express = $sql->obtenerResultado("CALL sp_select_ordenes_express1();");
$total_row_ordenes_express = count($row_ordenes_express);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$row_ordenes_punto_a_punto = $sql->obtenerResultado("CALL sp_select_ordenes_punto_a_punto1();");
$total_row_ordenes_punto_a_punto = count($row_ordenes_punto_a_punto);

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Panel de control</h2>
                </div>
                <div class="col-auto"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong class="card-title">Sucursales y repartidores</strong>
                    <div>
                        <label class="mr-2"><img src="../img/iconos/repartidor.png"> Repartidores</label>
                        <label><img src="../img/iconos/sucursal.png"> Sucursales</label>
                    </div>
                </div>
                <div class="card-body p-0 m-0">
                    <div id="map" class="map" style="width: 100%;height: 300px;"></div>
                </div>
            </div>
        </div>
        <!-- ULTIMAS ACCIONES -->
        <div class="col-sm-12 col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Filtro de ordenes</strong>
                </div>
                <div class="card-body" id="content_ultimas_acciones">
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">edit_note</span>
                                </div>
                                <div class="col">
                                    <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="6" class="text-decoration-none font-weight-bold text-dark">Ordenes pendientes por aceptar</a>
                                    <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[0]['total_orden']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">directions_bike</span>
                                </div>
                                <div class="col">
                                    <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="9,10" class="text-decoration-none font-weight-bold text-dark">Ordenes en camino</a>
                                    <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[1]['total_orden']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">timer</span>
                                </div>
                                <div class="col">
                                    <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="1" class="text-decoration-none font-weight-bold text-dark">Ordenes en temporizador</a>
                                    <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[2]['total_orden']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">check_circle_outline</span>
                                </div>
                                <div class="col">
                                    <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="5" class="text-decoration-none font-weight-bold text-dark">Ordenes entregadas</a>
                                    <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[3]['total_orden']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="material-icons-round">highlight_off</span>
                                </div>
                                <div class="col">
                                    <a href="javascript:void(0);" id="filtro_ordenes_dashboard" data-estado="3,4,7" class="text-decoration-none font-weight-bold text-dark">Ordenes canceladas</a>
                                    <div class="my-0 text-muted small">#<?php echo $row_ultimas_acciones[4]['total_orden']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TABLA DE ORDENES -->
        <div class="col-sm-12 mt-4">
            <div class="card shadow" id="content_ordenes">
                <div class="card-header d-flex justify-content-between align-items-center" data-text="Ordenes pendientes por aceptar" data-estado="6">
                    <div>
                        <div class="form-group my-0 py-0 text-right">
                            <label class="font-weight-bold text-dark">Ordenes pendientes por aceptar</label>
                        </div>
                        <p class="card-text">Últimas 10</p>
                    </div>
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
                <div class="card-body m-0 p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">No.</th>
                                    <th>Comprador</th>
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
                                if($total_row_ordenes>0){
                                    for ($i=0; $i < $total_row_ordenes; $i++) { 
                                        echo
                                        '<tr id="row_orden_'.$row_ordenes[$i]['id_orden'].'">
                                            <td><span class="dot dot-md '.$row_ordenes[$i]['color_origen_orden'].'"></span></td>
                                            <td>#'.$row_ordenes[$i]['id_orden'].'</td>
                                            <td style="max-width:200px;">
                                                <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes[$i]['nombre_cliente'].'</strong></p>
                                                <small class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['apellido_cliente'].'</small>
                                            </td>
                                            <td style="max-width:250px;">
                                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_sucursal'].'</p>
                                            </td>
                                            <td>'.$row_ordenes[$i]['nombre_tipo_orden'].'</td>
                                            <td style="max-width:350px;"
                                                ><p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_metodo_pago'].'</p>
                                            </td>
                                            <td style="max-width:350px;">
                                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['nombre_estado_orden'].'</p>
                                            </td>
                                            <td style="max-width:350px;">
                                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['direccion_orden'].'</p>
                                            </td>
                                            <td style="max-width:350px;">
                                                <p class="mb-0 text-muted text-truncate">'.$row_ordenes[$i]['fecha_registro_orden'].' hrs.</p>
                                            </td>
                                            <td class="max-width:200px;">
                                                <p class="mb-0 text-success text-truncate">'.$row_ordenes[$i]['simbolo_tipo_cambio']. $row_ordenes[$i]['costo_total_orden'].'</p>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-dark" style="width:90px;" href="#order_detail_'.$row_ordenes[$i]['id_orden'].'">Ver detalles</a>
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
        </div>
        <!-- TABLA DE ORDENES SUCURSALES EXPRESS -->
        <div class="col-sm-12 mt-4">
            <div class="card shadow" id="content_ordenes_express">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <div class="form-group my-0 py-0 text-right">
                            <label class="font-weight-bold text-dark">Ordenes (sucursales express)</label>
                        </div>
                        <p class="card-text">Últimas 10</p>
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
                                    <th>Comprador</th>
                                    <th>Sucursal</th>
                                    <th>Método de pago</th>
                                    <th>Estado de orden</th>
                                    <th>Dirección</th>
                                    <th>Fecha</th>
                                    <th>Total de orden</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_ordenes_express">
                                <?php
                                if($total_row_ordenes_express>0){
                                    for ($i=0; $i < $total_row_ordenes_express; $i++) { 
                                        echo
                                        '<tr id="row_orden_'.$row_ordenes_express[$i]['id_orden_express'].'">
                                            <td><span class="dot dot-md '.$row_ordenes_express[$i]['color_origen_orden'].'"></span></td>
                                            <td>#'.$row_ordenes_express[$i]['id_orden_express'].'</td>
                                            <td style="max-width:200px;">
                                                <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_express[$i]['nombre_cliente'].'</strong></p>
                                                <small class="mb-0 text-muted text-truncate">'.$row_ordenes_express[$i]['apellido_cliente'].'</small>
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
        <!-- TABLA DE PUNTO A PUNTO -->
        <div class="col-sm-12 mt-4">
            <div class="card shadow" id="content_ordenes_punto_a_punto">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <div class="form-group my-0 py-0 text-right">
                            <label class="font-weight-bold text-dark">Ordenes (punto a punto)</label>
                        </div>
                        <p class="card-text">Últimas 10</p>
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
                                    <th>Comprador</th>
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
                                                <p class="mb-0 text-muted text-truncate"><strong>'.$row_ordenes_punto_a_punto[$i]['nombre_cliente'].'</strong></p>
                                                <small class="mb-0 text-muted text-truncate">'.$row_ordenes_punto_a_punto[$i]['apellido_cliente'].'</small>
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
        <!-- REPARTIDORES ACTIVOS -->
        <div class="col-sm-12 mt-4">
            <div class="card shadow" id="content_repartidores_activos">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong class="card-title float-left">Repartidores activos</strong>
                    <div>
                        <ul class="pagination pagination-sm">
                            <?php
                                if($total_row_repartidores_activos>0){
                                    $limite_paginacion=10;
                                    $last_page=($total_row_repartidores_activos/$limite_paginacion);
                                    $bolean=false;
                                    
                                    if(is_float($last_page)){
                                        $fin_for=($last_page+1);
                                    }
                                    else{
                                        $fin_for=$last_page;
                                    }

                                    echo
                                    '<li class="page-item paginate_button" id="prev_page">
                                        <a class="page-link"><span aria-hidden="true">Ant.</span></a>
                                    </li>';
                                    for($i=0; $i<intval($fin_for); $i++){
                                        
                                        if(($i+1)<=5){
                                            echo
                                            '<li class="page-item paginate_button page-item-'.($i+1).' '; if($i==0){ echo 'active'; } echo'" id="new_page" data-page="'.($i+1).'"><a class="page-link">'.($i+1).'</a></li>';
                                        }
                                        else{
                                            $bolean=true;
                                        }

                                    }
                                    if($bolean==true){
                                        
                                        echo
                                        '<li class="page-item paginate_button">
                                            <a class="page-link">...</a>
                                        </li>';
                                    }
                                    echo
                                    '<li class="page-item paginate_button" id="next_page" data-last="'.intval($fin_for).'">
                                        <a class="page-link"><span aria-hidden="true">Sig.</span></a>
                                    </li>';
                                }
                                ?>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-0 m-0">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th colspan="2">Repartidor</th>
                                <th class="text-center">Ordenes en progreso</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_repartidores_activos">
                            <?php
                            if ($total_row_repartidores_activos > 0) {
                                $page=1;
                                for ($i = 0; $i < $total_row_repartidores_activos; $i++) {

                                    if($i>=$limite_paginacion){
                                        $page++;
                                        $limite_paginacion+=$limite_paginacion;
                                        $visibility='style="display:none;"';
                                    }
                                    else{
                                        $visibility='';
                                    }

                                    echo
                                    '<tr '.$visibility.' class="page_'.$page.'">
                                        <td>
                                            <p class="mb-0 text-muted"><strong>#' . $row_repartidores_activos[$i]['id_repartidor'] . '</strong></p>
                                        </td>
                                        <td>
                                            <div class="avatar avatar-sm">';
                                            if (file_exists('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor']) && count(glob('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor'] . '/*')) > 0) {
                                                $directorio = opendir('../../../../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor']);
                                                while ($archivo = readdir($directorio)) {
                                                    if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                        echo '<img src="../img/usuarios/' . $row_repartidores_activos[$i]['id_usuario_repartidor'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
                                                    }
                                                }
                                            } else {
                                                echo '<img src="../img/0/user-0.jpg" class="avatar-img rounded-circle">';
                                            }
                                            echo
                                            '</div>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-muted"><strong>' . $row_repartidores_activos[$i]['nombre_repartidor'] . ' ' . $row_repartidores_activos[$i]['apellido_repartidor'] . '</strong></p>
                                            <small class="mb-0 text-success">' . $row_repartidores_activos[$i]['nombre_estado_usuario'] . '</small>
                                        </td>
                                        <td class="text-center">
                                            <p class="mb-0 text-muted"><strong>' . $row_repartidores_activos[$i]['total_ordenes_progreso'] . '</strong></p>
                                        </td>
                                        <td class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#info_conductor_' . $row_repartidores_activos[$i]['id_repartidor'] . '">Ver información</a>
                                                <a class="dropdown-item" href="#asignar_orden_' . $row_repartidores_activos[$i]['id_repartidor'] . '">Asignar orden</a>
                                                <a class="dropdown-item" href="#ubicacion_repartidor_'.$row_repartidores_activos[$i]['id_repartidor'].'">Ver ubicación actual</a>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                            }
                            else{
                                echo
                                '<tr>
                                    <td colspan="5">No se encontraron resultados</td>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrc4t-zWOMoqOfuh1C0yP9TrF2IFDUijc&libraries=places&callback=create_map" async defer></script>
<script>
    function create_map() {
        var map = new google.maps.Map(
            document.getElementById('map'), {
                center: new google.maps.LatLng(28.6925355,-100.5421289),
                zoom: 13
            });

        var iconBase ='../img/iconos/';

        var icons = {
            repartidor: {
                icon: iconBase + 'repartidor.png'
            },
            sucursal: {
                icon: iconBase + 'sucursal.png'
            },
        };

        var features = [
            <?php
                if($total_row_repartidores>0){
                    for ($i=0; $i < $total_row_repartidores; $i++) {
                        echo
                        "{
                            position: new google.maps.LatLng(".$row_repartidores[$i]['latitud_ubicacion_repartidor'].", ".$row_repartidores[$i]['longitud_ubicacion_repartidor']."),
                            type: 'repartidor',
                            id:".$row_repartidores[$i]['id_repartidor'].",
                            title:'#".$row_repartidores[$i]['id_repartidor']." - ".$row_repartidores[$i]['nombre_repartidor']."'
                        },";
                    }
                }
                if($total_row_sucursales>0){
                    for ($i=0; $i < $total_row_sucursales; $i++) {
                        echo
                        "{
                            position: new google.maps.LatLng(".$row_sucursales[$i]['latitud_sucursal'].", ".$row_sucursales[$i]['longitud_sucursal']."),
                            type: 'sucursal',
                            id:".$row_sucursales[$i]['id_sucursal'].",
                            title:'#".$row_sucursales[$i]['id_sucursal']." - ".$row_sucursales[$i]['nombre_sucursal']."'
                        },";
                    }
                }
            ?>
        ];
        // Create markers.
        <?php
        for ($i=0; $i < ($total_row_repartidores+$total_row_sucursales); $i++) {
            echo
            'var marker_'.$i.' = new google.maps.Marker({
                position: features['.$i.'].position,
                icon: icons[features['.$i.'].type].icon,
                url: features['.$i.'].url,
                title: features['.$i.'].title,
                type: features['.$i.'].type,
                id: features['.$i.'].id,
                map: map
            });

            marker_'.$i.'.addListener("click", () => {
                marker_hash(marker_'.$i.'.type,marker_'.$i.'.id);
            });';
        }

        for ($i=0; $i < $total_row_zonas; $i++) {
            echo
            "var zona_".$row_zonas[$i]['id_zona']." = new google.maps.Circle({
                strokeColor: '#0051FF',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#7590FF',
                fillOpacity: 0.1,
                map: map,
                radius: ".$row_zonas[$i]['radio_zona'].",
                center: new google.maps.LatLng(".$row_zonas[$i]['latitud_zona'].", ".$row_zonas[$i]['longitud_zona']."), 
            });";
        }
        ?>
    }
</script>