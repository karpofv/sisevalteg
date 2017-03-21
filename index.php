<?php
include_once 'includes/layout/headp.php';
require 'includes/conf/general_parameters.php';
ini_set('display_errors', false);
ini_set('display_startup_errors', false);
if ($_GET[logaut] == '1') {
  session_cache_limiter('nocache,private');
  session_name($sess_name);
  session_start();
  $sid = session_id();
  session_destroy();
}
?>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" id="divlogin">
		<form action="index2.php" class="form form-horizontal" id="frmacceso" method="post" enctype="multipart/form-data">    
                               <!-- notificacion de error -->
                                <?php if (isset($_GET['error_login'])) {
        $error = $_GET['error_login']; ?>
                                    <div class="alert-danger" id="alerta-msg"> <a class="close" data-dismiss="alert">&times;</a> <strong>Accion!</strong>
                                        <?php echo $error_login_ms[$error]; ?>
                                    </div>
                                    <?php
                    }
?>            
			<div class="panel panel-default" id="panellog">
  				<div class="panel-heading">Iniciar Sesión</div>
  				<div class="panel-body" id="bodylog">
					<input type="text" class="form-control inputlog" name="user" placeholder="Ingrese su usuario" id="user" required>
					<input type="password" class="form-control inputlog" name="pass" placeholder="Contraseña" id="pass" required>
		  		</div>
 				<div class="panel-footer">
					<button type="submit" class="btn btn-default" id="btnacclog">INGRESAR</button>
 				</div>  			
			</div>  	             	
		</form>
    </div>
    <?php
include_once("includes/layout/foot.php");
?>