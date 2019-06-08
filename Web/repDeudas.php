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
    <title>Reporte de Deudas de Alumnos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="../images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/icons/favicon-114x114.png">
    <!--Loading bootstrap css-->
    


 
    <link type="text/css" rel="stylesheet" href="../styles/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="../css/datepicker.css">

           <link type="text/css" rel="stylesheet" href="../styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/animate.css">
    <link type="text/css" rel="stylesheet" href="../styles/all.css">
    <link type="text/css" rel="stylesheet" href="../styles/main.css">
    <link type="text/css" rel="stylesheet" href="../styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="../styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/pace.css">
    <link type="text/css" rel="stylesheet" href="../styles/jquery.news-ticker.css">
    <link rel="stylesheet" href="../dist/sweetalert.css">
    
     <script src="../js/jquery-1.7.2.min.js"></script> 

<style type="text/css">
    
.fila td{
    padding: 4px;
}




</style>
<style type="text/css" media="print">
@media print {
#header-topbar-option-demo {display:none;}
#sidebar {display:none;}

#title-breadcrumb-option-demo {display:none;}
#idol {display:none;}
#sacar1 {display:none;}
#sacar2 {display:none;}

#sacar3 {display:none;}

#sacar4 {display:none;}

#sacar5 {display:none;}
#footer {display:none;}

}
</style>

<script>
$(document).ready(function() {

    //LoadAlertas();
    //setInterval(LoadAlertas, 5000);

    $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });

$("#close").click(function(e){
           window.location= 'reportesE.php';

        });

LoadData();

$("#impRel").click(function(e){
    var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();



    window.open('impDeudas.php?v='+Grado+'&v1='+selFec+'&v2='+per+'&v3='+selSec+'&v4='+feci+'&v5='+fecf,' _blank');
});

$("#selGra").change(function() {

    var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    if(Grado==0){

        $("#divsec").hide();
        $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:0,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });

    }

    else{

        $.post("../Funciones/Ajax.php",{modulo:4,accion:3,v:Grado},function(data){
            $("#selSec").html(data);
            $("#divsec").show();
        

        }).always(function() {
            $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:0,v4:feci,v5:fecf},function(data1){
                        $('#list').html(data1);
            });
        });   

    }

    

});



$("#fec1").datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight: true,
    language: 'es',
    
    
      });
$("#fec2").datepicker({
    format: 'dd/mm/yyyy',
    todayHighlight: true,
    language: 'es',
    
      });





$("#selSec").change(function() {
    var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });


});

$("#txtper").keyup(function() {

    var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });

});



$("#selFec").change(function() {

    var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    if(selFec<4){

        $("#divfec").hide();
        $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });

    }

    else{
            
            $("#divfec").show();
        
 $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });
        

    }

    

});


$("#fec1").change(function(){
var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    if(selFec<4){

        $("#divfec").hide();
        $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });

    }

    else{
            
            $("#divfec").show();
        
 $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });
        

    }

});

$("#fec2").change(function(){
var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

   var per=$("#txtper").val();

    var selSec=parseInt($("#selSec").val());
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();


    if(selFec<4){

        $("#divfec").hide();
        $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });

    }

    else{
            
            $("#divfec").show();
        
 $.post("../Funciones/Ajax.php",{modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},function(data1){
                $('#list').html(data1);
        });
        

    }
    
});







     });

function rep1(){

       window.open('alertAlumnos.php').attr("target","_new");
     }

     function rep2(){
        window.open('alertDocentes.php').attr("target","_new");

     }

function LoadData(){
     var Grado=parseInt($("#selGra").val());

    var selFec=parseInt($("#selFec").val());

    var per=$("#txtper").val();

    var selSec=0;
    //alert(Grado);
    var feci=$("#fec1").val();
    var fecf=$("#fec2").val();
      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {modulo:10,accion:2,v:Grado,v1:selFec,v2:per,v3:selSec,v4:feci,v5:fecf},
                        success: function(data) {
                            $('#list').html(data);

                        }
                    })
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

     function detFalta(idper,fec,alum,dni,grado,sec,fec2){

        $("#txtAlu").val(alum);
        $("#txtDni").val(dni);
        $("#txtGrado").val(grado);
        $("#txtSec").val(sec);

        $("#myModalLabel").text('Inasistencia Justificada de Fecha: '+fec2);
       // $('#modal-config').modal('show');
        //alert(idper+" - "+fec);
        $.post("../Funciones/Ajax.php",{modulo:4,accion:2,v:idper,v1:fec},function(data){

            $("#txtmotivo").val(data.motivo);
            $("#idAsis").val(data.idDia);
        

         },"json").always(function() { 
        $('#modal-config').modal('show');
  });
     }

     function noEscribe(e){
  var key = window.Event ? e.which : e.keyCode
  return (key==null);
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

                    <li ><a href="alumnos.php"><i class="fa fa-users">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Alumnos</span></a>
                       
                    </li>
                    <li ><a href="docentes.php"><i class="fa fa-user-secret">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Gestionar Docentes</span></a>

                    </li>';
                  

                  if($_SESSION['nivelCR']==1 || $_SESSION['nivelCR']==2){
                    echo '<li><a href="gesAescolar.php"><i class="fa fa-cogs">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Año Escolar</span></a></li>';

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


                    echo'<li ><a href="reportes.php"><i class="fa fa-print">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Reportes</span></a>
                      
                    </li>';
                    
                    echo' <li class="active"><a href="reportesE.php"><i class="fa fa-bar-chart">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Reportes Económicos</span></a>
                      
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
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb" >
                    <div class="page-header pull-left">
                        <div class="page-title">
                            Módulo de Reportes de Deudas de Pagos</div>
                            
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right" id="idol">
                        <li><i class="fa fa-list"></i>&nbsp;<a href="reportesE.php">Reportes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Reportes de Deudas de Pagos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Reportes de Deudas de Pagos</li>
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
                        <nav class="navbar navbar-inverse navbar-foxid" role="navigation" id="sacar1">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                    <span class="sr-only">Desplegar navegación</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse navbar-ex1-collapse">
                                <button type="button" class="btn btn-primary btn-ms" id="impRel"> <i class="fa fa-print"></i> Imprimir</button>
                          
                                
                                
                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close"><i class="fa fa-reply-all"></i> Atrás</button>
                            </div>
                        </nav>
                         <div class="panel panel-default">
                            <div class="panel-heading" >Reporte de Alumnos</div>
                            <div class="panel-body">
                                <div class="row" id="sacar3">
                                <div class="col-lg-6">

                                <h4 class="box-heading" style="font-weight: bold;font-family: 'Oswald'; margin-bottom: 15px;font-size: 20px;">Filtrar por:</h4>
                                </div>
                                </div>
                                <div class="row" id="sacar4">
                                <div class="col-lg-3" style="display:none;">
                                 <div class="content-theme-setting" style="margin-bottom: 15px;">Grado:
                <select id="selGra" class="form-control" style="width: 100%;">
                <option value="0">Todos</option>
                <?php
                $sql="select * FROM grado g where estado='Activo';";
                $res=mysql_query($sql) or die("error");
                while($row=mysql_fetch_array($res)){
                    echo'<option value="'.$row[0].'">'.$row[1].'</option>';
                }

                ?>
                </select>
            </div>
                <div id="divsec" style="display:none">
                    
                      <div class="content-theme-setting" style="margin-bottom: 15px;">Sección:
                <select id="selSec" class="form-control" style="width: 100%;">
                <option value="0">Todas</option>
                
                </select>
            </div>
                </div>
                </div>

                <div class="col-lg-4">
                                 <div class="content-theme-setting" style="margin-bottom: 15px;">Fecha:
                <select id="selFec" class="form-control" style="width: 70%;">

                <option value="3">Siempre</option>
                <option value="4">Rango de Fecha</option>
                
                </select>
            </div>
                <div id="divfec" style="display:none">
                    
                      <div class="content-theme-setting" style="margin-bottom: 15px;">Rango de Fecha:<br>
                <div style="display: inline-block">
                <?php
                $todayh = getdate(); 
                        $d = $todayh['mday'];
                        $m = $todayh['mon'];
                        $y = $todayh['year'];

                $fecha=$d."/".$m."/".$y;

                echo'Desde: <input type="text" id="fec1" placeholder="dd/mm/aaaa" style="display: inline-block;
                    height: 34px;font-size: 12px;line-height: 1.5; width: 27%;" onKeyPress="return noEscribe(event);" value="'.$fecha.'">
                    Hasta: <input type="text" id="fec2"  placeholder="dd/mm/aaaa" style=" display: inline-block;
                    height: 34px;font-size: 12px;line-height: 1.5; width: 27%;" onKeyPress="return noEscribe(event);" value="'.$fecha.'">';

                ?>
                    
                </div>
            </div>
                </div>
                </div>

                <div class="col-lg-3">
                                 <div class="content-theme-setting" style="margin-bottom: 15px;">

                                    Alumno:
                
                <input type="text" id="txtper" placeholder="DNI, apellidos o nombres del Alumno" class="form-control" style="width:100%;">
            </div>
                
                </div>


                </div>

<div id="sacar2"><br><hr></div>
                                
                                <div id="msj"></div>
                                <div class="col-lg-12" id="list">

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
                                Inasistencia Justificada de Fecha: dd/mm/aaaa</h4>
                        </div>
                        <div class="modal-body">
                              <div class="field">
                              <table class="fila" style="width:100%;">
      <tr><td>Alumno :</td>
      <td><input readonly type="text" id="txtAlu"  name="txtAlu" value="" placeholder="Nombre" maxlength="150" class="form-control" style="display:inline;" /></td></tr>
      <tr><td>DNI : </td>  
      <td> <input readonly type="text" id="txtDni"  name="txtDni" value="" placeholder="########" maxlength="8" class="form-control"  style="width:50%;"/></td></tr>
      <tr><td> Grado : </td>   
        <td><input readonly type="text" id="txtGrado"  name="txtGrado" value="" placeholder="Grado" maxlength="50" class="form-control" style="width:50%;"/></td></tr>
         <tr><td> Sección :</td>  
         <td> <input readonly type="text" id="txtSec"  name="txtSec" value="" placeholder="Seccion" maxlength="50" class="form-control" style="width:50%;" /></td></tr>
          
         <tr>
             <td colspan="2">
                 Motivo:
                 <textarea readonly id="txtmotivo" class="form-control" style="height:100px;" >
                     
                 </textarea>
             </td>

         </tr>

          </table>
        </div>
        <input type="hidden" readonly value="0" id="idAsis" >

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnImprimir2" style="display:none">
                                Imprimir</button>
                                
                        </div>
                    </div>
                </div>
            </div>
   
    <script src="../script/jquery-migrate-1.2.1.min.js"></script>
    <script src="../script/jquery-ui.js"></script>
    <script src="../js/bootstrap.js"></script>
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
    <script src="../dist/sweetalert-dev.js"></script>
    <script src="../script/main.js"></script>
    
    <script src="../js/bootstrap-datepicker.js" type="text/javascript"></script>


</body>
</html>
