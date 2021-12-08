<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_menus = $sql->obtenerResultado("CALL sp_select_menus1('" . $_SESSION['id_sucursal_bxpress'] . "');");
$total_row_menus = count($row_menus);
?>
<?php 
    if($total_row_menus > 0){
        foreach($row_menus as $menu){ 
            $nombre = $ing['nombre_menu'];
            $id = $ing['id_menu'];
            ?>
            <option value="<?php echo $id ?>"><?php echo $nombre ?></option>
        <?php }
    }
?>