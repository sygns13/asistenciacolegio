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

$sql2="";
$sql3="";
            if($selF==0){
                $sql=" and p.fecha=curdate() ";

                $cabe="Día: "."$d/$m/$y";
                    }

            elseif($selF==1){

                 
                        if(strlen($d)==1){
                          $d='0'.$d;
                        }

                        if(strlen($m)==1){
                          $m='0'.$m;
                        }


                        $fec="$m/$y";
                        $fec1="$y-$m-01";
                        $fec2="$y-$m-31";

                        $cabe="Mes: ".$fec;


                        
                $sql=" and month(p.fecha)=month(curdate()) ";
            }

            elseif($selF==2){
                $sql=" and year(p.fecha)=year(curdate()) ";

                $cabe="Año: ".$y;
            }

            elseif($selF==3){
                $sql="";
            }

            elseif($selF==4){

                $fecin=$_GET['v4'];
                $fecfi=$_GET['v5'];

                $cabe="Desde: ".$fecin." Hasta: ".$fecfi;

                $fecin=substr($fecin,6,4)."/".substr($fecin,3,2)."/". substr($fecin,0,2);
                $fecfi=substr($fecfi,6,4)."/".substr($fecfi,3,2)."/". substr($fecfi,0,2);

                $sql=" and p.fecha between '".$fecin."' and '".$fecfi."' ";
            }



             if($selG==0){
                $sql2="";
            }
            else{
                $sql2=" and g.idgrado='".$selG."' ";
            }

            if($selS==0){
                $sql3="";
            }
            else{
                $sql3=" and s.idseccion='".$selS."' ";
            }




            $sql0="select * from aescolar;";
            $result=mysql_query($sql0) or die ("error");
            $result2=mysql_query($sql0) or die ("error");

$cont=1;
$sum=0;


while($row0=mysql_fetch_array($result)){

    $sqlz="(select p.idpago, ae.descripcion, concat(pe.apellidos,' ',pe.nombres), pe.dni,g.nombre,
s.nombre,pg.descripcion, p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario
FROM pagorealizado p
                inner join persona pe on pe.idpersona=p.idpersona
                inner join usuario u on u.idusuario=p.idusuario
                inner join alumno a on a.idpersona=pe.idpersona
                inner join detalusec da on da.idalumno=a.idalumno
                inner join seccion s on s.idseccion=da.idseccion
                inner join grado g on g.idgrado=s.idgrado
                inner join aescolar ae on ae.idA=da.idA
                inner join filtropago f on f.idfiltropago=p.idfiltropago
                inner join pagogeneral pg on pg.idfiltropago=f.idfiltropago
                where da.idA='".$row0[0]."' and p.fecha between ae.fechaini and ae.fechafin
                and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." ".$sql2."  ".$sql3."
                group by p.idpago )
union
(select p.idpago,ae.descripcion, concat(pe.apellidos,' ',pe.nombres), pe.dni,g.nombre,
s.nombre,concat(pc.descripcion,'-',year(pc.fechaini)), p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario
FROM pagorealizado p
                inner join persona pe on pe.idpersona=p.idpersona
                inner join usuario u on u.idusuario=p.idusuario
                inner join alumno a on a.idpersona=pe.idpersona
                inner join detalusec da on da.idalumno=a.idalumno
                inner join seccion s on s.idseccion=da.idseccion
                inner join grado g on g.idgrado=s.idgrado
                inner join aescolar ae on ae.idA=da.idA
                inner join filtropago f on f.idfiltropago=p.idfiltropago
                inner join pagoCronogramado pc on pc.idfiltropago=f.idfiltropago
                where da.idA='".$row0[0]."' and p.fecha between ae.fechaini and ae.fechafin
                and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." ".$sql2."  ".$sql3."
                group by p.idpago )
 order by 8,4;";   
        

$res=mysql_query($sqlz) or die("error1");

    while($row=mysql_fetch_array($res)){
            
        $sum=$sum+$row[9];
    }
}
    









echo'<div style="width: 24cm;margin: auto;background: " >';

            echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Reporte Económico Detallado</h3>';
$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$cabe.' Monto Total: S/.'.$num.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="8%">Año Académico</th>
                                        <th>Alumno</th>
                                        <th width="7%">DNI</th>
                                        <th width="7%">Grado</th>
                                        <th width="7%">Sección</th>
                                        <th width="15%">Concepto de Pago</th>
                                        <th width="7%">Fecha</th>
                                        <th width="8%"># de Boleta</th>
                                        <th width="7%">Monto S/.</th>
                                        <th width="10%">usuario que registró</th>


                                    </tr>
                                    </thead>
                                    <tbody>';




       while($row0=mysql_fetch_array($result2)){

    $sqlz="(select p.idpago, ae.descripcion, concat(pe.apellidos,' ',pe.nombres), pe.dni,g.nombre,
s.nombre,pg.descripcion, p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario
FROM pagorealizado p
                inner join persona pe on pe.idpersona=p.idpersona
                inner join usuario u on u.idusuario=p.idusuario
                inner join alumno a on a.idpersona=pe.idpersona
                inner join detalusec da on da.idalumno=a.idalumno
                inner join seccion s on s.idseccion=da.idseccion
                inner join grado g on g.idgrado=s.idgrado
                inner join aescolar ae on ae.idA=da.idA
                inner join filtropago f on f.idfiltropago=p.idfiltropago
                inner join pagogeneral pg on pg.idfiltropago=f.idfiltropago
                where da.idA='".$row0[0]."' and p.fecha between ae.fechaini and ae.fechafin
                and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." ".$sql2."  ".$sql3."
                group by p.idpago )
union
(select p.idpago,ae.descripcion, concat(pe.apellidos,' ',pe.nombres), pe.dni,g.nombre,
s.nombre,concat(pc.descripcion,'-',year(pc.fechaini)), p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario
FROM pagorealizado p
                inner join persona pe on pe.idpersona=p.idpersona
                inner join usuario u on u.idusuario=p.idusuario
                inner join alumno a on a.idpersona=pe.idpersona
                inner join detalusec da on da.idalumno=a.idalumno
                inner join seccion s on s.idseccion=da.idseccion
                inner join grado g on g.idgrado=s.idgrado
                inner join aescolar ae on ae.idA=da.idA
                inner join filtropago f on f.idfiltropago=p.idfiltropago
                inner join pagoCronogramado pc on pc.idfiltropago=f.idfiltropago
                where da.idA='".$row0[0]."' and p.fecha between ae.fechaini and ae.fechafin
                and (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." ".$sql2."  ".$sql3."
                group by p.idpago )
 order by 8,4;";   
        

$res1=mysql_query($sqlz) or die("error2");
while($row=mysql_fetch_array($res1)){
$fecha="".substr($row[7],8,2)."/".substr($row[7],5,2)."/". substr($row[7],0,4);

            echo '<tr><td style="text-align:center;">'.$cont.'</td>';
            echo'<td>'.$row[1].'</td>';
            echo'<td>'.$row[2].'</td>';
            echo'<td>'.$row[3].'</td>';
            echo'<td>'.$row[4].'</td>';
            echo'<td>'.$row[5].'</td>';
            echo'<td>'.$row[6].'</td>';
            echo'<td>'.$fecha.'</td>';
            echo'<td>'.$row[8].'</td>';
            echo'<td>'.$row[9].'</td>';
            echo'<td>'.$row[11].'</td>';
                

        

                $cont++;
    }
  
}












       
    

    echo' </tbody>
                                </table>
                            </div>
                        </div></div>';







?>
