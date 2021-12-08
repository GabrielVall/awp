<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
if( isset($_SESSION['id_empresa_comida_bxpress']) ){ 
    $row_usuario = $sql->obtenerResultado("CALL sp_select_usuario_emp('".$_SESSION['id_usuario_bxpress']."')");
}else{
    include_once("sin_cuenta.php");
    exit();
}
?>
<div class="card card-body" id="profile">
   <div class="row justify-content-center align-items-center">
      <div class="col-sm-auto col-4">
         <label class="avatar avatar-xl position-relative" id="form_imagen" for="editar_imagen_usuario">
            <img src="<?php echo select_imagen('usuarios/',$_SESSION['id_usuario_bxpress']) ?>" alt="bruce" class="w-100 border-radius-lg shadow-sm img-prof">
            <input type="file" style="display:none;" name="foto_perfil" id="editar_imagen_usuario" accept="image/png, image/gif, image/jpeg">
         </label>
      </div>
      <div class="col-sm-auto col-8 my-auto">
         <div class="h-100">
            <h5 class="mb-1 font-weight-bolder">
               <?php echo $row_usuario[0]['nombre_usuario'] ?>
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
            <?php echo $row_usuario[0]['correo_emp'] ?>
            </p>
            <p class="mb-0 font-weight-bold text-sm">
            <?php echo $row_usuario[0]['nombre_empresa_comida'] ?>
            </p>
         </div>
      </div>
      <!-- <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
         <label class="form-check-label d-flex justify-content-center align-items-center">
            <div>Tu cuenta no ha sido verificada</div>
            <div class="mx-4"><i class="far fa-times-circle" style="font-size:2em; color:#f17d7d"></i></div>
         </div>
      </div> -->
      <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
         <label class="form-check-label d-flex justify-content-center align-items-center">
            <div>Cuenta verificada</div>
            <div class="mx-4"><i class="fas fa-check-circle" style="font-size:2.1em; color:#5eb15e"></i></div>
         </div>
      </div>
   </div>
</div>
<div class="contenedor-config">
<div class="card mt-4" id="2fa">
   <div class="card-header d-flex">
      <h5 class="mb-0">Sonidos del panel</h5>
      <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
         <label class="form-check-label mb-0">
         <small id="profileVisibility">
         Reproducir sonidos de notificaciones
         </small>
         </label>
         <div class="form-check form-switch ms-2">
            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked="">
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="d-flex">
         <p class="my-auto">Alertas generales</p>
         <p class="text-secondary text-sm ms-auto my-auto me-3" id="notify-sound"></p>
         <button type="button"  class="btn btn-primary btn-sm mb-0 " data-bs-toggle="modal" data-bs-target="#exampleModal" id="modal_sonido" data-tipo="notify">Cambiar</button>
         <button type="button" data-audio="notify" class="btn btn-primary btn-sm mb-0 ms-2 config-btn audio_test">
            <i class="fas fa-volume-up" style="font-size:1.2em;"></i>
         </button>
      </div>
      <hr class="horizontal dark">
      <div class="d-flex">
         <p class="my-auto">Notificaciones de confirmación </p>
         <p class="text-secondary text-sm ms-auto my-auto me-3" id="success-sound"></p>
         <button type="button" class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal" id="modal_sonido" data-tipo="success">Cambiar</button>
         <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 config-btn audio_test" data-audio="success">
         <i class="fas fa-volume-up" style="font-size:1.2em;"></i>
         </button>
      </div>
      <hr class="horizontal dark">
      <div class="d-flex">
         <p class="my-auto">Notificaciones de error</p>
         <p class="text-secondary text-sm ms-auto my-auto me-3" id="error-sound"></p>
         <button type="button" class="btn btn-primary btn-sm mb-0 " data-bs-toggle="modal" data-bs-target="#exampleModal" id="modal_sonido" data-tipo="error">Cambiar</button>
         <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 config-btn audio_test" data-audio="error">
         <i class="fas fa-volume-up" style="font-size:1.2em;"></i>
         </button>
      </div>
   </div>
</div>


<div class="card mt-4 " id="2fa">
   <div class="card-header d-flex">
      <h5 class="mb-0">Auto-ayudas</h5>
   </div>
   <div class="card-body">
      <div class="d-flex">
         <p class="my-auto">Vista inicial</p>
         <p class="text-secondary text-sm ms-auto my-auto me-3"></p>
         <button class="btn btn-sm btn-outline-dark mb-0" data-ayuda="" type="button">Ver ayuda</button>
      </div>
      <hr class="horizontal dark">
      <div class="d-flex">
         <p class="my-auto">Formulario</p>
         <p class="text-secondary text-sm ms-auto my-auto me-3"></p>
         <button class="btn btn-sm btn-outline-dark mb-0" data-ayuda="formulario" type="button">Ver ayuda</button>
      </div>
   </div>
</div>


<div class="card mt-4 danger-card" id="delete">
   <div class="card-header">
      <h5>Desactivar usuarios</h5>
      <p class="text-sm mb-0">Desactivar a los usuarios hara que solo tu tengas acceso a tus sucursales, puedes revertir esta accion en cualquier momento.</p>
   </div>
   <div class="card-body d-sm-flex pt-0">
      <div class="d-flex align-items-center mb-sm-0 mb-4">
      <div>
         <div class="form-check form-switch mb-0">
         <input class="form-check-input" type="checkbox" id="confirmar_desactivar">
         </div>
      </div>
      <div class="ms-2">
         <span class="">Confirmar</span>
         <span class="text-xs d-block">Quiero ocultar mis sucursales.</span>
      </div>
      </div>
      <button class="btn btn-outline-secondary mb-0 ms-auto desactivado" id="boton_desactivar" type="button" name="button">Desactivar</button>
      <!-- bg-gradient-danger -->
   </div>
</div>
<div class="mb-5 pb-5"></div>




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_modal">Cambiar sonido - Confirmación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <ul class="list-group">
          <?php
          $files = glob('../../../sounds/*.{wav,mp3,ogg}', GLOB_BRACE);
            foreach($files as $file) { 
                $file = substr($file, 16);
                ?>
                <li class="list-group-item border-0 d-flex align-items-center p-2 mb-2 ">
                  <div class="avatar me-3">
                    <img src="../img/svg/sound.png" style="m-2" class="border-radius-lg shadow">
                  </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm"><?php echo $file; ?></h6>
                  </div>
                  <button type="button" class="btn btn-primary btn-sm mb-0 ms-auto config-btn audio_modal">
                    <i class="fas fa-volume-up" style="font-size:1.2em;" aria-hidden="true"></i>
                  </button>
                  <audio id="audio" src="../sounds/<?php echo $file; ?>"></audio>
                </li>
            <?php }
          ?>
                
              </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal" id="cambiar_sonido">Cambiar</button>
      </div>
    </div>
  </div>
</div>