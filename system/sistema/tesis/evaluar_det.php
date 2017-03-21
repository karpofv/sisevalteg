<?php
    $codigo = $_POST[c];
    $consultesis = paraTodos::arrayConsulta("*", "tesis","tes_codigo=$codigo");
    foreach($consultesis as $tesis){
        $nombre = $tesis[tes_titulo];
    }
?>
    <div class="container-fluid">
        <div class="form-group">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body app-heading">
                        <div class="app-title">
                            <div class="title"><span class="highlight"><?php echo $nombre;?></span></div>
                            <div class="description">Tesistas: 
                                <?php
                                    $consultesistas = paraTodos::arrayConsulta("*", "tesis_alumno ta, persona p", "ta.tesal_cedula=p.per_cedula and tesal_tescodigo=$codigo");
                                    foreach($consultesistas as $tesista){
                                ?>
                                    <span><?php echo $tesista[per_apellidos]." ".$tesista[per_nombres]?> | </span>
                                <?php
                                    }                                
                                ?>
                            </div>
                        </div>
                        <a href="<?php echo $ruta_base."system/accion.php?dmn=$idMenut&act=7&ver=2&c=$codigo"?>" target="_blank" title="Acta de evaluación de Aspectos"><i class="icon fa fa-file-image-o fa-4x"></i></a>
                        <a href="<?php echo $ruta_base."system/accion.php?dmn=$idMenut&act=8&ver=2&c=$codigo"?>" target="_blank" title="Acta de evaluación del TEG"><i class="icon fa fa-file-pdf-o fa-4x"></i></a>
                        <a href="<?php echo $ruta_base."system/accion.php?dmn=$idMenut&act=6&ver=2&c=$codigo"?>" target="_blank" title="Acta de evaluación del Documento"><i class="icon fa fa-file-text-o fa-4x"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="card card-banner card-green-light" href="javascript:void(0)" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2,
                                                                            a: 1,
                                                                            c : <?php echo $codigo; ?>,
                                                                            act: 3
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) { $('#itemseval').html(html); }
        										                      })">
                    <div class="card-body"> <i class="icon fa fa-file-image-o fa-4x"></i>
                        <div class="content">
                            <div class="title">Aspectos</div>
                            <div class="value"><span class="sign"></span></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="card card-banner card-blue-light"  href="javascript:void(0)" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            ver: 2,
                                                                            t: 1,
                                                                            c : <?php echo $codigo; ?>,                                                                                                
                                                                            act: 3
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) { $('#itemseval').html(html); }
        										                      })">
                    <div class="card-body"> <i class="icon fa fa-file-pdf-o fa-4x"></i>
                        <div class="content">
                            <div class="title">TEG</div>
                            <div class="value"><span class="sign"></span></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <a class="card card-banner card-yellow-light"  href="javascript:void(0)" onclick="$.ajax({
                                                                        type: 'POST',
                                                                        url: 'accion.php',
                                                                        data: {
                                                                            dmn: <?php echo $idMenut; ?>,
                                                                            d : 1,
                                                                            c : <?php echo $codigo; ?>,
                                                                            ver: 2,
                                                                            act: 3
                                                                        },
                                                                        ajaxSend: $('#itemseval').html(cargando),                                                    
                                                                        success: function(html) { $('#itemseval').html(html); }
        										                      })">
                    <div class="card-body"> <i class="icon fa fa-file-text-o fa-4x"></i>
                        <div class="content">
                            <div class="title">Documento</div>
                            <div class="value"><span class="sign"></span></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12">
                <div class="card">
                    <div id="itemseval">
                    </div>                
                </div>
            </div>
        </div>
    </div>