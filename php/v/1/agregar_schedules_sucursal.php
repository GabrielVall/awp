<?php
session_start();
include_once("../../m/SQLConexion.php");
$sql = new SQLConexion();
$row_productos = $sql->obtenerResultado("CALL sp_select_orden_id('".$_POST['valor']."')");
$total = count($row_productos);
?>
<div class="container-fluid py-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 tab_suc active-tab" data-show="#complementos_card">
                                Agregar shedules
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 tab_suc" data-show="#tabla_ingredientes">
                                Shedules agregados
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body pt-0" id="complementos_card">
            <div class="row">
                <div class="col-md-6 col-sm-12" id="formulario_complementos">
                    <label class="form-label">Nombre del shedule</label>
                    <div class="input-group mb-2">
                        <input id="nombre_complemento"   autocomplete="off" name="nombre_complemento"
                        class="form-control val_text" val-min="3" val-max="20" val-text="1"
                        type="text" placeholder="¿Como se llamara?">
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <div>
                                <label>Hora de apertura</label>
                                <input id="cant_minima" class="multisteps-form__input form-control val_text" 
                                val-tel="1" val-min="1" val-max="2" 
                                type="text" placeholder="¿A que hora abriras?">
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                            <div>
                                <label>Hora de cierre</label>
                                <input class="multisteps-form__input form-control val_text" id="cant_maxima" 
                                val-tel="1" val-min="1" val-max="2" 
                                type="text" placeholder="¿A que hora cerraras?">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                          <label>Productos</label>
                          <select class="form-control" id="seleccion_multiple">
                          </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                          <label>Dias</label>
                          <select class="form-control" id="seleccion_multiple">
                          </select>
                        </div>
                    </div>
                    <div class="row d-flex m-2 p-2">
                        <a href="javascript:void(0)" id="preview_complemento" class="btn btn-sm btn-secondary" > Previsualizar</a>
                        <a href="javascript:void(0)" id="agregar_complemento" data-id="0" class="btn btn-primary" >Agregar complemento</a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 justify-content-center d-flex">
                    <div class="mobile-dark"  style="max-height:700px;">
                        <iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php?editar=0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0" style="display:none;"  id="tabla_ingredientes">

        </div>
    </div>