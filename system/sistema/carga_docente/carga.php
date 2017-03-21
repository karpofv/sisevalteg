<?php
    $codigo = $_POST[c];
    $dmn = $_POST[dmn];
    $consulasgi = paraTodos::arrayConsulta("*", "docente", "doc_cedula=$codigo");
    foreach($consulasgi as $asig){
        $grado = $asig[doc_grado];
        $limitt = $asig[doc_limtutot];
        $limitj = $asig[doc_limjurado];
    }
?>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrarmodal()"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Carga del docente</h4>
            </div>
            <div class="modal-body">
                <div class="row">                    
                    <div class="col-sm-4">
                        <label class="control-label">Grado</label>
                        <select class="form-control selectnw" id="selgrado" onchange="$.ajax({
                                                                            type: 'POST',
                                                                            url: 'accion.php',
                                                                            data: {
                                                                                dmn:    <?php echo $idMenut; ?>,
                                                                                c:      '<?php echo $codigo;?>',
                                                                                g:      $('#selgrado').val(),
                                                                                lt:     $('#txtlimittut').val(),
                                                                                lj:     $('#txtlimitj').val(),
                                                                                ver:    2,
                                                                                act:    3
                                                                            },
                                                                            success: function() {
                                                                                $.ajax({
                                                                                    type: 'POST',
                                                                                    url: 'accion.php',
                                                                                    data: {
                                                                                        dmn:    <?php echo $idMenut; ?>,
                                                                                        ver:    2
                                                                                    },
                                                                                    success: function(html) {
                                                                                      $('#page-content').html(html);
                                                                                    }
                                                                                });
                                                                            }
                                                                          }).done(function() {
                                                                            $('#selgrado').addClass('alert-success');
                                                                        });">
                        <?php
                            combos::CombosSelect("1",$grado,"perg_codigo, perg_descripcion", "persona_grado", "perg_codigo", "perg_descripcion", "1=1");
                        ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Limite como tutor</label>
                        <input type="number" class="form-control" id="txtlimittut" value="<?php echo $limitt?>" onchange="$.ajax({
                                                                            type: 'POST',
                                                                            url: 'accion.php',
                                                                            data: {
                                                                                dmn:    <?php echo $idMenut; ?>,
                                                                                c:      '<?php echo $codigo;?>',
                                                                                g:      $('#selgrado').val(),
                                                                                lt:     $('#txtlimittut').val(),
                                                                                lj:     $('#txtlimitj').val(),
                                                                                ver:    2,
                                                                                act:    3
                                                                            },
                                                                            success: function() {
                                                                                $.ajax({
                                                                                    type: 'POST',
                                                                                    url: 'accion.php',
                                                                                    data: {
                                                                                        dmn:    <?php echo $idMenut; ?>,
                                                                                        ver:    2
                                                                                    },
                                                                                    success: function(html) {
                                                                                      $('#page-content').html(html);
                                                                                    }
                                                                                });
                                                                            }                                              
                                                                          }).done(function() {
                                                                            $('#txtlimittut').addClass('alert-success');                                                                                
                                                                        });">
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Limite como jurado</label>
                        <input type="number" class="form-control" id="txtlimitj" value="<?php echo $limitj;?>" onchange="$.ajax({
                                                                            type: 'POST',
                                                                            url: 'accion.php',
                                                                            data: {
                                                                                dmn:    <?php echo $idMenut; ?>,                       
                                                                                c:      '<?php echo $codigo;?>',
                                                                                g:      $('#selgrado').val(),
                                                                                lt:     $('#txtlimittut').val(),
                                                                                lj:     $('#txtlimitj').val(),
                                                                                ver:    2,
                                                                                act:    3
                                                                            },
                                                                            success: function() {
                                                                                $.ajax({
                                                                                    type: 'POST',
                                                                                    url: 'accion.php',
                                                                                    data: {
                                                                                        dmn:    <?php echo $idMenut; ?>,
                                                                                        ver:    2
                                                                                    },
                                                                                    success: function(html) {
                                                                                      $('#page-content').html(html);
                                                                                    }
                                                                                });
                                                                            }
                                                                          }).done(function() {
                                                                            $('#txtlimitj').addClass('alert-success');                                                                                
                                                                        });">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="cerrarmodal()">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>