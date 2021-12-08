<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
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
        <div class="col-md-6 col-sm-12" id="formulario_sucursal" data-title="¡Bienvenido!" data-step="1" data-intro="En este formulario agregaras la información básica de tu sucursal.">
            <label class="form-label">Nombre de la sucursal.</label>
            <input type="hidden" name="id" value="0">
            <div class="input-group">
                <input id="nombre_sucursal"  data-min="4" autocomplete="off" name="nombre_sucursal" class="form-control 
                validar_no_especiales"
                type="text" placeholder="¿Como se llamara?">
            </div>
            <span id="validar"></span>
            <div class="row">
                <div class="col-6">
                    <label class="form-label">País</label>
                    <div class="input-group ">
                        <select id="pais_select" name="id_pais">
                            <?php
                                if ($total_paises > 0) {
                                    for ($i=0; $i < $total_paises; $i++) {
                                        $selected = '';
                                        if($row_paises[$i]['ciudad_empresa'] == 1){
                                            $selected = 'selected';
                                        }
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $row_paises[$i]['id_pais']; ?>" ><?php echo $row_paises[$i]['nombre_pais']; ?></option>    
                                    <?php }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Estado</label>
                    <div class="input-group " id="estado_select">
                    </div>
                </div>
            </div>
            <label class="form-label">Ciudad</label>
            <div class="input-group" id="ciudad_select_cont">
               <p class="form-control"> Selecciona un estado para continuar</p>
            </div>
            <label class="form-label">Dirección</label>
            <span id="direccion_cont">

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
            <div class="input-group">
                <input name="imagen_sucursal" id="imagen_sucursal" name="lastName" class="form-control" type="file" >
            </div>
            <label class="form-label">Telefono de contacto</label>
            <div class="input-group">
                <input style="width: 100%" class="form-control" id="telefono" id="demo" placeholder="" name="telefono" data-min="10" data-max="12" type="tel" placeholder="A este numero llamaran los clientes" value="">
            </div>
            <label class="form-label">Whatsapp de contacto</label>
            <div class="input-group">
                <input style="width: 100%" class="form-control validar_solo_numero" id="telefono_wsp" id="demo" placeholder="" name="telefono_wsp" data-min="10" data-max="12" type="tel" placeholder="A este numero llamaran los clientes" value="">
            </div>
            <span id="validar"></span>
            <label class="form-label">Descripción</label>
            <div class="input-group">
                <textarea name="descripcion"  data-min="30" id="desc" name="lastName" class="form-control validar_no_especiales" placeholder="Describe tu negocio..."></textarea>
            </div>  
            <span id="validar"></span>
            <input type="hidden" value="" name="lat" id="lat_mp" class="form-control">
            <input type="hidden" value="" name="long" id="lng_mp" class="form-control">
            <div class="row d-flex m-2 p-2">
                <a href="javascript:void(0)" id="preview_sucursal" class="btn btn-sm btn-secondary" data-title="Previsualizar" data-step="2" data-intro="Puedes pulsar aqui para previsualizar tu sucursal antes de agregarla, sin embargo es necesario subir al menos la imagen"> Previsualizar</a>
                <a href="javascript:void(0)" id="agregar_sucursal" data-id="0" class="btn btn-primary" data-title="Boton agregar" data-step="4" data-intro="Cuando todo este listo, presiona el boton agregar para que tu sucursal pueda ser vista desde la app/navegador">Agregar sucursal</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 justify-content-center d-flex">
            <div class="mobile-dark"  style="max-height:700px;" data-title="Visualizador" data-step="3" data-intro="Aquí se veran los cambios una vez presionado el boton">
                <iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php?editar=0"></iframe>
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
})
</script>
</div>