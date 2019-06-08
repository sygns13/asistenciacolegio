<?php

//require "Funciones/General.php";
session_start();
if(!isset($_SESSION['user'])||($_SESSION['nivel']<1)){
    header('Location:index.php');
}
include "Funciones/configuration.php";
mysql_query("SET NAMES 'utf8'");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>GYD CONS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
     <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>

     <script>

     $(document).ready(function() {

        $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
        });


        jQuery("#close").click(function() {
            window.location = "Principal.php";
        });


        jQuery("#new").click(function(){
            if(jQuery("#dir").val().length>0 && jQuery("#clave1").val().length>0 && jQuery("#clave2").val().length>0 && jQuery("#clave1").val()==jQuery("#clave2").val()){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {id: jQuery("#idU").val(), idT: jQuery("#idT").val(), clave: jQuery("#clave1").val(), dir: jQuery("#dir").val(), telf: jQuery("#telf").val(), module: '10', action: '0'},
                        success: function(data) {
                            alert("Cuenta Actualizada");
                            window.location = "micuenta.php";
                            

                        }
                    })

                
            }
            else
            {
                alert("Las Claves deben de  Coincididir y por lo menos llene la Dirección");
            }
        }); 
         });
     </script>
       
</head>
<body>
    <div>
        <!--BEGIN THEME SETTING-->
      
        <!--END THEME SETTING-->
        <!--BEGIN BACK TO TOP-->
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <!--END BACK TO TOP-->
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="Principal.php" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">GYD CONS</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                
               
              
               <ul class="nav navbar navbar-top-links navbar-right mbn">
                    
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs"><?php echo $_SESSION['user']; ?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="micuenta.php"><i class="fa fa-user"></i>Mi Perfil</a></li>
                        
                            <li><a href="cerrar.php"><i class="fa fa-key"></i>Cerrar Session</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>
            <!--BEGIN MODAL CONFIG PORTLET-->
         
            <!--END MODAL CONFIG PORTLET-->
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
               <?php
                echo'<ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>

                    <li ><a href="Principal.php"><i class="fa fa-home">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Inicio</span></a></li>

                    <li ><a href="marca.php"><i class="fa fa-buysellads">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Marcas</span></a>
                    </li>

                    <li ><a href="categorias.php"><i class="fa fa-archive">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Categorías</span></a>
                       
                    </li>
                    <li><a href="Productos.php"><i class="fa fa-cubes">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Producto</span></a>

                    </li>';
                  

                  if($_SESSION['nivel']==1 || $_SESSION['nivel']==2){
                    echo '<li><a href="trabajadores.php"><i class="fa fa-users">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Trabajadores</span></a>';
                       } 
                    echo'</li>
                    <li><a href="proyectos.php"><i class="fa fa-gavel">
                        <div class="icon-bg bg-blue"></div>
                    </i><span class="menu-title">Proyectos</span></a>
                          
                    </li>
                    <li><a href="despachos.php"><i class="fa fa-truck">
                        <div class="icon-bg bg-red"></div>
                    </i><span class="menu-title">Despachos</span></a>
                      
                    </li>
                    <li><a href="devoluciones.php"><i class="fa fa-exchange">
                        <div class="icon-bg bg-yellow"></div>
                    </i><span class="menu-title">Devoluciones</span></a>
                    </li>
                    
                    <li><a href="proveedores.php"><i class="fa fa-user-secret">
                        <div class="icon-bg bg-dark"></div>
                    </i><span class="menu-title">Proveedores</span></a>
                      
                    </li>
                    <li><a href="compras.php"><i class="fa fa-usd">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">Compras</span></a>
                      
                    </li>';
                    
                    if($_SESSION['nivel']==1){
                        echo '<li><a href="usuarios.php"><i class="fa fa-user-plus">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Usuarios</span></a></li>';


                    }    
                echo'</ul>';
                ?>
            </div>
        </nav>
            <!--END SIDEBAR MENU-->
            <!--BEGIN CHAT FORM-->
            
            <!--END CHAT FORM-->
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Sistema de Existencia de Productos - Almacen</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="Principal.php">Inicio</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Categorias</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Categorias</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->

                <div class="page-content">
                    <div id="tab-general">
                         <div id="sum_box" class="row mbl">

                          <form>
                        <nav class="navbar navbar-inverse navbar-foxid" role="navigation">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                    <span class="sr-only">Desplegar navegación</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse navbar-ex1-collapse">
                                <button type="button" class="btn btn-primary btn-ms" id="new"> <i class="fa fa-floppy-o"></i> Grabar</button>
                               
                                <button type="reset" class="btn btn-info btn-ms" id="cancel"><i class="fa fa-undo"></i> Limpiar</button>
                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close"><i class="fa fa-reply-all"></i> Salir</button>
                            </div>
                        </nav>
                        <div id="msj"></div>
                        <input type="hidden" id="id" value="">
                        <div class="panel panel-default">
                            <div class="panel-heading">Mantenimiento de mi Perfil</div>
                            <div class="panel-body">
                                <?php

                                        $sql="select u.idUsuario , concat(t.nombres,' ',t.apellidos), u.usuario,u.nivel , tt.cargo, t.dni, t.telefono,t.direccion, t.idtrabajador
                                            from usuario u
                                            inner join trabajador t on t.idtrabajador=u.idtrabajador
                                            inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador
                                            where idUsuario='".$_SESSION['id']."';";

                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'
                                            <input type="hidden" value="'.$row[0].'" id="idU">
                                            <input type="hidden" value="'.$row[8].'" id="idT">
                                            <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Nombre:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm" disabled="true" value="'.$row[1].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="nom">
                                    </div>
                                </div><br><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Id de Usuario:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm" disabled="true" value="'.$row[2].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="nom">
                                    </div>
                                </div><br><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Nivel de Acceso:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm" disabled="true" value="'.$row[3].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="nom">
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Cargo:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm"  disabled="true" value="'.$row[4].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="nom">
                                    </div>
                                </div><br><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">DNI:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm" disabled="true" value="'.$row[5].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="nom">
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Teléfono:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm"   value="'.$row[6].'"style="border: solid 1px;color: rgb(102, 101, 110);" id="telf" name="telf">
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Dirección:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="text" class="form-control input-sm" value="'.$row[7].'" style="border: solid 1px;color: rgb(102, 101, 110);" id="dir" name="dir">
                                    </div>
                                </div><br><br>

                                            ';

                                         }

                                        ?>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Password:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="password" class="form-control input-sm" style="border: solid 1px;color: rgb(102, 101, 110);" id="clave1" name="clave1">
                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Repita su Password:</label>
                                    <div class="col-lg-5" id="inp">
                                        <input type="password" class="form-control input-sm" style="border: solid 1px;color: rgb(102, 101, 110);" id="clave2" name="clave2">
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </form>

                   
                        </div>
                </div>
                <!--END CONTENT-->
                <!--BEGIN FOOTER-->
                <div id="footer">
                    <div class="copyright">
                        <a href="http://themifycloud.com">2015 © Edwin Ivan Malpaso Huaromo</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    
    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script src="script/bootstrap.min.js"></script>
    <script src="script/bootstrap-hover-dropdown.js"></script>
    <script src="script/html5shiv.js"></script>
    <script src="script/respond.min.js"></script>
    <script src="script/jquery.metisMenu.js"></script>
    <script src="script/jquery.slimscroll.js"></script>
    <script src="script/jquery.cookie.js"></script>
    <script src="script/icheck.min.js"></script>
    <script src="script/custom.min.js"></script>
    <script src="script/jquery.news-ticker.js"></script>
    <script src="script/jquery.menu.js"></script>
    <script src="script/pace.min.js"></script>
    <script src="script/holder.js"></script>
    <script src="script/responsive-tabs.js"></script>
    <script src="script/jquery.flot.js"></script>
    <script src="script/jquery.flot.categories.js"></script>
    <script src="script/jquery.flot.pie.js"></script>
    <script src="script/jquery.flot.tooltip.js"></script>
    <script src="script/jquery.flot.resize.js"></script>
    <script src="script/jquery.flot.fillbetween.js"></script>
    <script src="script/jquery.flot.stack.js"></script>
    <script src="script/jquery.flot.spline.js"></script>
    <script src="script/zabuto_calendar.min.js"></script>
    <script src="script/index.js"></script>
    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="script/highcharts.js"></script>
    <script src="script/data.js"></script>
    <script src="script/drilldown.js"></script>
    <script src="script/exporting.js"></script>
    <script src="script/highcharts-more.js"></script>
    <script src="script/charts-highchart-pie.js"></script>
    <script src="script/charts-highchart-more.js"></script>
    <!--CORE JAVASCRIPT-->
    <script src="script/main.js"></script>
    
</body>
</html>
