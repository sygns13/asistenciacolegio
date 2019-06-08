<?php

//require "Funciones/General.php";
session_start();
if(!isset($_SESSION['userCR'])||($_SESSION['nivelCR']>2)){
    header('Location:../index.php');


}
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");
$con=$_SESSION['nivelCR'];
$idUser=$_SESSION['idCR'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Módulo de Pagos</title>
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

    <link rel="stylesheet" type="text/css" href="../css/datepicker.css">

    <link type="text/css" rel="stylesheet" href="../styles/animate.css">
    <link type="text/css" rel="stylesheet" href="../styles/all.css">
    <link type="text/css" rel="stylesheet" href="../styles/main.css">
    <link type="text/css" rel="stylesheet" href="../styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="../styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="../styles/pace.css">
    <link type="text/css" rel="stylesheet" href="../styles/jquery.news-ticker.css">
    <link rel="stylesheet" href="../dist/sweetalert.css">
     <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
<style type="text/css">
    
.fila td{
    padding: 4px;
}




</style>

<script>
     $(document).ready(function() { 
        //LoadZero();
       // LoadAlertas();
        //LoadData();
        //setInterval(LoadAlertas, 5000);
        $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });

       

        $("#close").click(function(e){
          swal({
  title: "¿Está seguro?",
  text: "Se Cerrará el Módulo Actual y se Dirigirá a la Página Principal",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#8CA9CE",
  confirmButtonText: "Continuar",
  closeOnConfirm: false
},
function(){
   window.location= 'Principal.php';

 //swal("Iniciado", "El Módulo fue iniciado", "success");
  swal.close();
   });

           

        });

        $("#config").click(function(e) {
             //$("#PanConf").toggle('slow');
            

             swal({
  title: "¿Está seguro?",
  text: "Se Iniciará Las Configuraciones Básicas y se cerrará cualquier pago en proceso",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#8CA9CE",
  confirmButtonText: "Continuar",
  closeOnConfirm: false
},
function(){
    $("#list3").html("");
   $("#panPagos").hide('slow');
             LoadConf();

             LoadConf1();
             LoadConf2();

 //swal("Iniciado", "El Módulo fue iniciado", "success");
  swal.close();
   });






        })


          $("#search").click(function(e) {
             var dato=$("#inputsearch").val();

             if(dato.length==0 ){
            swal('','Ingrese el nombre o DNI del Alumno','info');
           }
           else{
            LoadData();
           }
        });

          $('#inputsearch').keypress(function (e) {
              if (e.which == 13) {
                    var dato=$("#inputsearch").val();

             if(dato.length==0 ){
            swal('','Ingrese el nombre o DNI del Alumno','info');
           }
           else{
            LoadData();
           }
              }
            });


           

           $("#newPago").click(function(e){

            swal({
  title: "¿Está seguro?",
  text: "Se Iniciará el Módulo de Pagos",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#8CA9CE",
  confirmButtonText: "Continuar",
  closeOnConfirm: false
},
function(){

$("#inputsearch").val("");
 $('#list').html("");
 $('#list0').html("");
 $("#panPagos").show('fast');
 $("#list1").html("");
 $("#list2").html("");
 $("#list3").html("");
 $("#msj").html("");
 $("#msj1").html("");
 $("#msj2").html("");


$.post("../Funciones/ajax.php",{modulo:9,accion:12},function(dataD){
              
                      $("#selDes").html(dataD);
                      $("#selDesG").html(dataD);
                     
                });

$.post("../Funciones/ajax.php",{modulo:9,accion:13},function(dataR){
              
                      $("#selRec").html(dataR);
                      $("#selRecG").html(dataR);
                     
                });

$.post("../Funciones/ajax.php",{modulo:9,accion:14},function(dataDes){
              
                      $("#dtosDes").html(dataDes);
                     
                });

$.post("../Funciones/ajax.php",{modulo:9,accion:15},function(dataRec){
              
                      $("#dtosRec").html(dataRec);
                     
                });

$.post("../Funciones/ajax.php",{modulo:9,accion:17},function(dataDes){
              
                      $("#dtosDesG").html(dataDes);
                     
                });

$.post("../Funciones/ajax.php",{modulo:9,accion:18},function(dataRec){
              
                      $("#dtosRecG").html(dataRec);
                     
                });


 //swal("Iniciado", "El Módulo fue iniciado", "success");
  swal.close();
   });
           });




        $("#btnGuardarR").click(function(e){
          var des=$("#desR").val();
          var valor=parseFloat($("#montoR").val());
          var tipo=parseInt($('input:radio[name=radio]:checked').val());

          if(des.length==0 || valor.length==0){
            swal("","Complete los datos en el formulario","info");
          }
          else{
              if(tipo==1){

                if(valor<0 || valor>100){
                  swal("","Elporcentaje debe ubicarse entre un rango de 0 a 100","info");
                }
                else{

                  $.post("../Funciones/ajax.php",{modulo:9,accion:4,v1:des,v2:valor,v3:tipo},function(data1){
              
                      $("#msj1").html(data1);
                      LoadConf1();
                      $('#modal-config').modal('hide');
                     
                });

              }
               }

               else{
                $.post("../Funciones/ajax.php",{modulo:9,accion:4,v1:des,v2:valor,v3:tipo},function(data1){
              
                      $("#msj1").html(data1);
                      LoadConf1();
                      $('#modal-config').modal('hide');
              });

          }  
              


        }

        });

        $("#btnGuardarD").click(function(e){
          var des=$("#desR").val();
          var valor=parseFloat($("#montoR").val());
          var tipo=parseInt($('input:radio[name=radio]:checked').val());

          if(des.length==0 || valor.length==0){
            swal("","Complete los datos en el formulario","info");
          }
          else{
              if(tipo==1){

                if(valor<0 || valor>100){
                  swal("","Elporcentaje debe ubicarse entre un rango de 0 a 100","info");
                }
                else{

                  $.post("../Funciones/ajax.php",{modulo:9,accion:8,v1:des,v2:valor,v3:tipo},function(data1){
              
                      $("#msj2").html(data1);
                      LoadConf2();
                      $('#modal-config').modal('hide');
                     
                });

              }
               }

               else{
                $.post("../Funciones/ajax.php",{modulo:9,accion:8,v1:des,v2:valor,v3:tipo},function(data1){
              
                      $("#msj2").html(data1);
                      LoadConf2();
                      $('#modal-config').modal('hide');
              });

          }  
              


        }

        });


        $("#btnGuardarER").click(function(e){
          var des=$("#desR").val();
          var valor=parseFloat($("#montoR").val());
          var tipo=parseInt($('input:radio[name=radio]:checked').val());
          var cod=$("#idCod").val();

          if(des.length==0 || valor.length==0){
            swal("","Complete los datos en el formulario","info");
          }
          else{
              if(tipo==1){

                if(valor<0 || valor>100){
                  swal("","Elporcentaje debe ubicarse entre un rango de 0 a 100","info");
                }
                else{

                  $.post("../Funciones/ajax.php",{modulo:9,accion:6,v1:des,v2:valor,v3:tipo, v4:cod},function(data1){
              
                      $("#msj1").html(data1);
                      LoadConf1();
                      $('#modal-config').modal('hide');
                     
                });

              }
               }

               else{
                $.post("../Funciones/ajax.php",{modulo:9,accion:6,v1:des,v2:valor,v3:tipo, v4:cod},function(data1){
              
                      $("#msj1").html(data1);
                      LoadConf1();
                      $('#modal-config').modal('hide');
              });

          }  
              


        }

     }); 


    $("#btnGuardarED").click(function(e){
          var des=$("#desR").val();
          var valor=parseFloat($("#montoR").val());
          var tipo=parseInt($('input:radio[name=radio]:checked').val());
          var cod=$("#idCod").val();

          if(des.length==0 || valor.length==0){
            swal("","Complete los datos en el formulario","info");
          }
          else{
              if(tipo==1){

                if(valor<0 || valor>100){
                  swal("","Elporcentaje debe ubicarse entre un rango de 0 a 100","info");
                }
                else{

                  $.post("../Funciones/ajax.php",{modulo:9,accion:10,v1:des,v2:valor,v3:tipo, v4:cod},function(data1){
              
                      $("#msj2").html(data1);
                      LoadConf2();
                      $('#modal-config').modal('hide');
                     
                });

              }
               }

               else{
                $.post("../Funciones/ajax.php",{modulo:9,accion:10,v1:des,v2:valor,v3:tipo, v4:cod},function(data1){
              
                      $("#msj2").html(data1);
                      LoadConf2();
                      $('#modal-config').modal('hide');
              });

          }  
              


        }

     }); 



$("#btnGuardarPC3").click(function(e){

  var idDes=$("#selDes").val();
  var idRec=$("#selRec").val();
  var mont=$("#monFinalPC3").val();
  var nom=$("#myModalLabel3").html();
  var idFil=$("#idFilCP3").val();
  var idPer=$("#idPer").val();



if (mont<=0){
swal('','Modifique el pago, pues no puede ser igual o menor a 0','info');
}
else{


  $.post("../Funciones/ajax.php",{modulo:9,accion:16,v1:idDes,v2:idRec,v3:mont,v4:nom, v5:idFil, v6:2},function(data){
  $("#agregarP").append(data);
  var total=parseFloat($("#idMontoPagar").val());
  mont=parseFloat(mont);
  total=total+mont;
  var n= total.toFixed(2)
  $("#idMontoPagar").val(n);

  recorrertb('tabPagos');

  $("#btnPag"+idFil).css({'display':'none'});
  $('#modal-config3').modal('hide');


  });

}
 
});

$("#btnGuardarG").click(function(e){

  var idDes=$("#selDesG").val();
  var idRec=$("#selRecG").val();
  var mont=$("#monFinalG").val();
  var nom=$("#desPG").val();
  
  var idPer=$("#idPer").val();



if(nom.length==0){
swal('','Ingrese la descripción del Pago','info');
}

else{

if(mont<=0){
swal('','Modifique el pago, pues no puede ser igual o menor a 0','info');
}
else{




  $.post("../Funciones/ajax.php",{modulo:9,accion:16,v1:idDes,v2:idRec,v3:mont,v4:nom, v5:0, v6:1},function(data){
  $("#agregarP").append(data);
  var total=parseFloat($("#idMontoPagar").val());
  mont=parseFloat(mont);
  total=total+mont;
  var n= total.toFixed(2)
  $("#idMontoPagar").val(n);

  recorrertb('tabPagos');

 
  $('#modal-config4').modal('hide');


  });

  }
}
 
});




$("#montoPC3").keyup(function(e){
  var idDes=$("#selDes").val();
  var dcto=parseFloat($("#desD"+idDes).val());
  var tipo=parseInt($("#tipoD"+idDes).val());


  var idRec=$("#selRec").val();
  var rcgo=parseFloat($("#desR"+idRec).val());
  var tipo2=parseInt($("#tipoR"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }


  }





});


$("#selDes").change(function(){
var idDes=$("#selDes").val();
  var dcto=parseFloat($("#desD"+idDes).val());
  var tipo=parseInt($("#tipoD"+idDes).val());


  var idRec=$("#selRec").val();
  var rcgo=parseFloat($("#desR"+idRec).val());
  var tipo2=parseInt($("#tipoR"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }


  }


});


  $("#selRec").change(function(){

    var idDes=$("#selDes").val();
  var dcto=parseFloat($("#desD"+idDes).val());
  var tipo=parseInt($("#tipoD"+idDes).val());


  var idRec=$("#selRec").val();
  var rcgo=parseFloat($("#desR"+idRec).val());
  var tipo2=parseInt($("#tipoR"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPC3").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalPC3").val(n);
  }


  }

  });



$("#montoPG").keyup(function(e){
  var idDes=$("#selDesG").val();
  var dcto=parseFloat($("#desDG"+idDes).val());
  var tipo=parseInt($("#tipoDG"+idDes).val());


  var idRec=$("#selRecG").val();
  var rcgo=parseFloat($("#desRG"+idRec).val());
  var tipo2=parseInt($("#tipoRG"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }


  }

});



$("#selDesG").change(function(){ 
var idDes=$("#selDesG").val();
  var dcto=parseFloat($("#desDG"+idDes).val());
  var tipo=parseInt($("#tipoDG"+idDes).val());


  var idRec=$("#selRecG").val();
  var rcgo=parseFloat($("#desRG"+idRec).val());
  var tipo2=parseInt($("#tipoRG"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }


  }

 });

$("#selRecG").change(function(){ 
var idDes=$("#selDesG").val();
  var dcto=parseFloat($("#desDG"+idDes).val());
  var tipo=parseInt($("#tipoDG"+idDes).val());


  var idRec=$("#selRecG").val();
  var rcgo=parseFloat($("#desRG"+idRec).val());
  var tipo2=parseInt($("#tipoRG"+idRec).val());

  //alert(idBene+' - '+dcto+' - '+tipo);

  if(tipo==0){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-dcto;
   
  
     if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

    mont2=redondeo(mont2,1);

      var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

  mont2=redondeo(mont2,1);
 
    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }

  }


  if(tipo==1){
    var mont=parseFloat($("#montoPG").val());
    mont=mont-(mont*(dcto/100));
    

    if(tipo2==0){

    var mont2=parseFloat(mont);
    mont2 = mont2+rcgo;

   mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);

  }

  if(tipo2==1){
    var mont2=parseFloat(mont);
    mont2=mont2+(mont2*(rcgo/100));

    mont2=redondeo(mont2,1);

    var n= mont2.toFixed(2)
    $("#monFinalG").val(n);
  }


  }

 });





      });

function recorrertb(idtb){

    var cont=1;
        $("#"+idtb+" tbody tr").each(function (index) 
        {
            
            $(this).children("td").each(function (index2) 
            {
               //alert(index+'-'+index2);
               

               if(index2==0){
                  $(this).text(cont);
                  cont++;
               }
               if((cont+1)%2==0){
                //$(this).css( "background-color", "#f9f9f9" );
               }

               else{
               // $(this).css( "background-color", "fff" );
               }
               

            })
            
        })
  }

  function BajarP(elem,mon,fil){
  var ele=$(elem).closest('tr');
  mont=parseFloat(mon);
  var total=parseFloat($("#idMontoPagar").val());
  total=total-mont;

  var n= total.toFixed(2)
  $("#idMontoPagar").val(n);


  
  $("#btnPag"+fil).css({'display':'block'});
    ele.remove();
    recorrertb('tabPagos');
  }


function redondeo(numero, decimales)
{
var flotante = parseFloat(numero);
var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
return resultado;
}

      function LoadData(){
        bus=$("#inputsearch").val();
      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {search: bus, modulo: '9', accion: '0'},
                        success: function(data) {
                            $('#list').html(data);

                        }
                    })
     }

     function LoadConf(){

      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {modulo: '9', accion: '1'},
                        success: function(data) {
                            $('#list0').html(data);

                        }
                    })
     }

     function LoadConf1(){

      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {modulo: '9', accion: '3'},
                        success: function(data) {
                            $('#list1').html(data);

                        }
                    })
     }

     function LoadConf2(){

      
        $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {modulo: '9', accion: '7'},
                        success: function(data) {
                            $('#list2').html(data);

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


     
     function rep1(){

       window.open('alertAlumnos.php').attr("target","_new");
     }

     function rep2(){
        window.open('alertDocentes.php').attr("target","_new");

     }

     function soloNumeros(e){
  var key = window.Event ? e.which : e.keyCode
  return ((key >= 48 && key <= 57) || (key==8) || (key==35) || (key==34) || (key==46));
}

    function GuardarC1(){
     var mat=$("#mat").val(); 
     var mes=$("#mes").val();
     
      if(mat.length==0 || mes.length==0 ){
            swal('','Complete las casillas de información','info');
           }
           else{

            $.post("../Funciones/ajax.php",{modulo:9,accion:2,v1:mat,v2:mes},function(data1){

                $("#msj").html(data1);
                LoadConf();

              });



           }


    }

    function NewRec(){
        //$("#idGra").val(codG);
        $("#desR").val("");
        $("#montoR").val("");
        $("#radio1").attr('checked', true);


        $("#myModalLabel").text("Nuevo Recargo");
        $("#btnGuardarER").hide();
        $("#btnGuardarR").show();

        $("#btnGuardarED").hide();
        $("#btnGuardarD").hide();
        $('#modal-config').modal('show');
        $("#desR").focus();

     }

     function NewDes(){
        //$("#idGra").val(codG);
        $("#desR").val("");
        $("#montoR").val("");
        $("#radio1").attr('checked', true);


        $("#myModalLabel").text("Nuevo Descuento");
        $("#btnGuardarER").hide();
        $("#btnGuardarR").hide();

        $("#btnGuardarED").hide();
        $("#btnGuardarD").show();

        $('#modal-config').modal('show');
        $("#desR").focus();

     }




     function delR(cod,nom) {
         swal({
  title: "¿Está seguro?",
  text: "Se eliminará el recargo: "+nom,
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Eliminar",
  closeOnConfirm: false
},
function(){

  $.post("../Funciones/ajax.php",{modulo:9,accion:5,v1:cod},function(data1){
     swal.close();
    $("#msj1").html(data1);
    LoadConf1();
   
  });



  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
});
     }

     function delD(cod,nom) {
         swal({
  title: "¿Está seguro?",
  text: "Se eliminará el descuento: "+nom,
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Eliminar",
  closeOnConfirm: false
},
function(){

  $.post("../Funciones/ajax.php",{modulo:9,accion:9,v1:cod},function(data1){
     swal.close();
    $("#msj2").html(data1);
    LoadConf2();
   
  });



  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
});
     }

   function editR(cod,nom,mon,tipo){

  $("#myModalLabel").text("Editar Recargo");
  $("#desR").val(nom);
  $("#montoR").val(mon);
  $("#idCod").val(cod);
  $("#btnGuardarER").show();
  $("#btnGuardarR").hide();

  $("#btnGuardarED").hide();
  $("#btnGuardarD").hide();
 
  if(tipo==0){
    $("#radio2").attr('checked', true);
  }
  if(tipo==1){
    $("#radio1").attr('checked', true);
  }

  $('#modal-config').modal('show');
  $("#desR").focus();
}

function editD(cod,nom,mon,tipo){

  $("#myModalLabel").text("Editar Descuento");
  $("#desR").val(nom);
  $("#montoR").val(mon);
  $("#idCod").val(cod);
  $("#btnGuardarER").hide();
  $("#btnGuardarR").hide();

  $("#btnGuardarED").show();
  $("#btnGuardarD").hide();
 
  if(tipo==0){
    $("#radio2").attr('checked', true);
  }
  if(tipo==1){
    $("#radio1").attr('checked', true);
  }

  $('#modal-config').modal('show');
  $("#desR").focus();
}





function pagarA (cod,nom,grado,sec,dni) {
  //alert(cod+' '+nom+' '+grado+' '+sec+' '+dni);

  $("#panPagos").hide();
   $('#list3').html("");

   $.ajax({
                        url: '../Funciones/Ajax.php',
                        type: 'POST',
                        data: {search: bus, modulo: '9', accion: '11',v:cod, v1:nom, v2:grado, v3:sec, v4:dni},
                        success: function(data) {
                            $('#list3').html(data);
                            $("#fecPago").datepicker({
                              format: 'dd/mm/yyyy',
                              todayHighlight: true,
                              language: 'es',
                              
                              
                                });

                        }
                    })

}


function InfoC(des,monto,fecha,boleta,desc,rec){

  $("#myModalLabel2").text("Detalle de Pagos Realizados");

  $("#desPC").val(des);
  $("#montoPC").val(monto);
  $("#fechaPC").val(fecha);
  $("#BoletaPC").val(boleta);
  $("#descRe").val(desc);
  $("#recRe").val(rec);
 $('#modal-config2').modal('show');

}

function PagarC(idfil,des,monto){
$("#myModalLabel3").text(des);
$("#idFilCP3").val(idfil);
$("#montoPC3").val(monto);

$("#monFinalPC3").val(monto);

$("#selDes").val(0);

$("#selRec").val(0);

 $('#modal-config3').modal('show');
}

function PagarG(){
$("#myModalLabel4").text("Nuevo Pago General");

$("#desPG").val("");

$("#montoPG").val("0.00");

$("#monFinalG").val("0.00");

$("#selDesG").val(0);

$("#selRecG").val(0);

 $('#modal-config4').modal('show');

 $("#desPG").focus();
}

function noEscribe(e){
  var key = window.Event ? e.which : e.keyCode
  return (key==null);
}


function Rpago(){
var total=parseFloat($("#idMontoPagar").val());
var fecha=$("#fecPago").val();
var Boleta = $("#numBoleta").val();
var fecha = $("#fecPago").val();
var idPer=$("#idPer").val();
var idUser=$("#datoU").val();

var nom=$("#nomAlum").val();
var grado=$("#gradoAlum").val();
var sec=$("#secAlum").val();
var dni=$("#dniAlum").val();

var tipo=0;
var monto=0;
var idDes="";
var idRec="";
var idFi="";
var aux=0;

if(Boleta.length==0){
  Boleta="General";
}


if(total==0){
  swal('','No ha ingresado ningún Pago','info');
}
else
{

  swal({
  title: "¿Está seguro?",
  text: "Confirmar Pagos",
  type: "info",
  showCancelButton: true,
  confirmButtonColor: "#8CA9CE",
  confirmButtonText: "Continuar",
  closeOnConfirm: false
},
function(){
    tablaPagar(Boleta,idPer,idUser,fecha,function(){
   swal('','Pago(s) Realizado(s) Exitosamente','success');
   setTimeout(pagarA(idPer,nom,grado,sec,dni),2000);
   
});

 //swal("Iniciado", "El Módulo fue iniciado", "success");
  
   });






    //window.open("BoletaPago.php?v1="+idBol+"&v2="+option+"&v3="+idAlu+"",'_blank'); 
}

}

function tablaPagar(Boleta,idPer,idUser,fecha,miCallback){

  $("#tabPagos tbody tr").each(function(index,el){
    var tr=$(this).closest('tr');
    var tds=$(this).children('td');

    idFi=tr.data('idf');
    idDes=tr.data('idd');
    idRec=tr.data('idr');

    tipo=tr.data('tipo');

    monto=tds.eq(2).text();
    nombre=tds.eq(1).text();

    $.post("../Funciones/ajax.php",{modulo:9,accion:19,v1:idDes,v2:idRec,v3:monto,v4:idFi,v5:Boleta,v6:idPer, v7:idUser,v8:tipo,v9:fecha, v10:nombre},function(data){

      //alert(idDes+" "+idRec+" "+monto+" "+idFi+" "+Boleta+" "+idPer+" "+idUser+" "+tipo);

    });

  });

  miCallback();

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
                    </li>';
                  

                  if($_SESSION['nivelCR']==1 || $_SESSION['nivelCR']==2){
                    echo '
                    <li ><a href="alumnos.php"><i class="fa fa-users">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Alumnos</span></a>
                       
                    </li>
                    <li ><a href="docentes.php"><i class="fa fa-user-secret">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Gestionar Docentes</span></a>

                    </li>

                    <li><a href="gesAescolar.php"><i class="fa fa-cogs">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Gestionar Año Escolar</span></a></li>';

                    echo'<li><a href="gesConceptos.php"><i class="fa fa-check-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Conceptos Académicos</span></a>
                      
                    </li>';

                     echo'<li class="active" ><a href="modPagos.php"><i class="fa fa-money">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Módulo de Pagos</span></a>
                      
                    </li>';
                       
                       echo'<li><a href="code2/html/Codbarras.php"><i class="fa fa-barcode">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Generar Código de Barras</span></a>
                      
                    </li>';

                  } 
                    echo'<li><a href="reportes.php"><i class="fa fa-print">
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
                            Módulo de Gestión de Pagos</div>
                            
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-money"></i>&nbsp;<a href="modPagos.php">Módulo de Pagos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Módulo de Pagos</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Módulo de Pagos</li>
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
                                <button type="button" class="btn btn-primary btn-ms" id="newPago"> <i class="fa fa-usd"></i> Nuevo Pago</button>
                                
                                <?php

                                if($con==1){
                                  echo '<button type="button" class="btn btn-warning btn-ms" id="config"> <i class="fa fa-cogs"></i> Configuraciones</button>';
                                }
                                echo'<input type="hidden" value="'.$idUser.'" id="datoU">';

                                ?>

                                <button type="button" class="btn btn-default navbar-btn btn-ms" id="close" ><i class="fa fa-reply-all"></i> Atrás</button>
                            </div>
                        </nav>
                         <div id="msj"></div>
                        
                        <div class="panel panel-default">

                        



                    
                            
                            <div class="panel-body" id="panPagos">
                                <div class="col-lg-6">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="inputsearch" placeholder="Nombres, Apellidos o DNI" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        
                                         <input type="text" class="form-control" id="inputsearch1" placeholder="Nombres, Apellidos o DNI" style="border: solid 1px;color: rgb(102, 101, 110); visibility:hidden;">

                                        <span class="input-group-btn" style="align:top">
                                            <button class="btn btn-default" type="button" id="search" style="position: absolute;top: 0;"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                        </span>
                                    </div>
                                </div><br><br>
                                <div class="col-lg-10" id="list">
                                </div>

                                 
                            </div>

                             
                        </div>
                       
                        <div id="list3"></div>




                        <div id="list0"></div><div id="msj1"></div>
                        <div id="list1"></div><div id="msj2"></div>
                        <div id="list2"></div>

                        <div id="msj3"></div>



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
                              
                              <input type="hidden" id="idCod">

                            <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Descripción:*</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm" autofocus id="desR" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Tipo:*</label>
                                    
                                       
                                      <div class="col-lg-3">
                                            <label class="radio-inline" style="padding-left:20px;">
                                              <input type="radio"  name="radio" id="radio1" checked value="1"> Porcentaje
                                            </label> </div>
                                             <div class="col-lg-4">
                                            <label class="radio-inline"  >
                                              <input type="radio" name="radio" id="radio2" value="0"> Nuevos Soles
                                            </label>
                                           </div>
                                   
                                </div> 
                                <br>
                       
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Monto:*</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm"  id="montoR" maxlength="12" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return soloNumeros(event);">
                                    </div>
                                </div><br>




                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>
                            <button type="button" class="btn btn-primary" id="btnGuardarR">
                                Guardar</button>
                                <button type="button" class="btn btn-primary" id="btnGuardarER">
                                Guardar Cambios</button>

                                <button type="button" class="btn btn-primary" id="btnGuardarD">
                                Guardar</button>
                                <button type="button" class="btn btn-primary" id="btnGuardarED">
                                Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>



            <div id="modal-config2" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title" id="myModalLabel2">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                              
                              <input type="hidden" id="idPagoC">

                            <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Pago:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="desPC" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Monto Pagado:</label>
                                    
                                       <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="montoPC" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                      
                                   
                                </div> 
                                <br>
                       
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Fecha de Pago:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="fechaPC" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Num Boleta:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="BoletaPC" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Descuento:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="descRe" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Recargo:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="recRe" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>




                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>
                          
                        </div>
                    </div>
                </div>
            </div>









<div id="modal-config3" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title" id="myModalLabel3">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                              
                              <input type="hidden" id="idFilCP3">

                         

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Monto:</label>
                                    
                                       <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"   id="montoPC3" maxlength="12" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return soloNumeros(event);">
                                    </div>
                                      
                                   
                                </div> 
                                <br>
                       
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Descuento:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px;margin-right: 1%; margin-bottom: 0.5%;">
                                        
                                       <select class="form-control" style="display:inline;border: solid 1px;color: rgb(102, 101, 110);" id="selDes">
                                            
                                            <?php

                                                $sql4="select * FROM descuento r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                                $res4a=mysql_query($sql4) or die('error');

                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }


                                                echo'</select><div id="dtosDes" style="display: none;">';
                                                  while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desD'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoD'.$row4a[0].'">';
                                                  }

                                            ?>
                                        </div><br>


                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Recargo:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; margin-right: 1%; margin-bottom: 0.5%; ">
                                        
                                    <select class="form-control" style="display:inline;border: solid 1px;color: rgb(102, 101, 110);" id="selRec">
                                            
                                            <?php

                                                $sql4="select * FROM recargo r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                                $res4a=mysql_query($sql4) or die('error');


                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }

                                                echo'</select><div id="dtosRec" style="display: none;">';
                                                while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desR'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoR'.$row4a[0].'">';
                                                  }

                                            ?>
                                          </div><br>


                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Monto Final:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="monFinalPC3" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>

                                <button type="button" class="btn btn-primary" id="btnGuardarPC3">
                                Guardar</button>
                          
                        </div>
                    </div>
                </div>
            </div>







<div id="modal-config4" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                                &times;</button>
                            <h4 class="modal-title" id="myModalLabel4">
                                Modal title</h4>
                        </div>
                        <div class="modal-body">
                              
                              
                           <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Pago:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  autofocus id="desPG" maxlength="200" style="border: solid 1px;color: rgb(102, 101, 110);" >
                                    </div>
                                </div><br>

                         

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Monto:</label>
                                    
                                       <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"   id="montoPG" maxlength="12" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return soloNumeros(event);">
                                    </div>
                                      
                                   
                                </div> 
                                <br>
                       
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Descuento:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px;margin-right: 1%; margin-bottom: 0.5%;">
                                        
                                       <select class="form-control" style="display:inline;border: solid 1px;color: rgb(102, 101, 110);" id="selDesG">
                                            
                                            <?php

                                                $sql4="select * FROM descuento r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                                $res4a=mysql_query($sql4) or die('error');

                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }


                                                echo'</select><div id="dtosDesG" style="display: none;">';
                                                  while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desDG'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoDG'.$row4a[0].'">';
                                                  }

                                            ?>
                                        </div><br>


                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Recargo:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; margin-right: 1%; margin-bottom: 0.5%; ">
                                        
                                    <select class="form-control" style="display:inline;border: solid 1px;color: rgb(102, 101, 110);" id="selRecG">
                                            
                                            <?php

                                                $sql4="select * FROM recargo r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                                $res4a=mysql_query($sql4) or die('error');


                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }

                                                echo'</select><div id="dtosRecG" style="display: none;">';
                                                while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desRG'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoRG'.$row4a[0].'">';
                                                  }

                                            ?>
                                          </div><br>


                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label" style="padding-left: 0px; padding-right: 0px; ">Monto Final:</label>
                                    <div class="col-lg-8" style="padding-left: 0px; padding-right: 0px; ">
                                        <input type="text" class="form-control input-sm"  readonly id="monFinalG" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return noEscribe(event);">
                                    </div>
                                </div><br>

                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">
                                Cerrar</button>

                                <button type="button" class="btn btn-primary" id="btnGuardarG">
                                Guardar</button>
                          
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
    <script src="../dist/sweetalert-dev.js"></script>
    <script src="../script/main.js"></script>

     <script src="../js/bootstrap-datepicker.js" type="text/javascript"></script>



</body>
</html>
