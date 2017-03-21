<?php
    $ced = $_POST[ced];
    $codigo = $_POST[c];
    $codigoa = $_POST[ca];
    $eliminar = $_POST[eliminar];
    if($eliminar!=1){
        $insertar = paraTodos::arrayInserte("tesal_cedula, tesal_tescodigo", "tesis_alumno", "'$ced', '$codigo'");        
    }
    if($eliminar==1){
        $insertar=paraTodos::arrayDelete("tesal_codigo=$codigoa", "tesis_alumno");        
    }
?>

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
                                        ced: '<?php echo $tesista[per_cedula]?>',
                                        c: '<?php echo $codigo?>',
                                        ca: '<?php echo $codigoa?>',
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