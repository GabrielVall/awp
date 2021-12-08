<?php 
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_estados = $sql->obtenerResultado("CALL sp_select_estados('".$_POST['id_pais']."')");
$total_estados = count($row_estados);
?>
<select id="select_estado" name="id_estado">
<option selected>Selecciona una opción</option>
    <?php
        if ($total_estados > 0) {
            for ($i=0; $i < $total_estados; $i++) { ?>
                <option value="<?php echo $row_estados[$i]['id_estado']; ?>" ><?php echo $row_estados[$i]['nombre_estado']; ?></option>    
            <?php }
        }else{ ?>
            <option>No hay estados registrados</option>
        <?php }
    ?>
</select>
<script>
new SlimSelect({
    select: '#select_estado',
    placeholderSearch: true,
    searchPlaceholder: 'Buscar...',
    placeholder: 'Selecciona una opción..', 
})
</script>