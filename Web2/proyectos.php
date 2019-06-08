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
    <
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
        $("#edit2").hide();

        $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
        });

        LoadData();
        jQuery("#inputsearch").keyup(function(){
            LoadData();
        }); 

         jQuery("#close").click(function() {
            window.location = "Principal.php";
        });

        jQuery("#cancel").click(function() {
            limpiar();
        });

        jQuery("#new").click(function(){
            if(jQuery("#trab").val()>0 && jQuery("#proyecto").val().length>0 && jQuery("#presu").val().length>0 && jQuery("#estado").val().length>0 && jQuery("#fecini").val().length>0 && jQuery("#fecfin").val().length>0){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {trab: jQuery("#trab").val(), proy: jQuery("#proyecto").val(), presu: jQuery("#presu").val(), estado: jQuery("#estado").val(), fecini: jQuery("#fecini").val(), fecfin: jQuery("#fecfin").val(), module: '4', action: '2'},
                        success: function(data) {
                            $('#msj').html(data);
                            limpiar();
                            

                        }
                    })

                
            }
            else
            {
                alert("Llene Completamente el Formulario");
            }
        }); 

        jQuery("#delete").click(function() {
           

            var item= new Array();
                         var cont=0;
                        $(jQuery("#idproy:checked").each(function(){
                        item.push($(this).val());
                        cont=cont+1;
                        }));
                        if (cont==0){
                            alert("Seleccione al menos un Proyecto");
                        }
                            else{

                                if (confirm("Realmente desea eliminar el proyecto(s) Seleccionados")){

                                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {search: jQuery("#inputsearch").val(), module: '4', action: '-1'},
                        success: function(data) {
                           
                         $.each(item,function(index,contenido){
                            //alert(contenido);
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: {idproy: (contenido), module: '4', action: '1'},
                            success: function(data) {
                                           LoadData();
                                           limpiar();             
                                },

                                });
                            });

                        },
                        complete: function(){
                            LoadData();
                            limpiar(); 
                            //alert("Eliminados");
                        },

                                    })
                                    }}
                                    
                        });


        jQuery("#edit").click(function(){
            var item= new Array();
                        $(jQuery("#idproy:checked").each(function(){
                        item.push($(this).val());
                        }));
                        var aux=0;

                        $.each(item,function(index,contenido){
                            aux=aux+1;
                        });

                        if (aux==0){
                            alert("Seleccione una alternativa a editar");



                        }
                        if (aux>1){
                            alert("Solo seleccione una alternativa a editar");


                        }

                        if (aux==1){
                            $.each(item,function(index,contenido){
                                jQuery("#id").val(contenido);

                                $.ajax({
                                url: 'Ajax/Ajax.php',
                                type: 'POST',
                                data: {id: jQuery("#id").val(), module: '4', action: '3'},
                                success: function(data) {
                                    //$('#tabla').html(data);
                                    $("#formu").html(data);
                                    $("#edit").hide();
                                    $("#edit2").show();

                        }
                    })

                                
                                
                             });
                                
                             
                        }
        }); 

        jQuery("#edit2").click(function(){
            if(jQuery("#trab").val()>0 && jQuery("#proyecto").val().length>0 && jQuery("#presu").val().length>0 && jQuery("#estado").val().length>0 && jQuery("#fecini").val().length>0 && jQuery("#fecfin").val().length>0){


                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {id: jQuery("#id").val(), trab: jQuery("#trab").val(), proy: jQuery("#proyecto").val(), presu: jQuery("#presu").val(), estado: jQuery("#estado").val(), fecini: jQuery("#fecini").val(), fecfin: jQuery("#fecfin").val(), module: '4', action: '4'},
                        success: function(data) {
                            $('#msj').html(data);
                            limpiar();
                            

                        }
                    })

                
            }
            else
            {
                alert("Llene Completamente el formulario");
            }
        }); 


});

    function LoadData() {
                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {search: jQuery("#inputsearch").val(), module: '4', action: '0'},
                        success: function(data) {
                            $('#tabla').html(data);

                        }
                    })
                }
    function limpiar(){
        jQuery("#inputsearch").val("");
        jQuery("#trab").val('');
        jQuery("#proyecto").val("");
        jQuery("#presu").val("");
        jQuery("#estado").val("");
        jQuery("#fecini").val("");
        jQuery("#fecfin").val("");
        jQuery("#id").val("");
            
            LoadData();
            $("#edit").show();
            $("#edit2").hide();
            $("#id").val("");
    }

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
                    <li class="active"><a href="proyectos.php"><i class="fa fa-gavel">
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
                        <li class="hidden"><a href="#">Proyectos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Proyectos</li>
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
                                <button type="button" class="btn btn-success  btn-ms" id="edit"><i class="fa fa-pencil-square-o"></i> Editar</button>
                                <button type="button" class="btn btn-success  btn-ms" id="edit2"><i class="fa fa-pencil-square-o"></i> Grabar</button>
                                <button type="button" class="btn btn-danger btn-ms" id="delete"><i class="fa fa-eraser"></i> Eliminar</button>
                                <button type="button" class="btn btn-info btn-ms" id="cancel"><i class="fa fa-undo"></i> Limpiar</button>
                                
                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close"><i class="fa fa-reply-all"></i> Salir</button>
                            </div>
                        </nav>
                        <div id="msj"></div>
                        <input type="hidden" id="id" value="">
                        <div class="panel panel-default">
                            <div class="panel-heading">Mantenimiento de Productos</div>
                            <div class="panel-body">
                               
                               <div id="formu">
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Trabajador Responsable:</label>
                                    <div class="col-lg-5"><select id="trab" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="1">Seleccione...</option>

                                        <?php

                                        $sql="select t.idTrabajador,concat(t.nombres,' ',t.apellidos,'-',tt.cargo)
                                        from trabajador t
                                        inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        ?>


                                    </select>
                                    </div>
                                </div><br><br><br>
                                
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Nombre Proyecto:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="proyecto" placeholder="Nombre" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>


                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Presupuesto:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="presu" placeholder="00.00" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Estado:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="estado" placeholder="Estado" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Fecha Inicial:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="fecini" placeholder="dd/mm/aaaa" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div><br><br>
                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Fecha Final:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="fecfin" placeholder="dd/mm/aaaa" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div>

                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Catalogo de Proyectos</div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="inputsearch" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" disabled="true" type="button" id="search"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                        </span>
                                    </div>
                                </div><br><br>
                                <div class="col-lg-10" id="list">
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="tabla"></div>
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