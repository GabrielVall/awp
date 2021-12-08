
<?php
if($_SESSION['estado_usuario'] == 4){ ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div class="card-header pb-0 text-center">
            <h6 >Tu cuenta ha sido desactivada</h6>
            <p>Comunicate con el proveedor de servicio para obtener más información</p>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
        </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 text-center">
                <h6>Sesión expirada</h6>
                <p>Ha caducado tu sesión, vuelve a iniciar sesión, si tu cuenta esta configurada para iniciar automaticamente <a href=".">recarga la página.</a></p>
            </div>
            <div class="card-body px-0 pt-0 pb-2"></div>
        </div>
    </div>
</div>
<?php 
}
?>