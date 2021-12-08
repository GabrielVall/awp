<?php
session_start();
include_once('../../../../librerias/fpdf/mc_table.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes_express2('" . $_GET['id_orden'] . "');");

$pdf = new PDF_MC_Table('P','mm');
$pdf->AddPage();

// ENCABEZADO

    $pdf->Image('../../../../img/0/logo_blanco.png',120,5,80,80);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(10,54,157);
    
    $pdf->setXY(5,15);
    $pdf->Cell(100, 5, "Orden #".$_GET['id_orden'],0,0,'L', false);
    
    $pdf->setXY(105,15);
    $pdf->Cell(100, 5, 'Fecha de orden: '.$row_orden[0]['fecha_registro_orden_express'].'hrs.',0,0,'R', false);

    $pdf->Line(5,20,205,20);
    
    // TITULO
        $pdf->SetFont('Arial', 'B', 10);
        
        $pdf->setXY(5,25);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Comprador:",1,1,'L', true);
        
        $pdf->setXY(5,32);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Sucursal:",1,1,'L', true);
        
        $pdf->setXY(5,39);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Generada por:",1,1,'L', true);
        
        $pdf->setXY(5,50);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Repartidor:",1,1,'L', true);
        
        $pdf->setXY(5,57);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Pagado por:",1,1,'L', true);
        
        $pdf->setXY(5,64);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Estado de orden:",1,1,'L', true);

    // INFO

        $pdf->SetFont('Arial', '', 8);
    
        $pdf->setXY(45,25);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente']),1,1,'L', false);
        
        $pdf->setXY(45,32);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_sucursal_express']),1,1,'L', false);
        
        $pdf->setXY(45,39);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['nombre_origen_orden'],1,1,'L', false);
        
        $pdf->setXY(45,50);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_repartidor'].' '.$row_orden[0]['apellido_repartidor']),1,1,'L', false);
        
        $pdf->setXY(45,57);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_metodo_pago']),1,1,'L', false);
        
        $pdf->setXY(45,64);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['nombre_estado_orden'],1,1,'L', false);

// DETALLES
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0,0,0);
    
    $pdf->setXY(5,85);
    $pdf->Cell(200, 7, utf8_decode("Dirección de entrega:"),0,1,'L', false);
    
    $pdf->SetFont('Arial', '', 10);

    $pdf->setXY(5,90);
    $pdf->MultiCell(200, 4, utf8_decode($row_orden[0]['direccion_orden_express']),0,'L', false);


    $coor_y=$pdf->GetY()+5;

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setXY(5,$coor_y);
    $pdf->Cell(200, 4, "Detalles:",0,1,'L', false);

    $pdf->SetFont('Arial', '', 10);
    $pdf->setXY(5,$coor_y+=5);
    $pdf->MultiCell(200, 4, utf8_decode($row_orden[0]['observaciones_orden_express']),0,'L', false);
    
// TOTALES
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->setXY(5,$coor_y+=5);
    $pdf->MultiCell(200, 4, utf8_decode('Total de envío: ').$row_orden[0]['simbolo_tipo_cambio'].$row_orden[0]['costo_envio_orden_express'],0,'R', false);
    
    $pdf->setXY(5,$coor_y+=5);
    $pdf->MultiCell(200, 4, utf8_decode('Total de la orden: ').$row_orden[0]['simbolo_tipo_cambio'].$row_orden[0]['total_orden_express'],0,'R', false);
    
    $pdf->setXY(5,$coor_y+=5);
    $pdf->MultiCell(200, 4, utf8_decode('Total a pagar: ').$row_orden[0]['simbolo_tipo_cambio'].number_format(($row_orden[0]['total_orden_express']+$row_orden[0]['costo_envio_orden_express']),2,'.',','),0,'R', false);


$pdf->Output("Detalles_orden.pdf", "I");