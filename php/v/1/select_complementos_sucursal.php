<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_ingredientes = $sql->obtenerResultado("CALL sp_select_ingredientes1('".$_SESSION['id_sucursal_bxpress']."')");
$total_ingredientes = count($row_ingredientes);
?>
<?php 
    if($total_ingredientes > 0){
        foreach($row_ingredientes as $ing){ 
            $nombre_ing = $ing['nombre_ingrediente'];
            $id = $ing['id_ingrediente'];
            ?>
            <option value="<?php echo $id ?>"><?php echo $nombre_ing ?></option>
        <?php }
    }
?>