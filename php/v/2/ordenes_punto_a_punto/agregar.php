<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores4(1);");
$total_row_repartidores = count($row_repartidores);

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes2();");
$total_row_clientes = count($row_clientes);

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nueva orden punto a punto</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nueva orden punto a punto</strong>
                </div>
                <div class="card-body py-4 mb-1" id="content_info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label">Cliente</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="recibir_paquete">
                                            <label class="custom-control-label" for="recibir_paquete">Recibir paquete</label>
                                        </div>
                                    </div>
                                    <select id="id_cliente_orden_punto_a_punto">
                                        <?php
                                        if($total_row_clientes>0){
                                            for($i=0; $i<$total_row_clientes; $i++){

                                                if($i==0){
                                                    $id_cliente=$row_clientes[$i]['id_cliente'];
                                                }
                                                
                                                $id_producto='';
                                                $nombre_producto='';
                                                $row_productos = $sql->obtenerResultado("CALL sp_select_productos_cliente1('".$row_clientes[$i]['id_cliente']."');");
                                                $total_row_productos = count($row_productos);

                                                if($total_row_productos>0){
                                                    foreach($row_productos as $dato_producto){
                                                        $id_producto.=$dato_producto['id_producto_cliente'].',';
                                                        $nombre_producto.=$dato_producto['nombre_producto_cliente'].',';
                                                    }
                                                }

                                                echo '<option phone="'.$row_clientes[$i]['telefono_cliente'].'" name="'.$row_clientes[$i]['nombre_cliente'].' '.$row_clientes[$i]['apellido_cliente'].'" data-idp="'.$id_producto.'" data-namep="'.$nombre_producto.'" value="'.$row_clientes[$i]['id_cliente'].'">'.$row_clientes[$i]['nombre_cliente'].' '.$row_clientes[$i]['apellido_cliente'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Repartidor</label>
                                    <select id="id_repartidor">
                                        <?php
                                        if($total_row_repartidores>0){
                                            foreach($row_repartidores as $dato){
                                                echo '<option value="'.$dato['id_repartidor'].'">'.$dato['nombre_repartidor'].' '.$dato['apellido_repartidor'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Teléfono destinatario</label>
                                    <input type="text" class="form-control phone_format" id="telefono">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Nombre de quién recibe</label>
                                    <input type="text" class="form-control name_format" id="nombre_recibe">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Descripción</label>
                                    <textarea id="descripcion" rows="5" class="form-control string_format"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p class="mb-1">Dirección remitente</p>
                                    <input type="text" class="form-control" placeholder="" data-limit="2000" id="direccion_remitente">
                                    <input type="hidden" id="lat_remitente" value="0">
                                    <input type="hidden" id="lon_remitente" value="0">
                                    <div id="mapa_remitente" style="height:300px; margin: auto; "></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <p class="mb-1">Dirección destinatario</p>
                                    <input type="text" class="form-control" placeholder="" data-limit="2000" id="direccion_destinatario">
                                    <input type="hidden" id="lat_destinatario" value="0">
                                    <input type="hidden" id="lon_destinatario" value="0">
                                    <div id="mapa_destinatario" style="height:300px; margin: auto; "></div>
                                </div>
                            </div>
                            <div class="col-sm-12" id="productos_orden_punto_a_punto">
                                <div class="form-group border-bottom pb-4">
                                    <label class="form-label d-block">Productos a envíar</label>
                                    <select id="id_producto_orden_punto_a_punto" data-simbolo="<?php echo $simbolo[0]['simbolo_tipo_cambio']; ?>" class="col-6" multiple>
                                        <?php
                                        $row_productos = $sql->obtenerResultado("CALL sp_select_productos_cliente1('".$id_cliente."');");
                                        $total_row_productos = count($row_productos);

                                        if($total_row_productos>0){
                                            foreach($row_productos as $dato){
                                                echo '<option value="'.$dato['nombre_producto_cliente'].'">'.$dato['nombre_producto_cliente'].'</option>';
                                            }
                                        }
                                        ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <div class="row" id="content_productos"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_agregar_orden_punto_a_punto">Agregar</button>
                    </div>
                </div>
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
    function create_map() {
        var options={
            center: {
                lat: 28.6925355,
                lng: -100.5421289
            },
            zoom: 17,
            disableDefaultUI: true,
            streetViewControl: false,
            mapTypeControl: false,
        }
        var map = new google.maps.Map(document.getElementById('mapa_remitente'),options);
        var map_2 = new google.maps.Map(document.getElementById('mapa_destinatario'),options);

        // REMITENTE
        var input = document.getElementById('direccion_remitente');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Por favor, asegurate de utilizar el autocompletado");
                return;
            }
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            infowindow.setContent('Tu pedido sera enviado a: <div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);
            //Location details
            document.getElementById('direccion_remitente').value = place.formatted_address;
            document.getElementById('lat_remitente').value = place.geometry.location.lat();
            document.getElementById('lon_remitente').value = place.geometry.location.lng();
        });
        // DESTINATARIO
        var input_2 = document.getElementById('direccion_destinatario');
        var autocomplete_2 = new google.maps.places.Autocomplete(input_2);
        autocomplete_2.bindTo('bounds', map);
        var infowindow_2 = new google.maps.InfoWindow();
        var marker_2 = new google.maps.Marker({
            map: map_2,
            anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete_2.addListener('place_changed', function() {
            infowindow_2.close();
            marker_2.setVisible(false);
            var place = autocomplete_2.getPlace();
            if (!place.geometry) {
                window.alert("Por favor, asegurate de utilizar el autocompletado");
                return;
            }
            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map_2.fitBounds(place.geometry.viewport);
            } else {
                map_2.setCenter(place.geometry.location);
                map_2.setZoom(17);
            }
            marker_2.setPosition(place.geometry.location);
            marker_2.setVisible(true);
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            infowindow_2.setContent('Tu pedido sera enviado a: <div><strong>' + place.name + '</strong><br>' + address);
            infowindow_2.open(map_2, marker_2);
            //Location details
            document.getElementById('direccion_destinatario').value = place.formatted_address;
            document.getElementById('lat_destinatario').value = place.geometry.location.lat();
            document.getElementById('lon_destinatario').value = place.geometry.location.lng();
        });
    }
    // SLIMSELECT
    var select_id_repartidor = new SlimSelect({
        select: '#id_repartidor',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un repartidor',
    });
    var select_id_cliente = new SlimSelect({
        select: '#id_cliente_orden_punto_a_punto',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un cliente',
    });
    var select_id_producto_orden_punto_a_punto = new SlimSelect({
        select: '#id_producto_orden_punto_a_punto',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un producto',
        closeOnSelect: false,
        addable: function (value) {
            return value
        },
    });
</script>