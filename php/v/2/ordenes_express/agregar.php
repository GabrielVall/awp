<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_repartidores = $sql->obtenerResultado("CALL sp_select_repartidores4(1);");
$total_row_repartidores = count($row_repartidores);

$row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales_express2();");
$total_row_sucursales = count($row_sucursales);

$row_clientes = $sql->obtenerResultado("CALL sp_select_clientes2();");
$total_row_clientes = count($row_clientes);

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nueva orden express</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nueva orden express</strong>
                </div>
                <div class="card-body py-4 mb-1" id="content_info">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Cliente</label>
                                    <select id="id_cliente">
                                        <?php
                                        if($total_row_clientes>0){
                                            for($i=0; $i<$total_row_clientes; $i++){

                                                echo '<option value="'.$row_clientes[$i]['id_cliente'].'">'.$row_clientes[$i]['nombre_cliente'].' '.$row_clientes[$i]['apellido_cliente'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sucursal</label>
                                    <select id="id_sucursal_orden_express" data-simbolo='<?php echo $simbolo[0]['simbolo_tipo_cambio'] ?>'>
                                        <?php
                                        $costo='0.00';
                                        if($total_row_sucursales>0){
                                            for($i=0; $i<$total_row_sucursales; $i++){
                                                if($i==0){
                                                    $costo=$row_sucursales[$i]['costo_km_sucursal_express'];
                                                }
                                                echo '<option costo="'.$row_sucursales[$i]['costo_km_sucursal_express'].'" value="'.$row_sucursales[$i]['id_sucursal_express'].'">'.$row_sucursales[$i]['nombre_sucursal_express'].'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label class="form-label" id="costo_orden_express">Costo de envío: <?php echo $simbolo[0]['simbolo_tipo_cambio'].$costo; ?></label>
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
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nombre de quién recibe</label>
                                    <input type="text" class="form-control name_format" id="nombre_recibe_orden">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Detalles de orden</label>
                                    <textarea id="detalles_orden" rows="5" class="form-control string_format"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p class="mb-1">Dirección</p>
                                    <input type="text" class="form-control" placeholder="" data-limit="2000" id="direccion_orden_express">
                                    <input type="hidden" id="lat_orden_express" value="0">
                                    <input type="hidden" id="lon_orden_express" value="0">
                                    <div id="mapa_orden_express" style="height:300px; margin: auto; "></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_agregar_orden_express">Agregar</button>
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
        var map = new google.maps.Map(document.getElementById('mapa_orden_express'),options);

        var input = document.getElementById('direccion_orden_express');
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
            document.getElementById('direccion_orden_express').value = place.formatted_address;
            document.getElementById('lat_orden_express').value = place.geometry.location.lat();
            document.getElementById('lon_orden_express').value = place.geometry.location.lng();
        });
    }
    // SLIMSELECT
    var select_id_sucursal_orden_express = new SlimSelect({
        select: '#id_sucursal_orden_express',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una sucursal',
    });
    var select_id_repartidor = new SlimSelect({
        select: '#id_repartidor',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un repartidor',
    });
    var select_id_cliente = new SlimSelect({
        select: '#id_cliente',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione un cliente',
    });
</script>