<div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container-fluid">
            <div class="navbar-collapse collapse in">
                <ul class="nav navbar-nav navbar-mobile">
                    <li>
                        <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
                    </li>
                    <li class="logo"> <a class="navbar-brand" href="#"><span class="highlight">TEG.</span> 1</a> </li>
                    <li>
                        <button type="button" class="navbar-toggle"> <img class="profile-img" src="./assets/images/profile.png"> </button>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left">
                    <li class="navbar-title"></li>
                    <li class="navbar-search hidden-sm">
                        <input id="search" type="text" placeholder="Buscar..">
                        <button class="btn-search"><i class="fa fa-search"></i></button>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <!-- <li class="dropdown notification warning">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="icon"><i class="fa fa-comments" aria-hidden="true"></i></div>
                            <div class="title">Unread Messages</div>
                            <div class="count">99</div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="dropdown-header">Mensajes</li>
                                <li>
                                    <a href="#"> <span class="badge badge-warning pull-right">10</span>
                                        <div class="message"> <img class="profile" src="https://placehold.it/100x100">
                                            <div class="content">
                                                <div class="title">"Payment Confirmation.."</div>
                                                <div class="description">Alan Anderson</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-footer"> <a href="#">Ver  <i class="fa fa-angle-right" aria-hidden="true"></i></a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown notification warning">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
                            <div class="title">System Notifications</div>
                            <div class="count">10</div>
                        </a>
                        <div class="dropdown-menu">
                            <ul>
                                <li class="dropdown-header">Notificationes</li>
                                <li>
                                    <a href="#"> <span class="badge badge-danger pull-right">8</span>
                                        <div class="message">
                                            <div class="content">
                                                <div class="title">New Order</div>
                                                <div class="description">$400 total</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"> <span class="badge badge-danger pull-right">14</span> Inbox </a>
                                </li>
                                <li>
                                    <a href="#"> <span class="badge badge-danger pull-right">5</span> Issues Report </a>
                                </li>
                                <li class="dropdown-footer"> <a href="#">Ver todas <i class="fa fa-angle-right" aria-hidden="true"></i></a> </li>
                            </ul>
                        </div>
                    </li>-->
                    <li class="dropdown profile">
                        <a href="/html/pages/profile.html" class="dropdown-toggle" data-toggle="dropdown"> <img class="profile-img" src="<?php echo $ruta_base;?>/assets/images/unellez.jpg">
                            <div class="title">Profile</div>
                        </a>
                        <div class="dropdown-menu">
                            <div class="profile-info">
                                <?php
                                    $persona = paraTodos::arrayConsulta("*", "persona", "per_cedula=$cedula");
                                    foreach($persona as $per){
                                        $nombre = $per[per_apellidos]." ".$per[per_nombres];
                                    }
                                ?>
                                <span class="username"><?php echo $nombre;?></span> </div>
                            <ul class="action">
                                <!--<li>
                                    <a href="#">Perfil</a>
                                </li>
                                <li>
                                    <a href="#"> <span class="badge badge-danger pull-right">5</span> Mis mensajes </a>
                                </li>
                                <li> <a href="#">Configuración</a>
                                </li>-->
                                <li> <a href="accion.php?dmn=1&salir=1">Salir</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="ventanaVer"> </div>