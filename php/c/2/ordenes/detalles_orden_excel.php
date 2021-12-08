<?php 
session_start();
include_once("../../../m/SQLConexion.php");
include_once('../../../../librerias/phpexcel/Classes/PHPExcel.php');
include_once('../../../../librerias/phpexcel/Classes/PHPExcel/Writer/Excel2007.php');

$objPHPExcel = new PHPExcel();
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$sql = new SQLConexion();

$row_orden = $sql->obtenerResultado("CALL sp_select_ordenes2('" . $_GET['id_orden'] . "');");

$simbolo = $sql->obtenerResultado("SELECT simbolo_tipo_cambio FROM empresa_reparto INNER JOIN tipos_cambios USING(id_tipo_cambio) WHERE id_empresa_reparto=1");

$row_ordenes_productos = $sql->obtenerResultado("CALL sp_select_ordenes_productos1('" . $_GET['id_orden'] . "');");
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1','Fecha de orden: '.$row_orden[0]['fecha_registro_orden'].'hrs.')->getStyle('H1')->applyFromArray(fontsize(10,true));

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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Tipo de orden:')->getStyle('A5')->applyFromArray(fontsize(10,true));
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

		if($row_orden[0]['id_tipo_orden']==1){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A11:B11");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11', 'Dirección de entrega')->getStyle('A11')->applyFromArray(fontsize(10,true));
		}
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C3:H3");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $row_orden[0]['nombre_cliente'].' '.$row_orden[0]['apellido_cliente'])->getStyle('C3')->applyFromArray(fontsize(10,false));
		bordeado("C3:H3");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C4:H4");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $row_orden[0]['nombre_sucursal'])->getStyle('C4')->applyFromArray(fontsize(10,false));
		bordeado("C4:H4");

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("C5:H5");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', $row_orden[0]['nombre_tipo_orden'])->getStyle('C5')->applyFromArray(fontsize(10,false));
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

		if($row_orden[0]['id_tipo_orden']==1){
			$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A12:K12");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12', $row_orden[0]['direccion_orden'])->getStyle('A12')->applyFromArray(fontsize(8,false));
		}

	// THEAD DE TABLA
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A15:D15");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', 'Producto')->getStyle('A15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A15')->applyFromArray(colorText("FFFFFF"));
		bordeado("A15:B15");
		cellColor("A15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E15:H15");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E15', 'Observaciones')->getStyle('E15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('E15')->applyFromArray(colorText("FFFFFF"));
		bordeado("E15:H15");
		cellColor("E15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('I15:K15')->applyFromArray(texto_centrado());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I15', 'Precio')->getStyle('I15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('I15')->applyFromArray(colorText("FFFFFF"));
		bordeado("I15");
		cellColor("I15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J15', 'Cant.')->getStyle('J15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('J15')->applyFromArray(colorText("FFFFFF"));
		bordeado("J15");
		cellColor("J15",'0A369D');
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K15', 'Importe')->getStyle('K15')->applyFromArray(fontsize(10,true));
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('K15')->applyFromArray(colorText("FFFFFF"));
		bordeado("K15");
		cellColor("K15",'0A369D');

	// TBODY DE TABLA
		$row=16;
		$subtotal=0;
		if($total_ordenes_productos>0){
			foreach($row_ordenes_productos as $dato){
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".$row.":D".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, $dato['nombre_producto'])->getStyle('A'.$row)->applyFromArray(fontsize(8,false));
				bordeado("A".$row.":D".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells("E".$row.":H".$row);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$row, $dato['comentarios_orden_producto'])->getStyle('E'.$row)->applyFromArray(fontsize(8,false));
				bordeado("E".$row.":H".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->getStyle('I'.$row.':K'.$row)->applyFromArray(texto_centrado());
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, $simbolo[0]['simbolo_tipo_cambio'].$dato['precio_orden_producto'])->getStyle('I'.$row)->applyFromArray(fontsize(8,false));
				bordeado("I".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato['cantidad_orden_producto'])->getStyle('J'.$row)->applyFromArray(fontsize(8,false));
				bordeado("J".$row);
				
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $simbolo[0]['simbolo_tipo_cambio'].$dato['importe_orden_producto'])->getStyle('K'.$row)->applyFromArray(fontsize(8,false));
				bordeado("K".$row);

				$subtotal+=$dato['importe_orden_producto'];

				$row_ordenes_ingredientes = $sql->obtenerResultado("CALL sp_select_ordenes_ingredientes1('" . $dato['id_orden_producto'] . "');");
                $total_ordenes_ingredientes = count($row_ordenes_ingredientes);

				if($total_ordenes_ingredientes>0){
					
					$row++;
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B".$row.":H".$row);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, 'Ingredientes')->getStyle('B'.$row)->applyFromArray(fontsize(10,true));
					bordeado("B".$row.":H".$row);
					cellColor("B".$row,'D9D9D9');

					$objPHPExcel->setActiveSheetIndex(0)->getStyle('I'.$row.':K'.$row)->applyFromArray(texto_centrado());
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, 'Precio')->getStyle('I'.$row)->applyFromArray(fontsize(10,true));
					bordeado("I".$row);
					cellColor("I".$row,'D9D9D9');
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, 'Cant.')->getStyle('J'.$row)->applyFromArray(fontsize(10,true));
					bordeado("J".$row);
					cellColor("J".$row,'D9D9D9');
					
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, 'Importe')->getStyle('K'.$row)->applyFromArray(fontsize(10,true));
					bordeado("K".$row);
					cellColor("K".$row,'D9D9D9');

					foreach ($row_ordenes_ingredientes as $dato_ing){
						
						$row++;
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells("B".$row.":H".$row);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$row, $dato_ing['nombre_ingrediente_extra'])->getStyle('B'.$row)->applyFromArray(fontsize(8,true));
						bordeado("B".$row.":H".$row);
						cellColor("B".$row,'EAFAF1');

						$objPHPExcel->setActiveSheetIndex(0)->getStyle('I'.$row.':K'.$row)->applyFromArray(texto_centrado());
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$row, $dato_ing['simbolo_tipo_cambio'].$dato_ing['precio_orden_ingrediente'])->getStyle('I'.$row)->applyFromArray(fontsize(8,true));
						bordeado("I".$row);
						cellColor("I".$row,'EAFAF1');
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$row, $dato_ing['cantidad_orden_ingrediente'])->getStyle('J'.$row)->applyFromArray(fontsize(8,true));
						bordeado("J".$row);
						cellColor("J".$row,'EAFAF1');
						
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$row, $dato_ing['simbolo_tipo_cambio'].$dato_ing['importe_orden_ingrediente'])->getStyle('K'.$row)->applyFromArray(fontsize(8,true));
						bordeado("K".$row);
						cellColor("K".$row,'EAFAF1');

						$subtotal+=$dato_ing['importe_orden_ingrediente'];
					}

				}
				
				$row++;
			}
		}
	// TOTALES
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=2).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Subtotal: '.$simbolo[0]['simbolo_tipo_cambio'].number_format($subtotal,2,'.',','))->getStyle('A'.$row)->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=1).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Descuento: -'.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['descuento_cupon'])->getStyle('A'.$row)->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=1).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Costo de envío: '.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['costo_envio_orden'])->getStyle('A'.$row)->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=1).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Servicio de app: '.$simbolo[0]['simbolo_tipo_cambio'].$row_orden[0]['servicio_app'])->getStyle('A'.$row)->applyFromArray(fontsize(10,true));
		
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells("A".($row+=1).":K".$row);
		$objPHPExcel->setActiveSheetIndex(0)->getStyle('A'.$row.':K'.$row)->applyFromArray(texto_derecha());
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$row, 'Total a pagar: '.$simbolo[0]['simbolo_tipo_cambio'].number_format((str_replace(",", "", $row_orden[0]['servicio_app']) + str_replace(",", "", $row_orden[0]['costo_total_orden']) + str_replace(",", "", $row_orden[0]['costo_envio_orden'])),2,'.',','))->getStyle('A'.$row)->applyFromArray(fontsize(10,true));

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
    $objWriter->save('../../../../documentos/reportes/detalles_orden.xlsx');
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