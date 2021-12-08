<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_usuario = $sql->obtenerResultado("CALL sp_select_usuario_sucursal('".$_POST['id_sucursal']."')");
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Cuenta responsable</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body p-3">
            <label class="form-label">Usuario</label>
            <div class="d-flex align-items-center">
                <div class="form-group w-100">
                    <div class="input-group">
                        <input class="form-control" autocomplete="off" placeholder="Nombre de usuario" id="user_sucursal" name="usuario" 
                        value="<?php 
                            if($row_usuario[0]['id_usuario'] != 1){
                                echo $row_usuario[0]['nombre_usuario'];
                            }
                        ?>" type="text" >
                        <a class="input-group-text  btn-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <label class="form-label">Contraseña</label>
            <div class="d-flex align-items-center">
            <?php
            if($row_usuario[0]['id_usuario'] == 1){ ?>
                <div class="form-group w-70">
                    <div class="input-group">
                        <input class="form-control form-control-sm" id="pass_sucursal" name="pass" value="" type="text" disabled="" >
                        <button id="reload_pass_suc" class="input-group-text bg-transparent"><i class="fas fa-sync"></i></button>
                    </div>
                </div>
                <a href="javascript:;" class="btn btn-sm btn-outline-secondary ms-2 px-3" id="copiar_pass_suc">Copiar</a>
            </div>
            <?php }else{ ?>
                
                <input type="hidden" name="pass" value="0">
            <small class="col-12 text-center m-2">Contraseña inaccesible por seguridad, puedes <a href="#">Reestablecerla</a></small>
            <?php } ?>
            </div>

            <div class="m-2">
                <small>Asegurate de guardar tu contraseña, una vez generada no volvera a ser visible.</small>
            </div>

            <input type="hidden" value="<?php echo $_POST['id_sucursal'] ?>" name="id_sucursal">
            <?php 
                if($row_usuario[0]['id_usuario'] != 1){ ?>
                    <button id="btn_add_usuario" data-bs-dismiss="modal" class="btn bg-gradient-dark w-100 mb-0">Editar usuario</button>
                <?php } else{ ?>
                    <button id="btn_add_usuario" data-bs-dismiss="modal" class="btn bg-gradient-dark w-100 mb-0 disabled">Asignar usuario</button>
                <?php }
            ?>
            
            </div>
        </div>
</div>