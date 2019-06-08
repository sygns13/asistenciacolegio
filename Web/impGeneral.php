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

         
         $sqlz="select p.idpago, sum(p.pago), p.fecha, p.numboleta, pe.idpersona, pe.dni,concat(pe.apellidos,' ',pe.nombres), u.usuario FROM pagorealizado p
                inner join persona pe on pe.idpersona=p.idpersona
                inner join usuario u on u.idusuario=p.idusuario
                inner join alumno a on a.idpersona=pe.idpersona
                where (pe.nombres like '%".$per."%' or pe.apellidos like '%".$per."%' or pe.dni like '%".$per."%') ".$sql." group by p.fecha, p.numboleta, p.idpersona,p.idusuario;";   
        

$res=mysql_query($sqlz) or die("error1");

$cont=1;
$sum=0;
    while($row=mysql_fetch_array($res)){
            
        $sum=$sum+$row[1];
    }


echo'<div style="width: 24cm;margin: auto;background: " >';

            echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Reporte Económico General</h3>';
$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$cabe.' Monto Total: S/.'.$num.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Alumno</th>
                                        <th width="10%">DNI</th>
                                        <th width="15%"># de Boleta</th>
                                        <th width="10%">Fecha</th>
                                        <th width="10%">Monto S/.</th>
                                        <th width="15%">usuario que registró</th>


                                    </tr>
                                    </thead>
                                    <tbody>';




        $res1=mysql_query($sqlz) or die("error2");

        while($row=mysql_fetch_array($res1)){
            $fecha="".substr($row[2],8,2)."/".substr($row[2],5,2)."/". substr($row[2],0,4);

            echo '<tr><td style="text-align:center;">'.$cont.'</td>';
            echo'<td>'.$row[6].'</td>';
            echo'<td>'.$row[5].'</td>';
            echo'<td>'.$row[3].'</td>';
            echo'<td>'.$fecha.'</td>';
            echo'<td>'.$row[1].'</td>';
            echo'<td>'.$row[7].'</td>';
                

        

                $cont++;
    }
    

    echo' </tbody>
                                </table>
                            </div>
                        </div></div>';







?>
