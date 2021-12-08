<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidor = $sql->obtenerResultado("CALL sp_select_repartidor1('" . $_POST['id_repartidor'] . "');");

$row_puntuaciones = $sql->obtenerResultado("CALL sp_select_puntuaciones_usuarios1('" . $_POST['id_repartidor'] . "');");
$total_row_puntuaciones = count($row_puntuaciones);

$row_ordenes = $sql->obtenerResultado("CALL sp_select_ordenes1('" . $_POST['id_repartidor'] . "');");
$total_row_ordenes = count($row_ordenes);

$row_origenes_orden = $sql->obtenerResultado("CALL sp_select_origenes_orden1();");
$total_row_origenes_orden = count($row_origenes_orden);

$row_ordenes_express = $sql->obtenerResultado("CALL sp_select_ordenes_express4('" . $_POST['id_repartidor'] . "');");
$total_row_ordenes_express = count($row_ordenes_express);

$_SESSION['nombre_repartidor']=$row_repartidor[0]['nombre_repartidor'];

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Información personal</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#repartidores" class="text-decoration-none text-muted">Repartidores</a></li>
                            <li class="breadcrumb-item"><a href="#info_conductor_<?php echo $_POST['id_repartidor']; ?>" class="text-decoration-none text-muted"><?php echo $row_repartidor[0]['nombre_repartidor']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                    <div class="avatar avatar-xl">
                        <?php
                        if (file_exists('../../../../img/usuarios/' . $row_repartidor[0]['id_usuario']) && count(glob('../../../../img/usuarios/' . $row_repartidor[0]['id_usuario'] . '/*')) > 0) {
                            $directorio = opendir('../../../../img/usuarios/' . $row_repartidor[0]['id_usuario']);
                            while ($archivo = readdir($directorio)) {
                                if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                    echo '<img src="../img/usuarios/' . $row_repartidor[0]['id_usuario'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
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
                            <h4 class="mb-1"><?php echo $row_repartidor[0]['nombre_repartidor'] . ' ' . $row_repartidor[0]['apellido_repartidor']; ?></h4>
                            <p class="small mb-3"><span class="badge badge-primary" data-toggle="modal" data-target="#modal_estado_repartidor" id="badge_status" style="cursor:pointer;"><?php echo $row_repartidor[0]['nombre_estado_usuario']; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Datos personales</strong>
                        </div>
                        <div class="card-body">
                            <div class="row" id="content_info_personal">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-labe">Nombre(s)</label>
                                        <input type="text" class="form-control form-control-sm name_format" value="<?php echo $row_repartidor[0]['nombre_repartidor']; ?>" id="nombre_repartidor">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-labe">Apellidos</label>
                                        <input type="text" class="form-control form-control-sm name_format" value="<?php echo $row_repartidor[0]['apellido_repartidor']; ?>" id="apellido_repartidor">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <label class="form-labe">Correo</label>
                                        <input type="text" class="form-control form-control-sm email_format" value="<?php echo $row_repartidor[0]['correo_repartidor']; ?>" id="correo_repartidor">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                        <label class="form-labe">Teléfono</label>
                                        <input type="text" class="form-control form-control-sm phone_format" value="<?php echo $row_repartidor[0]['telefono_repartidor']; ?>" id="telefono_repartidor">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="mb-1 d-flex align-items-center justify-content-between">Dirección<span id="expandir_mapa" style="cursor:pointer;" data-map="#mapa_repartidor" class="material-icons-round">expand_more</span></p>
                                <input type="text" class="form-control form-control-sm" placeholder="" value="<?php echo $row_repartidor[0]['direccion_repartidor']; ?>" data-limit="2000" id="direccion_repartidor">
                                <input type="hidden" id="lat_repartidor" value="<?php echo $row_repartidor[0]['latitud_repartidor']; ?>">
                                <input type="hidden" id="lon_repartidor" value="<?php echo $row_repartidor[0]['longitud_repartidor']; ?>">
                                <div id="mapa_repartidor" style="height:300px; display: none; margin: auto; "></div>
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn mb-2 btn-outline-dark" data-id="<?php echo $_POST['id_repartidor']; ?>" id="btn_editar_info_conductor">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Últimas opiniones</strong>
                        </div>
                        <div class="card-body" style="min-height:310px; max-height:310px; overflow-y:auto;">
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
                                                    <a href="#customer_'.$dato['id_usuario_cliente'].'" class="avatar avatar-sm">';
                                                    if (file_exists('../../../../img/usuarios/' . $dato['id_usuario_cliente']) && count(glob('../../../../img/usuarios/' . $dato['id_usuario_cliente'] . '/*')) > 0) {
                                                        $directorio = opendir('../../../../img/usuarios/' . $dato['id_usuario_cliente']);
                                                        while ($archivo = readdir($directorio)) {
                                                            if ($archivo != '.' && $archivo != '.htaccess' && $archivo != '..') {
                                                                echo '<img src="../img/usuarios/' . $dato['id_usuario_cliente'] . '/' . $archivo . '" class="avatar-img rounded-circle">';
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
                <div class="col-sm-12 mt-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-0 py-0">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">attach_file</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Documentos</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#documentos_repartidor_<?php echo $_POST['id_repartidor']; ?>" class="text-muted">
                                        <span>Ver documentos</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-4 shadow">
                                <div class="card-body my-0 py-0">
                                    <div class="row align-items-center">
                                        <div class="col-3 text-center">
                                            <span class="circle circle-md bg-dark text-white d-flex justify-content-center">
                                                <span class="material-icons-round">local_shipping</span>
                                            </span>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted">&nbsp</p>
                                            <h3 class="h5 mt-4 ml-2">Vehículos</h3>
                                            <p class="text-muted">&nbsp</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="#vehiculos_repartidor_<?php echo $_POST['id_repartidor']; ?>" class="text-muted">
                                        <span>Ver vehículos</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            '<tr>
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
                                                    <a href="#order_detail_'.$row_ordenes[$i]['id_orden'].'" class="btn btn-sm btn-outline-dark" style="width:90px;" type="button">Ver detalles</a>
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
                                    <label class="font-weight-bold text-dark">Ordenes (sucursales express)</label>
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
                                    <tbody>
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
            </div>
        </div>
    </div>
</div>
<!-- MODALES -->

<!-- ESTADO REPARTIDOR -->
<div class="modal fade" id="modal_estado_repartidor" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Cambiar estado del repartidor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Actualizar estado</label>
                    <select id="id_estado_repartidor" class="form-control">
                        <option value="0">Selecciona una opción</option>
                        <option value="3" text="Activado">Activado</option>
                        <option value="4" text="Desactivado">Desactivado</option>
                        <option value="1" text="Pendiente">Pasarlo a solicitudes</option>
                        <option value="2" text="Aceptado">Pasarlo a solicitud aceptada</option>
                        <option value="5" text="Rechazado">Pasarlo a solicitud rechazada</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_cambiar_estado_repartidor" data-id="<?php echo $_POST['id_repartidor']; ?>">Actualizar estado</button>
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
    // MAPA

    var place_map = "";

    function create_map() {
        var map = new google.maps.Map(document.getElementById('mapa_repartidor'), {
            center: {
                lat: <?php echo $row_repartidor[0]['latitud_repartidor']; ?>,
                lng: <?php echo $row_repartidor[0]['longitud_repartidor']; ?>
            },
            zoom: 17,
            disableDefaultUI: true,
            streetViewControl: false,
            mapTypeControl: false,
        });
        var input_map = document.getElementById('direccion_repartidor');
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
            document.getElementById('lat_repartidor').value = place_map.geometry.location.lat();
            document.getElementById('lon_repartidor').value = place_map.geometry.location.lng();

        });
    }
</script>