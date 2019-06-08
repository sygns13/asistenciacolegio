<?php
session_start();
if(!isset($_SESSION['userCR'])||($_SESSION['nivelCR']<1)){
    header('Location:../index.php');
}
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");


	require("estilos1.php");
    $selF=$_GET['v'];

    $fec1=$_GET['v1'];
    $fec2=$_GET['v2'];



    $idper=$_GET['v3'];

    $dtos=$_GET['v4'];

    $ptos=$_GET['v5'];

    echo'<style type="text/css" media="print">
@media print {
#btnImprimir {display:none;}


}
</style>';

echo'<div style="position:absolute; margin-left: 50px; margin-top: 25px;" id="btnImprimir" >

<button type="button" class="btn btn-info" onclick="window.print();">Imprimir</button>
</div>';

                    //Ini ModA
            $sql="";


    if($selF==0){
          $sql="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
from persona p
inner join detconcepto d on d.idpersona=p.idpersona
inner join listaconcepto l on l.idlista=d.idlista
inner join concepto c on c.idconcepto=l.idconcepto
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=d.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and d.fecha=curdate() order by d.fecha)
union all
(select o.fecha,'OBSERVACIÓN GENERAL',o.descr,'',g.nombre,s.nombre,u.usuario,'0',o.idobs,'1' as iden
from persona p
inner join obs o on o.idpersona=p.idpersona
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=o.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and o.fecha=curdate() order by o.fecha);";

    }

    elseif($selF==1){
       $sql="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0'as iden
from persona p
inner join detconcepto d on d.idpersona=p.idpersona
inner join listaconcepto l on l.idlista=d.idlista
inner join concepto c on c.idconcepto=l.idconcepto
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=d.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and month(d.fecha)=month(curdate()) order by d.fecha)
union all
(select o.fecha,'OBSERVACIÓN GENERAL',o.descr,'',g.nombre,s.nombre,u.usuario,'0',o.idobs,'1'as iden
from persona p
inner join obs o on o.idpersona=p.idpersona
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=o.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and month(o.fecha)=month(curdate()) order by o.fecha);
";
    }

    elseif($selF==2){


       $sql="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
from persona p
inner join detconcepto d on d.idpersona=p.idpersona
inner join listaconcepto l on l.idlista=d.idlista
inner join concepto c on c.idconcepto=l.idconcepto
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=d.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and year(d.fecha)=year(curdate()) order by d.fecha)
union all
(select o.fecha,'OBSERVACIÓN GENERAL',o.descr,'',g.nombre,s.nombre,u.usuario,'0',o.idobs,'1' as iden
from persona p
inner join obs o on o.idpersona=p.idpersona
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=o.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and year(o.fecha)=year(curdate()) order by o.fecha);";

    }

    

    if($selF==3){
        $fec1=substr($fec1,6,4)."/".substr($fec1,3,2)."/". substr($fec1,0,2);
        $fec2=substr($fec2,6,4)."/".substr($fec2,3,2)."/". substr($fec2,0,2);
       $sql="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
from persona p
inner join detconcepto d on d.idpersona=p.idpersona
inner join listaconcepto l on l.idlista=d.idlista
inner join concepto c on c.idconcepto=l.idconcepto
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=d.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo' and p.idpersona='".$idper."' and d.fecha between '".$fec1."' and '".$fec2."' order by d.fecha)
union all
(select o.fecha,'OBSERVACIÓN GENERAL',o.descr,'',g.nombre,s.nombre,u.usuario,'0',o.idobs,'1' as iden
from persona p
inner join obs o on o.idpersona=p.idpersona
inner join alumno a on a.idpersona=p.idpersona
inner join detalusec da on da.idalumno=a.idalumno
inner join seccion s on s.idseccion=da.idseccion
inner join grado g on g.idgrado=s.idgrado
inner join usuario u on u.idusuario=o.idusuario
inner join aescolar ae on ae.ida=da.ida
where ae.estado='Activo'  and p.idpersona='".$idper."' and o.fecha between '".$fec1."' and '".$fec2."' order by o.fecha);";
    }

    


    $res=mysql_query($sql) or die("error");
    echo'<div style="width: 24cm;margin: auto;background: " >';
    
    echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Detalle de Méritos, Deméritos y otros.</h3>';

    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$dtos.' <div id="punt" style="display:inline-block; float:right;">Puntaje Total: '.$ptos.'</div></div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                       <th width="5%" style="text-align:center;">#</th>
                                        <th width="10%">Fecha</th>
                                       
                                        <th width="10%">Concepto</th>      
                                        <th width="20%">Descripción</th>
                                        <th >Observación</th>
                                        
                                        <th width="10%">Grado</th>
                                        <th width="10%">Seccion</th>

                                        <th width="10%">Usuario </th>
                                         <th width="5%">Puntos </th>


                                    </tr>
                                    </thead>
                                    <tbody>';



    $cont=1;
    while($row=mysql_fetch_array($res)){
        $fecha="".substr($row[0],8,2)."/".substr($row[0],5,2)."/". substr($row[0],0,4);
   
        $nom="'".$row[2]."'";

                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$fecha.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';
                echo'<td>'.$row[3].'</td>';
                echo'<td>'.$row[4].'</td>';
                echo'<td>'.$row[5].'</td>';
                echo'<td>'.$row[6].'</td>';
                echo'<td>'.$row[7].'</td></tr>';
                 
                $cont++;

    }

    echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

        echo'</div>'



?>
