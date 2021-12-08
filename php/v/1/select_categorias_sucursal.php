<?php
session_start();
include_once("../../m/SQLConexion.php");
include_once("../../f/main_fnc.php");
$sql = new SQLConexion();
$row_categorias = $sql->obtenerResultado("CALL sp_select_categorias_producto1('".$_SESSION['id_sucursal_bxpress']."')");
$total_categorias = count($row_categorias);
?>
<option selected disabled>Selecciona un cliente</option>
<?php 
    if($total_categorias > 0){
        foreach($row_categorias as $categ){ 
            $nombre_categoria = $categ['nombre_categoria_producto'];
            $id = $categ['id_categoria_producto'];
            ?>
            <option value="<?php echo $id ?>"><?php echo $nombre_categoria ?></option>
        <?php }
    }
?>