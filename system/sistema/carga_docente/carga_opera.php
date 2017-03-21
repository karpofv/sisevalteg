<?php    
    $codigo = $_POST[c];
    $grado = $_POST[g];
    $limitt = $_POST[lt];
    $limitj = $_POST[lj];
    /*Se verifica si el docente posee carga registrada*/
    $verificar = paraTodos::arrayConsultanum("*", "docente", "doc_cedula=$codigo");    
    if($verificar>0){
        paraTodos::arrayUpdate("doc_grado='$grado', doc_limtutot='$limitt', doc_limjurado='$limitj'", "docente", "doc_cedula=$codigo");
    } else {
        paraTodos::arrayInserte("doc_cedula, doc_grado, doc_limtutot, doc_limjurado", "docente", "'$codigo', '$grado', '$limitt', '$limitj'");
    }
?>