<?php
    require_once('../includes/fpdf/tcpdf.php');
    $codigo = $_GET[c];
	$aprob="____";
	$mencion="____";
	$modifi="____";
	$reprob="____";
    $exc ="";
    $suf ="";
    $reg ="";
    $def ="";
    $total ="";
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
		$pdf->MultiCell(190, 2, utf8_decode('EVALUACIÓN DE ASPECTOS'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 8);
		$pdf->SetFillColor(217, 217, 217);	
        $numero = paraTodos::arrayConsulta("count(cri_aspecto) as cri_aspecto", "evaluacion, criterio", "eval_cricodigo=cri_codigo and eval_tipo='ASPECTO' and eval_tescodigo=$codigo");
		foreach ($numero as $numeros){ 
            $exc = 35/$numeros[cri_aspecto];
            $suf = 26.25/$numeros[cri_aspecto];
            $reg = 17.5/$numeros[cri_aspecto];
            $pdf->MultiCell(10, 8, utf8_decode('Nº'), 1, 'C', 1, 0, '', '', true);		
            $pdf->MultiCell(100, 8, utf8_decode('ASPECTOS / VALORACIÓN'), 1, 'C', 1, 0, '', '', true);
            $pdf->MultiCell(20, 8, utf8_decode('Excelente '.$exc.'%'), 1, 'C', 1, 0, '', '', true);		
            $pdf->MultiCell(20, 8, utf8_decode('Suficiente '.$suf.'%'), 1, 'C', 1, 0, '', '', true);		
            $pdf->MultiCell(20, 8, utf8_decode('Regular '.$reg.'%'), 1, 'C', 1, 0, '', '', true);		
        }
		$pdf->MultiCell(20, 8, utf8_decode('Deficiente 0% '), 1, 'C', 1, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFillColor(220, 216, 196);
        $tipos = paraTodos::arrayConsulta("distinct(ct.crit_descripcion) as cri_tipo", "evaluacion, criterio c, criterio_tipo ct", "c.cri_tipo=ct.crit_codigo and eval_cricodigo=cri_codigo and eval_tipo='ASPECTO' and eval_tescodigo=$codigo");
		foreach ($tipos as $tipo){
			$pdf->SetFont('times', 'B', 8);			
			$pdf->MultiCell(190, 4, utf8_decode($tipo[cri_tipo]), 1, 'C', 1, 0, '', '', true);
			$pdf->Ln();
            $nota = paraTodos::arrayConsulta("*", "evaluacion e, criterio c, criterio_tipo ct, tools_nota t", "t.tnota_codigo=e.eval_notaj and c.cri_tipo=ct.crit_codigo and eval_cricodigo=cri_codigo and eval_tipo='ASPECTO' and eval_tescodigo=$codigo and eval_notat is null");
			foreach ($nota as $notas){
				$pdf->SetFont('times', '', 8);							
				if ($tipo[cri_tipo]==$notas[crit_descripcion]){
					$pdf->MultiCell(10, 5, utf8_decode($notas[cri_orden]), 1, 'C', 0, 0, '', '', true);		
					$pdf->MultiCell(100, 5, utf8_decode($notas[cri_aspecto]), 1, 'C', 0, 0, '', '', true);
                    if ($notas[tnota_descripcion] == 'EXCELENTE') {
					   $pdf->MultiCell(20, 5, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'SUFICIENTE') {
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'REGULAR') {
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
                    }
                    if ($notas[tnota_descripcion] == 'DEFICIENTE') {
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode('x'), 1, 'C', 0, 0, '', '', true);                       
                    }
                    if ($notas[tnota_descripcion] == '') {
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
					   $pdf->MultiCell(20, 5, utf8_decode(''), 1, 'C', 0, 0, '', '', true);                       
                    }
				}
				$pdf->Ln();
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
		$pdf->MultiCell(190, 5, utf8_decode('P-TEG-02                            									'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(190, 5, utf8_decode('ACTA DE EVALUACION DEL TRABAJO DE GRADO'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', '', 12);		
		$pdf->MultiCell(20, 10, utf8_decode(''), 0, 'J', 0, 0, '', '', true);		
		$pdf->MultiCell(160, 10, utf8_decode('Quienes suscribimos, Miembros del Jurado Evaluador Designado por Comisión Asesora del Programa de Ingeniería, Arquitectura y Tecnología de la Universidad Nacional Experimental de los Llanos Occidentales "Ezequiel Zamora", para calificar el trabajo de Grado Titulado:'), 0, 'J', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->Ln(2);
		$pdf->MultiCell(20, 6, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(160, 6, utf8_decode($gens[tes_titulo]), 0, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);					
		$pdf->MultiCell(160, 4, utf8_decode('Presentado por:'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
        $tesista = paraTodos::arrayConsulta("*", "tesis, tesis_alumno, persona", "tes_codigo=tesal_tescodigo and tesal_cedula=per_cedula and tes_codigo=$codigo");
		foreach($tesista as $tesistas){
			$pdf->SetFont('times', 'B', 12);			
			$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);			
			$pdf->MultiCell(160, 4, utf8_decode('Bachiller :'), 0, 'L', 0, 0, '', '', true);				
			$pdf->Ln();
			$pdf->SetFont('times', '', 10);						
			$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);			
			$pdf->MultiCell(100, 4, utf8_decode($tesistas[per_apellidos]." ".$tesistas[per_nombres]), 0, 'L', 0, 0, '', '', true);							
			$pdf->SetFont('times', 'B', 10);			
			$pdf->MultiCell(30, 4, utf8_decode('Cédula :'), 0, 'L', 0, 0, '', '', true);							
			$pdf->SetFont('times', '', 10);			
			$pdf->MultiCell(30, 4, utf8_decode($tesistas[per_cedula]), 0, 'L', 0, 0, '', '', true);							
			$pdf->Ln();
		}
		$pdf->Ln();		
		$pdf->SetFont('times', '', 12);		
		$pdf->MultiCell(20, 10, utf8_decode(''), 0, 'J', 0, 0, '', '', true);		
		$pdf->MultiCell(160, 10, utf8_decode('Como requisito para optar al grado académico de: INGENIERO(A) EN INFORMÁTICA, hacemos constar por medio de la presente acta que con fecha ( ) de ( ) de ( ), en Período Académico ('.$gens[tes_periodo].'), nos reunimos para oír la exposición pública de dicha Tesis. El(Los) Bachiller(es) presentó (aron) ante el Jurado Evaluador y se respondió a las preguntas formuladas, después de lo cual, el Jurado Evaluador decidió:'), 0, 'J', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->SetFont('times', 'B', 12);
		$pdf->MultiCell(20, 9, utf8_decode(''), 0, 'J', 0, 0, '', '', true);					
		$pdf->MultiCell(60, 9, utf8_decode('ASPECTOS'), 1, 'C', 1, 0, '', '', true);				        
        $pdf->MultiCell(50, 9, utf8_decode('JURADO(1) 35%'), 1, 'C', 1, 0, '', '', true);				
        $pdf->MultiCell(50, 9, utf8_decode('JURADO(2) 35%'), 1, 'C', 1, 0, '', '', true);     
		$pdf->Ln();
		$pdf->SetFont('times', '', 10);	
		$pdf->SetTextColor(0, 0, 0);	
        $tiposeval = paraTodos::arrayConsulta("distinct(eval_tipo) as eval_tipo","evaluacion", "eval_tescodigo=$codigo");
		foreach ($tiposeval as $tipoeval){
			$pdf->MultiCell(20, 9, utf8_decode(''), 0, 'J', 0, 0, '', '', true);						
			$pdf->MultiCell(60, 9, utf8_decode($tipoeval[eval_tipo]), 1, 'C', 0, 0, '', '', true);
            $jurados = paraTodos::arrayConsulta("DISTINCT (eval_cedulaj) as eval_cedulaj, per_nombres, per_apellidos", "evaluacion, persona", "eval_cedulaj=per_cedula and eval_tescodigo=$codigo");
            foreach ($jurados as $jurado){
                $total=0;
                $subtotal= paraTodos::arrayConsulta("COUNT( eval_notaj ) as cant , eval_notaj, eval_cedulaj, eval_tipo, t.tnota_descripcion","evaluacion e, tools_nota t", "e.eval_notaj=t.tnota_codigo and e.eval_tescodigo=$codigo order by eval_cedulaj, eval_tipo,eval_notaj");
                foreach ($subtotal as $sub){                    
                    if ($jurado[eval_cedulaj]==$sub[eval_cedulaj]){
                        if ($tipoeval[eval_tipo]==$sub[eval_tipo]){
                            if ($sub[tnota_descripcion]=='EXCELENTE'){
                                $total=$total+$sub[cant]*$exc;
                            }
                            if ($sub[tnota_descripcion]=='SUFICIENTE'){
                                $total=$total+$sub[cant]*$suf;
                            }
                            if ($sub[tnota_descripcion]=='REGULAR'){
                                $total=$total+$sub[cant]*$reg;
                            }
                        }
                    }
                }
                $pdf->MultiCell(50, 9, utf8_decode($total), 1, 'C', 0, 0, '', '', true);                
            }
            $pdf->Ln();            
        }      
		$pdf->SetFillColor(162, 162, 162);
		$pdf->MultiCell(20, 9, utf8_decode(''), 0, 'J', 0, 0, '', '', true);					
		$pdf->MultiCell(60, 9, utf8_decode('Nota del Tutor (3), según Fase de Ejecución del Proyecto (30%):'), 1, 'L', 0, 0, '', '', true);				
		$pdf->MultiCell(33, 9, utf8_decode(''), 1, 'L', 1, 0, '', '', true);
		$pdf->MultiCell(34, 9, utf8_decode(''), 1, 'L', 0, 0, '', '', true);		
		$pdf->MultiCell(33, 9, utf8_decode(''), 1, 'L', 1, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(20, 9, utf8_decode(''), 0, 'J', 0, 0, '', '', true);					
		$pdf->MultiCell(60, 9, utf8_decode('Nota Final del Subproyecto Trabajo de Grado'), 1, 'L', 0, 0, '', '', true);
        $total=0;  
        $subtotal= paraTodos::arrayConsulta("COUNT( eval_notaj ) as cant , eval_notaj, eval_cedulaj, eval_tipo, t.tnota_descripcion","evaluacion e, tools_nota t", "e.eval_notaj=t.tnota_codigo and e.eval_tescodigo=$codigo order by eval_cedulaj, eval_tipo,eval_notaj");
        foreach ($subtotal as $sub){
            if ($sub[tnota_descripcion]=='EXCELENTE'){
                $total=$total+$sub[cant]*$exc;
            }
            if ($sub[tnota_descripcion]=='SUFICIENTE'){
                $total=$total+$sub[cant]*$suf;
            }
            if ($sub[tnota_descripcion]=='REGULAR'){
                $total=$total+$sub[cant]*$reg;
            }
        }
        $totaleu=($total/25)+1;
		$pdf->MultiCell(100, 9, utf8_decode('Total Porcentajes                                                  Nota Escala Unellez (           '.$total.'%       )/25+1                  =                          '.$totaleu), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(20, 9, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(160, 9, utf8_decode('              Decision'.$aprob."Aprobado ".$mencion." con Mención ".$modifi." con Modificación ".$reprob." Reprobado"), 1, 'L', 0, 0, '', '', true);				
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Jurado Principal (1)'), 0, 'L', 0, 0, '', '', true);									
		$pdf->MultiCell(85, 4, utf8_decode('Jurado Principal (2)'), 0, 'L', 0, 0, '', '', true);									
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Prof.(a).(Firma)_________________________________'), 0, 'L', 0, 0, '', '', true);									
		$pdf->MultiCell(85, 4, utf8_decode('Prof.(a).(Firma)_________________________________'), 0, 'L', 0, 0, '', '', true);									
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Nombre y Apellido:'), 0, 'L', 0, 0, '', '', true);									
		$pdf->MultiCell(85, 4, utf8_decode('Nombre y Apellido:'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Cédula:'), 0, 'L', 0, 0, '', '', true);									
		$pdf->MultiCell(85, 4, utf8_decode('Cédula:'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Tutor(3)'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Prof.(a).(Firma)_________________________________'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('Nombre y Apellido'), 0, 'L', 0, 0, '', '', true);
		$pdf->MultiCell(85, 4, utf8_decode('(Firma y Sello del PIAT)'), 0, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Cédula:'), 0, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->MultiCell(20, 4, utf8_decode(''), 0, 'J', 0, 0, '', '', true);
		$pdf->MultiCell(170, 4, utf8_decode('Observaciones:'), 0, 'L', 0, 0, '', '', true);
	}
//*********************************************************************************************************************************************************************//
	/*$pdf->AddPage();
	$pdf->Image(base_url().'assets/img/unellez.jpg', 15, 5, 25, 0, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);
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
		$pdf->MultiCell(190, 5, utf8_decode('P-TEG-03                            									'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(190, 5, utf8_decode('PLANILLA PARA LA REVISION DEL DOCUMENTO (JURADO)'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', '', 10);		
		$pdf->MultiCell(190, 6, utf8_decode('Trabajo de Grado Titulado: '.$gens->tes_titulo), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(190, 6, utf8_decode('Bachiller(es) y Nr(s) de Cédula(s) '), 1, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 8);		
		$pdf->MultiCell(10, 5, utf8_decode('Nº'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(50, 5, utf8_decode('ASPECTOS'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(10, 5, utf8_decode('S'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(10, 5, utf8_decode('I'), 1, 'C', 0, 0, '', '', true);
		$pdf->SetFillColor(0, 0, 0);		
		$pdf->SetTextColor(255, 255, 255);		
		$pdf->MultiCell(110, 5, utf8_decode('OBSERVACIONES'), 1, 'C', 1, 0, '', '', true);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Ln();		
		foreach ($nota as $notas){	
			$pdf->SetFont('times', '', 8);
			if ($notas->cri_tipo=='DOCUMENTO'){
				$pdf->MultiCell(10, 9, utf8_decode($notas->cri_orden), 1, 'C', 0, 0, '', '', true);		
				$pdf->MultiCell(50, 9, utf8_decode($notas->cri_aspecto), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(10, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(10, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(110, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);				
				$pdf->Ln();				
			}					
		}
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(190, 6, utf8_decode('Leyendas: (S)ufientes / (I)nsuficientes'), 0, 'L', 0, 0, '', '', true);
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
	}*/
//*********************************************************************************************************************************************************************//
	/*$pdf->AddPage();
	$pdf->Image(base_url().'assets/img/unellez.jpg', 15, 5, 25, 0, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);
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
		$pdf->MultiCell(190, 5, utf8_decode('P-TEG-04                            									'), 0, 'R', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(190, 5, utf8_decode('PLANILLA PARA LA REVISION DEL PRODUCTO (JURADO)'), 0, 'C', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', '', 10);		
		$pdf->MultiCell(190, 6, utf8_decode('Trabajo de Grado Titulado: '.$gens->tes_titulo), 1, 'L', 0, 0, '', '', true);		
		$pdf->Ln();
		$pdf->MultiCell(190, 6, utf8_decode('Bachiller(es) y Nr(s) de Cédula(s) '), 1, 'L', 0, 0, '', '', true);
		$pdf->Ln();
		$pdf->SetFont('times', 'B', 8);		
		$pdf->MultiCell(10, 5, utf8_decode('Nº'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(50, 5, utf8_decode('ASPECTOS'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(10, 5, utf8_decode('S'), 1, 'C', 0, 0, '', '', true);
		$pdf->MultiCell(10, 5, utf8_decode('I'), 1, 'C', 0, 0, '', '', true);
		$pdf->SetFillColor(0, 0, 0);		
		$pdf->SetTextColor(255, 255, 255);		
		$pdf->MultiCell(110, 5, utf8_decode('OBSERVACIONES'), 1, 'C', 1, 0, '', '', true);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Ln();		
		foreach ($nota as $notas){	
			$pdf->SetFont('times', '', 8);
			if ($notas->cri_tipo=='PRODUCTO'){
				$pdf->MultiCell(10, 9, utf8_decode($notas->cri_orden), 1, 'C', 0, 0, '', '', true);		
				$pdf->MultiCell(50, 9, utf8_decode($notas->cri_aspecto), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(10, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(10, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);
				$pdf->MultiCell(110, 9, utf8_decode(''), 1, 'C', 0, 0, '', '', true);				
				$pdf->Ln();				
			}					
		}
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(190, 6, utf8_decode('Leyendas: (S)ufientes / (I)nsuficientes'), 0, 'L', 0, 0, '', '', true);
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
	}*/
	$pdf->Output('example_001.pdf', 'I');
?>