<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_paises = $sql->obtenerResultado("CALL sp_select_paises();");
$total_row_paises = count($row_paises);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nuevo repartidor</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#repartidores" class="text-decoration-none text-muted">Repartidores</a></li>
                            <li class="breadcrumb-item"><a href="#nuevo_repartidor" class="text-decoration-none text-muted">Nuevo repartidor</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nuevo repartidor</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row" id="content_info">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Nombre(s)</label>
                                <input type="text" class="form-control form-control-sm name_format" id="nombre_repartidor">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Apellidos</label>
                                <input type="text" class="form-control form-control-sm name_format" id="apellido_repartidor">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tel. contacto</label>
                                <input type="text" class="form-control form-control-sm phone_format" id="telefono_repartidor">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Ciudad</label>
                                <select id="id_ciudad">
                                    <?php
                                    if($total_row_paises>0){
                                        foreach ($row_paises as $dato_pais) {
                                            
                                            $row_estados = $sql->obtenerResultado("CALL sp_select_estados2('".$dato_pais['id_pais']."');");
                                            $total_row_estados = count($row_estados);
                                            
                                            echo
                                            '<optgroup label="'.$dato_pais['nombre_pais'].'">';
                                                if($total_row_estados>0){
                                                    foreach ($row_estados as $dato_estado) {

                                                        $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades2('".$dato_estado['id_estado']."');");
                                                        $total_row_ciudades = count($row_ciudades);

                                                        echo
                                                        '<optgroup label="&nbsp&nbsp&nbsp'.$dato_estado['nombre_estado'].'">';
                                                            if($total_row_ciudades>0){
                                                                foreach($row_ciudades as $dato_ciudad){
                                                                    echo '<option value="'.$dato_ciudad['id_ciudad'].'">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$dato_ciudad['nombre_ciudad'].'</option>';
                                                                }
                                                            }
                                                        echo
                                                        '</optgroup>';
                                                    }
                                                }
                                            echo
                                            '</optgroup>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Correo</label>
                                <input type="text" class="form-control form-control-sm email_format" id="correo_repartidor">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p class="mb-1 d-flex align-items-center justify-content-between">Dirección<span id="expandir_mapa" style="cursor:pointer;" data-map="#mapa_repartidor" class="material-icons-round">expand_more</span></p>
                                <input type="text" class="form-control form-control-sm" placeholder="" data-limit="2000" id="direccion_repartidor">
                                <input type="hidden" id="lat_repartidor" value="0">
                                <input type="hidden" id="lon_repartidor" value="0">
                                <div id="mapa_repartidor" style="height:300px; display: none; margin: auto; "></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre de usuario</label>
                                        <input type="text" class="form-control form-control-sm string_format" id="nombre_usuario">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Contraseña</label>
                                        <input type="password" class="form-control form-control-sm" id="contrasena">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-outline-dark" id="btn_agregar_repartidor">Agregar</button>
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
    var place_map = "";

    function create_map() {
        var map = new google.maps.Map(document.getElementById('mapa_repartidor'), {
            center: {
                lat: 28.6925355,
                lng: -100.5421289
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

    // SLIMSELECT
    var select_id_ciudad = new SlimSelect({
        select: '#id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
</script>