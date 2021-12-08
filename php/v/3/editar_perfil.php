<?php
    session_start();
    include_once("../../m/SQLConexion.php");
    $sql = new SQLConexion();
    $row_repartidor = $sql->obtenerResultado("CALL sp_select_informacion_repartidor('".$_SESSION['id_usuario']."')");
    $row_tipo_transporte = $sql->obtenerResultado("CALL sp_select_tipos_transporte()");
    $total_row_tipo_transporte = COUNT($row_tipo_transporte);
?>
<div class="container poppins" style="max-height:90vh; overflow-y:scroll;">
    <div class="top-detalles mt-5">
        <div class="row">
            <h3 class="text-center mt-1 titulo-detalle">Editar Perfil</h3>
        </div>
    </div>
    <div class="form-row m-4 poppins vh-edit" id="form_editar_repartidor">
        <div class="form-group col-12 mb-3">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control val_text val_pass" id="usuario" value="<?php echo $row_repartidor[0]['nombre_usuario']?>" val-min="3" val-max="50" val-text="1" val-tel="1">
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="password">Contraseña(Opcional)</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control pass val_text val_pass" id="password" placeholder="*******" autocomplete="new-password">
                <div style="display: flex;" id="generar_contraseña_formulario_inicio">
                    <span class="input-group-text px-4 border-md border-right-0">
                        <i class="fas fa-sync-alt"></i>
                    </span>
                </div>
            </div>
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="correo">Correo</label>
            <input type="text" class="form-control val_text val_pass" id="correo" value="<?php echo $row_repartidor[0]['correo_repartidor']?>" val-min="3" val-max="100" val-mail="1">
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control val_text val_pass" id="telefono" value="<?php echo $row_repartidor[0]['telefono_repartidor']?>" val-min="10" val-max="10" val-tel="1">
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="tipo_vehiculo">Tipo de vehiculo:</label>
            <select class="form-control val_text val_pass" id="tipo_vehiculo">
            <?php if($total_row_tipo_transporte>0){
                for ($i=0; $i < $total_row_tipo_transporte; $i++) { ?>
                <option value="<?php echo $row_tipo_transporte[$i]['id_tipo_transporte']?>" <?php if($row_tipo_transporte[$i]['id_tipo_transporte']==$row_repartidor[0]['id_tipo_transporte']){ echo 'selected';}?>><?php echo $row_tipo_transporte[$i]['nombre_tipo_transporte']?></option>
                <?php } 
            }?>
            </select>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="modelo">Modelo del vehículo</label>
            <input type="text" class="form-control val_text val_pass" id="modelo" value="<?php echo $row_repartidor[0]['modelo']?>" val-min="3" val-max="50" val-text="1">
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="color">Color</label>
            <input type="text" class="form-control val_text val_pass" id="color" value="<?php echo $row_repartidor[0]['color']?>" val-min="3" val-max="50" val-text="1">
            <div></div>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="detalles">Detalles</label>
            <textarea class="form-control val_text val_pass" id="detalles" val-min="3" val-max="200" val-text="1"><?php echo $row_repartidor[0]['descripcion_detalle_transporte_repartidor']?></textarea>
            <div></div>
        </div>
        <div class="d-grid gap-2">
              <a class="btn btn-success" id="editar_perfil" type="button">Guardar</a>
              <a class="btn btn-primary" href="#perfil" type="button">Volver</a>
        </div>
    </div>
</div>