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

    $selA=$_GET['v2'];

    $selS=$_GET['v3'];

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
                $sql="select * FROM diaasistencia d  where fecha=curdate() order by idDia desc;";
                    }

            elseif($selF==1){
                $sql="select * FROM diaasistencia d  where month(fecha)=month(curdate()) order by idDia desc;";
            }

            elseif($selF==2){
                $sql="select * FROM diaasistencia d  where year(fecha)=year(curdate()) order by idDia desc;";
            }

            elseif($selF==3){
                $sql="select * FROM diaasistencia d order by idDia desc;";
            }

            elseif($selF==4){

                $fecin=$_GET['v4'];
                $fecfi=$_GET['v5'];

                $fecin=substr($fecin,6,4)."/".substr($fecin,3,2)."/". substr($fecin,0,2);
                $fecfi=substr($fecfi,6,4)."/".substr($fecfi,3,2)."/". substr($fecfi,0,2);

                $sql="select * FROM diaasistencia d  where fecha between '".$fecin."' and '".$fecfi."' order by idDia desc;";
            }

        //$sql="select * FROM diaasistencia d order by idDia desc;";
        $res=mysql_query($sql) or die("error");

        while($row=mysql_fetch_array($res)){
            $fecha="".substr($row[1],8,2)."/".substr($row[1],5,2)."/". substr($row[1],0,4);

            echo'<div style="width: 24cm;margin: auto;background: " >';

            echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Lista de Asistencia del: '.$fecha.' </h3>';


            if($selG==0){
                    $sql1="select g.idgrado,g.nombre,g.estado FROM grado g
                inner join seccion s on s.idGrado=g.idGrado
                inner join detalusec d on d.idseccion=s.idseccion
                inner join alumno a on a.idalumno=d.idalumno
                where g.estado='Activo' and a.estado='Estudiante'  group by g.idgrado order by g.idgrado;";
            }

            else{
                $sql1="select g.idgrado,g.nombre,g.estado FROM grado g
                inner join seccion s on s.idGrado=g.idGrado
                inner join detalusec d on d.idseccion=s.idseccion
                inner join alumno a on a.idalumno=d.idalumno
                where g.estado='Activo' and a.estado='Estudiante' and g.idgrado='".$selG."' group by g.idgrado order by g.idgrado;";
            }
        
        $res1=mysql_query($sql1) or die("error1");
        while ($r1=mysql_fetch_array($res1)) {
            echo'<div style="font-size: 18px; color: #333;padding: 7px 15px;">Grado: '.$r1[1].':</div>';


       if($selG==0){
        $sql2="select * from seccion s where idGrado='".$r1[0]."' and estado='Activo';";
       }

       else{
        if($selS==0){
            $sql2="select * from seccion s where idGrado='".$r1[0]."' and estado='Activo';";
        }
        else{
            $sql2="select * from seccion s where idGrado='".$r1[0]."' and idseccion='".$selS."' and estado='Activo';";
        }

       }

        



        $res2=mysql_query($sql2) or die ("error2");

        while($r2=mysql_fetch_array($res2)){

            $cont=1;
                
                    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Sección: '.$r2[1].'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Alumno</th>
                                        <th width="19%">DNI</th>
                                        <th width="25%">Asistencia</th>


                                    </tr>
                                    </thead>
                                    <tbody>';

                                    $sql3="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,
                    if('".$row[1]."'>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.idDia='".$row[0]."' and asi.idpersona=p.idpersona),p.fecR
                    from alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join Seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    where s.idseccion='".$r2[0]."' and a.estado='Estudiante' and year('".$row[1]."')=ae.descripcion
                    order by p.apellidos, p.nombres;"; 



            

            $res3=mysql_query($sql3) or die("error3");
            while($r3=mysql_fetch_array($res3)){

                if($selA==0){
                    $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $alum="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $grado="'".$r1[1]."'";
                $sec="'".$r2[1]."'";

               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td></tr>';

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada </td></tr>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td></tr>'; 
                            }
                        
                    }
                }
                

                $cont++;
    
}
elseif ($selA==1) {

    if($r3[7]=='Asistió'){
         $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $alum="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $grado="'".$r1[1]."'";
                $sec="'".$r2[1]."'";

               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td></tr>';

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada  </td></tr>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td></tr>'; 
                            }
                        
                    }
                }
                

                $cont++;
    }
    
}

elseif ($selA==2) {
    if($r3[7]=='Inasistio' or strlen($r3[7])==0){
         $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $alum="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $grado="'".$r1[1]."'";
                $sec="'".$r2[1]."'";

               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td></tr>';

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada </td></tr>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td></tr>'; 
                            }
                        
                    }
                }
                

                $cont++;
    }
}



                

            }                        

            
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';


        }

        }

        }

        echo'</div>'



?>
