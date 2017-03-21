<?php
    $codigo=$_POST[c];
    $codigoa=$_POST[ca];
    $ejecutar=$_POST[ej];
    $evaluar=$_POST[ev];
    if($ejecutar==1){
        paraTodos::arrayInserte("agen_actcodigo, agen_tescodigo, agen_fecejec, agen_estado", "actividad_agenda", "'$codigoa', '$codigo', current_date, 'POR EVALUAR'");
    }
    if($evaluar==1){
        $consulagenda = paraTodos::arrayConsulta("*", "actividad_agenda", "agen_tescodigo=$codigo and agen_actcodigo=$codigoa");
        foreach($consulagenda as $agenda){
            $codigoagen = $agenda[agen_codigo];
        }
        paraTodos::arrayUpdate("agen_feceval=current_date, agen_estado='EVALUADO'","actividad_agenda", "agen_codigo=$codigoagen");
    }
?>