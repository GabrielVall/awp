<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_ciudades = $sql->obtenerResultado("CALL sp_select_ciudades('".$_POST['id_estado']."')");
$total_ciudades = count($row_ciudades);
?>
<select id="select_ciudad" name="id_ciudad">
<option selected>Selecciona una opción</option>
    <?php
        if ($total_ciudades > 0) {
            for ($i=0; $i < $total_ciudades; $i++) { ?>
                <option value="<?php echo $row_ciudades[$i]['id_ciudad']; ?>" ><?php echo $row_ciudades[$i]['nombre_ciudad']; ?></option>    
            <?php }
        }else{ ?>
            <option>No hay estados registrados</option>
        <?php }
    ?>
</select>

<script>
new SlimSelect({
    select: '#select_ciudad',
    placeholderSearch: true,
    searchPlaceholder: 'Buscar...',
    placeholder: 'Selecciona una opción..', 
})
</script>