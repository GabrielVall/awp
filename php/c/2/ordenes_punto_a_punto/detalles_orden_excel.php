<?php 
session_start();
include_once("../../../m/SQLConexion.php");
include_once('../../../../librerias/phpexcel/Classes/PHPExcel.php');
include_once('../../../../librerias/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_orden_punto_a_punto1('" . $_GET['id_orden'] . "');");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_historial_venta_punto_a_punto1('" . $_GET['id_orden'] . "');");
$total_ordenes_productos = count($row_ordenes_productos);

	// Establecer propiedades
	$objPHPExcel->getProperties()
	->setCreator("BorderBytes.MX")
	->setLastModifiedBy("BorderBytes.MX")
	->setTitle("Detalles de orden")
	->setSubject("Detalles de orden")
	->setDescription("Detalles de orden")
	->setKeywords("Excel Office 2007 openxml php")
	->setCategory("Reportes");

	// TITULO
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:B1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Orden #'.$_GET['id_orden'])->getStyle('A1')->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("H1:K1");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('H1')->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','Fecha de orden: '.$row_orden[0]['fecha_registro_orden_punto_a_punto'].'hrs.')->getStyle('H1')->applyFromArray(fontsize(10,true));

	// INFO ENCABEZADO DETALLE ORDEN
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:B3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Comprador:')->getStyle('A3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->applyFromArray(colorText("FFFFFF"));
		bordeado("A3:B3");
		cellColor("A3",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A4:B4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Repartidor:')->getStyle('A4')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->applyFromArray(colorText("FFFFFF"));
		bordeado("A4:B4");
		cellColor("A4",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A5:B5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Pagado por:')->getStyle('A5')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5')->applyFromArray(colorText("FFFFFF"));
		bordeado("A5:B5");
		cellColor("A5",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A7:B7");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', 'Recibe:')->getStyle('A7')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A7')->applyFromArray(colorText("FFFFFF"));
		bordeado("A7:B7");
		cellColor("A7",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A8:B8");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Tel??fono:')->getStyle('A8')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A8')->applyFromArray(colorText("FFFFFF"));
		bordeado("A8:B8");
		cellColor("A8",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A9:B9");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', 'Los productos:')->getStyle('A9')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A9')->applyFromArray(colorText("FFFFFF"));
		bordeado("A9:B9");
		cellColor("A9",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A11:B11");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'Generada por:')->getStyle('A11')->applyFromArray(fontsize(10,true));
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A11')->applyFromArray(colorText("FFFFFF"));
		bordeado("A11:B11");
		cellColor("A11",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("G11:H11");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G11', 'Estado de orden:')->getStyle('G11')->applyFromArray(fontsize(10,true));
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('G11')->applyFromArray(colorText("FFFFFF"));
		bordeado("G11:H11");
		cellColor("G11",'0A369D');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A13:C13");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A13', 'Direcci??n de remitente')->getStyle('A13')->applyFromArray(fontsize(10,true));

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A16:C16");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'Direcci??n de destinatario')->getStyle('A16')->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C3:K3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente'])->getStyle('C3')->applyFromArray(fontsize(10,false));
		bordeado("C3:K3");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C4:K4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $row_orden[0]['nombre_repartidor'] . ' ' . $row_orden[0]['apellido_repartidor'])->getStyle('C4')->applyFromArray(fontsize(10,false));
		bordeado("C4:K4");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C5:K5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', $row_orden[0]['nombre_metodo_pago'])->getStyle('C5')->applyFromArray(fontsize(10,false));
		bordeado("C5:K5");
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C7:K7");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', $row_orden[0]['nombre_recibe_orden_punto_a_punto'].' '.$row_orden[0]['apellido_repartidor'])->getStyle('C7')->applyFromArray(fontsize(10,false));
		bordeado("C7:K7");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C8:K8");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', $row_orden[0]['telefono_orden_punto_a_punto'])->getStyle('C8')->applyFromArray(fontsize(10,false));
		bordeado("C8:K8");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C9:K9");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', $row_orden[0]['tipo_orden'])->getStyle('C9')->applyFromArray(fontsize(10,false));
		bordeado("C9:K9");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C11:E11");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C11', $row_orden[0]['nombre_origen_orden'])->getStyle('C11')->applyFromArray(fontsize(8,false));
        bordeado("C11:E11");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("I11:K11");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I11', $row_orden[0]['nombre_estado_orden'])->getStyle('I11')->applyFromArray(fontsize(8,false));
        bordeado("I11:K11");

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A14:K14");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', $row_orden[0]['direccion_envio_orden_punto_a_punto'])->getStyle('A14')->applyFromArray(fontsize(8,false));

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A17:K17");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', $row_orden[0]['direccion_entrega_orden_punto_a_punto'])->getStyle('A17')->applyFromArray(fontsize(8,false));

	// THEAD DE TABLA
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A19:I19");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A19', 'Producto')->getStyle('A19')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A19')->applyFromArray(colorText("FFFFFF"));
		bordeado("A19:B19");
		cellColor("A19",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J19:K19");
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('J19'.':K19')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J19', 'Precio')->getStyle('J19')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J19')->applyFromArray(colorText("FFFFFF"));
		bordeado("J19:K19");
		cellColor("J19",'0A369D');
		
	// TBODY DE TABLA
		$row=20;
		$subtotal=0;
		if($total_ordenes_productos>0){
			foreach($row_ordenes_productos as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":I".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_producto_punto_a_punto'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":I".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("J".$row.":K".$row);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle("J".$row.":K".$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato['simbolo_tipo_cambio'] . $dato['precio_producto_punto_a_punto'])->getStyle('J'.$row)->applyFromArray(fontsize(8,false));
				bordeado("J".$row.":K".$row);
				
				$row++;
			}
		}
	// TOTALES
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=2).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total a pagar: '.$row_orden[0]['simbolo_tipo_cambio'] . $row_orden[0]['total_orden_punto_a_punto'])->getStyle('A'.$row)->applyFromArray(fontsize(10,true));
		
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Detalles de orden');

	// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
	$objPHPExcel->setActiveSheetIndex(0);

	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Reporte/Detalles_orden.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// 	$objWriter->save('php://output');
    $objWriter->save('../../../../documentos/reportes/detalles_orden_punto_a_punto.xlsx');
	exit;
// FUNCIONES

	// IMAGENES
		function setimage($url_image, $position){
			global $objPHPExcel;
			global $objDrawing;
			$gdImage = @imagecreatefromjpeg($url_image);

			if(!$gdImage){
				$gdImage = imagecreatefrompng($url_image);
			}
			$objDrawing->setName('Sample image');
			$objDrawing->setDescription('Sample image');
			$objDrawing->setImageResource($gdImage);
			$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
			$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
			$objDrawing->setHeight(150);
			$objDrawing->setCoordinates($position);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}

	// TAMA??O DE FUENTE
		function fontsize($size,$bold){
			return array(
					'font'  => array(
						'bold'  => $bold,
						'size'  => $size,
					));
		}

	// COLORES
		// COLOR DE CELDA
			function cellColor($cells,$color){
				global $objPHPExcel;

				$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'rgb' => $color
					)
				));
			}
		// COLOR DE TEXTO
			function colorText($color){
				return array(
					'font'  => array(
						'color' => array('rgb' => $color),
					));
			}
	// BORDER
		function bordeado($celda){
			global $objPHPExcel;
				$border_style= array('borders' => array('left' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style2= array('borders' => array('right' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style3= array('borders' => array('top' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$border_style4= array('borders' => array('bottom' => array('style' => 
				PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),)));
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style2);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style3);
				$objPHPExcel->getActiveSheet()->getStyle($celda)->applyFromArray($border_style4);
		}
	// ALINEACI??N DE TEXTO
		function texto_centrado(){
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', '')->getStyle('A4')->applyFromArray(texto_centrado());
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
			);
		}
		function texto_derecha(){
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
				)
			);
		}
		function texto_izquierda(){
			return array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
				)
			);
		}