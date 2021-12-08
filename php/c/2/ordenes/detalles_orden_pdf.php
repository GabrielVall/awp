<?php
session_start();
include_once('../../../../librerias/fpdf/mc_table.php');
include_once("../../../m/SQLConexion.php");
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes2('" . $_GET['id_orden'] . "');");

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_ordenes_productos1('" . $_GET['id_orden'] . "');");
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
    $pdf->Cell(100, 5, 'Fecha de orden: '.$row_orden[0]['fecha_registro_orden'].'hrs.',0,0,'R', false);

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
        $pdf->Cell(40, 7, "Tipo orden:",1,1,'L', true);
        
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
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_sucursal']),1,1,'L', false);
        
        $pdf->setXY(45,39);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['nombre_tipo_orden'],1,1,'L', false);
        
        $pdf->setXY(45,50);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_repartidor'].' '.$row_orden[0]['apellido_repartidor']),1,1,'L', false);
        
        $pdf->setXY(45,57);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, utf8_decode($row_orden[0]['nombre_metodo_pago']),1,1,'L', false);
        
        $pdf->setXY(45,64);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(75, 7, $row_orden[0]['nombre_estado_orden'],1,1,'L', false);

    // DIRECCION
    if($row_orden[0]['id_tipo_orden']==1){
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(0,0,0);
        
        $pdf->setXY(5,75);
        $pdf->Cell(200, 7, utf8_decode("Dirección de entrega:"),0,1,'L', false);

        $pdf->SetFont('Arial', '', 10);

        $pdf->setXY(5,80);
        $pdf->MultiCell(200, 4, utf8_decode($row_orden[0]['direccion_orden']),0,'L', false);
    }

// TABLA ORDENES PRODUCTOS

    $coor_y=$pdf->GetY()+5;

    $pdf->SetFont('Arial', 'B', 10);
    // ENCABEZADO
        $pdf->SetFillColor(10,54,157);
        $pdf->SetTextColor(255,255,255);
        $pdf->setXY(5,$coor_y);
        $pdf->Cell(75, 7, "Productos",1,1,'L', true);
        $pdf->setXY(80,$coor_y);
        $pdf->Cell(75, 7, "Observaciones",1,1,'L', true);
        $pdf->setXY(155,$coor_y);
        $pdf->Cell(25, 7, "Precio",1,1,'C', true);
        $pdf->setXY(180,$coor_y);
        $pdf->Cell(25, 7, "Subtotal",1,1,'C', true);

    // DATOS
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', '', 8);
        
        $subtotal=0;
        if($total_ordenes_productos>0){
            foreach($row_ordenes_productos as $dato){
                
                $pdf->setX(5);
                $pdf->SetWidths(array(75,75,25,25));
                $pdf->Row(
                    array(
                        utf8_decode($dato['nombre_producto']),
                        utf8_decode($dato['comentarios_orden_producto']),
                        $simbolo[0]['simbolo_tipo_cambio'].$dato['precio_orden_producto'].' ('.$dato['cantidad_orden_producto'].')',
                        $simbolo[0]['simbolo_tipo_cambio'].$dato['importe_orden_producto']
                    ),
                    4,
                    array('L','L','C','C'),
                    false
                );
                $subtotal+=$dato['importe_orden_producto'];

                $row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $dato['id_orden_producto'] . "');");
                $total_ordenes_ingredientes = count($row_ordenes_ingredientes);

                if($total_ordenes_ingredientes>0){
                    $pdf->SetFillColor(217,217,217);
                    $pdf->SetFont('Arial', 'B', 8);
                    
                    $pdf->setX(10);
                    $pdf->SetWidths(array(145,25,25));
                    $pdf->Row(
                        array(
                            'Ingredientes',
                            'Precio',
                            'Subtotal',
                        ),
                        4,
                        array('L','C','C'),
                        true
                    );
                    $pdf->SetFont('Arial', '', 8);
                    foreach ($row_ordenes_ingredientes as $dato_ing){
                        $pdf->SetFillColor(234,250,241);
                        $pdf->setX(10);
                        $pdf->SetWidths(array(145,25,25));
                        $pdf->Row(
                            array(
                                $dato_ing['nombre_ingrediente_extra'],
                                $dato_ing['simbolo_tipo_cambio'].$dato_ing['precio_orden_ingrediente'].' ('.$dato_ing['cantidad_orden_ingrediente'].')',
                                $dato_ing['simbolo_tipo_cambio'].$dato_ing['importe_orden_ingrediente'],
                            ),
                            4,
                            array('L','C','C'),
                            true
                        );

                        $subtotal+=$dato_ing['importe_orden_ingrediente'];
                    }
                    
                }
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
        $pdf->Cell(200, 5, 'Subtotal: '.$simbolo[0]['simbolo_tipo_cambio'].number_format($subtotal,2,'.',','),0,0,'R', false);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->Cell(200, 5, 'Descuento: -'.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['descuento_cupon'],0,0,'R', false);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->Cell(200, 5, utf8_decode('Costo de envío: ').$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['costo_envio_orden'],0,0,'R', false);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->Cell(200, 5, 'Servicio de app: '.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['servicio_app'],0,0,'R', false);
        $pdf->setXY(5,$coor_y+=5);
        $pdf->Cell(200, 5, 'Total a pagar: '.$simbolo[0]['simbolo_tipo_cambio'].number_format((str_replace(",", "", $row_orden[0]['servicio_app']) + str_replace(",", "", $row_orden[0]['costo_total_orden']) + str_replace(",", "", $row_orden[0]['costo_envio_orden'])),2,'.',','),0,0,'R', false);

$pdf->Output("Detalles_orden.pdf", "I");