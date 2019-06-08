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
         $sql="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,da.fecha, s.nombre,g.nombre,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    inner join grado g on g.idgrado=s.idgrado
                    where p.idpersona='".$idper."'  and year(da.fecha)=ae.descripcion and da.fecha=curdate()
                    order by da.idDia desc;";

    }

    elseif($selF==1){
        $sql="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,da.fecha, s.nombre,g.nombre,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    inner join grado g on g.idgrado=s.idgrado
                    where p.idpersona='".$idper."'  and year(da.fecha)=ae.descripcion and month(da.fecha)=month(curdate())
                    order by da.idDia desc;";
    }

    elseif($selF==2){


        $sql="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,da.fecha, s.nombre,g.nombre,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    inner join grado g on g.idgrado=s.idgrado
                    where p.idpersona='".$idper."'  and year(da.fecha)=ae.descripcion and year(da.fecha)=year(curdate())
                    order by da.idDia desc;";
    }

    elseif($selF==3){
        $sql="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,da.fecha, s.nombre,g.nombre,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    inner join grado g on g.idgrado=s.idgrado
                    where p.idpersona='".$idper."'  and year(da.fecha)=ae.descripcion
                    order by da.idDia desc;";
    }

    if($selF==4){
        $fec1=substr($fec1,6,4)."/".substr($fec1,3,2)."/". substr($fec1,0,2);
        $fec2=substr($fec2,6,4)."/".substr($fec2,3,2)."/". substr($fec2,0,2);
        $sql="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,da.fecha, s.nombre,g.nombre,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    inner join grado g on g.idgrado=s.idgrado
                    where p.idpersona='".$idper."'  and year(da.fecha)=ae.descripcion and da.fecha between '".$fec1."' and '".$fec2."'
                    order by da.idDia desc;";
    }

    


    $res=mysql_query($sql) or die("error");
    echo'<div style="width: 24cm;margin: auto;background: " >';
    
    echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Detalle de Asistencias</h3>';

    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$dtos.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                       <th width="5%" style="text-align:center;">#</th>
                                        <th width="10%">Fecha</th>
                                        <th width="10%">Hora Ingreso</th>
                                        <th width="10%">Hora Salida</th>      
                                        <th>Alumno</th>
                                        <th width="8%">DNI</th>
                                        <th width="10%">Grado</th>
                                        <th width="10%">Seccion</th>

                                        <th width="10%">Usuario </th>
                                        <th width="15%">Asistencia</th>


                                    </tr>
                                    </thead>
                                    <tbody>';



    $cont=1;
    while($row=mysql_fetch_array($res)){
        $fecha2="".substr($row[11],8,2)."/".substr($row[11],5,2)."/". substr($row[11],0,4);
        $fec2="".substr($row[6],8,2)."/".substr($row[6],5,2)."/". substr($row[6],0,4);

        $fec="'".$row[6]."'";
        $fec3="'".$fec2."'";
        $idPer="'".$row[1]."'";
        $alum="'".$row[3].' '.$row[2]."'";
        $dni="'".$row[4]."'";
        $grado="'".$row[8]."'";
        $sec="'".$row[7]."'";

                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$fec2.'</td>';
                if(strlen($row[13])==0){
                    echo'<td style="text-align:center;">---------</td>';
                    echo'<td style="text-align:center;">---------</td>';
                }
                else{
                 echo'<td>'.$row[13].'</td>';  
                  if($row[13]==$row[14]){
                    echo'<td style="text-align:center;">---------</td>';
                 }
                 else{
                    echo'<td>'.$row[14].'</td>';
                 } 
                }
                
                echo'<td>'.$row[3].' '.$row[2].'</td>';
                echo'<td>'.$row[4].'</td>';
                echo'<td><strong>'.$row[8].'</strong></td>';
                echo'<td><strong>'.$row[7].'</strong></td>';
                 if($row[9]==0){
                    echo'<td style="text-align:center;">---------</td> <td>Alumno Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($row[9]==1){
                    if(strlen($row[10])==0){
                         echo'<td style="text-align:center;">---------</td> <td>No Asistió</td></tr>';

                    }
                    else{
                        if($row[10]=='Inasistio'){
                                echo'<td>'.$row[12].'</td><td>Falta Justificada</td>
                                </tr>';
                            }
                            else{
                                echo'<td>'.$row[12].'</td> <td>'.$row[10].'</td></tr>'; 
                            }
                        
                    }
                }
                 
                $cont++;

    }

    echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

        echo'</div>'



?>
