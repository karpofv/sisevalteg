<div class="container-fluid">
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
                            <th>Asig. Tesista</th>
                            <th>Asig. Tutor</th>
                            <th>Asig. Jurado</th>
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
                                                                            ver: 2,
                                                                            act: 2
                                                                        },
                                                                        ajaxSend: $('#ventanaVer').html(cargando),                                                    
                                                                        success: function(html) { $('#ventanaVer').html(html); }
        										                      });"><i class="fa fa-plus-circle" style="font-size: 1.5em; color:#3a8eca"></i></a></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $tesis[tes_codigo]?>',
                                                                            ver: 2,
                                                                            act: 4
                                                                        },
                                                                        ajaxSend: $('#ventanaVer').html(cargando),                                                    
                                                                        success: function(html) { $('#ventanaVer').html(html); }
        										                      });"><i class="fa fa-plus-circle font-red" style="font-size: 1.5em; color:#3a8eca"></i></a></td>
                                <td><a href="javascript:void(0)"  onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            c: '<?php echo $tesis[tes_codigo]?>',
                                                                            ver: 2,
                                                                            act: 3
                                                                        },
                                                                        ajaxSend: $('#ventanaVer').html(cargando),                                                    
                                                                        success: function(html) { $('#ventanaVer').html(html); }
        										                      });"><i class="fa fa-plus-circle" style="font-size: 1.5em; color:#3a8eca"></i></a></td>
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