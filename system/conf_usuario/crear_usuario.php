<?php
	$cedula = $_POST[cedula];
	$nombre = utf8_encode($_POST[nombre]);
	$apellido = utf8_encode($_POST[apellido]);
	$eliminar = $_POST[eliminar];
	$editar = $_POST[editar];
	$insertar = $_POST[insertar];
	/*GUARDAR*/
	if ($insertar=='1'){
		$consul = paraTodos::arrayConsultanum("cedula", "registrados", "cedula=$cedula");
		$consulu = paraTodos::arrayConsultanum("CEDULA", "asoc", "CEDULA='$cedula'");
		if ($consul>0 and $consulu>0){
			paraTodos::showMsg("Esta persona ya se encuentra registrada", "alert-danger");
		} else{
			paraTodos::arrayInserte("cedula, Nombres, Apellidos", "registrados", "$cedula, '$nombre', '$apellido'");
		}
	}
	/*MOSTRAR*/
	if($editar == 1 and $nombre ==""){
		$validaasoc = paraTodos::arrayConsultanum("*", "asoc a", "a.CEDULA='$cedula'");
		if ($validaasoc>0){
			paraTodos::showMsg("No puede modificar estos datos de un asociado", "alert-danger");
			$cedula = "";
		} else {
			$consulta = paraTodos::arrayConsulta("*", "registrados u", "u.cedula=$cedula");
			foreach($consulta as $row){
				$nombre = $row[Nombres];
				$apellido = $row[Apellidos];
			}
		}
	}
	/*UPDATE*/
	if($editar == 1 and $nombre !=""){
		paraTodos::arrayUpdate("cedula=$cedula, Nombres='$nombre', Apellidos='$apellido'", "registrados", "cedula=$cedula");
	}
	/*ELIMINAR*/
	if ($eliminar !=''){
		paraTodos::arrayDelete("Cedula=$cedula", "usuarios");
		paraTodos::arrayDelete("cedula=$cedula", "registrados");
	}
?>
    <div class="content">
        <div>
            <div class="page-header-title">
                <h4 class="page-title">Usuarios</h4> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4 class="m-b-30 m-t-0">Administrar usuarios</h4>
                                <div class="row">
                                    <form class="form-horizontal">
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-1 control-label" for="cedula">Cédula</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="cedula" type="number" value="<?php echo $cedula; ?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-1 control-label" for="nombre">Nombres</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="nombre" type="text" value="<?php echo $nombre;?>"> </div>
                                        </div>
                                        <div class="form-group" style="display: block;">
                                            <label class="col-sm-1 control-label" for="apellido">Apellidos</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="apellido" type="text" value="<?php echo $apellido;?>"> </div>
                                        </div>
                                        <div class="box-footer">
                                            <input id="enviar" type="button" value="Guardar" class="btn btn-primary col-md-offset-5" onclick="
<?php
						if($editar==""){
?>
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									cedula 	: $('#cedula').val(),
									nombre 	: $('#nombre').val(),
									apellido: $('#apellido').val(),
									insertar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#cedula').val('');
									$('#nombre').val('');
									$('#apellido').val('');
								},
							}); return false;
<?php
						} else {
?>
                            $.ajax({
								url:'accion.php',
								type:'POST',
								data:{
									dmn 	: <?php echo $idMenut;?>,
									cedula 	: $('#cedula').val(),
									nombre 	: $('#nombre').val(),
									apellido: $('#apellido').val(),
									editar: 1,
									ver 	: 2
								},
								success : function (html) {
									$('#page-content').html(html);
									$('#cedula').val('');
									$('#nombre').val('');
									$('#apellido').val('');
								},
							}); return false;
<?php
					}
?>
                   "> </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <table class="table table-hover" id="usuarios">
                                        <thead>
                                            <tr>
                                                <td class="text-center"><strong>Cédula</strong></td>
                                                <td class="text-center"><strong>Nombre y Apellido</strong></td>
                                                <td class="text-center"><strong>Usuario</strong></td>
                                                <td class="text-center"><strong>Editar</strong></td>
                                                <td class="text-center"><strong>Eliminar</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
								            $consulsol = paraTodos::arrayConsulta("r.CEDULA, r.Nombres, r.Apellidos, u.Usuario", "registrados r left join usuarios u on u.Cedula=r.cedula", "r.CEDULA not in(select CEDULA FROM asoc)");
								            foreach($consulsol as $row){
?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php echo $row[CEDULA];?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo utf8_decode($row[Nombres]." ".$row[Apellidos]);?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo utf8_decode($row[Usuario]);?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            cedula 	: <?php echo $row[CEDULA];?>,
                                                            editar 	: 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-edit"></i>
									               </a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.ajax({
                                                        url:'accion.php',
                                                        type:'POST',
                                                        data:{
                                                            dmn 	: <?php echo $idMenut;?>,
                                                            cedula 	: <?php echo $row[CEDULA];?>,
                                                            eliminar : 1,
                                                            ver 	: 2
                                                        },
                                                        success : function (html) {
                                                            $('#page-content').html(html);
                                                        },
                                                    }); return false;"><i class="fa fa-eraser"></i>
									               </a>
                                                </td>
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
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#usuarios').DataTable({
            "language": {
                "url": "<?php echo $ruta_base;?>assets/js/Spanish.json"
            }
        });
    </script>
