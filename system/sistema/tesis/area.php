<?php
    $codigo = $_POST[c];
    $area = $_POST[a];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $area!=""){
        $insertar = paraTodos::arrayInserte("ar_descrip", "area", "'$area'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $area ="";                                     
    }
    /*UPDATE*/
    if($editar==1 and $area!=""){
        $update = paraTodos::arrayUpdate("ar_descrip='$area'", "area", "ar_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $area ="";
    }
    /*MOSTRAR*/
    if($editar==1 and $area==""){
        $consulcarrera = paraTodos::arrayConsulta("*", "area", "ar_codigo=$codigo");
        foreach($consulcarrera as $areac){
            $area = $areac[ar_descrip];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("ar_codigo=$codigo", "area");
        if($eliminar){
            paraTodos::showMsg("Area de investigacion eliminada", "alert-success");
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
                                                                            a: $('#txtarea').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Areas de investigación </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-12">
                                    <label class="control-label">Area de investigacion</label>
                                    <input type="text" class="form-control" id="txtarea" value="<?php echo $area;?>" required>
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
            <div class="card-header"> Areas de investigación registradas </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consularea = paraTodos::arrayConsulta("*", "area", "1=1");
                            foreach($consularea as $areac){
                        ?>
                            <tr>
                                <td><?php echo $areac[ar_descrip]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $areac[ar_codigo]?>',
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
                                                                            c: '<?php echo $areac[ar_codigo]?>',
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