<?php
    $codigo = $_POST[c];
    $titulo = $_POST[t];
    $periodo = $_POST[p];
    $linea = $_POST[l];
    $area = $_POST[a];
    $observ = $_POST[o];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $titulo!=""){
            paraTodos::showMsg("$observ", "alert-success");        
        $insertar = paraTodos::arrayInserte("tes_periodo, tes_linea, tes_area, tes_titulo, tes_observacion", "tesis", "'$periodo','$linea', '$area', '$titulo', '$observ'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $titulo = "";
        $periodo = "";
        $linea = "";
        $area = "";
        $observ = "";
    }
    /*UPDATE*/
    if($editar==1 and $titulo!=""){
        $update = paraTodos::arrayUpdate("tes_periodo='$periodo', tes_linea='$linea', tes_area='$area', tes_titulo='$titulo', tes_observacion='$observ'", "tesis", "tes_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $titulo = "";
        $periodo = "";
        $linea = "";
        $area ="";
        $observ ="";
    }
    /*MOSTRAR*/
    if($editar==1 and $titulo==""){
        $consultesis = paraTodos::arrayConsulta("*", "tesis", "tes_codigo=$codigo");
        foreach($consultesis as $tesis){
            $titulo = $tesis[tes_titulo];
            $periodo = $tesis[tes_periodo];
            $linea = $tesis[tes_linea];
            $area = $tesis[tes_area];
            $observ = $tesis[tes_observacion];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("tes_codigo=$codigo", "tesis");
        if($eliminar){
            paraTodos::showMsg("Trabajo de grado eliminado", "alert-success");
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
                                                                            t: $('#txttitulo').val(),
                                                                            p: $('#selperiodo').val(),
                                                                            l: $('#sellinea').val(),
                                                                            a: $('#selarea').val(),
                                                                            o: $('#txtobserv').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Trabajos de Grado </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-12">
                                    <label class="control-label">Título del proyecto</label>
                                    <input type="text" class="form-control" id="txttitulo" value="<?php echo $titulo;?>" required>
                                    <input type="text" class="form-control collapse" id="codigo" value="<?php echo $codigo;?>">
                                </div>
                                <div class="col-sm-4 col-md-2">
                                    <label class="control-label">Periodo académico</label>
                                    <select class="form-control selectnw" id="selperiodo">
                                        <?php
                                            combos::CombosSelect("1",$periodo,"per_codigo, per_periodo, per_anual, concat(per_anual,'-',tp.tper_descripcion)", "periodo p, tools_periodo tp", "per_codigo", "concat(per_anual,'-',tp.tper_descripcion)", "p.per_periodo=tp.tper_codigo and per_inicio<=current_date and per_final>=current_date");
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <label class="control-label">Linea de investigación</label>
                                    <select class="form-control selectnw" id="sellinea">
                                        <?php
                                            combos::CombosSelect("1",$linea,"lin_codigo, lin_descrip", "linea", "lin_codigo", "lin_descrip", "1=1");
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <label class="control-label">Area de investigación</label>
                                    <select class="form-control selectnw" id="selarea">
                                        <?php
                                            combos::CombosSelect("1",$area,"ar_codigo, ar_descrip", "area", "ar_codigo", "ar_descrip", "1=1");
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <label class="control-label">Observación</label>
                                    <textarea class="form-control" id="txtobserv"><?php echo $observ?></textarea>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btnopera" id="btnsave">GUARDAR</button>
                <button type="button" class="btn btn-success btnopera" onclick="cancel();">CANCELAR</button>
            </div>
        </form>
    </div>
    <div class="form-group">
        <div class="card">
            <div class="card-header"> Trabajos de grado registrados </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Linea</th>
                            <th>Area</th>
                            <th>Titulo</th>                            
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consultesis = paraTodos::arrayConsulta("*", "tesis t, linea  l, area a, periodo p, tools_periodo tp", " tp.tper_codigo=p.per_periodo and t.tes_linea=l.lin_codigo and t.tes_area=a.ar_codigo and t.tes_periodo=p.per_codigo");
                            foreach($consultesis as $tesis){
                        ?>
                            <tr>
                                <td><?php echo $tesis[per_anual]."-".$tesis[tper_descripcion]?></td>
                                <td><?php echo $tesis[lin_descrip]?></td>
                                <td><?php echo $tesis[ar_descrip]?></td>
                                <td><?php echo $tesis[tes_titulo]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $tesis[tes_codigo]?>',
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
                                                                            c: '<?php echo $tesis[tes_codigo]?>',
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