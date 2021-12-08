<?php 
session_start();
include_once("../../../m/SQLConexion.php");
include_once('../../../../librerias/phpexcel/Classes/PHPExcel.php');
include_once('../../../../librerias/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes_express2('" . $_GET['id_orden'] . "');");

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','Fecha de orden: '.$row_orden[0]['fecha_registro_orden_express'].'hrs.')->getStyle('H1')->applyFromArray(fontsize(10,true));

	// INFO ENCABEZADO DETALLE ORDEN
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:B3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Comprador:')->getStyle('A3')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3')->applyFromArray(colorText("FFFFFF"));
		bordeado("A3:B3");
		cellColor("A3",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A4:B4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Sucursal:')->getStyle('A4')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A4')->applyFromArray(colorText("FFFFFF"));
		bordeado("A4:B4");
		cellColor("A4",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A5:B5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Generada por:')->getStyle('A5')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A5')->applyFromArray(colorText("FFFFFF"));
		bordeado("A5:B5");
		cellColor("A5",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A7:B7");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', 'Repartidor:')->getStyle('A7')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A7')->applyFromArray(colorText("FFFFFF"));
		bordeado("A7:B7");
		cellColor("A7",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A8:B8");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Pagado por:')->getStyle('A8')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A8')->applyFromArray(colorText("FFFFFF"));
		bordeado("A8:B8");
		cellColor("A8",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A9:B9");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', 'Estado de orden:')->getStyle('A9')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A9')->applyFromArray(colorText("FFFFFF"));
		bordeado("A9:B9");
		cellColor("A9",'0A369D');

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A11:B11");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'Dirección de entrega')->getStyle('A11')->applyFromArray(fontsize(10,true));
		
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A14:B14");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', 'Detalles')->getStyle('A14')->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C3:H3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente'])->getStyle('C3')->applyFromArray(fontsize(10,false));
		bordeado("C3:H3");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C4:H4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $row_orden[0]['nombre_sucursal_express'])->getStyle('C4')->applyFromArray(fontsize(10,false));
		bordeado("C4:H4");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C5:H5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', $row_orden[0]['nombre_origen_orden'])->getStyle('C5')->applyFromArray(fontsize(10,false));
		bordeado("C5:H5");
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C7:H7");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', $row_orden[0]['nombre_repartidor'].' '.$row_orden[0]['apellido_repartidor'])->getStyle('C7')->applyFromArray(fontsize(10,false));
		bordeado("C7:H7");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C8:H8");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', $row_orden[0]['nombre_metodo_pago'])->getStyle('C8')->applyFromArray(fontsize(10,false));
		bordeado("C8:H8");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C9:H9");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', $row_orden[0]['nombre_estado_orden'])->getStyle('C9')->applyFromArray(fontsize(10,false));
		bordeado("C9:H9");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A12:K12");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', $row_orden[0]['direccion_orden_express'])->getStyle('A12')->applyFromArray(fontsize(8,false));

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A15:K15");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', $row_orden[0]['observaciones_orden_express'])->getStyle('A15')->applyFromArray(fontsize(8,false));

	// TOTALES
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A17".":K17");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A17:K17')->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', 'Total de envío: '.$row_orden[0]['simbolo_tipo_cambio'].$row_orden[0]['costo_envio_orden_express'])->getStyle('A17')->applyFromArray(fontsize(10,true));
		
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A18".":K18");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A18:K18')->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A18', 'Total de la orden: '.$row_orden[0]['simbolo_tipo_cambio'].$row_orden[0]['total_orden_express'])->getStyle('A18')->applyFromArray(fontsize(10,true));
		
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A19".":K19");
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A19:K19')->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A19', 'Total a pagar: '.$row_orden[0]['simbolo_tipo_cambio'].number_format(($row_orden[0]['total_orden_express']+$row_orden[0]['costo_envio_orden_express']),2,'.',','))->getStyle('A19')->applyFromArray(fontsize(10,true));
		

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
    $objWriter->save('../../../../documentos/reportes/detalles_orden_express.xlsx');
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

	// TAMAÑO DE FUENTE
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
	// ALINEACIÓN DE TEXTO
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