<?php
    $aspecto = $_POST[a];
    $codigo = $_POST[c];
    $tesis= $_POST[t];
    $documento= $_POST[d];
    $cosultut = paraTodos::arrayConsultanum("*", "tesis_tutor", "testu_tescodigo=$codigo and testu_cedula=$cedula");
    if($cosultut>0){
        $resp="TUTOR";
    }
    $cosulju= paraTodos::arrayConsultanum("*", "tesis_jurado", "tesju_tescodigo=$codigo and tesju_cedula=$cedula");
    if($cosulju>0){
        $resp="JURADO";
    }
?>
    <table class="table">
        <thead>
            <tr>
                <th>Criterio</th>
                <th>Nota</th>
                <th>Evaluar</th>
            </tr>
        </thead>
        <tbody>
<?php
    if($aspecto==1){
        $consulaspecto = paraTodos::arrayConsulta("*", "criterio", "cri_estado=1 order by cri_orden");
        foreach($consulaspecto as $aspec){
?>
            <tr>
                <td><?php echo $aspec[cri_aspecto];?></td>
                <td>
                    <?php
                    $evaluado="EVALUAR";
                    if($resp=="TUTOR"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$aspec[cri_codigo]' and eval_tipo='ASPECTO' and eval_notat<>''");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notat];
                            $evaluado="Reevaluar";
                        }
                    }
                    if($resp=="JURADO"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$aspec[cri_codigo]' and eval_tipo='ASPECTO' and eval_cedulaj=$cedula");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notaj];
                            $evaluado="Reevaluar";                            
                        }
                    }
                    ?>
                    <select class="form-control selectnw" id="selnota<?php echo $aspec[cri_codigo];?>">
                    <?php
                        combos::CombosSelect("1",$nota,"tnota_codigo, tnota_descripcion", "tools_nota", "tnota_codigo", "tnota_descripcion", "1=1");
                    ?>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            t : 'ASPECTO',
                                                                            c : <?php echo $codigo;?>,
                                                                            cc : <?php echo $aspec[cri_codigo];?>,
                                                                            n : $('#selnota<?php echo $aspec[cri_codigo];?>').val(),
                                                                            ev : '<?php echo $resp; ?>',
                                                                            ver: 2,
                                                                            act: 4
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) {
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: 'accion.php',
                                                                                data: {
                                                                                    dmn: <?php echo $idMenut; ?>,
                                                                                    c : <?php echo $codigo;?>,                    
                                                                                    a : 1,
                                                                                    ver: 2,
                                                                                    act: 3
                                                                                },
                                                                                ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                                success: function(html) { $('#itemseval').html(html); }
                                                                            });
                                                                        }
        										                      });"><?php echo $evaluado;?></button></td>
            </tr>
    <?php
        }
        $nota=null;
    }
    if($tesis==1){
        $consultesis = paraTodos::arrayConsulta("*", "criteriot", "crit_estado=1 order by crit_orden");
        foreach($consultesis as $tes){
?>
            <tr>
                <td><?php echo $tes[crit_descrip];?></td>
                <td>
                    <?php
                    $evaluado="EVALUAR";
                    if($resp=="TUTOR"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$tes[crit_codigo]' and eval_tipo='TESIS' and eval_notat<>''");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notat];
                            $evaluado="Reevaluar";
                        }
                    }
                    if($resp=="JURADO"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$tes[crit_codigo]' and eval_tipo='TESIS' and eval_cedulaj=$cedula");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notaj];
                            $evaluado="Reevaluar";                            
                        }
                    }
                    ?>                    
                    <select class="form-control selectnw" id="selnota<?php echo $tes[crit_codigo];?>">
                    <?php
                        combos::CombosSelect("1",$nota,"tnota_codigo, tnota_descripcion", "tools_nota", "tnota_codigo", "tnota_descripcion", "1=1");
                    ?>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            t : 'TESIS',
                                                                            c : <?php echo $codigo;?>,
                                                                            cc : <?php echo $tes[crit_codigo];?>,
                                                                            n : $('#selnota<?php echo $tes[crit_codigo];?>').val(),
                                                                            ev : '<?php echo $resp; ?>',
                                                                            ver: 2,
                                                                            act: 4
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) {
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: 'accion.php',
                                                                                data: {
                                                                                    dmn: <?php echo $idMenut; ?>,
                                                                                    c : <?php echo $codigo;?>,                    
                                                                                    T : 1,
                                                                                    ver: 2,
                                                                                    act: 3
                                                                                },
                                                                                ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                                success: function(html) { $('#itemseval').html(html); }
                                                                            });
                                                                        }
        										                      });"><?php echo $evaluado;?></button></td>
            </tr>
    <?php
        }        
    }
    if($documento==1){
        $consuldocumento = paraTodos::arrayConsulta("*", "criteriod", "crid_estado=1 order by crid_tipo");
        foreach($consuldocumento as $doc){
?>
            <tr>
                <td><?php echo $doc[crid_aspecto];?></td>
                <td>
                    <?php
                    $evaluado="EVALUAR";
                    if($resp=="TUTOR"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$doc[crid_codigo]' and eval_tipo='DOCUMENTO' and eval_notat<>''");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notat];
                            $evaluado="Reevaluar";
                        }
                    }
                    if($resp=="JURADO"){
                        $cuentaeval = paraTodos::arrayConsulta("*", "evaluacion", "eval_tescodigo=$codigo and eval_cricodigo='$doc[crid_codigo]' and eval_tipo='DOCUMENTO' and eval_cedulaj=$cedula");
                        foreach($cuentaeval as $eval){
                            $nota = $eval[eval_notaj];
                            $evaluado="Reevaluar";                            
                        }
                    }
                    ?>                    
                    <select class="form-control selectnw" id="selnota<?php echo $doc[crid_codigo];?>">
                    <?php
                        combos::CombosSelect("1",$nota,"tnota_codigo, tnota_descripcion", "tools_nota", "tnota_codigo", "tnota_descripcion", "1=1");
                    ?>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            t : 'DOCUMENTO',
                                                                            c : <?php echo $codigo;?>,
                                                                            cc : <?php echo $doc[crid_codigo];?>,
                                                                            n : $('#selnota<?php echo $doc[crid_codigo];?>').val(),
                                                                            ev : '<?php echo $resp; ?>',
                                                                            ver: 2,
                                                                            act: 4
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) {
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: 'accion.php',
                                                                                data: {
                                                                                    dmn: <?php echo $idMenut; ?>,
                                                                                    c : <?php echo $codigo;?>,                    
                                                                                    d : 1,
                                                                                    ver: 2,
                                                                                    act: 3
                                                                                },
                                                                                ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                                success: function(html) { $('#itemseval').html(html); }
                                                                            });
                                                                        }
        										                      });"><?php echo $evaluado;?></button></td>
            </tr>
    <?php
        }        
    }
?>
                    </tbody>
    </table>