<?php
    require_once('../includes/fpdf/tcpdf.php');
    $codigo = $_GET[c];
	$aprob="____";
	$mencion="____";
	$modifi="____";
	$reprob="____";
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'UTF-8', false);
	$pdf->setPrintHeader(false);
	// Add a page
//*********************************************************************************************************************************************************************//
	$pdf->AddPage();
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
		$pdf->MultiCell(190, 2, utf8_decode('EVALUACIÓN DE TRABAJO DE GRADO (JURADO)'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 8);
		$pdf->SetFillColor(217, 217, 217);		
		$pdf->MultiCell(10, 4, utf8_decode('             Nº'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(100, 4, utf8_decode('                                                                                                                                   ASPECTOS / CRITERIOS'), 1, 'C', 1, 0, '', '', true);
		$pdf->MultiCell(20, 4, utf8_decode('			Excelente 1%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 2, utf8_decode('Suficiente 0.75%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 2, utf8_decode('Regular 0.50%'), 1, 'C', 1, 0, '', '', true);		
		$pdf->MultiCell(20, 4, utf8_decode('			Deficiente 0% '), 1, 'C', 1, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFillColor(220, 216, 196);
        $tipos = paraTodos::arrayConsulta("distinct(crit_descripcion) as crit_tipo", "evaluacion, criteriot c, criterio_tipo ct", "ct.crit_codigo=c.crit_tipo and eval_cricodigo=crit_codigo and eval_tipo='TESIS' and eval_tescodigo=$codigo");
		foreach ($tipos as $tipo){
			$pdf->SetFont('times', 'B', 8);			
			$pdf->MultiCell(190, 4, utf8_decode($tipo[cri_tipo]), 1, 'C', 1, 0, '', '', true);
			$pdf->Ln();   
            $notas = paraTodos::arrayConsulta("*", "evaluacion, criteriot c, criterio_tipo ct", "ct.crit_codigo=c.crit_tipo and eval_cricodigo=crit_codigo and eval_tipo='TESIS' and eval_tescodigo=$codigo");
			foreach ($nota as $notas){	
				$pdf->SetFont('times', '', 8);							
				if ($tipo[cri_tipo]==$notas[crit_descripcion]){
					$pdf->MultiCell(10, 5, utf8_decode($notas[cri_orden]), 1, 'C', 0, 0, '', '', true);		
					$pdf->MultiCell(100, 5, utf8_decode($notas[cri_aspecto]), 1, 'C', 0, 0, '', '', true);
					$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);		
					$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);		
					$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);		
					$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					$pdf->Ln();				
				}					
			}			
			$pdf->SetFont('times', 'B', 10);			
			$pdf->MultiCell(110, 5, utf8_decode('Subtotales'), 1, 'C', 0, 0, '', '', true);			
			$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'R', 0, 0, '', '', true);		
			$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'R', 0, 0, '', '', true);		
			$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'R', 0, 0, '', '', true);		
			$pdf->MultiCell(20, 5, utf8_decode(''), 1, 'R', 0, 0, '', '', true);			
			$pdf->Ln();			
		}
	}
//*********************************************************************************************************************************************************************//
	$pdf->Output('example_001.pdf', 'I');
?>