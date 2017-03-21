<?php
    $codigo = $_POST[c];
    $indicador = $_POST[i];
    $tipo = $_POST[t];
    $aspecto = $_POST[a];
    $estado = $_POST[es];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $aspecto!=""){
        $insertar = paraTodos::arrayInserte("crid_indicador, crid_tipo, crid_aspecto, crid_estado", "criteriod", "'$indicador', '$tipo', '$aspecto', '$estado'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $indicador = "";
        $tipo = "";
        $aspecto = "";
        $estado = "";
    }
    /*UPDATE*/
    if($editar==1 and $aspecto!=""){
        $update = paraTodos::arrayUpdate("crid_indicador='$indicador', crid_tipo='$tipo', crid_aspecto='$aspecto', crid_estado='$estado'", "criteriod", "crid_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $indicador = "";
        $tipo = "";
        $aspecto = "";
        $estado = "";
    }
    /*MOSTRAR*/
    if($editar==1 and $aspecto==""){
        $consulcriterio = paraTodos::arrayConsulta("*", "criteriod c, criterio_tipo ct, status s", "c.crid_tipo=ct.crit_codigo and c.crid_estado=s.st_codigo and crid_codigo=$codigo");
        foreach($consulcriterio as $criterio){
            $indicador = $criterio[crid_indicador];
            $tipo = $criterio[crit_codigo];
            $aspecto = $criterio[crid_aspecto];
            $estado = $criterio[st_codigo];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("crid_codigo=$codigo", "criteriod");
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
                                                                            i: $('#txtindicador').val(),
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
                                    <input type="text" class="form-control collapse" id="codigo" value="<?php echo $codigo;?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Inidicador</label>
                                    <input type="text" class="form-control" id="txtindicador" value="<?php echo $indicador;?>" required>
                                </div>                                
                                <div class="col-sm-2">
                                    <label class="control-label">Tipo</label>
                                    <select class="form-control selectnw" id="seltipo">
                                        <?php
                                            combos::CombosSelect("1",$tipo,"crit_codigo, crit_descripcion", "criterio_tipo", "crit_codigo", "crit_descripcion", "crit_codigo>4 and crit_codigo<11");
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
                                <div class="col-sm-8">
                                    <br>
                                    <button type="submit" class="btn btn-default btnopera" id="btnsave">GUARDAR</button>
                                    <button type="button" class="btn btn-default btnopera" onclick="cancel();">CANCELAR</button>                                
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <th>Aspecto</th>
                            <th>Tipo</th>
                            <th>Inidicador</th>
                            <th>Estatus</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulcriterio = paraTodos::arrayConsulta("*", "criteriod c, criterio_tipo ct, status s", "c.crid_tipo=ct.crit_codigo and c.crid_estado=s.st_codigo order by crid_tipo");
                            foreach($consulcriterio as $criterio){
                        ?>
                            <tr>
                                <td><?php echo $criterio[crid_aspecto]?></td>
                                <td><?php echo $criterio[crit_descripcion]?></td>
                                <td><?php echo $criterio[crid_indicador]?></td>
                                <td><?php echo $criterio[st_descripcion]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $criterio[crid_codigo]?>',
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
                                                                            c: '<?php echo $criterio[crid_codigo]?>',
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