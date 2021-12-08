<?php
session_start();
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_empresa = $sql->obtenerResultado("CALL sp_select_empresa_reparto1();");

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row align-items-center mb-2">
                <div class="col">
                    <h2 class="h3 page-title">Configuración de la cuenta</h2>
                </div>
                <div class="col-auto"></div>
            </div>
            <div class="row">
                <!-- INFORMACIÓN -->
                <div class="col-sm-12 col-md-8">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Información de la cuenta</strong>
                        </div>
                        <div class="card-body" id="content_info">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre de empresa de reparto</label>
                                        <input type="text" class="form-control form-control-sm name_format" value="<?php echo $row_empresa[0]['nombre_empresa_reparto']; ?>" id="nombre_empresa">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nombre de usuario</label>
                                        <input type="text" class="form-control form-control-sm string_format" value="<?php echo $row_empresa[0]['nombre_usuario']; ?>" id="nombre_usuario">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" class="form-control form-control-sm phone_format" value="<?php echo $row_empresa[0]['telefono_empresa_reparto']; ?>" id="telefono_empresa">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Correo</label>
                                        <input type="text" class="form-control form-control-sm email_format" value="<?php echo $row_empresa[0]['correo_empresa_reparto']; ?>" id="correo_empresa">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group text-right">
                                        <button type="button" class="btn mb-2 btn-outline-dark" id="btn_guardar_info_cuenta">Guardar cambios</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTRASEÑA -->
                <div class="col-sm-12 col-md-4">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Cambiar contraseña</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Nueva contraseña</label>
                                <input type="password" class="form-control form-control-sm" id="contrasena">
                            </div>
                            <div class="form-group text-right">
                                <button type="button" class="btn mb-2 btn-outline-dark" id="btn_guardar_contrasena">Guardar cambios</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>