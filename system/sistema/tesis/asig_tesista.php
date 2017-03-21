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
                <h4 class="modal-title">Asignar alumnos a trabajo de grado: <b><?php echo $nombre;?></b></h4>
            </div>
            <div class="modal-body">
                <div id="tesistaag">
<div class="row">
    <label>alumnos Asignados</label>
<?php
    $consulasig = paraTodos::arrayConsulta("*", "tesis_alumno ta, persona p", "ta.tesal_cedula=p.per_cedula and ta.tesal_tescodigo=$codigo");
    foreach($consulasig as $asig){
?>
    <a href="javascript:void(0)" onclick="$.ajax({
                                type: 'POST',
                                    url: 'accion.php',
                                    data: {
                                        dmn: <?php echo $idMenut; ?>,
                                        ced: '<?php echo $asig[per_cedula]?>',
                                        c: '<?php echo $codigo?>',
                                        ca: '<?php echo $asig[tesal_codigo]?>',
                                        ver: 2,
                                        act: 5,
                                        eliminar: 1
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
                                });" title="Eliminar"><span class="label label-warning"><?php echo $asig[per_cedula].": ".$asig[per_nombres]." ".$asig[per_apellidos]." " ?><i class="fa fa-user-times"></i></span></a>
<?php
    }
?>
    </div>
                </div>
                <table id="tbtesista" class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consultesista = paraTodos::arrayConsulta("*", "persona p", "per_tipo=2 and p.per_cedula not in (select ta.tesal_cedula from tesis_alumno ta where ta.tesal_tescodigo=$codigo)");
                        foreach($consultesista as $tesista){
                        ?>
                        <tr>
                            <td><?php echo $tesista[per_cedula];?></td>
                            <td><?php echo $tesista[per_nombres];?></td>
                            <td><?php echo $tesista[per_apellidos];?></td>
                            <td><a href="javascript:void(0)"  onclick="$.ajax({
                                type: 'POST',
                                    url: 'accion.php',
                                    data: {
                                        dmn: <?php echo $idMenut; ?>,
                                        ced: '<?php echo $tesista[per_cedula]?>',
                                        c: '<?php echo $codigo?>',
                                        ver: 2,
                                        act: 5
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
                                });"><i class="fa fa-plus-circle" style="font-size: 1.5em; color:#3a8eca"></i></a></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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