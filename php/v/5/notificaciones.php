<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_ntf = $sql->obtenerResultado("CALL sp_verificar_notificaciones_recientes('".$_SESSION['id_usuario_bxpress']."')");
$total_ntf = count($row_ntf);
?>
<div class="container-fluid py-4">
    <div class="row my-4">
        <div class="col-12">
          <div class="card">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titulo</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mensaje</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Origen</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">fecha</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if($total_ntf > 0){
                            for ($i=0; $i < $total_ntf; $i++) { ?>
                            <tr>
                                <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?php echo $row_ntf[$i]['titulo_notificacion']; ?></h6>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <p class="text-sm text-secondary mb-0"><?php echo $row_ntf[$i]['mensaje_notificacion']; ?></p>
                                </td>
                                <td>
                                    <p class="text-sm text-secondary mb-0">Cliente</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm"><?php echo $row_ntf[$i]['fecha_notificacion']; ?></p>
                                </td>
                                <td class="align-middle text-center">
                                <span class="text-secondary text-sm"><?php if($row_ntf[$i]['estado_notificacion']){
                                    echo 'Vista';
                                }else{
                                    echo 'Pendiente';
                                } ?></span>
                                </td>
                                <td class="align-items-center d-flex align-middle text-center">
                                    <a type="button" class="btn btn-secondary btn-sm m-0">Ver</a>
                                </td>
                            </tr>
                            <?php }
                        }
                    ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
</div>