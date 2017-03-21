<div class="container-fluid">
    <div class="form-group">
        <div class="card">
            <div class="card-header"> Docentes registrados </div>
            <div class="card-body no-padding">
                <table class="datatable table table-striped primary" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Grado</th>
                            <th>Lim. Tut.</th>
                            <th>Lim. Jur.</th>
                            <th>Asignar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $consuluser = paraTodos::arrayConsulta("*", "perfiles pf, persona p left join docente d on d.doc_cedula=p.per_cedula left join persona_grado pg on pg.perg_codigo=d.doc_grado", "p.per_tipo=pf.CodPerfil and CodPerfil=4");
                                foreach($consuluser as $user){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $user[per_cedula]?>
                                </td>
                                <td>
                                    <?php echo $user[per_nombres]?>
                                </td>
                                <td>
                                    <?php echo $user[per_apellidos]?>
                                </td>
                                <td>
                                    <?php echo $user[perg_descripcion]?>
                                </td>
                                <td>
                                    <?php echo $user[doc_limtutot]?>
                                </td>
                                <td>
                                    <?php echo $user[doc_limjurado]?>
                                </td>
                                <td><a href="javascript:void(0)" onclick="$.ajax({
                                                                            type: 'POST',
                                                                            url: 'accion.php',
                                                                            data: {
                                                                                dmn:    <?php echo $idMenut; ?>,
                                                                                c:      '<?php echo $user[per_cedula]?>',
                                                                                editar: 1,
                                                                                ver:    2,
                                                                                act:    2,
                                                                            },
                                                                            ajaxSend: $('#ventanaVer').html(cargando),                                                    
                                                                            success: function(html) { $('#ventanaVer').html(html); }
                                                                          });"><i class="fa fa-edit"></i></a></td>
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
    $(".datatable").DataTable({
        "scrollX": true
    });
</script>