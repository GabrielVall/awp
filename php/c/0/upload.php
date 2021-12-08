<?php
session_start();
$ruta = '../../../img/'.$_POST['carpeta'];
if (!file_exists($ruta)) {
    mkdir($ruta);
}
$ruta = '../../../img/'.$_POST['carpeta'].'/'.$_POST['subcarpeta'];
if (!file_exists($ruta)) {
    mkdir($ruta);
}

// CROPPER DROPZONE ADD
if($_POST['request'] == 'cropper_dropzone'){
    upload_dropzone($ruta);
}
// CROPPER AND DROPZONE COPY
else if($_POST['request'] == "cropper_dropzone_copy"){

    $from = '../../../img/'.$_POST['carpeta'].'/user_'.$_SESSION['id_empresa_reparto_bexpress'];
    $to = '../../../img/'.$_POST['carpeta'].'/'.$_POST['subcarpeta'];
    copy_files($from,$to);

}
// CROPPER AND DROPZONE COPY UPDATE
else if($_POST['request'] == "cropper_dropzone_copy_update"){

    $files = glob('../../../img/' . $_POST['carpeta'] . '/' . $_POST['subcarpeta'] . '/*');
    foreach ($files as $file) {
        if (is_file($file)){
            unlink($file);
        }
    }

    $from = '../../../img/'.$_POST['carpeta'].'/user_'.$_SESSION['id_empresa_reparto_bexpress'];
    $to = '../../../img/'.$_POST['carpeta'].'/'.$_POST['subcarpeta'];
    copy_files($from,$to);

}
// CROPPER AND DROPZONE CANCEL
else if($_POST['request'] == "cropper_dropzone_delete"){

    $from = '../../../img/'.$_POST['carpeta'].'/user_'.$_SESSION['id_empresa_reparto_bexpress'];
    unlink($from.'/'.$_POST['name']);
    
}
// CROPPER AND DROPZONE DELETE
else if($_POST['request'] == "cropper_dropzone_delete_2"){

    $from = '../../../img/'.$_POST['carpeta'].'/'.$_POST['subcarpeta'];
    if(unlink($from.'/'.$_POST['name'])){
        $response_array['status']='success';
    }
    else{
        $response_array['status']='error';
    }

    header('Content-type: application/json');
    echo json_encode($response_array);
    
}
// DELETE FILE
else if($_POST['request'] == "delete_file"){
    
    if(unlink($ruta.'/'.$_POST['name'])){
        $response_array['status']='success';
        $response_array['title']='Archivo';
        $response_array['message']='eliminado correctamente';
        $response_array['time']=1500;
    }
    else{
        $response_array['status']='error';
        $response_array['title']='Error';
        $response_array['message']='por favor inténtelo de nuevo';
        $response_array['time']=3000;
    }


    header('Content-type: application/json');
    echo json_encode($response_array);
}

// FUNCIONES
function upload_dropzone($ruta){
    $nombre_archivo = $_FILES['file']['name'];
    $tmp_archivo = $_FILES['file']['tmp_name'];

    $archivador = $ruta . "/" . $nombre_archivo;

    if (!empty($_FILES)) {

        if(move_uploaded_file($tmp_archivo, $archivador)){
            $response_array["status"]="success";
        }
        else{
            $response_array["status"]="error";
        }
    }
    header('Content-type: application/json');
    echo json_encode($response_array);
}
function copy_files($from,$to){
    $dir = opendir($from);
    while(($file = readdir($dir)) !== false){
        if(strpos($file, '.') !== 0){
            if(copy($from.'/'.$file, $to.'/'.$file)){
                
                unlink($from.'/'.$file);

                $new_name='image_'.date("d-m-y_H-i-s");

                $img_created_to_webp=@imagecreatefrompng($to.'/'.$file);

                if(!$img_created_to_webp){
                    $img_created_to_webp = imagecreatefromjpeg($to.'/'.$file);
                }

                $w=imagesx($img_created_to_webp);
                $h=imagesy($img_created_to_webp);
                $webp=imagecreatetruecolor($w,$h);
                $i=0;
                imagecopy($webp,$img_created_to_webp,0,0,0,0,$w,$h);

                while(file_exists($to.'/'.$new_name.'.webp')){
                    $new_name.='_'.$i;
                    $i++;
                }

                if(imagewebp($webp, $to.'/'.$new_name.'.webp', 80)){
                    $response_array['status']="success";
                }
                else{
                    $response_array['status']="error";
                }
                
                imagedestroy($img_created_to_webp);
                imagedestroy($webp);

                unlink($to.'/'.$file);
            }
            else{
                $response_array["status"]="error";
                break;
            }
        }
    }
    header('Content-type: application/json');
    echo json_encode($response_array);
}