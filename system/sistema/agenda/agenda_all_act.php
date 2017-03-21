<?php
    $codigo = $_POST[c];
    $consultesis = paraTodos::arrayConsulta("*", "tesis", "tes_codigo=$codigo");
    foreach($consultesis as $tesis){
        $nombre = $tesis[tes_titulo];
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $consulactivi = paraTodos::arrayConsulta("*", "actividad_resp ar, actividad a left join actividad_agenda ag on act_codigo = agen_actcodigo and agen_tescodigo = $codigo", "a.act_responsable=ar.actr_codigo");
                            foreach($consulactivi as $activi){
                            ?>
                            <tr>
                                <td><?php echo $activi[act_descrip];?></td>
                                <td><?php echo paraTodos::convertDate($activi[agen_fecejec]);?></td>
                                <td><?php echo paraTodos::convertDate($activi[agen_feceval]);?></td>
                                <td><?php echo $activi[agen_estado];?></td>
                                <td><?php echo $activi[actr_descripcion];?></td>                                
                            </tr>
                            <?php                              
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