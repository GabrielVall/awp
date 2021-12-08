<?php
session_start();
include_once('../../../../librerias/fpdf/mc_table.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_orden_punto_a_punto1('" . $_GET['id_orden'] . "');");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_historial_venta_punto_a_punto1('" . $_GET['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

$pdf = new PDF_MC_Table('P','mm');
$pdf->AddPage();

// ENCABEZADO

    $pdf->Image('../../../../img/0/logo_blanco.png',120,5,80,80);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(10,54,157);
    
    $pdf->setXY(5,15);
    $pdf->Cell(100, 5, "Orden #".$_GET['id_orden'],0,0,'L', false);
    
    $pdf->setXY(105,15);
    $pdf->Cell(100, 5, 'Fecha de orden: '.$row_orden[0]['fecha_registro_orden_punto_a_punto'].'hrs.',0,0,'R', false);

    $pdf->Line(5,20,205,20);
    
    // TITULO
        $pdf->SetFont('Arial', 'B', 10);
        
        $pdf->setXY(5,25);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Comprador:",1,1,'L', true);
        
        $pdf->setXY(5,32);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Repartidor:",1,1,'L', true);
        
        $pdf->setXY(5,39);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Pagado por:",1,1,'L', true);
        
        $pdf->setXY(5,50);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Recibe:",1,1,'L', true);
        
        $pdf->setXY(5,57);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, utf8_decode("Teléfono:"),1,1,'L', true);
        
        $pdf->setXY(5,64);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(40, 7, "Los productos:",1,1,'L', true);

        $pdf->setXY(5,75);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(26, 7, "Generada por:",1,1,'L', true);

        $pdf->setXY(105,75);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(26, 7, "Estado Orden:",1,1,'L', true);

    // INFO

        $pdf->SetFont('Arial', '', 8);
    
        $pdf->setXY(45,25);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente']),1,1,'L', false);
        
        $pdf->setXY(45,32);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_repartidor'] . ' ' . $row_orden[0]['apellido_repartidor']),1,1,'L', false);
        
        $pdf->setXY(45,39);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['nombre_metodo_pago'],1,1,'L', false);
        
        $pdf->setXY(45,50);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_recibe_orden_punto_a_punto']),1,1,'L', false);
        
        $pdf->setXY(45,57);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['telefono_orden_punto_a_punto'],1,1,'L', false);
        
        $pdf->setXY(45,64);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['tipo_orden']),1,1,'L', false);
        
        $pdf->setXY(31,75);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(72, 7, utf8_decode($row_orden[0]['nombre_origen_orden']),1,1,'L', false);
        
        $pdf->setXY(131,75);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(74, 7, utf8_decode($row_orden[0]['nombre_estado_orden']),1,1,'L', false);

    // DIRECCIONES

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0,0,0);
        
        $pdf->setXY(5,85);
        $pdf->Cell(200, 4, utf8_decode("Dirección del remitente:"),0,1,'L', false);

        $pdf->SetFont('Arial', '', 10);

        $pdf->setXY(5,90);
        $pdf->MultiCell(200, 4, utf8_decode($row_orden[0]['direccion_envio_orden_punto_a_punto']),0,'L', false);

        $coor_y=$pdf->GetY()+5;

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setXY(5,$coor_y);
        $pdf->Cell(200, 4, utf8_decode("Dirección del detinatario:"),0,1,'L', false);

        $pdf->SetFont('Arial', '', 10);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->MultiCell(200, 4, utf8_decode($row_orden[0]['direccion_entrega_orden_punto_a_punto']),0,'L', false);


// TABLA ORDENES PRODUCTOS

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetFillColor(10,54,157);
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,$coor_y+=10);
        $pdf->Cell(175, 7, "Producto",1,1,'L', true);
        $pdf->setXY(180,$coor_y);
        $pdf->Cell(25, 7, "Precio",1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 8);
        
        if($total_ordenes_productos>0){
            $subtotal=0;
            foreach($row_ordenes_productos as $key => $dato){
                
                $pdf->setX(5);
                $pdf->SetWidths(array(175,25));
                $pdf->Row(
                    array(
                        utf8_decode($dato['nombre_producto_punto_a_punto']),
                        $dato['simbolo_tipo_cambio'] . $dato['precio_producto_punto_a_punto'],
                    ),
                    4,
                    array('L','C'),
                    false
                );
            }
        }
        else{
            $pdf->setXY(5,95);
            $pdf->Cell(200, 7, "No se encontraron resultados",1,1,'L', false);
        }

    // PIE DE PÁGINA
        $coor_y=$pdf->GetY()+5;
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->Cell(200, 5, 'Total a pagar: '.$row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['total_orden_punto_a_punto'],0,0,'R', false);

$pdf->Output("Detalles_orden.pdf", "I");