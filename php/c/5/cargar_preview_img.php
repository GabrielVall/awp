<?php
session_start();
include_once("../../f/main_fnc.php");
if(isset($_FILES['file']['name'])){
    subir_imagen('preview_sucursal',$_SESSION['id_usuario_bxpress'],$_FILES['file'],array("jpg","jpeg","png"));
}