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
        $("#edit2").hide();
        $("#formu0").hide();

        $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
        });

        LoadData();LoadData2();LoadData3();
        jQuery("#categoria").focus();

        jQuery("#inputsearch").keyup(function(){
            LoadData();
        }); 

        jQuery("#close").click(function() {
            window.location = "Principal.php";
        });

        jQuery("#cancel").click(function() {
            limpiar();
            LoadData();
        });

        jQuery("#delete").click(function() {
            jQuery("#inputsearch").val("");
            jQuery("#marca").val("");
            $("#edit").show();
            $("#edit2").hide();
            $("#id").val("");

            var item= new Array();
                         var cont=0;
                        $(jQuery("#idprod:checked").each(function(){
                        item.push($(this).val());
                        cont=cont+1;
                        }));
                        if (cont==0){
                            alert("Seleccione al menos un Producto");
                        }
                            else{

                                if (confirm("Realmente desea eliminar el Producto(s) Seleccionado")){

                                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: { module: '1', action: '-1'},
                        success: function(data) {
                           
                         $.each(item,function(index,contenido){
                            //alert(contenido);
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: {idprod: (contenido), module: '2', action: '1'},
                            success: function(data) {
                                           LoadData();             
                                },

                                });
                            });

                        },
                        complete: function(){
                            LoadData();
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: { module: '2', action: '12'},
                            success: function(data) {
                                $('#selP').html(data);
                                   }
                        })
                            //alert("Eliminados");
                        },

                                    })
                                    }}
                                    
            });


            jQuery("#new").click(function(){

            if(jQuery("#producto").val().length>0 && jQuery("#stock").val().length>0 && jQuery("#stockmin").val().length>0 && jQuery("#stockmax").val().length>0 && jQuery("#costo").val().length>0 && jQuery("#marca").val()>0 && jQuery("#categoria").val()>0){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {producto: jQuery("#producto").val(), stock: jQuery("#stock").val(), smin: jQuery("#stockmin").val(), smax: jQuery("#stockmax").val(), costo: jQuery("#costo").val(), marca: jQuery("#marca").val(), cat: jQuery("#categoria").val(), module: '2', action: '2'},
                        success: function(data) {
                            $('#msj').html(data);
                            limpiar();
                            

                        }
                    })

                
            }
            else
                {
                alert("Complete Correctamente todos los datos del producto");
                }
            }); 

            jQuery("#edit").click(function(){
            var item= new Array();
                        $(jQuery("#idprod:checked").each(function(){
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
                                data: {id: jQuery("#id").val(), module: '2', action: '3'},
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
            if(jQuery("#producto").val().length>0 && jQuery("#stock").val().length>0 && jQuery("#stockmin").val().length>0 && jQuery("#stockmax").val().length>0 && jQuery("#costo").val().length>0 && jQuery("#marca").val()>0 && jQuery("#categoria").val()>0){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {id: jQuery("#id").val(), producto: jQuery("#producto").val(), stock: jQuery("#stock").val(), smin: jQuery("#stockmin").val(), smax: jQuery("#stockmax").val(), costo: jQuery("#costo").val(), marca: jQuery("#marca").val(), cat: jQuery("#categoria").val(), module: '2', action: '4'},
                        success: function(data) {
                            $('#msj').html(data);
                            limpiar();
                            LoadData();
                            

                        }
                    })

                
            }
            else
                {
                alert("Complete Correctamente todos los datos del producto");
                }
        }); 

        jQuery("#unit").click(function() {
            $("#formu0").toggle();
            LoadData2();
        });

        jQuery("#closeU").click(function() {
            $("#formu0").hide();
        });


        jQuery("#grab").click(function(){

            if(jQuery("#costoE").val().length>0   && jQuery("#lispro").val()>0 && jQuery("#lisuni").val()>0){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {costo: jQuery("#costoE").val(), prod: jQuery("#lispro").val(), unid: jQuery("#lisuni").val(), module: '2', action: '6'},
                        success: function(data) {
                            $('#msj2').html(data);
                            LoadData2();
                            limpiar2();
                            

                        }
                    })

                
            }
            else
                {
                alert("Complete Correctamente todos los datos del producto");
                }
            }); 


            jQuery("#deleteU").click(function() {
                jQuery("#lispro").val('');
                jQuery("#lisuni").val('');
                jQuery("#costoE").val("");
                $("#id2").val("");


            var item= new Array();
                         var cont=0;
                        $(jQuery("#idpu:checked").each(function(){
                        item.push($(this).val());
                        cont=cont+1;
                        }));
                        if (cont==0){
                            alert("Seleccione al menos una Asignación");
                        }
                            else{

                                if (confirm("Realmente desea eliminar la asignación del Producto(s) Seleccionado")){

                                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: { module: '1', action: '-1'},
                        success: function(data) {
                           
                         $.each(item,function(index,contenido){
                            //alert(contenido);
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: {idprodu: (contenido), module: '2', action: '7'},
                            success: function(data) {
                                           LoadData2();             
                                },

                                });
                            });

                        },
                        complete: function(){
                            LoadData2();
                            //alert("Eliminados");
                        },

                                    })
                                    }}
                                    
        });

        
        jQuery("#newU").click(function(){

            $(".modal").toggle();

        });

        jQuery("#grabU").click(function(){
            if(jQuery("#nunid").val().length>0 && jQuery("#cantunid").val().length>0){

                 $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {nombre: jQuery("#nunid").val(), cant: jQuery("#cantunid").val(), module: '2', action: '9'},
                        success: function(data) {
                            $('#msj3').html(data);
                            limpiar3();
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: { module: '2', action: '10'},
                            success: function(data) {
                                $('#selU').html(data);
                                   }
                        })
                            

                        }
                    })

                
            }
            else
            {
                alert("Llene los datos completos de la Unidad");
            }
            

        });

        jQuery("#deleteUni").click(function() {
                jQuery("#nunid").val("");
                jQuery("#cantunid").val("");

            var item= new Array();
                         var cont=0;
                        $(jQuery("#idunid:checked").each(function(){
                        item.push($(this).val());
                        cont=cont+1;
                        }));
                        if (cont==0){
                            alert("Seleccione al menos una Unidad");
                        }
                            else{

                                if (confirm("Realmente desea eliminar la Unidad(s) Seleccionado")){

                                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: { module: '1', action: '-1'},
                        success: function(data) {
                           
                         $.each(item,function(index,contenido){
                            //alert(contenido);
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: {idunid: (contenido), module: '2', action: '11'},
                            success: function(data) {
                                           LoadData3();  
                                           $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: { module: '2', action: '10'},
                            success: function(data) {
                                $('#selU').html(data);
                                   }
                            })           
                                },

                                });
                            });

                        },
                        complete: function(){
                            LoadData3();
                            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: { module: '2', action: '10'},
                            success: function(data) {
                                $('#selU').html(data);
                                   }
                        })
                            //alert("Eliminados");
                        },

                                    })
                                    }}
                                    
        });

    });
    function LoadData() {
                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {search: jQuery("#inputsearch").val(), module: '2', action: '0'},
                        success: function(data) {
                            $('#tabla').html(data);

                        }
                    })
                }

    function LoadData2() {
                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {module: '2', action: '5'},
                        success: function(data) {
                            $('#tabUnid').html(data);

                        }
                    })
                }
    function LoadData3() {
                    $.ajax({
                        url: 'Ajax/Ajax.php',
                        type: 'POST',
                        data: {module: '2', action: '8'},
                        success: function(data) {
                            $('#table3').html(data);

                        }
                    })
                }
    function limpiar(){
        LoadData();
        jQuery("#inputsearch").val("");
        jQuery("#producto").val("");
        jQuery("#stock").val("");
        jQuery("#stockmin").val("");
        jQuery("#stockmax").val("");
        jQuery("#costo").val("");
        jQuery("#marca").val('');
        jQuery("#categoria").val('');
            $("#edit").show();
            $("#edit2").hide();
            $("#id").val("");
            $.ajax({
                            url: 'Ajax/Ajax.php',
                            type: 'POST',
                            data: { module: '2', action: '12'},
                            success: function(data) {
                                $('#selP').html(data);
                                   }
                        })
    }

    function limpiar2(){
        LoadData2();
        jQuery("#lispro").val('');
        jQuery("#lisuni").val('');
        jQuery("#costoE").val("");

    }

    function limpiar3(){
        LoadData3();
        jQuery("#nunid").val("");
        jQuery("#cantunid").val("");
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
                    <li class="active"><a href="Productos.php"><i class="fa fa-cubes">
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
                        <li class="hidden"><a href="#">Productos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Productos</li>
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
                                <button type="button" class="btn btn-warning btn-ms" id ="unit"><i class="fa fa-list-alt"></i> Asignar Unidades</button>
                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close"><i class="fa fa-reply-all"></i> Salir</button>
                            </div>
                        </nav>
                        <div id="msj"></div>
                        <input type="hidden" id="id" value="">

                    <div id="formu0">
                         <div class="panel panel-default">

                            <div class="panel-heading">Gestionando Unidades</div>
                            <div class="panel-body">

                                <div id="msj2"></div>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Producto:</label>
                                    <div class="col-lg-5" id="selP"><select id="lispro" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>
                                        <?php

                                        $sql="select * from producto;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        ?>




                                    </select>
                                    </div>
                                </div><br><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Unidades:</label>
                                    <div class="col-lg-5" id="selU"><select id="lisuni" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>
                                        <?php

                                        $sql="select * FROM unidades u;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        ?>
                                    </select>
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Costo EspecialxUnidad:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00.00" id="costoE" type="text" class="form-control input-sm" id="costoprov" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br><br>

                                <button type="button" class="btn btn-primary btn-ms" id="grab"> <i class="fa fa-floppy-o"></i> Guardar</button>
                                <button type="button" class="btn btn-danger btn-ms" id="deleteU"><i class="fa fa-eraser"></i> Eliminar</button>
                                <button type="button" class="btn btn-info btn-ms" id="closeU"><i class="fa fa-undo"></i> Cerrar</button>
                                <a data-toggle="modal" data-target="#myModal"><button type="button" class="btn btn-default btn-ms" id="newU"> <i class="fa fa-floppy-o"></i> Gestionar Unidad</button></a><br><br>
                                <div id="tabUnid">
                                    
                                </div>


                            </div>

                        </div>
                    </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Mantenimiento de Productos</div>
                            <div class="panel-body">
                              
                                <div id="formu">
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Categoria:</label>
                                    <div class="col-lg-5"><select id="categoria" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>
                                        <?php

                                        $sql="select * from categoria;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        ?>




                                    </select>
                                    </div>
                                </div><br><br>
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Marca:</label>
                                    <div class="col-lg-5">
                                        <select id="marca" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>
                                         <?php

                                        $sql="select * from marca;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        ?>

                                    </select>
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Producto:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="Nombre" id="producto" type="text" class="form-control input-sm" id="producto" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Minimo:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" id="stockmin" type="text" class="form-control input-sm" id="stockmin" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Maximo:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" id="stockmax" type="text" class="form-control input-sm" id="stockmax" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Real:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" id="stock" type="text" class="form-control input-sm" id="stockreal" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div><br><br>
                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Costo Unitario:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00.00" id="costo" type="text" class="form-control input-sm" id="costoprov" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div>

                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">Catalogo de Productos</div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="inputsearch" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" disabled="true" type="button" id="search"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                        </span>
                                    </div>
                                </div>                                </div>
                            </div>
                        </div>
                    </form><br><br>
                    
                    
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


     <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title">
                                Mantenimiento de Unidades</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Descripción:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="Nombre" id="nunid" type="text" class="form-control input-sm" id="producto" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Cantidad:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="Cantidad" id="cantunid" type="text" class="form-control input-sm" id="producto" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>

                                <br><br>
                               <button type="button" class="btn btn-primary btn-ms" id="grabU"> <i class="fa fa-floppy-o"></i> Guardar</button>
                                <button type="button" class="btn btn-danger btn-ms" id="deleteUni"><i class="fa fa-eraser"></i> Eliminar</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button><br><br>
                                <div id="msj3"></div>
                                <div id="table3"></div>

                                
                        </div>
                        <div class="modal-footer">
                            
                       
                        </div>
                    </div>
                </div>
            </div>
 
</body>
</html>
