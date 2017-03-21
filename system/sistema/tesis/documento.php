<?php
    require_once('../includes/fpdf/tcpdf.php');
    $codigo = $_GET[c];
	$aprob="____";
	$mencion="____";
	$modifi="____";
	$reprob="____";
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
	$pdf->setPrintHeader(false);
    $pdf->AddPage();
	$pdf->SetFont('Arial','B',10);
	$pdf->Image($absolute_uri.'assets/images/unellez.jpg', 15, 5, 25, 0, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);
    $gen = paraTodos::arrayConsulta("*", "tesis", "tes_codigo=$codigo");
	foreach($gen as $gens){
		$pdf->SetFont('times', 'B', 8);
		$pdf->MultiCell(30, 5, '', 0, 'C', 0, 0, '', '', true);		
		$pdf->MultiCell(40, 5, 'Universidad Nacional Experimental de los Llanos Occidentales "Ezequiel Zamora".', 0, 'C', 0, 0, '', '', true);		
		$pdf->MultiCell(120, 5, utf8_decode('Vicerrectordo de Planificación y Desarrollo Social.                  '), 0, 'R', 0, 0, '', '', true);			
		$pdf->Ln();
		$pdf->MultiCell(190, 2, utf8_decode('PROGRAMA: INGENIERÍA, ARQUITECTURA Y TECNOLOGÍA'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(190, 2, utf8_decode('SUBPROGRAMA: INGENIERÍA EN INFORMATICA							'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(190, 2, utf8_decode('P-TEG-01                            									'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(190, 2, utf8_decode('EVALUACIÓN DEL DOCUMENTO (JURADO)'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();        
		$pdf->Ln();
		$pdf->SetFont('times', '', 10);		
		$pdf->MultiCell(190, 6, utf8_decode('Trabajo de Grado Titulado: '.$gens[tes_titulo]), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(190, 6, utf8_decode('Bachiller(es) y Nr(s) de Cédula(s) '), 1, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 8);
		$pdf->SetFillColor(217, 217, 217);
		$pdf->MultiCell(40, 9, utf8_decode('ASPECTOS'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(70, 9, utf8_decode('INDICADORES'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(20, 9, utf8_decode('1%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 9, utf8_decode('0.5%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 9, utf8_decode('0.25%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 9, utf8_decode('0% '), 1, 'C', 1, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFillColor(220, 216, 196);
        $tipos = paraTodos::arrayConsulta("distinct(crit_descripcion) as crid_tipo", "evaluacion, criteriod c, criterio_tipo ct", "c.crid_tipo=ct.crit_codigo and eval_cricodigo=crid_codigo and eval_tipo='DOCUMENTO' and eval_tescodigo=$codigo");
		foreach ($tipos as $tipo){
			$pdf->SetFont('times', 'B', 8);			
			$pdf->MultiCell(190, 4, utf8_decode($tipo[crid_tipo]), 1, 'C', 1, 0, '', '', true);
			$pdf->Ln();
            $nota = paraTodos::arrayConsulta("*", "evaluacion e, criteriod c, criterio_tipo ct, tools_nota t", "t.tnota_codigo=e.eval_notaj and c.crid_tipo=ct.crit_codigo and eval_tipo='DOCUMENTO' and eval_tescodigo=$codigo");
			foreach ($nota as $notas){	
				$pdf->SetFont('times', '', 8);							
				if ($tipo[crid_tipo]==$notas[crit_descripcion]){
					$pdf->MultiCell(40, 9, utf8_decode($notas[crid_aspecto]), 1, 'C', 0, 0, '', '', true);
					$pdf->MultiCell(70, 9, utf8_decode($notas[crid_indicador]), 1, 'C', 0, 0, '', '', true);
                    if ($notas[tnota_descripcion] == 'EXCELENTE') {
					   $pdf->MultiCell(20, 9, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'SUFICIENTE') {
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'REGULAR') {
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'DEFICIENTE') {
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);                       
                    }
                    if ($notas[tnota_descripcion] == '') {
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);                       
                    }
					$pdf->Ln();				
				}					
			}	
		}
        $pdf->Ln();
		$pdf->SetFont('times', 'B', 10);		
		$pdf->MultiCell(40, 15, utf8_decode('OBSERVACIONES ADICIONALES'), 1, 'C', 0, 0, '', '', true);		
		$pdf->MultiCell(110, 15, utf8_decode(''), 1, 'L', 0, 0, '', '', true);		
        $pdf->SetFont('times', '', 8);		
		$pdf->MultiCell(40, 5, utf8_decode('___Aceptar Sin Cambios'), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();		
		$pdf->MultiCell(150, 5, utf8_decode(''), 0, 'L', 0, 0, '', '', true);		
		$pdf->MultiCell(40, 5, utf8_decode('___Aceptar Con Cambios'), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();		
		$pdf->MultiCell(150, 5, utf8_decode(''), 0, 'L', 0, 0, '', '', true);		
		$pdf->MultiCell(40, 5, utf8_decode('___Rechazar'), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Jurado Principal'), 0, 'L', 0, 0, '', '', true);									
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Prof.(a).(Firma)_________________________________'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Nombre y Apellido:'), 0, 'L', 0, 0, '', '', true);									
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Cédula:'), 0, 'L', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('(Firma y Sello del PIAT)'), 0, 'L', 0, 0, '', '', true);        
	}
	$pdf->Output('example_001.pdf', 'I');
?>
