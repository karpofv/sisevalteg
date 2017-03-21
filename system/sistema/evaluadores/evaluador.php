<?php
    $codigo = $_POST[c];
    $carrera = $_POST[ca];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $carrera!=""){
        $insertar = paraTodos::arrayInserte("car_descrip", "carrera", "'$carrera'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $carrera ="";                                     
    }
    /*UPDATE*/
    if($editar==1 and $carrera!=""){
        $update = paraTodos::arrayUpdate("car_descrip='$carrera'", "carrera", "car_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $carrera ="";
    }
    /*MOSTRAR*/
    if($editar==1 and $carrera==""){
        $consulcarrera = paraTodos::arrayConsulta("*", "carrera", "car_codigo=$codigo");
        foreach($consulcarrera as $carrerac){
            $carrera = $carrerac[car_descrip];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("car_codigo=$codigo", "carrera");
        if($eliminar){
            paraTodos::showMsg("carrera eliminada", "alert-success");
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
                                                                            ca: $('#txtcarrera').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Evaluador </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-12">
                                    <label class="control-label">Carrera</label>
                                    <input type="text" class="form-control" id="txtcarrera" value="<?php echo $carrera;?>" required>
                                    <input type="text" class="form-control collapse" id="codigo" value="<?php echo $codigo;?>"> </div>                                
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
            <div class="card-header"> Evaluador registrado </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Carrera</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulcarrera = paraTodos::arrayConsulta("*", "carrera", "1=1");
                            foreach($consulcarrera as $carrerac){
                        ?>
                            <tr>
                                <td><?php echo $carrerac[car_descrip]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $carrerac[car_codigo]?>',
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
                                                                            c: '<?php echo $carrerac[car_codigo]?>',
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