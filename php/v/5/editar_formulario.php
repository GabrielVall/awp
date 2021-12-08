<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_sucursal = $sql->obtenerResultado("CALL sp_select_sucursal('".$_POST['valor']."')");

$row_categoria = $sql->obtenerResultado("CALL sp_select_categorias_disponibles()");
$total_row_categoria = count($row_categoria);

$row_paises = $sql->obtenerResultado("CALL sp_select_paises()");
$total_paises = count($row_paises);
?>
<div class="card mb-4">
    <div class="card-header">
        <h5>Agregar sucursal</h5>
    </div>
<div class="card-body pt-0">
    <div class="row">
        <div class="col-md-6 col-sm-12" id="formulario_sucursal">
            <label class="form-label">Nombre de la sucursal.</label>
            <input type="hidden" name="id" value="<?php echo $_POST['valor']; ?>">
            <div class="input-group">
                <input id="nombre_sucursal" data-min="4" value="<?php echo $row_sucursal[0]['nombre_sucursal'] ?>" autocomplete="off" name="nombre_sucursal" 
                class="form-control 
                val_text" val-min="3" val-max="30"
                type="text" placeholder="¿Como se llamara?">
            </div>
            <span id="validar"></span>
            <div class="row">
                <div class="col-6">
                    <label class="form-label">País</label>
                    <div class="input-group ">
                        <select id="pais_select" name="id_pais">
                            <?php if ($total_paises > 0) {
                                    for ($i=0; $i < $total_paises; $i++) {
                                        $selected = '';
                                        if($row_paises[$i]['id_pais'] == $row_sucursal[0]['id_pais']){
                                            $selected = 'selected';
                                        } ?>
                                        <option <?php echo $selected ?> value="<?php echo $row_paises[$i]['id_pais']; ?>" ><?php echo $row_paises[$i]['nombre_pais']; ?></option>    
                                    <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Estado</label>
                    <div class="input-group " id="estado_select">
                    <?php 
                    $row_estados = $sql->obtenerResultado("CALL sp_select_estados('".$row_sucursal[0]['id_pais']."')");
                    $total_estados = count($row_estados);
                    ?>
                    <select id="select_estado" name="id_estado">
                        <?php
                            if ($total_estados > 0) {
                                for ($i=0; $i < $total_estados; $i++) { 
                                    $selected = '';
                                    if($row_sucursal[0]['id_estado'] == $row_estados[$i]['id_estado']){
                                        $selected = 'selected';
                                    }
                                    ?>
                                    <option <?php echo $selected ?> value="<?php echo $row_estados[$i]['id_estado']; ?>" ><?php echo $row_estados[$i]['nombre_estado']; ?></option>    
                                <?php }
                            }else{ ?>
                                <option>No hay estados registrados</option>
                            <?php }
                        ?>
                    </select>
                    <script>
                    new SlimSelect({
                        select: '#select_estado',
                        placeholderSearch: true,
                        searchPlaceholder: 'Buscar...',
                        placeholder: 'Selecciona una opción..',
                    })
                    </script>
                    </div>
                </div>
            </div>
            <label class="form-label">Ciudad</label>
            <div class="input-group" id="ciudad_select_cont">
            <?php
            $row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades('".$row_sucursal[0]['id_estado']."')");
            $total_ciudades = count($row_ciudades);
            ?>
            <select id="select_ciudad" name="id_ciudad">
            <option selected>Selecciona una opción</option>
                <?php
                    if ($total_ciudades > 0) {
                        for ($i=0; $i < $total_ciudades; $i++) { 
                            $selected = '';
                            if($row_sucursal[0]['id_ciudad'] == $row_ciudades[$i]['id_ciudad']){
                                $selected = 'selected';
                            }
                            ?>
                            <option <?php echo $selected; ?> value="<?php echo $row_ciudades[$i]['id_ciudad']; ?>" ><?php echo $row_ciudades[$i]['nombre_ciudad']; ?></option>    
                        <?php }
                    }else{ ?>
                        <option>No hay estados registrados</option>
                    <?php }
                ?>
            </select>
            <script>
                new SlimSelect({
                    select: '#select_ciudad',
                    placeholderSearch: true,
                    searchPlaceholder: 'Buscar...',
                    placeholder: 'Selecciona una opción..', 
                })
            </script>
            </div>
            <label class="form-label">Dirección</label>
            <span id="direccion_cont">
            <?php
            $row_ciudad = $sql->obtenerResultado("CALL sp_select_ciudad('".$row_sucursal[0]['id_ciudad']."')");
            ?>
            <div class="input-group" id="">
                <input id="direccion" value="<?php echo $row_sucursal[0]['direccion_sucursal']; ?>" name="direccion" class="form-control" type="text" placeholder="Escoge una ciudad para continuar">
            </div>
            <div id="map" style="width:100%; height:300px; display:none" data-lat="<?php echo $row_ciudad[0]['lat_ciudad']; ?>" data-lon="<?php echo $row_ciudad[0]['lon_ciudad']; ?>">
            </div>
            </span>
            <label class="form-label">Categoria de tu empresa</label>
            <div class="input-group ">
                <select id="categoria_select" name="categoria_select">
                    <?php
                        if ($total_row_categoria > 0) {
                            for ($i=0; $i < $total_row_categoria; $i++) { ?>
                                <option data-cat="<?php echo $row_categoria[$i]['nombre_categoria_sucursal']; ?>" 
                                    value="<?php echo $row_categoria[$i]['id_categoria_sucursal']; ?>" >
                                    <?php echo $row_categoria[$i]['nombre_categoria_sucursal']; ?>
                                </option>    
                            <?php }
                        }
                    ?>
                </select>
            </div>
            <label class="form-label">Imagen promocional</label>
            <div class="row m-2">
                <label for="imagen_sucursal" class="col-12">
                    <a class="btn btn-primary row">Cambiar imagen</a>
                    <input name="imagen_sucursal"  id="imagen_sucursal" class="form-control d-none" type="file" >
                </label>
            </div>
            <label class="form-label">Telefono de contacto</label>
            <div class="input-group">
                <input style="width: 100%" 
                class="form-control" id="telefono" id="demo" placeholder="" name="telefono" data-min="10" data-max="12" type="tel" placeholder="A este numero llamaran los clientes" value="<?php echo $row_sucursal[0]['telefono_sucursal'] ?>">
            </div>
            <label class="form-label">Whatsapp de contacto</label>
            <div class="input-group">
                <input style="width: 100%" class="form-control " id="telefono_wsp" id="demo" placeholder="" name="telefono_wsp" data-min="10" data-max="12" type="tel" placeholder="A este numero llamaran los clientes" value="<?php echo $row_sucursal[0]['telefono_whatsapp_sucursal'] ?>">
            </div>
            <span id="validar"></span>
            <label class="form-label">Descripción</label>
            <div class="input-group">
                <textarea name="descripcion" data-min="30" id="desc" name="lastName" class="form-control validar_no_especiales" placeholder="Describe tu negocio..."><?php echo $row_sucursal[0]['descripcion_sucursal'] ?></textarea>
            </div>
            <span id="validar"></span>
            <input type="hidden" value="<?php echo $row_sucursal[0]['latitud_sucursal'] ?>" name="lat" id="lat_mp" class="form-control">
            <input type="hidden" value="<?php echo $row_sucursal[0]['longitud_sucursal'] ?>" name="long" id="lng_mp" class="form-control">
            <div class="row d-flex m-2 p-2">
                <a href="javascript:void(0)" id="preview_sucursal" class="btn btn-sm btn-secondary"> Previsualizar</a>
                <a href="javascript:void(0)" data-id="<?php echo $_POST['valor'] ?>" id="agregar_sucursal" class="btn btn-primary">Editar sucursal</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 justify-content-center d-flex">
            <div class="mobile-dark"  style="max-height:700px;">
                <iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php"></iframe>
            </div>
        </div>
    </div>
</div>
<script>
new SlimSelect({
    select: '#categoria_select',
    placeholderSearch: true,
    searchPlaceholder: 'Buscar...',
    placeholder: 'Selecciona una opción..', 
});
new SlimSelect({
    select: '#pais_select',
    placeholderSearch: true,
    searchPlaceholder: 'Buscar...',
    placeholder: 'Selecciona una opción..', 
});
</script>
</div>