<?php

function escape($str){
	foreach ($str as $index => $post){
		$post = addslashes($post);
	};
	
	return $str;
}

function select_imagen($ruta,$id,$n_carpetas = 3,$n_carpetas_vista = 1){
    $dir = '';
    for ($i=0; $i < $n_carpetas; $i++) { 
        $dir = $dir.'../';
    }
    $vista = '';
    for ($i=0; $i < $n_carpetas_vista; $i++) { 
        $vista = $vista.'../';
    }
    // Toma la ruta desde el controlador a la imagen
    $ruta_full = $dir.'img/'.$ruta.'/'.$id;
    // Toma la ruta desde el archivo a la imagen
    $ruta = $vista.'img/'.$ruta;
    // Si el directorio existe
    if(is_dir($ruta_full)){
        // Si existe más de un archivo (ignora '.','..')
        if(count(scandir($ruta_full)) > 2){
            $primer_archivo = scandir($ruta_full)[2];
            // Regresa la ruta del archivo a mostrar en la vista
            return $ruta.$id.'/'.$primer_archivo;
        }else{
            // Solo aparece cuando existe carpeta pero no la imagen
            return $ruta.'/error.jpg';
        }
    }else{
        // Solo aparece si no existe la carpeta, muestra la imagen por defecto de la carpeta
        return $ruta.'/default.jpg';
    }
    return $ruta;
}

function agrupar_numero($num) {
    if($num>1000) {
  
          $x = round($num);
          $x_number_format = number_format($x);
          $x_array = explode(',', $x_number_format);
          $x_parts = array('k', 'm', 'b', 't');
          $x_count_parts = count($x_array) - 1;
          $x_display = $x;
          $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
          $x_display .= $x_parts[$x_count_parts - 1];
  
          return $x_display;
  
    }
  
    return $num;
}
// $ruta = direccion a la cual mandar el archivo ej /productos /usuarios
// $carpeta = carpeta a crear generalmente el id insertado
// $extensiones = array() de extensiones aceptadas del archivo a subir
// $n_carpetas = numero de carpetas a salir, default 3
function subir_imagen($ruta,$carpeta,$archivo,$valid_extensions,$n_carpetas = 3){
    $dir = '';
    for ($i=0; $i < $n_carpetas; $i++) { 
        $dir = $dir.'../';
    }
    $location = $dir.'/'.'img/'.$ruta.'/'.$carpeta;
    if (!file_exists($location)) {
        mkdir($location, 0777, true);
    }else{
        $borrar_dir = $location;
        $borrar_files = glob($borrar_dir.'/*'); // get all file names
        foreach($borrar_files as $borrar_file){ // iterate files
        if(is_file($borrar_file)) {
            unlink($borrar_file); // delete file
        }
}
    }
    $location = $location.'/'.$archivo['name'];
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    $response = 0;
    /* validar extencion */
    if(in_array(strtolower($imageFileType), $valid_extensions)) {
        /* Subir  archivo */
        if(move_uploaded_file($archivo['tmp_name'],$location)){
            $response = $location;
        }
    }
}

function sinResultados($texto,$spans = 6){ 
    $x = <<<EOT
    <td class="text-center" colspan="$spans" style="overflow: hidden">
        <div class="row justify-content-center d-flex">
            <div class="col-12">
                <img src="../img/svg/empty.png">
            </div>
            <div class="col-12 text-center">
                No hay a $texto registrados
            </div>
        </div>
    </td>
    EOT;
    return $x;
}