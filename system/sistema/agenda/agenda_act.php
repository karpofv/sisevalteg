<?php
    $codigo = $_POST[c];
    $consultesis = paraTodos::arrayConsulta("*", "tesis", "tes_codigo=$codigo");
    foreach($consultesis as $tesis){
        $nombre = $tesis[tes_titulo];
    }
    $tesisrespa = paratodos::arrayConsultanum("*", "tesis_alumno", "tesal_cedula=$cedula and tesal_tescodigo=$codigo");
    if($tesisrespa>0){
        $responsable ="ALUMNO";
        $act = 3;
    }
    $tesisrespt = paratodos::arrayConsultanum("*", "tesis_tutor", "testu_cedula=$cedula  and testu_tescodigo=$codigo");
    if($tesisrespt>0){
        $responsable ="TUTOR";
        $act = 4;        
    }
    $tesisrespj = paratodos::arrayConsultanum("*", "tesis_jurado", "tesju_cedula=$cedula  and tesju_tescodigo=$codigo");
    if($tesisrespj>0){
        $responsable ="JURADO";
        $act = 5;        
    }
?>
<div class="modal fade in" id="Mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrarmodal()"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Estado de las actividades asignadas al TEG: <b><?php echo $nombre;?></b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="tbtesista" class="datatable table table-striped primary" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Descripción</th>
                                <th>Fec. Ejecución</th>
                                <th>Fec. Evaluación</th>
                                <th>Estatus</th>
                                <th>Responsable</th>
                                <th>Ejecutar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulactivi = paraTodos::arrayConsulta("*", "actividad_resp ar, actividad a left join actividad_agenda ag on act_codigo = agen_actcodigo and agen_tescodigo = $codigo", "a.act_responsable=ar.actr_codigo");
                            foreach($consulactivi as $activi){
                                if($responsable==$activi[actr_descripcion]){
                                    if($responsable ="JURADO"){
                                        if($activi[agen_estado]==""){
                                            $accion = "EJECUTAR";
                                            $ejecutar= 1;
                                            $evaluar= 1;                                            
                                        }                                        
                                    } else {
                                        if($activi[agen_estado]==""){
                                            $accion = "EJECUTAR";
                                            $ejecutar= 1;
                                        }
                                    }                                     
                                } else {
                                    if($responsable=="TUTOR" and $activi[actr_descripcion]=="ALUMNO"){
                                        if($activi[agen_estado]=="POR EVALUAR"){
                                            $accion = "EVALUAR";
                                            $evaluar= 1;
                                        }   
                                    }
                                    if($responsable=="JURADO" and $activi[actr_descripcion]=="TUTOR"){
                                        if($activi[agen_estado]=="POR EVALUAR"){
                                            $accion = "EVALUAR";
                                            $evaluar= 1;
                                        }   
                                    }
                                }
                            ?>
                            <tr>
                                <td><?php echo $activi[act_descrip];?></td>
                                <td><?php echo paraTodos::convertDate($activi[agen_fecejec]);?></td>
                                <td><?php echo paraTodos::convertDate($activi[agen_feceval]);?></td>
                                <td><?php echo $activi[agen_estado];?></td>
                                <td><?php echo $activi[actr_descripcion];?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                    type: 'POST',
                                        url: 'accion.php',
                                        data: {
                                            dmn: <?php echo $idMenut; ?>,
                                            c: '<?php echo $codigo?>',
                                            ca: '<?php echo $activi[act_codigo]?>',
                                            ej: '<?php echo $ejecutar?>',
                                            ev: '<?php echo $evaluar?>',
                                            ver: 2,
                                            act: 3
                                        },
                                        success: function(html) {
                                              $.ajax({
                                                type: 'POST',
                                                    url: 'accion.php',
                                                    data: {
                                                        dmn: <?php echo $idMenut; ?>,
                                                        c: '<?php echo $codigo?>',
                                                        ver: 2,
                                                        act: 2
                                                    },
                                                    success: function(html) { $('#ventanaVer').html(html); }
                                                });                                

                                        }
                                    });"><?php echo $accion;?></a></td>
                            </tr>
                            <?php
                            $accion = "";
                            $ejecutar= "";                                
                            $evaluar= "";                                
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="cerrarmodal()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>            
<script>
    $("#tbtesista").DataTable();
    function cancel(){
        $.ajax({
            type: 'POST',
            url: 'accion.php',
            data: {
                dmn: <?php echo $idMenut; ?>,
                ver: 2                                     
            },
            ajaxSend: $('#page-content').html(cargando),                                                    
            success: function(html) { $('#page-content').html(html); }
        });
    }
</script>