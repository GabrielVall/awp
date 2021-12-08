<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_categorias_sucursales = $sql->obtenerResultado("CALL sp_select_categorias_disponibles();");
$total_row_categorias_sucursales = count($row_categorias_sucursales);

$row_empresas_comida = $sql->obtenerResultado("CALL sp_select_empresas_comida2();");
$total_row_empresas_comida = count($row_empresas_comida);

$row_paises = $sql->obtenerResultado("CALL sp_select_paises();");
$total_row_paises = count($row_paises);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Agregar nueva sucursal</h2>
                </div>
                <div class="col-auto">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="#sucursales" class="text-decoration-none text-muted">Sucursales</a></li>
                            <li class="breadcrumb-item"><a href="#nueva_sucursal" class="text-decoration-none text-muted">Nueva sucursal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header">
                    <strong class="card-title">Nueva sucursal</strong>
                </div>
                <div class="card-body py-4 mb-1">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-info-tab" data-toggle="pill" href="#v-info" role="tab" aria-controls="v-info" aria-selected="true">Información de la sucursal</a>
                                <a class="nav-link" id="v-imagenes-tab" data-toggle="pill" href="#v-imagenes" role="tab" aria-controls="v-imagenes" aria-selected="false">Imagen de la sucursal</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content mb-4" id="v-pills-tabContent">
                                <!-- INFO DEL PRODUCTO -->
                                <div class="tab-pane fade show active" id="v-info" role="tabpanel" aria-labelledby="v-info-tab">
                                    <div class="row" id="content_info">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control name_format form-control-sm" id="nombre_sucursal">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Descripción</label>
                                                <textarea id="descripcion_sucursal" rows="5" class="form-control string_format"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Tel. contacto</label>
                                                        <input type="text" class="form-control phone_format form-control-sm" id="telefono_sucursal">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Tel. whatsapp</label>
                                                        <input type="text" class="form-control phone_format form-control-sm" id="telefono_whatsapp_sucursal">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <p class="mb-1 d-flex align-items-center justify-content-between">Dirección<span id="expandir_mapa" style="cursor:pointer;" data-map="#mapa_sucursal" class="material-icons-round">expand_more</span></p>
                                                <input type="text" class="form-control form-control-sm" placeholder="" data-limit="2000" id="direccion_sucursal">
                                                <input type="hidden" id="lat_sucursal" value="0">
                                                <input type="hidden" id="lon_sucursal" value="0">
                                                <div id="mapa_sucursal" style="height:300px; display: none; margin: auto; "></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Categoría de la sucursal</label>
                                                        <select id="id_categoria_sucursal">
                                                            <?php
                                                            if($total_row_categorias_sucursales>0){
                                                                foreach ($row_categorias_sucursales as $dato) {
        
                                                                    echo '<option value="'.$dato['id_categoria_sucursal'].'">'.$dato['nombre_categoria_sucursal'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
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
                                                        <label class="form-label">Empresa</label>
                                                        <select id="id_empresa">
                                                            <?php
                                                            if($total_row_empresas_comida>0){
                                                                foreach ($row_empresas_comida as $dato) {
        
                                                                    echo '<option value="'.$dato['id_empresa_comida'].'">'.$dato['nombre_empresa_comida'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
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
                                </div>
                                <!-- IMÁGENES -->
                                <div class="tab-pane fade mb-4" id="v-imagenes" role="tabpanel" aria-labelledby="v-imagenes-tab">
                                    <div class="form-group">
                                        <div class="dropzone" id="myDropzone"></div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-outline-dark" id="btn_agregar_sucursal">Agregar</button>
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
<!-- MODALES -->

<!-- CROPPER -->
<div class="modal fade" id="modal_cropper" data-backdrop="static" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Recorte de imagen</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_cropper" data-id="">Confirmar</button>
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
    // CROPPER
    cropper_dropzone('.dropzone', '.jpg, .jpeg', 1, 'cropper_dropzone', 'sucursales', <?php echo $_SESSION['id_empresa_reparto_bexpress'];?>, 1200, 800);

    // MAPA
    var place_map = "";

    function create_map() {
        var map = new google.maps.Map(document.getElementById('mapa_sucursal'), {
            center: {
                lat: 28.6925355,
                lng: -100.5421289
            },
            zoom: 17,
            disableDefaultUI: true,
            streetViewControl: false,
            mapTypeControl: false,
        });
        var input_map = document.getElementById('direccion_sucursal');
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
            document.getElementById('lat_sucursal').value = place_map.geometry.location.lat();
            document.getElementById('lon_sucursal').value = place_map.geometry.location.lng();

        });
    }

    // SLIMSELECT
    var select_id_categoria_sucursal = new SlimSelect({
        select: '#id_categoria_sucursal',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una categoría de sucursal',
    });
    var select_id_empresa = new SlimSelect({
        select: '#id_empresa',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una empresa',
    });
    var select_id_ciudad = new SlimSelect({
        select: '#id_ciudad',
        searchText: 'No se encontraron resultados',
        searchPlaceholder: 'Buscar',
        placeholder: 'Seleccione una ciudad',
    });
</script>