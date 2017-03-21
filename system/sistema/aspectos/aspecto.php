<?php
    $codigo = $_POST[c];
    $orden = $_POST[o];
    $tipo = $_POST[t];
    $aspecto = $_POST[a];
    $estado = $_POST[es];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $aspecto!=""){
        $insertar = paraTodos::arrayInserte("cri_orden, cri_tipo, cri_aspecto, cri_estado", "criterio", "'$orden', '$tipo', '$aspecto', '$estado'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $orden = "";
        $tipo = "";
        $aspecto = "";
        $estado = "";
    }
    /*UPDATE*/
    if($editar==1 and $aspecto!=""){
        $update = paraTodos::arrayUpdate("cri_orden='$orden', cri_tipo='$tipo', cri_aspecto='$aspecto', cri_estado='$estado'", "criterio", "cri_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $orden = "";
        $tipo = "";
        $aspecto = "";
        $estado = "";
    }
    /*MOSTRAR*/
    if($editar==1 and $aspecto==""){
        $consulcriterio = paraTodos::arrayConsulta("*", "criterio c, criterio_tipo ct, status s", "c.cri_tipo=ct.crit_codigo and c.cri_estado=s.st_codigo and cri_codigo=$codigo");
        foreach($consulcriterio as $criterio){
            $orden = $criterio[cri_orden];
            $tipo = $criterio[crit_codigo];
            $aspecto = $criterio[cri_aspecto];
            $estado = $criterio[st_codigo];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("cri_codigo=$codigo", "criterio");
        if($eliminar){
            paraTodos::showMsg("Aspecto eliminado", "alert-success");
        }
    }
?>
<div class="container-fluid">
    <div class="form-group">
            <form class="form-horizontal" id="formulario" onsubmit="
                                                                    $.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            editar: '<?php echo $editar?>', 
                                                                            c: $('#codigo').val(), 
                                                                            o: $('#txtorden').val(),
                                                                            a: $('#txtaspecto').val(),
                                                                            t: $('#seltipo').val(),
                                                                            es: $('#selstatus').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Aspectos de evaluacion </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-6">
                                    <label class="control-label">Aspecto</label>
                                    <input type="text" class="form-control" id="txtaspecto" value="<?php echo $aspecto;?>" required>
                                    <input type="text" class="form-control collapse" id="codigo" value="<?php echo $codigo;?>"> </div>                                
                                <div class="col-sm-2">
                                    <label class="control-label">Tipo</label>
                                    <select class="form-control selectnw" id="seltipo">
                                        <?php
                                            combos::CombosSelect("1",$tipo,"crit_codigo, crit_descripcion", "criterio_tipo", "crit_codigo", "crit_descripcion", "crit_codigo=1 or crit_codigo=2 or crit_codigo=3");
                                        ?>
                                    </select>                                    
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">Estatus</label>
                                    <select class="form-control selectnw" id="selstatus">
                                        <?php
                                            combos::CombosSelect("1",$estado,"st_codigo, st_descripcion", "status", "st_codigo", "st_descripcion", "st_codigo=1 or st_codigo=2");
                                        ?>
                                    </select>                                    
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">Orden</label>
                                    <input type="number" class="form-control" id="txtorden" value="<?php echo $orden;?>" required>
                            </div>                        
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btnopera" id="btnsave">GUARDAR</button>
                    <button type="button" class="btn btn-default btnopera" onclick="cancel();">CANCELAR</button>
                </div>
            </div>
        </form>
    </div>
    <div class="form-group">
        <div class="card">
            <div class="card-header"> Apectos de evaluacion registrados </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Orden</th>
                            <th>Aspecto</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulcriterio = paraTodos::arrayConsulta("*", "criterio c, criterio_tipo ct, status s", "c.cri_tipo=ct.crit_codigo and c.cri_estado=s.st_codigo order by cri_tipo,cri_orden");
                            foreach($consulcriterio as $criterio){
                        ?>
                            <tr>
                                <td><?php echo $criterio[cri_orden]?></td>
                                <td><?php echo $criterio[cri_aspecto]?></td>
                                <td><?php echo $criterio[crit_descripcion]?></td>
                                <td><?php echo $criterio[st_descripcion]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $criterio[cri_codigo]?>',
                                                                            editar: 1,
                                                                            ver: 2                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      });"><i class="fa fa-edit"></i></a></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $criterio[cri_codigo]?>',
                                                                            eliminar: 1,
                                                                            ver: 2 
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      });"><i class="fa fa-remove font-red"></i></a></td>
                            </tr>
                        <?php
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(".datatable").DataTable();
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