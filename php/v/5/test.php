<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
if(isset($_SESSION['id_empresa_comida_bxpress'])){
    $row_sucursales = $sql->obtenerResultado("CALL sp_select_sucursales_empresa('".$_SESSION['id_empresa_comida_bxpress']."')");
    $total_sucursales = count($row_sucursales);
}else{
    include_once("sin_cuenta.php");
    exit();
}
?>
<div class="col-12 mt-4">
    <div class="card mb-4">
    <div class="card-header pb-0 p-3">
        <h6 class="mb-1">Mis sucursales</h6>
        <p class="text-sm">Agrega o selecciona una sucursal</p>
    </div>
    <div class="card-body p-3">
        <div class="row">
            <?php
            if ($total_sucursales > 0) {
                for ($i=0; $i < $total_sucursales; $i++) {  ?>
                   <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                        <div class="card card-blog card-plain">
                            <div class="position-relative">
                                <a class="d-block shadow-xl border-radius-xl">
                                <img src="<?php echo select_imagen('sucursales/',$row_sucursales[$i]['id_sucursal']) ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </a>
                            </div>
                            <div class="card-body px-1 pb-0">
                                <p class="text-gradient text-dark mb-2 text-sm">#<?php echo $row_sucursales[$i]['nombre_categoria_sucursal'] ?></p>
                                <a href="javascript:;">
                                <h5>
                                    <?php echo $row_sucursales[$i]['nombre_sucursal'] ?>
                                </h5>
                                </a>
                                <p class="mb-2 text-sm">
                                    <?php echo $row_sucursales[$i]['descripcion_sucursal'] ?>
                                </p>
                                <span class="text-sm" style="margin:0;">
                                    <i class="fas fa-user"></i> Administrador: Test test
                                </span>
                                <div class="d-flex align-items-center justify-content-end">
                                <button type="button" class="btn btn-primary btn-sm mb-0 config-btn">
                                    <i class="fas fa-cog" style="font-size:1.2em;"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mb-0 ">Acceder</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                <?php }
            }
            ?>
            
            <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                <div class="card h-100 card-plain border agregar_sucursal">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <a href="javascript:;">
                    <i class="fa fa-plus text-secondary mb-3" aria-hidden="true"></i>
                    <h5 class=" text-secondary"> Agregar sucursal </h5>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>