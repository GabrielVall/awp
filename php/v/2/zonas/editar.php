<?php
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_zona = $sql->obtenerResultado("CALL sp_select_zona1('".$_POST['id_zona']."');");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Editar área de servicio</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#areas_servicio" class="text-decoration-none text-muted">Áreas de servicio</a></li>
                            <li class="breadcrumb-item"><a href="#area_servicio_info_<?php echo $_POST['id_zona']; ?>" class="text-decoration-none text-muted"><?php echo $row_zona[0]['nombre_zona']; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-sm-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Editar área de servicio</strong>
                        </div>
                        <div class="card-body">
                            <div class="row" id="content_info">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control form-control-sm name_format" id="nombre_zona" value="<?php echo $row_zona[0]['nombre_zona']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Radio</label>
                                        <input type="text" class="form-control form-control-sm price_format" id="radio_zona" value="<?php echo $row_zona[0]['radio_zona']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <p class="mb-1 d-flex align-items-center justify-content-between">Dirección<span id="expandir_mapa" style="cursor:pointer;" data-map="#mapa_zona" class="material-icons-round">expand_more</span></p>
                                        <input type="text" class="form-control form-control-sm" placeholder="" data-limit="2000" value="<?php echo $row_zona[0]['direccion_zona']; ?>" id="direccion_zona">
                                        <input type="hidden" id="lat_zona"  value="<?php echo $row_zona[0]['latitud_zona']; ?>">
                                        <input type="hidden" id="lon_zona"  value="<?php echo $row_zona[0]['longitud_zona']; ?>">
                                        <div id="mapa_zona" style="height:300px; display: none; margin: auto; "></div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-outline-dark" id="btn_guardar_zona" data-id="<?php echo $_POST['id_zona']; ?>">Guardar cambios</button>
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
        var map = new google.maps.Map(document.getElementById('mapa_zona'), {
            center: {
                lat: <?php echo $row_zona[0]['latitud_zona']; ?>,
                lng: <?php echo $row_zona[0]['longitud_zona']; ?>
            },
            zoom: 17,
            disableDefaultUI: true,
            streetViewControl: false,
            mapTypeControl: false,
        });
        var input_map = document.getElementById('direccion_zona');
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
            document.getElementById('lat_zona').value = place_map.geometry.location.lat();
            document.getElementById('lon_zona').value = place_map.geometry.location.lng();

        });
    }
</script>