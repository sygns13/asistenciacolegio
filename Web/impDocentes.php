<?php
session_start();
if(!isset($_SESSION['userCR'])||($_SESSION['nivelCR']<1)){
    header('Location:../index.php');
}
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");


	require("estilos1.php");


    $selF=$_GET['v1'];

    $selA=$_GET['v2'];



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
        $res=mysql_query($sql) or die("error");

        while($row=mysql_fetch_array($res)){
            $fecha="".substr($row[1],8,2)."/".substr($row[1],5,2)."/". substr($row[1],0,4);

            echo'<div style="width: 24cm;margin: auto;background: " >';
            echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Lista de Asistencia del: '.$fecha.' </h3>';

            $cont=1;
                
                    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Docentes</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Docente</th>
                                        <th width="19%">DNI</th>
                                        <th width="15%">Especialidad</th>
                                        <th width="19%">Asistencia</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
             $sql3="select d.iddocente,p.idpersona,p.nombres,p.apellidos,p.dni,d.estado,
                    if('".$row[1]."'>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.idDia='".$row[0]."' and asi.idpersona=p.idpersona),p.fecR, d.especialidad
                    from docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where d.estado='Activo' and year(p.fecR)<=year('".$row[1]."');;"; 

             $res3=mysql_query($sql3) or die("error3");
            while($r3=mysql_fetch_array($res3)){


                if($selA==0){

                    $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $doc="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $esp="'".$r3[9]."'";


               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                echo'<td>'.$r3[9].'</td>';
                if($r3[6]==0){
                    echo'<td>Docente Registrado el: '.$fecha2.'</td></tr>'; 

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

                if($selA==1){

                     if($r3[7]=='Asistió'){
                            $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $doc="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $esp="'".$r3[9]."'";


               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                echo'<td>'.$r3[9].'</td>';
                if($r3[6]==0){
                    echo'<td>Docente Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td></tr>';

                    }
                    else{

                         if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada</td></tr>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td></tr>'; 
                            }

                        
                    }
                }
                

                $cont++;
                     }


                }

                if($selA==2){
                    if($r3[7]=='Inasistio' or strlen($r3[7])==0){
                               $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $doc="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $esp="'".$r3[9]."'";


               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$r3[3].' '.$r3[2].'</td>';
                echo'<td>'.$r3[4].'</td>';
                echo'<td>'.$r3[9].'</td>';
                if($r3[6]==0){
                    echo'<td>Docente Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td></tr>';

                    }
                    else{

                         if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada</td></tr>';
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

        echo'</div>'



?>
