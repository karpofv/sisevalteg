<?php
    $codigo = $_POST[c];
    $linea = $_POST[l];
    $editar = $_POST[editar];
    $eliminar = $_POST[eliminar];
    $dmn = $_POST[dmn];
    /*INSERTAR*/
    if($editar=="" and $linea!=""){
        $insertar = paraTodos::arrayInserte("lin_descrip", "linea", "'$linea'");
        if($insertar){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $linea ="";                                     
    }
    /*UPDATE*/
    if($editar==1 and $linea!=""){
        $update = paraTodos::arrayUpdate("lin_descrip='$linea'", "linea", "lin_codigo=$codigo");
        if($update){
            paraTodos::showMsg("Actualizacion exitosa", "alert-success");
        }     
        $codigo = "";
        $linea ="";
    }
    /*MOSTRAR*/
    if($editar==1 and $linea==""){
        $consullinea = paraTodos::arrayConsulta("*", "linea", "lin_codigo=$codigo");
        foreach($consullinea as $lineac){
            $linea = $lineac[lin_descrip];
        }
    }
    /*ELIMINAR*/
    if($eliminar==1){
        $eliminar = paraTodos::arrayDelete("lin_codigo=$codigo", "linea");
        if($eliminar){
            paraTodos::showMsg("Linea de investigación eliminada", "alert-success");
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
                                                                            l: $('#txtlinea').val(),
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2                                                                     
                                                                        },
                                                                        ajaxSend: $('#page-content').html(cargando),                                                    
                                                                        success: function(html) { $('#page-content').html(html); }
        										                      }); return false" action="javascript: void(0);" method="post">       
            <div class="card">
                <div class="card-header"> Lineas de investigación </div>
                <div class="card-body">
                    <div class="row">
                        <div class="" id="datosgen">
                            <div class="">
                                <div class="col-sm-12">
                                    <label class="control-label">Linea</label>
                                    <input type="text" class="form-control" id="txtlinea" value="<?php echo $linea;?>" required>
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
            <div class="card-header"> Linea de investigación registradas </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Linea</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consullinea = paraTodos::arrayConsulta("*", "linea", "1=1");
                            foreach($consullinea as $lineac){
                        ?>
                            <tr>
                                <td><?php echo $lineac[lin_descrip]?></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $lineac[lin_codigo]?>',
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
                                                                            c: '<?php echo $lineac[lin_codigo]?>',
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