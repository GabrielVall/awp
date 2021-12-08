<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_ciudad = $sql->obtenerResultado("CALL sp_select_ciudad('".$_POST['id_ciudad']."')");
?>
<div class="input-group" id="">
    <input id="direccion" name="direccion" class="form-control" type="text" placeholder="Escoge una ciudad para continuar">
</div>
<div id="map" style="width:100%; height:300px; display:none" data-lat="<?php echo $row_ciudad[0]['lat_ciudad']; ?>" data-lon="<?php echo $row_ciudad[0]['lon_ciudad']; ?>">
</div>