<?php
session_start();
if(!isset($_SESSION['userCR'])||($_SESSION['nivelCR']<1)){
    header('Location:../index.php');
}
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");


	require("estilos1.php");
      $selG=$_GET['v'];

    $selF=$_GET['v1'];

    $per=$_GET['v2'];

    $selS=$_GET['v3'];

    echo'<style type="text/css" media="print">
@media print {
#btnImprimir {display:none;}


}
</style>';

echo'<div style="position:absolute; margin-left: 50px; margin-top: 25px;" id="btnImprimir" >

<button type="button" class="btn btn-info" onclick="window.print();">Imprimir</button>
</div>';



$todayh = getdate(); 
                        $d = $todayh['mday'];
                        $m = $todayh['mon'];
                        $y = $todayh['year'];

$cabe="";
$fec1="";
$fec2="";
$sql="";

 $sql="";
           
           $sql="";
            if($selF==0){
                $sql=" and p.fecha=curdate() ";
                    }

            elseif($selF==1){
                $sql=" and month(p.fecha)=month(curdate()) ";
            }

            elseif($selF==2){
                $sql=" and year(p.fecha)=year(curdate()) ";
            }

            elseif($selF==3){
                $sql="";
            }

            elseif($selF==4){

                $fecin=$_GET['v4'];
                $fecfi=$_GET['v5'];

                $fecin=substr($fecin,6,4)."/".substr($fecin,3,2)."/". substr($fecin,0,2);
                $fecfi=substr($fecfi,6,4)."/".substr($fecfi,3,2)."/". substr($fecfi,0,2);

                $sql=" and (c.fechaini between '".$fecin."' and '".$fecfi."' or c.fechafin between '".$fecin."' and '".$fecfi."') ";
            }



$sqlz="select * FROM aescolar a;";   
        

$res=mysql_query($sqlz) or die("error1");

$cont=1; $cont2=0;
$sum=0;


    while($row=mysql_fetch_array($res)){

        $sqlz1="select concat(pe.apellidos,' ',pe.nombres),pe.dni, c.idpagocrono, concat(c.descripcion,'-',ae.descripcion),c.fechafin,c.monto, s.nombre,g.nombre,
            if((select p.idpago from pagorealizado p where p.idfiltropago=f.idfiltropago and p.idpersona=pe.idpersona),1,0),
            if(c.fechafin<curdate(),1,0), if(year(c.fechafin)<year(curdate()),0,1)
             from pagocronogramado c
            inner join aescolar ae on ae.idA=c.idA
            inner join filtropago f on f.idfiltropago=c.idfiltropago,
            persona pe
            inner join alumno a on a.idpersona=pe.idpersona
            inner join detalusec d on d.idalumno=a.idalumno
            inner join seccion s on s.idseccion=d.idseccion
            inner join grado g on g.idgrado=s.idgrado
            where ae.idA='".$row[0]."' and d.idA=ae.idA 
            and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." order by 1, c.fechafin;";

$res1=mysql_query($sqlz1) or die ("error2");

while($row1=mysql_fetch_array($res1)){
    if($row1[8]==0){

        if($row1[9]==1){
           $sum=$sum+$row1[5];
     $cont2++; 
        }
     
}
}
             
    }




echo'<div style="width: 24cm;margin: auto;background: " >';

            echo'<h3 style="text-align:center;text
            -decoration:underline; color: #333;">Reporte de Deudas</h3>';
$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$cabe.' Monto Total: S/.'.$num.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                      <th width="5%">#</th>
                                        <th width="10%">Año Escolar</th>
                                        <th>Alumno</th>
                                        <th width="10%">DNI</th>
                                        <th width="20%">Descripción de la Deuda</th>
                                        <th width="10%">Grado</th>
                                        <th width="10%">Sección</th>
                                        <th width="10%">Fecha de Vencimiento de Pago</th>
                                        <th width="10%">S/. Monto </th>

                                    </tr>
                                    </thead>
                                    <tbody>';




         $sqlz="select * FROM aescolar a;";   
        

$resf=mysql_query($sqlz) or die("error1");

$cont=1;
    while($row=mysql_fetch_array($resf)){

        $sqlz1="select concat(pe.apellidos,' ',pe.nombres),pe.dni, c.idpagocrono, concat(c.descripcion,'-',ae.descripcion),c.fechafin,c.monto, s.nombre,g.nombre,
            if((select p.idpago from pagorealizado p where p.idfiltropago=f.idfiltropago and p.idpersona=pe.idpersona),1,0),
            if(c.fechafin<curdate(),1,0), if(year(c.fechafin)<year(curdate()),0,1), ae.descripcion
             from pagocronogramado c
            inner join aescolar ae on ae.idA=c.idA
            inner join filtropago f on f.idfiltropago=c.idfiltropago,
            persona pe
            inner join alumno a on a.idpersona=pe.idpersona
            inner join detalusec d on d.idalumno=a.idalumno
            inner join seccion s on s.idseccion=d.idseccion
            inner join grado g on g.idgrado=s.idgrado
            where ae.idA='".$row[0]."' and d.idA=ae.idA 
            and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." order by 1, c.fechafin;";

$res1f=mysql_query($sqlz1) or die ("error2");

while($row1=mysql_fetch_array($res1f)){


    if($row1[8]==0){

        if($row1[9]==1){

            if($row1[10]==0){

                echo '<tr>';
            }
            else{
                echo '<tr>';
            }

            $fecha="".substr($row1[4],8,2)."/".substr($row1[4],5,2)."/". substr($row1[4],0,4);

            echo '<td style="text-align:center;">'.$cont.'</td>';
            echo'<td>'.$row1[11].'</td>';
            echo'<td>'.$row1[0].'</td>';
            echo'<td>'.$row1[1].'</td>';
            echo'<td>'.$row1[3].'</td>';
            echo'<td>'.$row1[7].'</td>';
            echo'<td>'.$row1[6].'</td>';
            echo'<td>'.$fecha.'</td>';
            echo'<td>'.$row1[5].'</td>';

                

        

                $cont++;

        }
        

    }

     

}
             
    }

    

    echo' </tbody>
                                </table>
                            </div>
                        </div></div>';







?>
