<?php

//require "Funciones/General.php";
session_start();
if(!isset($_SESSION['userCR'])||($_SESSION['nivelCR']<1)){
    header('Location:../index.php');
}
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestión de Alumnos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="../images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    


    <link type="text/css" rel="stylesheet" href="../styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/animate.css">
    <link type="text/css" rel="stylesheet" href="../styles/all.css">
    <link type="text/css" rel="stylesheet" href="../styles/main.css">
    <link type="text/css" rel="stylesheet" href="../styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="../styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/pace.css">
    <link type="text/css" rel="stylesheet" href="../styles/jquery.news-ticker.css">
    <link rel="stylesheet" href="../dist/sweetalert.css">
     <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
      <script src="../dist/sweetalert-dev.js"></script>
<script>
     $(document).ready(function() { 
        LoadZero();
        LoadAlertas();
        setInterval(LoadAlertas, 5000);
        $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });

       

        $("#close").click(function(e){
           window.location= 'Principal.php';

        });

        $("#search").click(function(e) {
             LoadZero();
        })

        $("#btnGuardar").click(function(e){

            var nom=$("#txtSec").val();
            var codG=$("#idGra").val();

              if(nom.length==0){
                //alert("Ingrese un nombre a la maestria");
                swal('Faltan datos','Ingrese una descripción a la maestria','info');
              }
              else{
              $.post("../Funciones/ajax.php",{modulo:0,accion:1,v1:codG,v2:nom},function(data1){

                //$("#msj").html(data1);
                var aux=parseInt(data1);
                if(aux==0){
                    swal('Error!','Sección ya existente, no se ingresó la Sección a la Base de Datos.','error');
                }
                if(aux==1){
                    swal('Exito','Nueva Sección Registrada','success');
                }
                if(aux==2){
                    swal('Error!','Error del sistema, no se ingresó la Sección a la Base de Datos.','error');
                }
                LoadData();
                $('#modal-config').modal('hide');
                $("#txtSec").val("");
                $("#inputsearch").val("");
              });
  }
        });

 $("#btnGuardarE").click(function(e){

            var nom=$("#txtSec").val();
            var codS=$("#idSec").val();
            var codG=$("#idGra").val();

              if(nom.length==0){
                //alert("Ingrese un nombre a la maestria");
                swal('Faltan datos','Ingrese una descripción a la maestria','info');
              }
              else{
              $.post("../Funciones/ajax.php",{modulo:0,accion:3,v1:codS,v2:nom,v3:codG},function(data1){

                //$("#msj").html(data1);
                var aux=parseInt(data1);
                if(aux==0){
                    swal('Error!','El nombre indicado ya existe, no se modificó la Sección.','error');
                }
                if(aux==1){
                    swal('Exito','Sección Editada','info');
                }
                if(aux==2){
                    swal('Error!','Error del sistema, no se modificó la Sección.','error');
                }
                LoadData();
                $('#modal-config').modal('hide');
                $("#txtSec").val("");
                $("#inputsearch").val("");
              });
  }
        });






     });

     function LoadZero(){
        var bus=jQuery("#inputsearch").val();
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {search: bus, modulo: '0', accion: '0'},
                        success: function(data) {
                            $('#list').html(data);

                        }
                    })
     }

     function LoadData(){
      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {search: '', modulo: '0', accion: '0'},
                        success: function(data) {
                            $('#list').html(data);

                        }
                    })
     }

     function rep1(){

       window.open('alertAlumnos.php').attr("target","_new");
     }

     function rep2(){
        window.open('alertDocentes.php').attr("target","_new");

     }

     function newS(codG,nom){
        $("#idGra").val(codG);
        $("#myModalLabel").text("Nueva Sección del "+nom+".");
        $("#btnGuardarE").hide();
        $("#btnGuardar").show();
        $('#modal-config').modal('show');
        $("#txtSec").focus();

     }

     function editS(codG,nom,cod,nom1){
        $("#idGra").val(codG);
        $("#idSec").val(cod);
        $("#myModalLabel").text("Editar la Sección del "+nom+".");
        $("#txtSec").val(nom1);
        $("#btnGuardarE").show();
        $("#btnGuardar").hide();
        $('#modal-config').modal('show');
        $("#txtSec").focus();

     }

     function delS(cod,nom){
        swal({
  title: "¿Está seguro?",
  text: "Se eliminará la Sección: "+nom,
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Eliminar",
  closeOnConfirm: false
},
function(){

  $.post("../Funciones/ajax.php",{modulo:0,accion:2,v1:cod},function(data1){

    var aux=parseInt(data1);

    if(aux==1){
      swal("", "No se puede eliminar la Sección,debido a que tiene alumnos en el presente año escolar", "error");
    }
    if(aux==2){

      swal("Eliminada!", "La Sección "+nom+" fue eliminada", "success");
        LoadData();

    }
    if(aux==3){

      swal("Eliminada!", "La Sección "+nom+" fue dada de baja", "success");
        LoadData();

    }

    if(aux==4){
      swal("", "No se puede eliminar la Sección,debido a un error en el sistema", "error");
    }
  });



  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
});
     }

     function LoadAlertas(){

        $.ajax({
                        url: '../Funciones/ajax.php',
                        type: 'POST',
                        data: {search: jQuery("#inputsearch").val(), modulo: '7', accion: '0'},
                        success: function(data) {
                            $('#alertAlu').html(data);

                        }
                    })

        $.ajax({
                        url: '../Funciones/ajax.php',
                        type: 'POST',
                        data: {search: jQuery("#inputsearch").val(), modulo: '7', accion: '1'},
                        success: function(data) {
                            $('#alertDoc').html(data);

                        }
                    })
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
                <a id="logo" href="Principal.php" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">IEP. Cristo Rey</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                
               
              
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                   

                    <li class="dropdown" id="alerta1"><a data-hover="dropdown" onclick="rep1();" href="javascript:void(0);" class="dropdown-toggle" id="alertAlu"></a>
                        
                    </li>

                    <li class="dropdown" id="alerta2"><a data-hover="dropdown" onclick="rep2();" href="javascript:void(0);" href="#" class="dropdown-toggle" id="alertDoc"></a>
                        
                    </li>


                    
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="../images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs"><?php echo $_SESSION['userCR']; ?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="micuenta.php"><i class="fa fa-user"></i>Mi Perfil</a></li>
                        
                            <li><a href="../Funciones/cerrarSesion.php"><i class="fa fa-key"></i>Cerrar Session</a></li>
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

                    <li ><a href="controlAsistencia.php"><i class="fa fa-calendar">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Control de Asistencia</span></a>
                    </li>

                    <li ><a href="controlSalida.php"><i class="fa fa-sign-out">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Control de Salida</span></a>
                    </li>

                    <li class="active" ><a href="alumnos.php"><i class="fa fa-users">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Alumnos</span></a>
                       
                    </li>
                    <li><a href="docentes.php"><i class="fa fa-user-secret">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Gestionar Docentes</span></a>

                    </li>';
                  

                  if($_SESSION['nivelCR']==1 || $_SESSION['nivelCR']==2){
                    echo '<li><a href="gesAescolar.php"><i class="fa fa-cogs">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Año Escolar</span></a> </li>';
                       
                    echo'<li><a href="gesConceptos.php"><i class="fa fa-check-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Conceptos Académicos</span></a>
                      
                    </li>';

                     echo'<li><a href="modPagos.php"><i class="fa fa-money">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Módulo de Pagos</span></a>
                      
                    </li>';
                    
                       } 
                       

                       echo'<li><a href="code2/html/Codbarras.php"><i class="fa fa-barcode">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Generar Código de Barras</span></a>
                      
                    </li>';


                    echo' <li><a href="reportes.php"><i class="fa fa-print">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Reportes</span></a>
                      
                    </li>';
                    
                    if($_SESSION['nivelCR']==1){
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
                            Módulo de Gestión de Alumnos</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-users"></i>&nbsp;<a href="alumnos.php">Alumnos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Alumnos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Alumnos</li>
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
                               
                          
                                
                                
                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close"><i class="fa fa-reply-all"></i> Salir</button>
                            </div>
                        </nav>
                       
                        <div class="panel panel-default">
                            <div class="panel-heading">Lista de Grados y Secciones</div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="inputsearch" placeholder="Grado" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="search"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                        </span>
                                    </div>
                                </div><br><br>
                                <div id="msj"></div>
                                <div class="col-lg-10" id="list">
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
                        <a href="http://themifycloud.com">2015 © IEP Cristo Rey Huaraz</a></div>
                </div>
                <!--END FOOTER-->
            </div>
            <!--END PAGE WRAPPER-->
        </div>
    </div>
    
    

          <div id="modal-config" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title" id="myModalLabel">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                              <div class="field">
          Sección: <input type="text" id="txtSec"  name="txtSec" value="" placeholder="Nombre" maxlength="45" class="login username-field span5" />
        </div>
        <input type="hidden" readonly value="0" id="idGra" >
        <input type="hidden" readonly value="0" id="idSec" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardar">
                                Guardar</button>
                                <button type="button" class="btn btn-primary" id="btnGuardarE">
                                Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
    <script src="../script/jquery-migrate-1.2.1.min.js"></script>
    <script src="../script/jquery-ui.js"></script>
    <script src="../script/bootstrap.min.js"></script>
    <script src="../script/bootstrap-hover-dropdown.js"></script>
    <script src="../script/html5shiv.js"></script>
    <script src="../script/respond.min.js"></script>
    <script src="../script/jquery.metisMenu.js"></script>
    <script src="../script/jquery.slimscroll.js"></script>
    <script src="../script/jquery.cookie.js"></script>
    <script src="../script/icheck.min.js"></script>
    <script src="../script/custom.min.js"></script>
    <script src="../script/jquery.news-ticker.js"></script>
    <script src="../script/jquery.menu.js"></script>
    <script src="../script/pace.min.js"></script>
    <script src="../script/holder.js"></script>
    <script src="../script/responsive-tabs.js"></script>
    <script src="../script/jquery.flot.js"></script>
    <script src="../script/jquery.flot.categories.js"></script>
    <script src="../script/jquery.flot.pie.js"></script>
    <script src="../script/jquery.flot.tooltip.js"></script>
    <script src="../script/jquery.flot.resize.js"></script>
    <script src="../script/jquery.flot.fillbetween.js"></script>
    <script src="../script/jquery.flot.stack.js"></script>
    <script src="../script/jquery.flot.spline.js"></script>
    <script src="../script/zabuto_calendar.min.js"></script>
    <script src="../script/index.js"></script>
    <!--LOADING SCRIPTS FOR CHARTS-->
    <script src="../script/highcharts.js"></script>
    <script src="../script/data.js"></script>
    <script src="../script/drilldown.js"></script>
    <script src="../script/exporting.js"></script>
    <script src="../script/highcharts-more.js"></script>
    <script src="../script/charts-highchart-pie.js"></script>
    <script src="../script/charts-highchart-more.js"></script>
    <!--CORE JAVASCRIPT-->
   
    <script src="../script/main.js"></script>



</body>
</html>
