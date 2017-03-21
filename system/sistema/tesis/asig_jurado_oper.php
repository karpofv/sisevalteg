<?php
    $ced = $_POST[ced];
    $codigo = $_POST[c];
    $codigoa = $_POST[ca];
    $eliminar = $_POST[eliminar];
    if($eliminar!=1){
        $insertar = paraTodos::arrayInserte("tesju_cedula, tesju_tescodigo", "tesis_jurado", "'$ced', '$codigo'");        
    }
    if($eliminar==1){
        $insertar=paraTodos::arrayDelete("tesju_codigo=$codigoa", "tesis_jurado");        
    }
?>

<div class="row">
    <label>Jurados asignados: </label>
<?php
    $consulasig = paraTodos::arrayConsulta("*", "tesis_jurado ta, persona p", "ta.tesju_cedula=p.per_cedula and ta.tesju_tescodigo=$codigo");
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
                                        act: 7,
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
                                                    act: 3
                                                },
                                                success: function(html) { $('#ventanaVer').html(html); }
                                            });
                                          }
                                });" title="Eliminar"><span class="label label-warning"><?php echo $asig[per_cedula].": ".$asig[per_nombres]." ".$asig[per_apellidos]." " ?><i class="fa fa-user-times"></i></span></a>
<?php
    }
?>
    </div>