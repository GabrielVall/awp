<?php
    session_start();
    include_once("../../m/SQLConexion.php");
    $sql = new SQLConexion();
    $row_repartidor = $sql->obtenerResultado("CALL sp_select_informacion_repartidor('".$_SESSION['id_usuario']."')");
?>
<div class="container poppins mh-90">
    <div class="top-detalles">
        <div class="row">
            <div class="col-12 justify-content-center d-flex mt-4">
                <div class="contenedor-img-detalle">
                    <div class="imagen-circular">
                        <img src="https://image.flaticon.com/icons/png/512/190/190677.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <h3 class="text-center mt-1 titulo-detalle">Mi cuenta</h3>
        </div>
    </div>
    <div class="form-row m-4 poppins formulario">
        <div class="form-group col-md-12 mb-3">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" readonly id="usuario" value="<?php echo $row_repartidor[0]['nombre_usuario']?>">
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="nombre_repartidor">Nombre Repartidor</label>
            <input type="text" class="form-control" readonly id="nombre_repartidor" value="<?php echo $row_repartidor[0]['nombre_repartidor']?>">
        </div>
        <div class="form-group col-md-12 mb-3">
            <label for="empresa">Empresa afiliada</label>
            <input type="text" class="form-control" readonly id="empresa" value="<?php echo $row_repartidor[0]['nombre_empresa_reparto']?>">
        </div>
        <?php
            if($row_repartidor[0]['id_sucursal']>0){ ?>
        <div class="form-group col-md-12 mb-3">
            <label for="sucursal">Sucursal afiliada</label>
            <input type="text" class="form-control" readonly id="sucursal" value="<?php echo $row_repartidor[0]['nombre_sucursal']?>">
        </div>
            <?php }
        ?>
        <div class="form-group col-md-12 mb-3">
            <label for="vehiculo">Vehículo</label>
            <input type="text" class="form-control" readonly id="vehiculo" value="<?php echo $row_repartidor[0]['nombre_tipo_transporte']?>">
        </div>
        <div class="d-grid gap-2">
            <a class="btn btn-primary" href="#editar_perfil" type="button">Editar Perfil</a>
        </div>
    </div>
</div>