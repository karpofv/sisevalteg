<?php
    $resp = $_POST[ev];
    $codigo = $_POST[c];
    $criterio = $_POST[cc];
    $tipo = $_POST[t];
    $nota = $_POST[n];
    if($resp=="TUTOR"){
        $cuentaeval = paraTodos::arrayConsultanum("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$criterio' and eval_tipo='$tipo' and eval_notat<>''");
        if ($cuentaeval>0){
            paratodos::arrayUpdate("eval_notat='$nota'", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$criterio' and eval_tipo='$tipo' and eval_notat<>0");
        } else {
            paraTodos::arrayInserte("eval_tescodigo, eval_cricodigo, eval_tipo, eval_notat", "evaluacion", "'$codigo', '$criterio', '$tipo', '$nota'");         
        }
    }
    if($resp=="JURADO"){
        $cuentaeval = paraTodos::arrayConsultanum("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$criterio' and eval_tipo='$tipo' and eval_cedulaj=$cedula");
        if ($cuentaeval>0){
            paratodos::arrayUpdate("eval_notaj='$nota'", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$criterio' and eval_tipo='$tipo' and eval_cedulaj=$cedula");
        } else {
            paraTodos::arrayInserte("eval_tescodigo, eval_cricodigo, eval_tipo,eval_cedulaj, eval_notaj", "evaluacion", "'$codigo', '$criterio', '$tipo', '$cedula','$nota'");      
        }        
    }
?>