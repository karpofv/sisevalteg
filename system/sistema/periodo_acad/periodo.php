<?php
    $codigo = $_POST[c];
    $anual = $_POST[a];
    $periodo = $_POST[p];
    $inicio = $_POST[i];
    $fin = $_POST[f];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $periodo!=""){
        $insertar = paraTodos::arrayInserte("per_anual, per_periodo, per_inicio, per_final", "periodo", "'$anual','$periodo', '$inicio', '$fin'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $anual ="";                                     
        $periodo ="";                                     
        $inicio ="";                                     
        $fin ="";                                     
    }
    /*UPDATE*/
    if($editar==1 and $periodo!=""){
        $update = paraTodos::arrayUpdate("per_anual='$anual', per_periodo='$periodo', per_inicio='$inicio', per_final='$fin'", "periodo", "per_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $anual ="";                                     
        $periodo ="";                                     
        $inicio ="";                                     
        $fin ="";
    }
    /*MOSTRAR*/
    if($editar==1 and $periodo==""){
        $consulperiodo = paraTodos::arrayConsulta("*", "periodo", "per_codigo=$codigo");
        foreach($consulperiodo as $per){
            $periodo = $per[per_periodo];
            $anual = $per[per_anual];
            $inicio = $per[per_inicio];
            $fin = $per[per_final];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("per_codigo=$codigo", "periodo");
        if($eliminar){
            paraTodos::showMsg("periodo eliminado", "alert-success");
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
                                                                            p: $('#selper').val(),
                                                                            a: $('#selanual').val(),
                                                                            i: $('#desde').val(),
                                                                            f: $('#hasta').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Periodos </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-2">
                                    <label class="control-label">Periodo</label>
                                    <input type="text" class="form-control collapse" id="codigo" value="<?php echo $codigo;?>">
                                    <select class="form-control selectnw" id="selper">
                                        <?php
                                            combos::CombosSelect("1",$periodo,"tper_codigo, tper_descripcion", "tools_periodo", "tper_codigo", "tper_descripcion", "1=1");
                                        ?>
                                    </select>                                    
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">Año</label>
                                    <select class="form-control selectnw" id="selanual">
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        <optio></optio>
                                    </select>                                    
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">Inicio</label>
                                    <input type="date" id="desde" class="form-control" value="<?php echo $inicio?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="control-label">Final</label>
                                    <input type="date" id="hasta" class="form-control" value="<?php echo $fin?>">
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <button type="submit" class="btn btn-default btnopera" id="btnsave">GUARDAR</button>
                <button type="button" class="btn btn-default btnopera" onclick="cancel();">CANCELAR</button>
            </div>
        </form>
    </div>
    <div class="form-group">
        <div class="card">
            <div class="card-header"> Periodos registrados </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Año</th>
                            <th>Periodo</th>
                            <th>Inicio</th>
                            <th>Final</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulperiodo = paraTodos::arrayConsulta("*", "periodo", "1=1");
                            foreach($consulperiodo as $periodo){
                        ?>
                            <tr>
                                <td><?php echo $periodo[per_anual]?></td>
                                <td><?php echo $periodo[per_periodo]?></td>
                                <td><?php echo $periodo[per_inicio]?></td>
                                <td><?php echo $periodo[per_final]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $periodo[per_codigo]?>',
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
                                                                            c: '<?php echo $periodo[per_codigo]?>',
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