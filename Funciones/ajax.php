<?php
require "../Funciones/General.php";
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");
$modulo = $_POST['modulo'];
$accion = $_POST['accion'];

switch ($modulo) {

case 0:	// Modulo Alumnos
		
		switch ($accion) {
			case 0: // Buscar Alumnos
				
			$bus=$_POST['search'];

            $sql0="select * FROM grado g where g.estado='Activo' and nombre like '%".$bus."%';";
            $result0=mysql_query($sql0);
            
            while($row0=mysql_fetch_array($result0)){
                $cont=1;
                $nom="'".$row0[1]."'";
                    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Grado: '.$row0[1].'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Sección</th>
                                        <th width="21%">Gestión</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $sql="select * FROM seccion s where s.estado='Activo' and s.idgrado='".$row0[0]."';";                   
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){

                $nom1="'".$row[1]."'";
                echo '<tr><td>'.$cont.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>
                <a href="alumnosSec.php?v1='.$row[0].'"><button type="button" class="btn btn-success">
                <i class="fa fa-users"></i></button></a>

                <a href="javascript:;" onclick="editS('.$row0[0].','.$nom.','.$row[0].','.$nom1.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delS('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"  
                style="padding-left:14px;padding-right:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';

                $cont++;

            }                        

            echo'<tr><td colspan="3">
            <a href="javascript:;" onclick="newS('.$row0[0].','.$nom.')"><button type="button" class="btn btn-warning">
                <i class="fa fa-plus"></i></button></a>
            </td></tr>';
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

            }

		


			break;

            case 1:

            $cod=$_POST['v1'];
            $nomS=$_POST['v2'];

            $aux=0;
            $sql0="select * from seccion where nombre='".$nomS."' and idGrado='".$cod."' and estado='Activo';";
            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){
                $aux=1;
            }

            if($aux==1){
                echo'0';
            }
            if($aux==0){
                $sql="insert into seccion values(null,'".$nomS."','".$cod."','Activo');";
                if(mysql_query($sql)){
                    echo '1';
                }
                else{
                     echo '2';
                }

            }

            break;

            case 2:
            $cod=$_POST['v1'];

            $aux=0;
            $sql0="select a.idAlumno,s.nombre
                    from seccion s
                    inner join detalusec d on d.idseccion=s.idseccion
                    inner join alumno a on a.idalumno=d.idalumno
                    inner join aescolar ae on ae.idA=d.idA
                    where s.idseccion='".$cod."' and a.estado='Estudiante' and ae.estado='Activo';";

            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){

                $aux=1;
            }

            if($aux==1){
                echo '1';
            }
            if($aux==0){

                $aux1=0;
                $sql0="select a.idAlumno,s.nombre
                        from seccion s
                        inner join detalusec d on d.idseccion=s.idseccion
                        inner join alumno a on a.idalumno=d.idalumno
                        inner join aescolar ae on ae.idA=d.idA
                        where s.idseccion='".$cod."';";
                $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){

                $aux1=1;
            }

            if($aux1==1){

                $sql="update Seccion set estado='Baja' where idseccion='".$cod."';";
                if(mysql_query($sql)){
                    echo'3';
                }
                else{
                        echo'4';
                }
            }

            else{
                $sql1="delete from dethoraseccion where idseccion='".$cod."';";
                $sql="delete from Seccion where idseccion='".$cod."';";

                if(mysql_query($sql1)){
                    if(mysql_query($sql)){
                        echo'2';
                    }
                    else{
                        echo'4';
                    }
                }
                else{
                    echo'4';
                }



            }
            }

            break;

            case 3:

            $idSec=$_POST['v1'];
            $nom=$_POST['v2'];
            $idGra=$_POST['v3'];

             $aux=0;
            $sql0="select * from seccion s where s.nombre='".$nom."' and s.idGrado='".$idGra."' and s.estado='Activo'
                    and s.idseccion not in (select se.idseccion from seccion se where se.idseccion='".$idSec."');";
            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){
                $aux=1;
            }

            if($aux==1){
                echo'0';
            }
            if($aux==0){
                $sql="update seccion set nombre='".$nom."' where idseccion='".$idSec."'";
                if(mysql_query($sql)){
                    echo '1';
                }
                else{
                     echo '2';
                }

            }


            break;

            case 4:

            $idSe=$_POST['v1'];

         


                echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Alumnos</div>
                            <div class="panel-body">';

            

            $sql="select p.idpersona,concat(p.nombres,' ',p.apellidos),p.dni,p.telefono,p.direccion,p.correo, 
                (select if(year(curdate())=ae.descripcion,0,1))
                    from alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on d.idalumno=a.idalumno
                    inner join seccion s on s.idseccion=d.idseccion
                    inner join aescolar ae on ae.idA=d.idA
                    where s.idseccion='".$idSe."' and a.estado='Estudiante'
                    and a.idalumno not in(
select al.idalumno from alumno al,detalusec da, aescolar aes
where aes.estado='Activo' and aes.fechaini>ae.fechafin and al.idalumno=da.idalumno and aes.idA=da.idA);
";
            
                 echo' 
                                <table class="table table-hover table-bordered" name="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th width="10%" style="text-align:center;">Sel
                                          
                                            <input type="checkbox" name="selT" id="selT" value="0" onClick="Seleccionar(this);">
                                            
                                        </th>
                                        <th>Alumno</th>
                                        <th width="10%">DNI</th>
                                        <th  width="20%">Estado</th>
                                        <th width="16%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){



                $nom1="'".$row[1]."'";
                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo '<td style="text-align:center;">
              
                <input type="checkbox" name="idAlum[]" id="idAlum" class="idAlum" value="' . $row[0] . '">
            
                </td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';

                if($row[6]==0){
                    echo'<td>Matriculado<input type="hidden" id="estMat' . $row[0] . '" value="0"></td>';
                }
                elseif($row[6]==1){
                    echo'<td>No Matriculado<input type="hidden" id="estMat' . $row[0] . '" value="1"></td>';
                }
                
                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="editA('.$row[0].','.$nom1.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delA('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';

                $cont++;

            }                        

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';
            break;

            case 5:

            $nom=$_POST['v1'];
            $ape=$_POST['v2'];
            $dni=$_POST['v3'];
            $dir=$_POST['v4'];
            $telf=$_POST['v5'];
            $mail=$_POST['v6'];

            $idSec=$_POST['v7'];
            $aux=0;

            $sql0="select * FROM persona p where dni='".$dni."';";

            $result0=mysql_query($sql0) or die("error");

            while ($row=mysql_fetch_array($result0)) {
                $aux=1;
            }
            if($aux==1){
                 echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> DNI de Alumno ya existente, no se realizo el registro.
                                        </div>';
            }

            else{
                $sql="insert into persona values(null,'".$nom."','".$ape."','".$dni."','".$telf."','".$dir."','".$mail."',curdate());";
                if(mysql_query($sql)){
                    $idP=0;
                    $sql0="select p.idpersona from persona p order by p.idpersona desc  limit 1;";

                    $result=mysql_query($sql0) or die("error");

                    while ($row=mysql_fetch_array($result)) {
                        $idP=$row[0];
                    }

                    $sql1="insert into alumno values(null,'Estudiante', '".$idP."')";

                    if(mysql_query($sql1)){
                        $idAE=0;
                        $idAlumno=0;

                        $sqlz="select * from aescolar where estado='Activo';";
                        $resz=mysql_query($sqlz) or die("errorz");
                        while ($row1=mysql_fetch_array($resz)) {
                        $idAE=$row1[0];
                    }

                    $sqlz1="select * from alumno order by idalumno desc limit 1;";
                        $resz1=mysql_query($sqlz1) or die("errorz1");
                        while ($row2=mysql_fetch_array($resz1)) {
                        $idAlumno=$row2[0];
                    }

                    $sqlf="insert into detAluSec values(null,'".$idAlumno."','".$idAE."','".$idSec."','Activo');";
                    if(mysql_query($sqlf)){

                        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el registro del alumno.
                                        </div>';
                    }




                    }
                    else{
                        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
                    }


                }
                else{
                    echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
                }

            }

            break;

            case 6:

            $cod=$_POST['v1'];
            $aux=0;
            $auxAlu=0;

            $sqIni="select idalumno from alumno where idpersona='".$cod."';";
            $resIni=mysql_query($sqIni) or die("error");
            while($row=mysql_fetch_array($resIni)){
                $auxAlu=$row[0];
            }


            $sqz="delete from detAluSec where idAlumno='".$auxAlu."';";
            $sql0="delete from alumno where idpersona='".$cod."';";
            $sql="delete from persona where idpersona='".$cod."';";

            $consul="select * FROM asistencia a where a.idpersona='".$cod."';";
            $result=mysql_query($consul) or die("error");
            while ($row=mysql_fetch_array($result)) {
                $aux=1;
            }

            if($aux==1){
                echo'1';
            }
            else{
                if(mysql_query($sqz)){
                   if(mysql_query($sql0)){
                    if(mysql_query($sql)){
                        echo'2';
                    }
                    else{
                        echo'3';
                    }
                }  else{
                        echo'3';
                    }
                }
                
                else{
                    echo'3';
                }


            }
          



            break;

            case 7:

            $cod=$_POST['v1'];

            $sql="select * FROM persona p where p.idpersona='".$cod."';";

            $miarray=array('nom'=>"vacio",'ape'=>"vacio",'dni'=>"vacio",'tel'=>"vacio",'dir'=>"vacio",'mail'=>"vacio");
            $result=mysql_query($sql) or die("error");

            while ($row=mysql_fetch_array($result)) {
                $miarray=array('nom'=>$row[1],'ape'=>$row[2],'dni'=>$row[3],'tel'=>$row[4],'dire'=>$row[5],'mail'=>$row[6]);
    
            }

            echo (json_encode($miarray));

            break;

            case 8:

             $nom=$_POST['v1'];
            $ape=$_POST['v2'];
            $dni=$_POST['v3'];
            $dir=$_POST['v4'];
            $telf=$_POST['v5'];
            $mail=$_POST['v6'];

            $idP=$_POST['v'];
            $aux=0;

             $sql0="select * FROM persona p where dni='".$dni."'
                    and p.idpersona not in (select pe.idpersona from persona pe where pe.idpersona='".$idP."');";

            $result0=mysql_query($sql0) or die("error");

            while ($row=mysql_fetch_array($result0)) {
                $aux=1;
            }
            if($aux==1){
                 echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> DNI de Alumno ya existente, no se realizo el cambio.
                                        </div>';
            }
            else{
                $sql="update persona set nombres='".$nom."', apellidos='".$ape."', dni='".$dni."', 
                telefono='".$telf."', direccion='".$dir."', correo='".$mail."' where idpersona='".$idP."';";

                if(mysql_query($sql)){
                    echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el cambio del alumno.
                                        </div>';
                }
                else{
                    echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el cambio. 
                                        </div>';
                }


            }

            break;

            case 9:

            $idSec=$_POST['v'];
            $aux=0;

            $sql="select idgrado from seccion where idseccion='".$idSec."';";
            $res=mysql_query($sql) or die("error");
            while($row=mysql_fetch_array($res)){
                $aux=$row[0];
            }

            if($aux<11){
                $aux=$aux+1;
                $sql1="select * FROM grado g where idgrado='".$aux."';";
                $sql2="select * from seccion s where idgrado='".$aux."';";

                $res1=mysql_query($sql1) or die("error1");
                $res2=mysql_query($sql2) or die("error1");

                while($row=mysql_fetch_array($res1)){
                    
                    echo'<h4>Grado: '.$row[1].'</h4> ';
            }
                echo'Sección: <select class="form-control" style="display:inline;width: 50%;" id="idNewSec">';

                while($row=mysql_fetch_array($res2)){
                    
                    echo'<option value="'.$row[0].'">'.$row[1].'</option>';
            }

            echo'</select> ';


            }

            if($aux==11){
                echo'<h4>Finalizar Estudios</h4> ';
                echo'Acción: <select class="form-control" style="display:inline;width: 50%;" id="idNewSec">';
                echo'<option value="-1">Egresar del Colegio</option>';
                echo'</select> ';
            }



            break;

            case 10:
            $idalum=$_POST['v'];
            $idSec=$_POST['v1'];

            $sql="CALL PasarDeGrado('".$idSec."','".$idalum."')";

            if(mysql_query($sql)){
                echo'guud';
            }
            else{
                echo'fail';
            }

            break;

            case 11:
             $idalum=$_POST['v'];
            

            $sql="CALL EgresarEstudios('".$idalum."')";

            if(mysql_query($sql)){
                echo'guud';
            }
            else{
                echo'fail';
            }

            break;


            case 12:
            $idalum=$_POST['v'];
            $idSec=$_POST['v1'];

            $sql="CALL PasarDeGrado('".$idSec."','".$idalum."')";

            if(mysql_query($sql)){
                echo'guud';
            }
            else{
                echo'fail';
            }

            break;




			}
			

break;

case 1:

switch ($accion) {
    case  0:

    $bus=$_POST['search'];


        echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Docentes</div>
                            <div class="panel-body" style="overflow-x:auto;">';

            

            $sql="select p.idpersona,concat(p.nombres,' ',p.apellidos),p.dni,p.telefono,p.direccion,p.correo, d.especialidad
                    from docente d
                    inner join persona p on p.idpersona=d.idpersona
                     where d.estado='Activo' and (p.nombres like '%".$bus."%' or p.apellidos like '%".$bus."%' or p.dni like '%".$bus."%');";
            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Docente</th>
                                        <th width="13%">DNI</th>
                                        <th width="15%">especialidad</th>
                                        <th width="16%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){

                $nom1="'".$row[1]."'";
                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';
                 echo'<td>'.$row[6].'</td>';
                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="editD('.$row[0].','.$nom1.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delD('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';

                $cont++;

            }                        

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';
    break;

    case 1:

            $nom=$_POST['v1'];
            $ape=$_POST['v2'];
            $dni=$_POST['v3'];
            $dir=$_POST['v4'];
            $telf=$_POST['v5'];
            $mail=$_POST['v6'];

            $esp=$_POST['v7'];
            $aux=0;

            $sql0="select * FROM persona p where dni='".$dni."';";

            $result0=mysql_query($sql0) or die("error");

            while ($row=mysql_fetch_array($result0)) {
                $aux=1;
            }
            if($aux==1){
                 echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> DNI del Docente ya existente, no se realizo el registro.
                                        </div>';
            }

            else{
                $sql="insert into persona values(null,'".$nom."','".$ape."','".$dni."','".$telf."','".$dir."','".$mail."',curdate());";
                if(mysql_query($sql)){
                    $idP=0;
                    $sql0="select p.idpersona from persona p order by p.idpersona desc  limit 1;";

                    $result=mysql_query($sql0) or die("error");

                    while ($row=mysql_fetch_array($result)) {
                        $idP=$row[0];
                    }

                    $sql1="insert into docente values(null,'Activo', '".$esp."','".$idP."')";

                    if(mysql_query($sql1)){
                        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el registro del docente.
                                        </div>';
                    }
                    else{
                        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
                    }


                }
                else{
                    echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
                }

            }

    break;

    case 2:


    $cod=$_POST['v1'];
            $aux=0;

            $sql0="delete from docente where idpersona='".$cod."';";
            $sql="delete from persona where idpersona='".$cod."';";

            $consul="select * FROM asistencia a where a.idpersona='".$cod."';";
            $result=mysql_query($consul) or die("error");
            while ($row=mysql_fetch_array($result)) {
                $aux=1;
            }

            if($aux==1){
                echo'1';
            }
            else{
                if(mysql_query($sql0)){
                    if(mysql_query($sql)){
                        echo'2';
                    }
                    else{
                        echo'3';
                    }
                }
                else{
                    echo'3';
                }


            }
    break;

    case 3:

        $cod=$_POST['v1'];

            $sql="select * FROM persona p
                    inner join docente d on d.idpersona=p.idpersona
                    where p.idpersona='".$cod."';";

            $miarray=array('nom'=>"vacio",'ape'=>"vacio",'dni'=>"vacio",'tel'=>"vacio",'dir'=>"vacio",'esp'=>"vacio",'mail'=>"vacio");
            $result=mysql_query($sql) or die("error");

            while ($row=mysql_fetch_array($result)) {
                $miarray=array('nom'=>$row[1],'ape'=>$row[2],'dni'=>$row[3],'tel'=>$row[4],'dire'=>$row[5],'esp'=>$row[10],'mail'=>$row[6]);
    
            }

            echo (json_encode($miarray));

    break;

    case 4:

            $nom=$_POST['v1'];
            $ape=$_POST['v2'];
            $dni=$_POST['v3'];
            $dir=$_POST['v4'];
            $telf=$_POST['v5'];
            $mail=$_POST['v6'];
            $esp=$_POST['v7'];

            $idP=$_POST['v'];
            $aux=0;

             $sql0="select * FROM persona p where dni='".$dni."'
                    and p.idpersona not in (select pe.idpersona from persona pe where pe.idpersona='".$idP."');";

            $result0=mysql_query($sql0) or die("error");

            while ($row=mysql_fetch_array($result0)) {
                $aux=1;
            }
            if($aux==1){
                 echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> DNI de Alumno ya existente, no se realizo el cambio.
                                        </div>';
            }
            else{
                $sql="update persona set nombres='".$nom."', apellidos='".$ape."', dni='".$dni."', 
                telefono='".$telf."', direccion='".$dir."', correo='".$mail."' where idpersona='".$idP."';";

                if(mysql_query($sql)){

                    $sq="update docente set especialidad='".$esp."' where idpersona='".$idP."';";

                    if(mysql_query($sq)){


                    echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el cambio del alumno.
                                        </div>';
                                    }
                }
                else{
                    echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el cambio. 
                                        </div>';
                }


            }

    break;
    

}
break;

case 2:

switch ($accion) {
    case 0:
        
        $bus=$_POST['search'];

        $sql="select * FROM aescolar a where descripcion like '%".$bus."%'  order by a.idA desc;";

        $res=mysql_query($sql) or die("error");

        echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Historial de Años Escolares Histórico</div>
                            <div class="panel-body" style="overflow-x:auto;">';

            

            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Descripcion</th>
                                        <th width="20%">Fecha Inicial</th>
                                        <th width="20%">Fecha Final</th>
                                        <th width="20%">Estado</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
    
            while($row=mysql_fetch_array($res)){

                $fecini=substr($row[1], -2).'-'.substr($row[1], -5,2).'-'.substr($row[1], -10,4);
                $fecfin=substr($row[2], -2).'-'.substr($row[2], -5,2).'-'.substr($row[2], -10,4);

                  if($row[4]=="Activo")
                    {
                        $nom1="'".$row[1]."'";
                echo '<tr><td style="text-align:center; background-color:#71EF90;">'.$cont.'</td>';
                echo'<td style="background-color:#71EF90;">'.$row[3].'</td>';

                echo'<td style="background-color:#71EF90;">'.$fecini.'</td>';
                 echo'<td style="background-color:#71EF90;"> '.$fecfin.'</td>';
                echo'<td style="text-align:center; background-color:#71EF90;">'.$row[4].'</td></tr>';
                    }
            else {
                $nom1="'".$row[1]."'";
                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[3].'</td>';
                echo'<td>'.$fecini.'</td>';
                 echo'<td>'.$fecfin.'</td>';
                echo'<td style="text-align:center;">'.$row[4].'</td></tr>';

            }
                

                $cont++;

            }                        

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

        break;

        case 1:

        $sql="select * FROM aescolar a where fechaini<=curdate() and fechafin>=curdate() and estado='Activo';";
        $res=mysql_query($sql) or die("error");

        $aux=0;

        while ($row=mysql_fetch_array($res)) {
            $aux=1;
        }

        echo $aux;


        break;

        case 2:

        $hoy = getdate();
        $y = $hoy['year'];
        
        $sql="CALL NuevoA('".$y."','".$y."/01/01','".$y."/12/31')";
        if(mysql_query($sql)){
            echo'good';
        }
        else{
            echo'fail';
        }


        break;
        
        
    
   
}

break;

case 3:   //Módulo de Control de Asistencia  // Salidas
    switch ($accion) {
        case 0:
          $dni=$_POST['v'];  
          $aux=0;
          $idP="";
          $nom="";
          $ape="";
          $est="";
          $sec="";
          $gra="";
          $idUs=$_POST['v1'];

          $sql0="select p.idpersona, p.nombres, p.apellidos, p.dni, p.telefono, p.direccion, p.correo,p.fecR,a.idalumno,
                    a.estado,a.idpersona,s.nombre,g.nombre
                     FROM persona p
                      inner join alumno a on a.idpersona=p.idpersona
                      inner join detalusec d on d.idalumno=a.idalumno
                     inner join seccion s on s.idseccion=d.idseccion
                      inner join grado g on g.idgrado=s.idgrado
                      where a.estado='Estudiante' and p.dni='".$dni."' 

                    union
                    select  p.idpersona, p.nombres, p.apellidos, p.dni, p.telefono, p.direccion, p.correo,p.fecR,d.iddocente,
                    d.estado,d.idpersona,d.especialidad,d.especialidad
                    from persona p
                      inner join docente d on d.idpersona=p.idpersona
                      where d.estado='Activo' and p.dni='".$dni."' ";

        $res=mysql_query($sql0) or die("error");
        
        while($row=mysql_fetch_array($res)){
            $aux=1;
              $idP=$row[0];
              $nom=$row[1];
              $ape=$row[2];
              $est=$row[9];
              $sec=$row[11];
              $gra=$row[12];


        }  



        if($aux==0){
             echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>No Registrado!</strong> No se encuentran registros de Alumnos o docentes con el DNI '.$dni.'.  </div>';
        }

        else{
            $sql="select * FROM asistencia a where a.idpersona='".$idP."' and a.fecha=curdate();";
            $result=mysql_query($sql) or die("error2");
            $aux1=0;

            while ($row=mysql_fetch_array($result)) {

                $aux1=1;

                if($est=="Estudiante"){

                    echo'<br><div class="alert alert-info alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Ya Registrado!</strong>  Alumno(a): '.$ape.' '.$nom.'.  DNI: '.$dni.' <br>
                Grado: '.$gra.'. Sección: '.$sec.'<br>
                Ya ha sido registrado el día de hoy alas '.$row[3].'.
            </div>';

                }

                if($est=="Activo"){

                    echo'<br><div class="alert alert-info alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Ya Registrado!</strong> Docente: '.$ape.' '.$nom.'. DNI: '.$dni.' <br>
                Ya ha sido registrado el día de hoy alas '.$row[3].'.
            </div>';
                    
                }


                

            }

            if($aux1==0){
                $sql1="CALL CAsistencia('".$dni."','".$idUs."')";
                if(mysql_query($sql1)){
                    $hoy = getdate();

                    $sq="select curtime();";
                    $res=mysql_query($sq) or die("error3");
                    $time="hh:mm:ssss";
                    while ($row=mysql_fetch_array($res)) {
                        $time=$row[0];
                    }


                    if($est=="Estudiante"){

                    echo'<br><div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Correcto!</strong>  Se registró la asistencia del alumno(a): '.$ape.' '.$nom.'.  DNI: '.$dni.' 
                <br>Hora de Asistencia: '.$time.'<br>
                Grado: '.$gra.'. Sección: '.$sec.'.
            </div>';

                }

                if($est=="Activo"){

                   echo'<br><div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Correcto!</strong>  Se registró la asistencia del docente: '.$ape.' '.$nom.'.  DNI: '.$dni.' 
                <br>Hora de Asistencia: '.$time.'.
            </div>';
                    
                }

                    
                }

                else{
                    echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado, Error del Sistema.
                                            </div>';
                }
               
            }


        }

        break;

        case 1:

        $dni=$_POST['v'];  
          $aux=0;
          $idP="";
          $nom="";
          $ape="";
          $est="";
          $sec="";
          $gra="";
          $idUs=$_POST['v1'];

          $sql0="
          select p.idpersona, p.nombres, p.apellidos, p.dni, p.telefono, p.direccion, p.correo,p.fecR,a.idalumno,
                    a.estado,a.idpersona,s.nombre,g.nombre
                     FROM persona p
                      inner join alumno a on a.idpersona=p.idpersona
                      inner join detalusec d on d.idalumno=a.idalumno
                     inner join seccion s on s.idseccion=d.idseccion
                      inner join grado g on g.idgrado=s.idgrado
                      where a.estado='Estudiante' and p.dni='".$dni."'

                    union
          select  p.idpersona, p.nombres, p.apellidos, p.dni, p.telefono, p.direccion, p.correo,p.fecR,d.iddocente,
                    d.estado,d.idpersona,d.especialidad,d.especialidad
                    from persona p
                      inner join docente d on d.idpersona=p.idpersona
                      where d.estado='Activo' and p.dni='".$dni."';";

        $res=mysql_query($sql0) or die("error");
        
        while($row=mysql_fetch_array($res)){
            $aux=1;
              $idP=$row[0];
              $nom=$row[1];
              $ape=$row[2];
              $est=$row[9];
              $sec=$row[11];
              $gra=$row[12];


        }            

        if($aux==0){
             echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>No Registrado!</strong> No se encuentran registros de alumnos o docentes con el DNI '.$dni.'.  </div>';
        }

        else{

            $sql="select * FROM asistencia a where a.idpersona='".$idP."' and a.fecha=curdate() and a.estado='Asistio';";
            $result=mysql_query($sql) or die("error2");
            $idasis=0;
            $aux1=0;
            $hraIn="hh:mm:ssss";
            $horaSal="hh:mm:ssss";

            while ($row=mysql_fetch_array($result)) {
                $idasis=$row[0];
                $aux1=1;
                $hraIn=$row[3];
                $horaSal=$row[4];

            }

            if($est=="Activo"){
                 if($aux1==0){
                echo'<br><div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>No se registró la Salida del Docente!</strong> Docente: '.$ape.' '.$nom.'. DNI: '.$dni.' <br>
                    En el día de hoy no se cuenta con el registro de ingreso del docente, por lo cual no se puede registrar la Salida.
            </div>';
            }
            else{
                if($horaSal>$hraIn){
                    echo'<br><div class="alert alert-info alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Ya Registrado!</strong> Docente: '.$ape.' '.$nom.'. DNI: '.$dni.' <br>
                Ya ha sido registrada la Salida el día de hoy alas '.$horaSal.'.
            </div>';
                }

                else{

                    $sq="select curtime();";
                    $res=mysql_query($sq) or die("error3");
                    $time="hh:mm:ssss";
                    while ($row=mysql_fetch_array($res)) {
                        $time=$row[0];
                    }



                    $sqlf="update asistencia set hraSalida='".$time."' where idAsistencia='".$idasis."';";
                    if(mysql_query($sqlf)){

                    echo'<br><div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Correcto!</strong>  Se registró la salida del docente: '.$ape.' '.$nom.'.  DNI: '.$dni.' 
                <br>Hora de Salida: '.$time.'.
                    </div>';  
                }

                else{
                    echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado, Error del Sistema.
                                            </div>';
                }
                }
            }
            }

            elseif($est="Estudiante"){
                if($aux1==0){
                echo'<br><div class="alert alert-warning alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>No se registró la Salida del Alumno(a)!</strong> Alumno(a): '.$ape.' '.$nom.'. DNI: '.$dni.' <br>
                    Grado: '.$gra.'. Sección: '.$sec.' <br>
                    En el día de hoy no se cuenta con el registro de ingreso del alumno(a), por lo cual no se puede registrar la Salida.
            </div>';
            }
            else{
                if($horaSal>$hraIn){
                    echo'<br><div class="alert alert-info alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Ya Registrado!</strong> Alumno(a): '.$ape.' '.$nom.'. DNI: '.$dni.' <br>
                Grado: '.$gra.'. Sección: '.$sec.' <br>
                Ya ha sido registrada la Salida el día de hoy alas '.$horaSal.'.
            </div>';
                }

                else{

                    $sq="select curtime();";
                    $res=mysql_query($sq) or die("error3");
                    $time="hh:mm:ssss";
                    while ($row=mysql_fetch_array($res)) {
                        $time=$row[0];
                    }



                    $sqlf="update asistencia set hraSalida='".$time."' where idAsistencia='".$idasis."';";
                    if(mysql_query($sqlf)){

                    echo'<br><div class="alert alert-success alert-dismissable">
                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                <strong>Correcto!</strong>  Se registró la salida del Alumno(a): '.$ape.' '.$nom.'.  DNI: '.$dni.'  <br>
                Grado: '.$gra.'. Sección: '.$sec.' 
                <br>Hora de Salida: '.$time.'.
                    </div>';  
                }

                else{
                    echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado, Error del Sistema.
                                            </div>';
                }
                }
            }
            }

           

        }

        break;


        

    }

break;

case 4: //Modulo de Reportes
switch ($accion) {
    case 0: //Reportes de Alumnos
        
        $sql="select * FROM diaasistencia d order by idDia desc;";
        $res=mysql_query($sql) or die("error");

        while($row=mysql_fetch_array($res)){
            $fecha="".substr($row[1],8,2)."/".substr($row[1],5,2)."/". substr($row[1],0,4);
            echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Lista de Asistencia del: '.$fecha.' </h3>';

        $sql1="select g.idgrado,g.nombre,g.estado FROM grado g
                inner join seccion s on s.idGrado=g.idGrado
                inner join detalusec d on d.idseccion=s.idseccion
                inner join alumno a on a.idalumno=d.idalumno
                where g.estado='Activo' and a.estado='Estudiante' group by g.idgrado order by g.idgrado;";
        $res1=mysql_query($sql1) or die("error1");
        while ($r1=mysql_fetch_array($res1)) {
            echo'<div style="font-size: 18px; color: #333;padding: 7px 15px;">Grado: '.$r1[1].':</div>';

        $sql2="select * from seccion s where idGrado='".$r1[0]."' and estado='Activo';";
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

                $idPer="'".$r3[1]."'";
                $fec="'".$row[1]."'";
                $fec2="'".$fecha."'";

                $alum="'".$r3[3]." ".$r3[2]."'";
                $dni="'".$r3[4]."'";
                $grado="'".$r1[1]."'";
                $sec="'".$r2[1]."'";

               $fecha2="".substr($r3[8],8,2)."/".substr($r3[8],5,2)."/". substr($r3[8],0,4);

                echo '<tr><td>'.$cont.'</td>';
                echo'<td><a href="repDetAlum.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
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
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$sec.','.$fec2.');">det</button></td></tr>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td></tr>'; 
                            }
                        
                    }
                }
                

                $cont++;

            }                        

            
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';


        }

        }

        }

        
    
    break;

    case 1:




    $selF=$_POST['v1'];

    $selA=$_POST['v2'];





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

                $fecin=$_POST['v4'];
                $fecfi=$_POST['v5'];

                $fecin=substr($fecin,6,4)."/".substr($fecin,3,2)."/". substr($fecin,0,2);
                $fecfi=substr($fecfi,6,4)."/".substr($fecfi,3,2)."/". substr($fecfi,0,2);

                $sql="select * FROM diaasistencia d  where fecha between '".$fecin."' and '".$fecfi."' order by idDia desc;";
            }
        $res=mysql_query($sql) or die("error");

        while($row=mysql_fetch_array($res)){
            $fecha="".substr($row[1],8,2)."/".substr($row[1],5,2)."/". substr($row[1],0,4);
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
                echo'<td><a href="repDetDoc.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
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
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$doc.','.$dni.','.$esp.','.$fec2.');">det</button></td></tr>';
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
                echo'<td><a href="repDetDoc.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
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
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$doc.','.$dni.','.$esp.','.$fec2.');">det</button></td></tr>';
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
                echo'<td><a href="repDetDoc.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
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
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$doc.','.$dni.','.$esp.','.$fec2.');">det</button></td></tr>';
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


    break;

    case 2:

    $idper=$_POST['v'];
    $fec=$_POST['v1'];

    $sql="select * from asistencia where idpersona='".$idper."' and fecha='".$fec."';";

    $res=mysql_query($sql) or die("error");

    $miarray=array('idDia' => "vacio",'motivo' =>"vacio");

    while ($row=mysql_fetch_array($res)) {

         $miarray=array('idDia' => $row[0],'motivo' =>$row[7]);
        
    }

    echo (json_encode($miarray));

    break;

    case 3:

    $idGra=$_POST['v'];

    $sql="select * FROM seccion where idgrado='".$idGra."';";

    $res=mysql_query($sql) or die("error");


    

    echo '<option value="0">Todas</option>';

    while ($row=mysql_fetch_array($res)) {

         echo'<option value="'.$row[0].'">'.$row[1].'</option>';
        
    }

    break;

    case 4:

    $selG=$_POST['v'];

    $selF=$_POST['v1'];

    $selA=$_POST['v2'];

    $selS=$_POST['v3'];

    

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

                $fecin=$_POST['v4'];
                $fecfi=$_POST['v5'];

                $fecin=substr($fecin,6,4)."/".substr($fecin,3,2)."/". substr($fecin,0,2);
                $fecfi=substr($fecfi,6,4)."/".substr($fecfi,3,2)."/". substr($fecfi,0,2);

                $sql="select * FROM diaasistencia d  where fecha between '".$fecin."' and '".$fecfi."' order by idDia desc;";
            }

        //$sql="select * FROM diaasistencia d order by idDia desc;";
        $res=mysql_query($sql) or die("error");

        while($row=mysql_fetch_array($res)){
            $fecha="".substr($row[1],8,2)."/".substr($row[1],5,2)."/". substr($row[1],0,4);
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
                                        <th width="25%">Recomendaciones, Tareas u Obs.</th>


                                    </tr>
                                    </thead>
                                    <tbody>';

                                    $sql3="select a.idalumno,p.idpersona, p.nombres,p.apellidos,p.dni, a.estado,
                    if('".$row[1]."'>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.idDia='".$row[0]."' and asi.idpersona=p.idpersona),p.fecR,

                (select count(c.iddetConcepto) from detconcepto c, listaconcepto l  where c.idpersona=a.idpersona
                    and fecha='".$row[1]."' and l.idlista=c.idlista and l.idconcepto=1),
(select count(c.iddetConcepto) from detconcepto c, listaconcepto l  where c.idpersona=a.idpersona
                    and fecha='".$row[1]."' and l.idlista=c.idlista and l.idconcepto=2),
(select count(c.iddetConcepto) from detconcepto c, listaconcepto l  where c.idpersona=a.idpersona
                    and fecha='".$row[1]."' and l.idlista=c.idlista and l.idconcepto=3),
(select count(c.iddetConcepto) from detconcepto c, listaconcepto l  where c.idpersona=a.idpersona
                    and fecha='".$row[1]."' and l.idlista=c.idlista and l.idconcepto=4),
(select count(o.idobs) from obs o where o.fecha='".$row[1]."' and o.idpersona=p.idpersona)

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
                echo'<td><a href="repDetAlum.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td>'; 

                    echo '<td style="text-align:center;">------------</td></tr>';

                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td>';

                         

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$sec.','.$fec2.');">det</button></td>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td>'; 
                            }
                        
                    }

                    echo '<td style="text-align:center;"><ul class="nav navbar navbar-top-links navbar mbn">
                    <li class="dropdown" id="merito" style="display: inline-block;">
                        <span class="badge badge-green">M: '.$r3[9].'</span></li>

                    <li class="dropdown" id="demerito" style="display: inline-block;">
                        <span class="badge badge-red">D: '.$r3[10].'</span></li>

                    <li class="dropdown" id="presenta" style="display: inline-block;">
                        <span class="badge badge-blue">P: '.$r3[11].'</span></li>

                    <li class="dropdown" id="forma" style="display: inline-block;">
                        <span class="badge badge-yellow">F: '.$r3[12].'</span></li>

                    <li class="dropdown" id="observa" style="display: inline-block;">
                        <span class="badge badge-gray">O: '.$r3[13].'</span></li>

                    <li class="dropdown" id="vermas" style="display: inline-block;"><a style="padding: 0px 0px;" data-hover="dropdown"  href="repDetAlumCon.php?v='.$r3[1].'" class="dropdown-toggle" id="Mas">
                        Ver más+</a></li>

                        </ul>
                        </td></tr>';
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
                echo'<td><a href="repDetAlum.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td>'; 
                    echo '<td style="text-align:center;">------------</td></tr>';


                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td>';

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$sec.','.$fec2.');">det</button></td>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td>'; 
                            }
                        
                    }
                    echo '<td style="text-align:center;"><ul class="nav navbar navbar-top-links navbar mbn">
                    <li class="dropdown" id="merito" style="display: inline-block;">
                        <span class="badge badge-green">M: '.$r3[9].'</span></li>

                    <li class="dropdown" id="demerito" style="display: inline-block;">
                        <span class="badge badge-red">D: '.$r3[10].'</span></li>

                    <li class="dropdown" id="presenta" style="display: inline-block;">
                        <span class="badge badge-blue">P: '.$r3[11].'</span></li>

                    <li class="dropdown" id="forma" style="display: inline-block;">
                        <span class="badge badge-yellow">F: '.$r3[12].'</span></li>

                    <li class="dropdown" id="observa" style="display: inline-block;">
                        <span class="badge badge-gray">O: '.$r3[13].'</span></li>

                    <li class="dropdown" id="vermas" style="display: inline-block;"><a style="padding: 0px 0px;" data-hover="dropdown"  href="repDetAlumCon.php?v='.$r3[1].'" class="dropdown-toggle" id="Mas">
                        Ver más+</a></li>

                        </ul>
                        </td></tr>';
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
                echo'<td><a href="repDetAlum.php?v='.$r3[1].'">'.$r3[3].' '.$r3[2].'</a></td>';
                echo'<td>'.$r3[4].'</td>';
                if($r3[6]==0){
                    echo'<td>Alumno Registrado el: '.$fecha2.'</td></tr>'; 
                    echo '<td style="text-align:center;">------------</td></tr>';


                }
                elseif($r3[6]==1){
                    if(strlen($r3[7])==0){
                         echo'<td>No Asistió</td>';

                    }
                    else{
                        if($r3[7]=='Inasistio'){
                                echo'<td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$sec.','.$fec2.');">det</button></td>';
                            }
                            else{
                                echo'<td>'.$r3[7].'</td>'; 
                            }
                        
                    }
                    echo '<td style="text-align:center;"><ul class="nav navbar navbar-top-links navbar mbn">
                    <li class="dropdown" id="merito" style="display: inline-block;">
                        <span class="badge badge-green">M: '.$r3[9].'</span></li>

                    <li class="dropdown" id="demerito" style="display: inline-block;">
                        <span class="badge badge-red">D: '.$r3[10].'</span></li>

                    <li class="dropdown" id="presenta" style="display: inline-block;">
                        <span class="badge badge-blue">P: '.$r3[11].'</span></li>

                    <li class="dropdown" id="forma" style="display: inline-block;">
                        <span class="badge badge-yellow">F: '.$r3[12].'</span></li>

                    <li class="dropdown" id="observa" style="display: inline-block;">
                        <span class="badge badge-gray">O: '.$r3[13].'</span></li>

                    <li class="dropdown" id="vermas" style="display: inline-block;"><a style="padding: 0px 0px;" data-hover="dropdown"  href="repDetAlumCon.php?v='.$r3[1].'" class="dropdown-toggle" id="Mas">
                        Ver más+</a></li>

                        </ul>
                        </td></tr>';
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



        //fin modA

          







    break;

    case 5:

    $selF=$_POST['v'];

    $fec1=$_POST['v1'];
    $fec2=$_POST['v2'];



    $idper=$_POST['v3'];

    $dtos=$_POST['v4'];

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
                                echo'<td>'.$row[12].'</td><td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$sec.','.$fec3.');">det</button></td>
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


    break;

    case 6:

     $selF=$_POST['v'];

    $fec1=$_POST['v1'];
    $fec2=$_POST['v2'];



    $idper=$_POST['v3'];

    $dtos=$_POST['v4'];

    $sql="";


    if($selF==0){
         $sql="select d.iddocente,p.idpersona, p.nombres,p.apellidos,p.dni, d.estado,da.fecha, d.especialidad,d.especialidad,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where p.idpersona='".$idper."'  and da.fecha=curdate()
                    order by da.idDia desc;";

    }

    elseif($selF==1){
        $sql="select d.iddocente,p.idpersona, p.nombres,p.apellidos,p.dni, d.estado,da.fecha, d.especialidad,d.especialidad,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where p.idpersona='".$idper."'  and month(da.fecha)=month(curdate())
                    order by da.idDia desc;";
    }

    elseif($selF==2){


        $sql="select d.iddocente,p.idpersona, p.nombres,p.apellidos,p.dni, d.estado,da.fecha, d.especialidad,d.especialidad,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where p.idpersona='".$idper."'   and year(da.fecha)=year(curdate())
                    order by da.idDia desc;";
    }

    elseif($selF==3){
        $sql="select d.iddocente,p.idpersona, p.nombres,p.apellidos,p.dni, d.estado,da.fecha, d.especialidad,d.especialidad,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where p.idpersona='".$idper."'
                    order by da.idDia desc;";
    }

    if($selF==4){
        $fec1=substr($fec1,6,4)."/".substr($fec1,3,2)."/". substr($fec1,0,2);
        $fec2=substr($fec2,6,4)."/".substr($fec2,3,2)."/". substr($fec2,0,2);
        $sql="select d.iddocente,p.idpersona, p.nombres,p.apellidos,p.dni, d.estado,da.fecha, d.especialidad,d.especialidad,
                    if(da.fecha>=p.fecR,'1','0'),
                    (select asi.estado from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),p.fecR,
                (select u.usuario from asistencia asi
                      inner join usuario u on asi.idusuario=u.idusuario where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraIngreso from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."'),
                    (select asi.hraSalida from asistencia asi where asi.fecha=da.fecha and asi.idpersona='".$idper."')
                    from  diaasistencia da, docente d
                    inner join persona p on p.idpersona=d.idpersona
                    where p.idpersona='".$idper."' and da.fecha between '".$fec1."' and '".$fec2."'
                    order by da.idDia desc;";
    }

    


    $res=mysql_query($sql) or die("error");

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
                                        <th>Docente</th>
                                        <th width="8%">DNI</th>
                                        <th width="10%">Especialidad</th>
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
                    echo'<td style="text-align:center;">---------</td><td style="text-align:center;">---------</td>';
                }
                else{
                 echo'<td>'.$row[13].'</td>';   
                 if($row[13]==$row[14]){
                    echo'<td>No Registró</td>';
                 }
                 else
                    echo'<td>'.$row[14].'</td>'; 
                }
                
                echo'<td>'.$row[3].' '.$row[2].'</td>';
                echo'<td>'.$row[4].'</td>';
                echo'<td><strong>'.$row[8].'</strong></td>';
                 if($row[9]==0){
                    echo'<td style="text-align:center;">---------</td> <td>Docente Registrado el: '.$fecha2.'</td></tr>'; 

                }
                elseif($row[9]==1){
                    if(strlen($row[10])==0){
                         echo'<td style="text-align:center;">---------</td> <td>No Asistió</td></tr>';

                    }
                    else{
                        if($row[10]=='Inasistio'){
                                echo'<td>'.$row[12].'</td><td>Falta Justificada  <button type="button" class="" onClick="detFalta('.$idPer.','.$fec.','.$alum.','.$dni.','.$grado.','.$fec3.');">det</button></td>
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
    break;
    
   
}
break;

case 5: //Modilo de Usuarios
switch ($accion) {
    case 0:
         $bus=$_POST['search'];


        echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Usuarios</div>
                            <div class="panel-body" style="overflow-x:auto;">';

            

            $sql="select u.idusuario,u.nom,u.ape,u.dni,u.usuario, t.descripcion
                    from usuario u
                    inner join tipousuario t on t.idtipousu=u.idtipousu
                    where u.usuario like '%".$bus."%' or u.nom like'%".$bus."%' or u.ape like '%".$bus."%' or u.dni like '%".$bus."%';";
            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th width=20%"">Username</th>
                                        <th>Nombre</th>
                                        <th width="13%">DNI</th>
                                        <th width="15%">Nivel</th>
                                        <th width="16%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){

                $nom1="'".$row[2]." ".$row[1]."'";
                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[4].'</td>';
                echo'<td>'.$row[2].' '.$row[1].'</td>';
                 echo'<td>'.$row[3].'</td>';
                    echo'<td>'.$row[5].'</td>';
                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="editU('.$row[0].','.$nom1.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a> ';

                if($cont>1){
                echo' <a href="javascript:;" onclick="delU('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a>';
                }

                echo'</td></tr>';

                $cont++;

            }                        

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';
    break;

    case 1:

    $nom=$_POST['v1'];
    $ape=$_POST['v2'];
    $dni=$_POST['v3'];
    $nivel=$_POST['v4'];
    $usu=$_POST['v5'];
    $clave=$_POST['v6'];

    $aux=0;

    $sql0=sprintf("select * from usuario u where u.usuario='%s';",$usu);
    $res=mysql_query($sql0) or die("error");
    while($row=mysql_fetch_array($res)){
    $aux=1;

    }

    if($aux==1){
        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Ya existe un registro con ese nombre de usuario, ingrese otro.
                                        </div>';
    }
    else{
        $sql=sprintf("insert into usuario values(null,'%s','%s','%s','%s','%s','%s');",$nom,$ape,$dni,$usu,$clave,$nivel);

        if(mysql_query($sql)){
            echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se registró con éxito el nuevo usuario.
                                        </div>';

        }
        else{
             echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se guardó el registro del usuario.
                                        </div>';
        }

        }
    


    break;

    case 2:
        $cod=$_POST['v1'];
            $aux=0;

            $sql0="delete from usuario where idusuario='".$cod."';";
            $sql="delete from usuario where idusuario='".$cod."';";

            

            if($aux==1){
                echo'1';
            }
            else{
                
                    if(mysql_query($sql)){
                        echo'2';
                    }
                    else{
                        echo'3';
                    }
               

            }
    break;
    case 3:

        $cod=$_POST['v1'];

            $sql="select * FROM usuario u where u.idusuario='".$cod."';";

            $miarray=array('nom'=>"vacio",'ape'=>"vacio",'dni'=>"vacio",'usu'=>"vacio",'clave'=>"vacio",'nivel'=>"vacio");
            $result=mysql_query($sql) or die("error");

            while ($row=mysql_fetch_array($result)) {
                $miarray=array('nom'=>$row[1],'ape'=>$row[2],'dni'=>$row[3],'usu'=>$row[4],'clave'=>$row[5],'nivel'=>$row[6]);
    
            }

            echo (json_encode($miarray));

    break;
    
    case 4:

        $nom=$_POST['v1'];
        $ape=$_POST['v2'];
        $dni=$_POST['v3'];
        $nivel=$_POST['v4'];
        $usu=$_POST['v5'];
        $clave=$_POST['v6'];

            $idU=$_POST['v'];
            $aux=0;

             $sql0=sprintf("select * from usuario u where usuario='%s' and u.idusuario not in(select us.idusuario from usuario us where us.idusuario='%s');",$usu,$idU);

            $result0=mysql_query($sql0) or die("error");

            while ($row=mysql_fetch_array($result0)) {
                $aux=1;
            }
            if($aux==1){
                 echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> El nombre de usuario ya se encuentr registrado para otro usuario.
                                        </div>';
            }
            else{
                $sql=sprintf("update usuario set nom='%s', ape='%s', dni='%s', idtipousu='%s', usuario='%s', clave='%s' where idusuario='%s';",$nom,$ape,$dni,$nivel,$usu,$clave,$idU);


                    if(mysql_query($sql)){


                    echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo la actualización del usuario.
                                        </div>';
                                    }
                
                else{
                    echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo la actualización. 
                                        </div>';
                }


            }
    break;
}

break;

case 6: //Mi Perfil
switch ($accion) {
    case 0:
        $idU=$_POST['v'];
        $clave0=$_POST['v1'];
        $clave1=$_POST['v2'];
        $clave2=$_POST['v3'];

        $aux=0;

       $sql0=sprintf("select * from usuario u where u.idusuario='%s' and u.clave='%s';",$idU,$clave0);
       $res=mysql_query($sql0) or die("error");

       while($row=mysql_fetch_array($res)){
        $aux=1;
       }
       if($aux==0){
        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> La clave actual ingresada es incorrecta.
                                        </div>';
       }
       else{

        $sql=sprintf("update usuario set clave='%s' where idusuario='%s';",$clave1,$idU);
        if(mysql_query($sql)){
            echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el cambio de contraseña.
                                        </div>';

        }
        else{
            echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se actualizó el registro.
                                        </div>';
        }
       }



    break;
    
 
}
break;

case 7: // Módulo de Alertas

switch ($accion) {
    case 0:

    $aux=0;
    $sql="select count(p.idpersona)
                     FROM persona p
                      inner join alumno a on a.idpersona=p.idpersona
                      inner join detalusec d on d.idalumno=a.idalumno
                     inner join seccion s on s.idseccion=d.idseccion
                      inner join grado g on g.idgrado=s.idgrado
                      where a.estado='Estudiante'
                       and p.idpersona not in(
                      select pa.idpersona from persona pa, asistencia asi
                      where pa.idpersona=asi.idpersona and asi.fecha=curdate()) group by p.idpersona;";

    $res=mysql_query($sql) or die("error");
    while ($row=mysql_fetch_array($res)) {
        $aux=$aux+1;
    }

    if($aux==0){

        echo'<i class="fa fa-user"></i>
                        <span class="badge badge-green">A: 0</span>';

    }
    elseif($aux>0){
        echo'<i class="fa fa-user"></i>
                        <span class="badge badge-red">A: '.$aux.'</span>';
    }


        
    break;

     case 1:

    $aux=0;
    $sql=" select count(p.idpersona)
                    from persona p
                      inner join docente d on d.idpersona=p.idpersona
                      where d.estado='Activo' and p.idpersona not in(
                      select pa.idpersona from persona pa, asistencia asi
                      where pa.idpersona=asi.idpersona and asi.fecha=curdate());";

    $res=mysql_query($sql) or die("error");
    while ($row=mysql_fetch_array($res)) {
        $aux=$row[0];
    }

    if($aux==0){

        echo'<i class="fa fa-user-secret"></i>
                        <span class="badge badge-green">D: 0</span>';

    }
    elseif($aux>0){
        echo'<i class="fa fa-user-secret"></i>
                        <span class="badge badge-red">D: '.$aux.'</span>';
    }


        
    break;

    case 2:

    $busAl=$_POST['v'];

    $sql="select * FROM persona p
                      inner join alumno a on a.idpersona=p.idpersona
                      inner join detalusec d on d.idalumno=a.idalumno
                     inner join seccion s on s.idseccion=d.idseccion
                      inner join grado g on g.idgrado=s.idgrado
                      inner join aescolar ae on ae.idA=d.idA
                      where a.estado='Estudiante'
                       and p.idpersona not in(
                      select pa.idpersona from persona pa, asistencia asi
                      where pa.idpersona=asi.idpersona and asi.fecha=curdate())and a.idalumno not in(
select al.idalumno from alumno al,detalusec da, aescolar aes
where aes.estado='Activo' and aes.fechaini>ae.fechafin and al.idalumno=da.idalumno and aes.idA=da.idA) order by g.idgrado, s.idseccion, p.apellidos, p.nombres;";




    $result=mysql_query($sql) or die("error");

    echo'
    <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Alumnos</div>
                            <div class="panel-body">
              <table class="table table-striped table-bordered" style="" id="tabla1">
                <thead>
                  <tr style="padding:5px;">
                    <th style="padding:5px; border-top: 1px solid #dddddd; width:5%; text-align:center;">N°</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Alumno</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">DNI</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Grado</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Sección</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Justificar Falta</th>
                  </tr>
                </thead>
                <tbody>';


    $cont=1;            
    while($row=mysql_fetch_array($result)){

      $nom="'".$row[1].' '.$row[2]."'";
      $cod="'".$row[0]."'";
      $dni="'".$row[3]."'";

      $grado="'".$row[21]."'";
      $seccion="'".$row[17]."'";



      echo'<tr style="padding:5px;"><td style="padding:5px; text-align:center;">';
      echo $cont;
      echo'</td>';

      echo '<td>'.$row[1].' '.$row[2].'</td>';
      echo'<td>'.$row[3].'</td>';
      echo'<td>'.$row[21].'</td>';

      echo'<td>'.$row[17].'</td>';

       echo'<td style="text-align:center;"><button type="button" class="btn btn-info" onClick="justificar('.$cod.','.$nom.','.$dni.','.$grado.','.$seccion.');">Justificar</button></td>';
      echo' </tr>';

      $cont++;
    }
    echo '</tbody>
              </table> </div>
                        </div>';
    break;

    case 3:

    $idPer=$_POST['v1'];
    $idUsu=$_POST['v2'];
    $motivo=$_POST['v3'];

    $alu=$_POST['v4'];
    $dni=$_POST['v5'];
    $grado=$_POST['v6'];
    $sec=$_POST['v7'];

    $sql="CALL JustificarI('".$idPer."','".$idUsu."','".$motivo."')";

    if(mysql_query($sql)){
        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se registró la Justificación del alumno: '.$alu.'. DNI: '.$dni.'<br>
                                            Grado: '.$grado.'   |   Sección: '.$sec.'.
                                        </div>';
    }

    else{
        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
    }

    break;
    
     case 4:

    $busAl=$_POST['v'];

    $sql="select * FROM persona p
                      inner join docente d on d.idpersona=p.idpersona
                      where d.estado='Activo'
                       and p.idpersona not in(
                      select pa.idpersona from persona pa, asistencia asi
                      where pa.idpersona=asi.idpersona and asi.fecha=curdate()) order by  p.apellidos, p.nombres;";




    $result=mysql_query($sql) or die("error");

    echo'
    <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Alumnos</div>
                            <div class="panel-body">
              <table class="table table-striped table-bordered" style="" id="tabla1">
                <thead>
                  <tr style="padding:5px;">
                    <th style="padding:5px; border-top: 1px solid #dddddd; width:5%; text-align:center;">N°</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Docente</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">DNI</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Especialidad</th>
                    <th style="padding:5px; border-top: 1px solid #dddddd; ">Justificar Falta</th>
                  </tr>
                </thead>
                <tbody>';


    $cont=1;            
    while($row=mysql_fetch_array($result)){

      $nom="'".$row[1].' '.$row[2]."'";
      $cod="'".$row[0]."'";
      $dni="'".$row[3]."'";

      $esp="'".$row[10]."'";




      echo'<tr style="padding:5px;"><td style="padding:5px; text-align:center;">';
      echo $cont;
      echo'</td>';

      echo '<td>'.$row[1].' '.$row[2].'</td>';
      echo'<td>'.$row[3].'</td>';
      echo'<td>'.$row[10].'</td>';

       echo'<td style="text-align:center;"><button type="button" class="btn btn-info" onClick="justificar('.$cod.','.$nom.','.$dni.','.$esp.');">Justificar</button></td>';
      echo' </tr>';

      $cont++;
    }
    echo '</tbody>
              </table> </div>
                        </div>';
    break;

    case 5:

    $idPer=$_POST['v1'];
    $idUsu=$_POST['v2'];
    $motivo=$_POST['v3'];

    $doc=$_POST['v4'];
    $dni=$_POST['v5'];
    $esp=$_POST['v6'];

    $sql="CALL JustificarI('".$idPer."','".$idUsu."','".$motivo."')";

    if(mysql_query($sql)){
        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se registró la Justificación del Docente: '.$doc.'. DNI: '.$dni.'<br>
                                            Especialidad: '.$esp.'.
                                        </div>';
    }

    else{
        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
    }

    break;

}
break;

case 8: //Modulo de Codigos

switch ($accion) {
    case 0:
        $idCon=$_POST['v'];

            $sql0="select * from concepto where idconcepto='".$idCon."';";
            $result0=mysql_query($sql0);
            
            while($row0=mysql_fetch_array($result0)){
                $cont=1;
                
                    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$row0[1].'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">CODIGO</th>
                                        <th>'.$row0[1].'</th>
                                        <th width="10%">PUNTOS</th>
                                        <th width="21%">GESTION</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $sql="select * FROM listaconcepto l where idconcepto='".$row0[0]."' and estado='activo';";                   
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){

                $nom="'".$row[1]."'";
                $cod="'".$row[2]."'";
                $pto="'".$row[5]."'";
                $concep="'".$row0[1]."'";


               
                echo '<tr><td>'.$row[2].'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[5].'</td>';
                echo'<td>
                
                <a href="javascript:;" onclick="editC('.$row[0].','.$nom.','.$cod.','.$pto.','.$concep.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delC('.$row[0].','.$nom.','.$cod.')"><button type="button" class="btn btn-danger"  
                style="padding-left:14px;padding-right:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';

                $cont++;

            }                        

           
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

            }
    break;

    case 1:

    $idCod=$_POST['v1'];
    $desc=$_POST['v2'];
    $ptos=$_POST['v3'];
    $cod=$_POST['v4'];


     $aux=0;
            $sql0="select * from listaconcepto where (descr='".$desc."' or codlista='".$cod."')  and estado='Activo';";
            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){
                $aux=1;
            }

            if($aux==1){
                echo'<br><div class="alert alert-warning alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> El registro ya existe, no se registró nuevamente. 
                                        </div>';
            }
            if($aux==0){
                $sql="insert into listaconcepto values(null,'".$desc."','".$cod."','Activo','".$idCod."','".$ptos."');";
                if(mysql_query($sql)){
                    echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el registro correctamente.
                                        </div>';
                }
                else{
                     echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
                }

            }


    break;

    case 2:


    $cod=$_POST['v1'];

            $aux=0;
            $sql0="select * from detconcepto where estado='Activo' and idlista='".$cod."';";

            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){

                $aux=1;
            }

            if($aux==1){
                echo '1';
            }
            if($aux==0){


                $sql="delete from listaconcepto where idlista='".$cod."';";

                if(mysql_query($sql)){
                    echo '2';
                }
                else{
                    echo'3';
                }



            
            }

    break;

    case 3:


    
    $desc=$_POST['v1'];
    $ptos=$_POST['v2'];
    $cod=$_POST['v3'];

    $idLis=$_POST['v'];


     $aux=0;
            $sql0="select * from listaconcepto where (descr='".$desc."' or codlista='".$cod."') and idlista<>'".$idLis."';";
            $result0=mysql_query($sql0) or die("error");

            while($row=mysql_fetch_array($result0)){
                $aux=1;
            }

            if($aux==1){
                echo'<br><div class="alert alert-warning alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> El registro ya existe, no se editó. 
                                        </div>';
            }
            if($aux==0){
                $sql="update listaconcepto set descr='".$desc."', codlista='".$cod."', puntos='".$ptos."' where idlista='".$idLis."';";
                if(mysql_query($sql)){
                    echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se editó el registro correctamente.
                                        </div>';
                }
                else{
                     echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se editó el registro. 
                                        </div>';
                }

            }



    break;

    case 4:



    $selF=$_POST['v'];

    $fec1=$_POST['v1'];
    $fec2=$_POST['v2'];



    $idper=$_POST['v3'];

    $dtos=$_POST['v4'];

    $sql="";

    $sql1="";

    $sum=0;


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
where ae.estado='Activo' and d.fecR=curdate() and p.idpersona='".$idper."' and d.fecha=curdate() order by d.fecha)
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
where ae.estado='Activo' and o.fecR=curdate() and p.idpersona='".$idper."' and o.fecha=curdate() order by o.fecha);";


$sql1="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
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
where ae.estado='Activo' and d.fecR<>curdate() and p.idpersona='".$idper."' and d.fecha=curdate() order by d.fecha)
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
where ae.estado='Activo' and o.fecR<>curdate() and p.idpersona='".$idper."' and o.fecha=curdate() order by o.fecha);";

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
where ae.estado='Activo' and d.fecR=curdate() and p.idpersona='".$idper."' and month(d.fecha)=month(curdate()) order by d.fecha)
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
where ae.estado='Activo' and o.fecR=curdate() and p.idpersona='".$idper."' and month(o.fecha)=month(curdate()) order by o.fecha);
";

$sql1="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0'as iden
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
where ae.estado='Activo' and d.fecR<>curdate() and p.idpersona='".$idper."' and month(d.fecha)=month(curdate()) order by d.fecha)
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
where ae.estado='Activo' and o.fecR<>curdate() and p.idpersona='".$idper."' and month(o.fecha)=month(curdate()) order by o.fecha);
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
where ae.estado='Activo' and d.fecR=curdate() and p.idpersona='".$idper."' and year(d.fecha)=year(curdate()) order by d.fecha)
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
where ae.estado='Activo' and o.fecR=curdate() and p.idpersona='".$idper."' and year(o.fecha)=year(curdate()) order by o.fecha);";

$sql1="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
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
where ae.estado='Activo' and d.fecR<>curdate() and p.idpersona='".$idper."' and year(d.fecha)=year(curdate()) order by d.fecha)
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
where ae.estado='Activo' and o.fecR<>curdate() and p.idpersona='".$idper."' and year(o.fecha)=year(curdate()) order by o.fecha);";
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
where ae.estado='Activo' and d.fecR=curdate() and p.idpersona='".$idper."' and d.fecha between '".$fec1."' and '".$fec2."' order by d.fecha)
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
where ae.estado='Activo' and o.fecR=curdate() and p.idpersona='".$idper."' and o.fecha between '".$fec1."' and '".$fec2."' order by o.fecha);";

$sql1="(select d.fecha,c.descr,l.descr,d.obs,g.nombre,s.nombre,u.usuario,l.puntos,d.iddetconcepto,'0' as iden
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
where ae.estado='Activo' and d.fecR<>curdate() and p.idpersona='".$idper."' and d.fecha between '".$fec1."' and '".$fec2."' order by d.fecha)
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
where ae.estado='Activo' and o.fecR<>curdate() and p.idpersona='".$idper."' and o.fecha between '".$fec1."' and '".$fec2."' order by o.fecha);";

    }

    
$res=mysql_query($sql) or die("error");

    $res1=mysql_query($sql) or die("error");

$result=mysql_query($sql1) or die("error");

$result1=mysql_query($sql1) or die("error");
    while($row1=mysql_fetch_array($res1)){
        $sum=$sum+$row1[7];
    }

    while($row2=mysql_fetch_array($result1)){
        $sum=$sum+$row2[7];
    }


    echo'<h3 style="text-align:center;text-decoration:underline; color: #333;">Recomendaciones, Tareas u Observaciones</h3>';

    echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">'.$dtos.' <div id="punt" style="display:inline-block; float:right;">Puntaje Total: '.$sum.'</div></div>
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
                                         <th width="5%">Gestion </th>
                                        


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
                echo'<td>'.$row[7].'</td>';
                echo'<td><a href="javascript:;" onclick="del('.$row[8].','.$row[9].','.$nom.')"><button type="button" class="btn btn-danger"  
                style="padding-left:14px;padding-right:14px;">
                <i class="fa fa-remove"></i></button></a></td></tr>';
                
                                 
                $cont++;
                

    }

    while($rowz=mysql_fetch_array($result)){
        $fecha="".substr($rowz[0],8,2)."/".substr($rowz[0],5,2)."/". substr($rowz[0],0,4);
   


                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$fecha.'</td>';
                echo'<td>'.$rowz[1].'</td>';
                echo'<td>'.$rowz[2].'</td>';
                echo'<td>'.$rowz[3].'</td>';
                echo'<td>'.$rowz[4].'</td>';
                echo'<td>'.$rowz[5].'</td>';
                echo'<td>'.$rowz[6].'</td>';
                echo'<td>'.$rowz[7].'</td>';
                echo'<td style="text-align:center;">-------</td></tr>';
                
                                 
                $cont++;
                

    }

    echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

                        echo '<input type="hidden" value="'.$sum.'" id="sumaF">';



    break;

    case 5:

    $idCon=$_POST['v'];

    if($idCon==5){

        echo '<option value="0">Otras Observaciones</option>';
    }

        else{


    $sql="select * from listaconcepto where idconcepto='".$idCon."' and estado='Activo';";

                                        $res=mysql_query($sql) or die("error");

                                        while($row=mysql_fetch_array($res)){
                                          echo '<option value="'.$row[0].'">'.$row[2].' - '.$row[1].'</option>';
                                        }
                                        }

    break;

    case 6:

    $idPer=$_POST['v1'];
    $idLis=$_POST['v2'];
    $fec=$_POST['v3'];
    $obs=$_POST['v4'];
    $idUsu=$_POST['v5'];

    $fecini=substr($fec,6,4)."/".substr($fec,3,2)."/". substr($fec,0,2);


    $sql="insert into obs values(null,trim('".$obs."'),'".$fecini."',curdate(),'Activo','".$idPer."','".$idUsu."');";

    if(mysql_query($sql)){
        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el registro del alumno.
                                        </div>';
    }
    else{
            echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
    }
    break;

    case 7:


     $idPer=$_POST['v1'];
    $idLis=$_POST['v2'];
    $fec=$_POST['v3'];
    $obs=$_POST['v4'];
    $idUsu=$_POST['v5'];

    $fecini=substr($fec,6,4)."/".substr($fec,3,2)."/". substr($fec,0,2);


    $sql="insert into detconcepto values(null,'".$fecini."',curdate(),trim('".$obs."'),'Activo','".$idLis."','".$idPer."','".$idUsu."');";

    if(mysql_query($sql)){
        echo'<br><div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se realizo el registro del alumno.
                                        </div>';
    }
    else{
            echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error del Sistema, no se realizo el registro. 
                                        </div>';
    }


    break;

    case 8:

            $cod=$_POST['v1'];
            $filtro=$_POST['v2'];

            $sql="";

            if($filtro==0){
                $sql="delete from detconcepto where iddetconcepto='".$cod."'";
            }
            if($filtro==1){
                $sql="delete from obs where idobs='".$cod."'";
            }

            $aux=0;

            if(mysql_query($sql)){
                echo '2';
            }
            else{
                echo '1';
            }
            
    break;
    

}
break;

case 9: //Módulo de Pagos

switch ($accion) {
    case 0:
        

    $bus=$_POST['search'];


        echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Alumnos</div>
                            <div class="panel-body" style="overflow-x:auto;">';

            

            $sql="select p.idpersona,concat(p.nombres,' ',p.apellidos),p.dni,p.telefono,p.direccion,p.correo,s.nombre,g.nombre
                    from alumno a
                    inner join persona p on p.idpersona=a.idpersona
                    inner join detalusec d on a.idAlumno=d.idAlumno
                    inner join seccion s on s.idSeccion=d.idSeccion
                    inner join grado g on g.idgrado=s.idgrado
                    where (d.estado='Activo' or d.estado='Egresado') and (p.nombres like '%".$bus."%' or p.apellidos like '%".$bus."%' or p.dni like '%".$bus."%');";
            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Alumno</th>
                                        <th width="13%">DNI</th>
                                        <th width="15%">Grado</th>
                                        <th width="16%">Seccion</th>
                                         <th width="16%">Accion</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){

                $nom1="'".$row[1]."'";
                $dni="'".$row[2]."'";
                $grad1="'".$row[7]."'";
                $sec1="'".$row[6]."'";

                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';
                 echo'<td>'.$row[7].'</td>';
                 echo'<td>'.$row[6].'</td>';
                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="pagarA('.$row[0].','.$nom1.','.$grad1.','.$sec1.','.$dni.')"><button type="button" class="btn btn-info">
                Pagar <i class="fa fa-credit-card"></i></button></a>


                </td></tr>';

                $cont++;

            }                        

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

    break;

    case 1:

    $sql="select * FROM configpago c where estado='Activo';";
    $pagMatricula=0;
    $pagMes=0;

    $result=mysql_query($sql);

     while($row=mysql_fetch_array($result)){
        $pagMatricula=$row[1];
        $pagMes=$row[2];

     }

    echo'   <div class="panel panel-default">
                            <div class="panel-heading">Configuraciones Básicas</div>
                            <div class="panel-body">
                               
                                
                                
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Matrícula:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control  input-sm" value="'.$pagMatricula.'" onKeyPress="return soloNumeros(event);" autofocus id="mat" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>

                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Mensualidad:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control  input-sm" value="'.$pagMes.'"  onKeyPress="return soloNumeros(event);" id="mes" maxlength="100" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div>

                            
                            </div>

                             <div class="collapse navbar-collapse navbar-ex1-collapse" style="padding-bottom:20px; padding-left:30px;">
                                <button type="button" class="btn btn-success  btn-ms" id="btnGuardar" onclick="GuardarC1()"><i class="fa fa-floppy-o"></i> Guardar</button>
                                           
                                <button type="reset" class="btn btn-info btn-ms" id="cancel"><i class="fa fa-undo"></i> Cancelar</button>
                                 
                                
                               
                            </div>



                         </div>';
    break;

    case 2:

    $mat=$_POST['v1']; 
    $mes=$_POST['v2'];

    $sql="update configpago set matricula='".$mat."', mensualidad='".$mes."' where estado='Activo';";

     if(mysql_query($sql)){

                        echo'<br><div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Éxito!</strong> Se actualizaron los Datos.
                                        </div>';
                    }




                    
                    else{
                        echo'<br><div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> Error, no se realizo la actualización, seguramente debido a un error en el formato de los montos ingresados. 
                                            Recomendación: "Usar 02 decimales y un único punto separador de decimales."
                                        </div>';
                    }

    break;

    case 3:

    $sql="select * FROM recargo r where estado='activo';; ";
    $aux=0;

    $result=mysql_query($sql);

  

    echo'   <div class="panel panel-default">
                            <div class="panel-heading">Recargos</div>
                            

                             <div class="collapse navbar-collapse navbar-ex1-collapse" style="    max-height: none;padding-bottom:20px; padding-top:20px; padding-left:30px;">
                                <button type="button" class="btn btn-info  btn-ms"  onclick="NewRec()"><i class="fa fa-plus"></i> Nuevo Recargo</button>';
                                           
                                
                            echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Recargos</div>
                            <div class="panel-body" style="overflow-x:auto;">';
            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Descripción</th>
                                        <th width="13%">Recargo</th>
                                        <th width="15%">Tipo</th>
                                        <th width="16%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            
            while($row=mysql_fetch_array($result)){
                $aux=1;
                $tipo="";
                if($row[3]==1){
                    $tipo="Porcentaje %";
                }
                if($row[3]==0){
                    $tipo="Monetario S/.";
                }

               $nom1="'".$row[1]."'";
               $mon="'".$row[2]."'";
               $tip="'".$row[3]."'";

                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';
                echo'<td>'.$tipo.'</td>';

                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="editR('.$row[0].','.$nom1.','.$mon.','.$tip.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delR('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';
                

                $cont++;

            }       

            if($aux==0){

                echo '<tr><td colspan="5"> No Hay Recargos Creados</td></tr>';
            }                 

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';     
                                
                               
                            echo'</div>



                        </div>';
    break;

    case 4:

    $des=$_POST['v1'];
    $valor=$_POST['v2'];
    $tipo=$_POST['v3'];

    $aux=0;
    $sql0="select * from recargo where descripcion='".$des."' and estado='Activo';";

    $result=mysql_query($sql0) or die('error');

    while($row=mysql_fetch_array($result)){
      $aux=1;
    }

    if($aux==1){
      echo'<div class="alert" style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
          background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado, Recargo ya Ingresado.
                                            </div>';
    }
    elseif($aux==0){
      $sql="insert into recargo values(null,'".$des."','".$valor."','".$tipo."','Activo') ";
      if(mysql_query($sql)){
      
          echo'<div class="alert alert-success">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Correcto!</strong> Registro Ingresado.
                                            </div>';
      }

      else{
        echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado Error del Sistema.
                                            </div>';
      }
    }


    break;

    case 5:

 
     $cod=$_POST['v1'];
     $aux=0;

    $sql0="select r.idRec from recargo r
            inner join pagorealizado p on r.idRec=p.idRec
            where r.idRec='".$cod."' group by r.idRec;";

    $result0=mysql_query($sql0) or die("error");

    while ($row0=mysql_fetch_array($result0)) {
      $aux=1;
    }

    if($aux==1){
      $sql="update recargo set estado='Baja' where idRec='".$cod."';";
      if(mysql_query($sql)){
        echo'<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Correcto!</strong> Registro Eliminado.
        </div>';
        
      }


    }
    elseif ($aux==0) {

      $sql="delete from recargo where idRec='".$cod."';";  
      if(mysql_query($sql)){
        echo'<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Correcto!</strong> Registro Eliminado.
        </div>';
      }    
    }
    break;

    case 6:

     $cod=$_POST['v4'];
    $des=$_POST['v1'];
    $valor=$_POST['v2'];
    $tipo=$_POST['v3'];

    $aux=0;
    $sql0="select * from recargo b where  b.estado='Activo' and b.descripcion='".$des."' and
          b.idRec not in(select be.idRec from recargo be where be.idRec='".$cod."');";

    $result=mysql_query($sql0) or die('error');

    while($row=mysql_fetch_array($result)){
      $aux=1;
    }

    if($aux==1){
      echo'<div class="alert" style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
          background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Editado, está repitiendo la descripción de un 
                                              Recargo existente.
                                            </div>';
    }
    elseif($aux==0){
      $sql="update recargo set descripcion='".$des."', monto='".$valor."',tipo='".$tipo."' where idRec='".$cod."'";
      if(mysql_query($sql)){
      
          echo'<div class="alert alert-info">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Correcto!</strong> Registro Editado Correctamente.
                                            </div>';
      }

      else{
        echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Editado, Error del Sistema.
                                            </div>';
      }
    }
    break;

    case 7:

        $sql="select * FROM descuento d where estado='activo';; ";
    $aux=0;

    $result=mysql_query($sql);

  

    echo'   <div class="panel panel-default">
                            <div class="panel-heading">Descuentos</div>
                            

                             <div class="collapse navbar-collapse navbar-ex1-collapse" style="    max-height: none; padding-bottom:20px; padding-top:20px; padding-left:30px;">
                                <button type="button" class="btn btn-info  btn-ms"  onclick="NewDes()"><i class="fa fa-plus"></i> Nuevo Descuento</button>';
                                           
                                
                            echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Descuentos</div>
                            <div class="panel-body" style="overflow-x:auto;">';
            
                 echo' 
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Descripción</th>
                                        <th width="13%">Descuento</th>
                                        <th width="15%">Tipo</th>
                                        <th width="16%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody>';
            $cont=1;
            
            while($row=mysql_fetch_array($result)){
                $aux=1;
                $tipo="";
                if($row[3]==1){
                    $tipo="Porcentaje %";
                }
                if($row[3]==0){
                    $tipo="Monetario S/.";
                }

               $nom1="'".$row[1]."'";
               $mon="'".$row[2]."'";
               $tip="'".$row[3]."'";

                echo '<tr><td style="text-align:center;">'.$cont.'</td>';
                echo'<td>'.$row[1].'</td>';
                echo'<td>'.$row[2].'</td>';
                echo'<td>'.$tipo.'</td>';

                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="editD('.$row[0].','.$nom1.','.$mon.','.$tip.')"><button type="button" class="btn btn-info">
                <i class="fa fa-cogs"></i></button></a>

                <a href="javascript:;" onclick="delD('.$row[0].','.$nom1.')"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a>

                </td></tr>';
                

                $cont++;

            }       

            if($aux==0){

                echo '<tr><td colspan="5"> No Hay Descuentos Creados</td></tr>';
            }                 

      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div><br>';     
                                
                               
                            echo'</div>



                        </div>';
    break;

    case 8:

    $des=$_POST['v1'];
    $valor=$_POST['v2'];
    $tipo=$_POST['v3'];

    $aux=0;
    $sql0="select * from descuento where descripcion='".$des."' and estado='Activo';";

    $result=mysql_query($sql0) or die('error');

    while($row=mysql_fetch_array($result)){
      $aux=1;
    }

    if($aux==1){
      echo'<div class="alert" style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
          background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado, Descuento ya Ingresado.
                                            </div>';
    }
    elseif($aux==0){
      $sql="insert into descuento values(null,'".$des."','".$valor."','".$tipo."','Activo') ";
      if(mysql_query($sql)){
      
          echo'<div class="alert alert-success">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Correcto!</strong> Registro Ingresado.
                                            </div>';
      }

      else{
        echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Ingresado Error del Sistema.
                                            </div>';
      }
    }


    break;

    case 9:

    $cod=$_POST['v1'];
     $aux=0;

    $sql0="select r.idDes from descuento r
            inner join pagorealizado p on r.idDes=p.idRec
            where r.idDes='".$cod."' group by r.idDes;";

    $result0=mysql_query($sql0) or die("error");

    while ($row0=mysql_fetch_array($result0)) {
      $aux=1;
    }

    if($aux==1){
      $sql="update descuento set estado='Baja' where idDes='".$cod."';";
      if(mysql_query($sql)){
        echo'<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Correcto!</strong> Registro Eliminado.
        </div>';
        
      }


    }
    elseif ($aux==0) {

      $sql="delete from descuento where idDes='".$cod."';";  
      if(mysql_query($sql)){
        echo'<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Correcto!</strong> Registro Eliminado.
        </div>';
      }    
    }
  
    break;

    case 10:

    $cod=$_POST['v4'];
    $des=$_POST['v1'];
    $valor=$_POST['v2'];
    $tipo=$_POST['v3'];

    $aux=0;
    $sql0="select * from descuento b where  b.estado='Activo' and b.descripcion='".$des."' and
          b.idDes not in(select be.idDes from descuento be where be.idDes='".$cod."');";

    $result=mysql_query($sql0) or die('error');

    while($row=mysql_fetch_array($result)){
      $aux=1;
    }

    if($aux==1){
      echo'<div class="alert" style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
          background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Editado, está repitiendo la descripción de un 
                                              Descuento existente.
                                            </div>';
    }
    elseif($aux==0){
      $sql="update descuento set descripcion='".$des."', monto='".$valor."',tipo='".$tipo."' where idDes='".$cod."'";
      if(mysql_query($sql)){
      
          echo'<div class="alert alert-info">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Correcto!</strong> Registro Editado Correctamente.
                                            </div>';
      }

      else{
        echo'<div class="alert " style="    text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);
             background-color: rgb(214, 176, 176);color: #9C0000;">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Error!</strong> Registro No Editado, Error del Sistema.
                                            </div>';
      }
    }

    break;

    case 11:

    $cod=$_POST['v'];
    $nom=$_POST['v1'];
    $grado=$_POST['v2'];
    $sec=$_POST['v3'];
    $dni=$_POST['v4'];

$todayh = getdate(); 
                        $d = $todayh['mday'];
                        $m = $todayh['mon'];
                        $y = $todayh['year'];

                $fecha=$d."/".$m."/".$y;

    echo'<div class="panel panel-default">
                            <div class="panel-heading">Realizar Pagos</div>
                            <div class="panel-body">
                               
                                
                                
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Alumno (a)</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm"  id="nomAlum" value="'.$nom.'" readonly onKeyPress="return noEscribe(event);" maxlength="200" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <input type="hidden" id="idPer" value="'.$cod.'">
                                    </div>
                                </div><br>


                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">DNI</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm"  id="dniAlum" maxlength="8" value="'.$dni.'" readonly onKeyPress="return noEscribe(event);" style="border: solid 1px;color: rgb(102, 101, 110);" onKeyPress="return soloNumeros(event);">
                                    </div>
                                </div><br>


                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Grado</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="gradoAlum"  value="'.$grado.'" readonly maxlength="100" onKeyPress="return noEscribe(event);" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>

                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Sección</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="secAlum" value="'.$sec.'" readonly onKeyPress="return noEscribe(event);" maxlength="100"  style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div></div><br>

                                    <br>
                                    <hr style="border-top: 1px solid #999;"><br>

                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-1 control-label">N° Boleta</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="numBoleta" autofocus maxlength="100"  style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div></div><br>

                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-1 control-label">Fecha</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="fecPago" placeholder="DD/MM/AAAA" onKeyPress="return noEscribe(event);"  value="'.$fecha.'" maxlength="100"  style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div></div><br>';

                         
 echo'<div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Lista de Conceptos a Pagar</div>
                            <div class="panel-body" style="overflow-x:auto;">';


            
                 echo' 
                                <table class="table table-hover table-bordered" id="tabPagos">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Descripción</th>
                                        <th width="20%">Importe</th>
                                        <th width="15%">Gestionar</th>


                                    </tr>
                                    </thead>
                                    <tbody id="agregarP">';
                                  
                                   
      
                                   echo' </tbody>
                                </table>
                            </div>
                        </div>';


                            echo' 
                            <div class="col-lg-2" style="padding-left:0px; float: right; padding-bottom:20px;">
                         <input type="text" class="form-control input-sm" id="idMontoPagar" readonly value="0.00"  maxlength="100"  style="border: solid 1px;color: rgb(102, 101, 110); ">
                                    </div>
                                <label class="col-lg-1 control-label" style="padding-bottom:20px; padding-left:0px; float: right;">Monto Total</label>

                                <div class="col-lg-2" style="padding-bottom:20px; padding-left:0px;">
                                <button type="button" class="btn btn-success  btn-ms" id="btnGuardarPagar" onclick="Rpago();"><i class="fa fa-floppy-o">
                                </i> Confirmar pagos</button>
                            </div>
        
       <div class="col-lg-12" >                       
 <hr style="border-top: 1px solid #999;"></div>

        <div class="col-lg-12" >                       
 <h3>Lista de Conceptos de Pagos</h3>

 </div>';

echo ' <div class="col-lg-12" style="padding-bottom:20px; padding-left:0px;"><button type="button" class="btn btn-info  btn-ms" id="btnNuevoPagoG" onClick="PagarG();"><i i class="fa fa-cart-plus" aria-hidden="true"></i> Nuevo Pago General</button>
</div>';

echo' <div class="col-lg-12">';

$sql="select * FROM aescolar a;";
$result=mysql_query($sql);

$ida=0;

$cont=0;
$v[0]=0;
$nomA[0]='';
$estA[0]='';
 while($row=mysql_fetch_array($result)){    
$ida=$row[0];
$aux1=0;
$sql0="select c.idpagocrono,c.descripcion,c.monto,c.idfiltropago,c.fechafin
from pagocronogramado c, persona a
where c.idA='".$ida."' and year(a.fecR)<=year(c.fechaini) and a.idpersona='".$cod."'
and c.idfiltropago not in (select p.idfiltropago from pagorealizado p where p.idpersona='".$cod."');";

$res1=mysql_query($sql0);
while($row0=mysql_fetch_array($res1)){
$aux1=1;
}

if($aux1==1){
   $v[$cont]=$ida;
   $nomA[$cont]=$row[3];
   $estA[$cont]=$row[4];
$cont++; 
}

    }


for ($i = 0; $i < $cont; $i++) {


    $sql2="select c.idpagocrono,c.descripcion,c.monto,c.idfiltropago,c.fechafin,
if((select p.idpago from pagorealizado p where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago),1,0),
(select p.idpago from pagorealizado p where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago),
(select p.pago from pagorealizado p where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago),
(select p.fecha from pagorealizado p where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago),
(select p.numboleta from pagorealizado p where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago),
(select d.descripcion from pagorealizado p, descuento d where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago and d.idDes=p.idDes),
(select d.descripcion from pagorealizado p, recargo d where p.idpersona='".$cod."' and p.idfiltropago=c.idfiltropago and d.idRec=p.idRec)
from pagocronogramado c, persona a
where c.idA='".$v[$i]."' and a.idpersona='".$cod."';";

$res2=mysql_query($sql2);


   echo'<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Cronograma de Pagos del Año Escolar '.$nomA[$i].'</div>
                            <div class="panel-body" style="overflow-x:auto;">
                                <table class="table table-hover table-condensed table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center;">#</th>
                                        <th>Descripción</th>
                                        <th width="15%">Fecha Limite de Pago</th>
                                        <th width="15%">Importe</th>
                                        <th width="15%">Estado</th>
                                        <th width="10%">Gestion</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
$cont2=1;
$fechaactual = Date("Y-m-d");
while($row2=mysql_fetch_array($res2)){

            $fechaRe=substr($row2[8], -2).'/'.substr($row2[8], -5,2).'/'.substr($row2[8], -10,4);


            $desRe="'".$row2[1]." - ".$nomA[$i]."'";
            $montoRe="'".$row2[7]."'";
            $fechaRe="'".$fechaRe."'";
            $boletaRe="'".$row2[9]."'";
            $descuentoRe="'".$row2[10]."'";
            $recargoRe="'".$row2[11]."'";


            $idFilPC="'".$row2[3]."'";
            $montoPC="'".$row2[2]."'";

            

            $fechaVen=substr($row2[4], -2).'/'.substr($row2[4], -5,2).'/'.substr($row2[4], -10,4);


               if($row2[5]==0){


                if($fechaactual>$row2[4]){

                echo '<tr style="background-color:#EBB3B3;"><td style="text-align:center;">'.$cont2.'</td>';
                echo'<td>'.$row2[1].'</td>';
                echo'<td>'.$fechaVen.'</td>';
                echo'<td>'.$row2[2].'</td>';

                echo'<td>Pago Extemporaneo</td>';
                echo'<td style="text-align:center; ">
               

                <a href="javascript:;" onclick="PagarC('.$idFilPC.','.$desRe.','.$montoPC.')" id="btnPag'.$row2[3].'"><button type="button" class="btn btn-warning">
                <i class="fa fa-cart-arrow-down"></i> Pagar</button></a>
                </td></tr>';

                }

                else{

                    echo '<tr><td style="text-align:center;">'.$cont2.'</td>';
                echo'<td>'.$row2[1].'</td>';
                echo'<td>'.$fechaVen.'</td>';
                echo'<td>'.$row2[2].'</td>';

                echo'<td>Pago Normal</td>';
                echo'<td style="text-align:center;">
               

                <a href="javascript:;" onclick="PagarC('.$idFilPC.','.$desRe.','.$montoPC.')" id="btnPag'.$row2[3].'"><button type="button" class="btn btn-warning">
                <i class="fa fa-cart-arrow-down"></i> Pagar</button></a>
                </td></tr>';

                }
                
               }

               elseif($row2[5]==1){

                echo '<tr style="background-color:#B2F0AE;"><td style="text-align:center;">'.$cont2.'</td>';
                echo'<td>'.$row2[1].'</td>';
                echo'<td>'.$fechaVen.'</td>';
                echo'<td>'.$row2[7].'</td>';

                echo'<td>Concepto Pagado</td>';

                echo'<td style="text-align:center;">
                <a href="javascript:;" onclick="InfoC('.$desRe.','.$montoRe.','.$fechaRe.','.$boletaRe.','.$descuentoRe.','.$recargoRe.')"><button type="button" class="btn btn-info"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-info-circle"></i> Info</button></a>

                </td></tr>';

               }
              

                
                

                $cont2++;



}
                                   
                                    echo'</tbody>
                                </table>
                            </div>
                        </div>';

                       
}

echo'</div></div> ';




    break;

    case 12:

    $sql4="select * FROM descuento r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                              

                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }

    break;

    case 13:

    $sql4="select * FROM recargo r where r.estado='Intangible' or r.estado='Activo';";
                                                $res4=mysql_query($sql4) or die("errr");
                                           


                                                while ($row4=mysql_fetch_array($res4)) {
                                                    echo'<option value="'.$row4[0].'">'.$row4[1].'</option>';
                                                }

    break;

    case 14:

    $sql4="select * FROM descuento r where r.estado='Intangible' or r.estado='Activo';";
    $res4a=mysql_query($sql4) or die('error');
    while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desD'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoD'.$row4a[0].'">';
                                                  }

    break;

    case 15:
    $sql4="select * FROM recargo r where r.estado='Intangible' or r.estado='Activo';";
    $res4a=mysql_query($sql4) or die('error');
    while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desR'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoR'.$row4a[0].'">';
                                                  }
                                                  
    break;

    case 16:

    $idDes=$_POST['v1'];
    $idRec=$_POST['v2'];

    $mon=$_POST['v3'];
    $nom=$_POST['v4'];
    $idFil=$_POST['v5'];

    $tipoP=$_POST['v6'];

    $mon1="'".$mon."'";
    $fil="'".$idFil."'";

    echo '<tr data-tipo="'.$tipoP.'" data-idf="'.$idFil.'" data-idd="'.$idDes.'" data-idr="'.$idRec.'">';
    echo'<td style="text-align:center;padding:4px;">1</td>';
    echo'<td style="padding:4px;">'.$nom.'</td>';
    echo'<td style="text-align:center;padding:4px;">'.$mon.'</td>';
    



    echo '<td style="text-align:center; ">


    <a href="javascript:;" onclick="BajarP(this,'.$mon1.','.$fil.');")"><button type="button" class="btn btn-danger"
                style="padding-right:14px;padding-left:14px;">
                <i class="fa fa-remove"></i></button></a></td>';
    echo'</tr>';

    break;

    case 17:

    $sql4="select * FROM descuento r where r.estado='Intangible' or r.estado='Activo';";
    $res4a=mysql_query($sql4) or die('error');
    while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desDG'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoDG'.$row4a[0].'">';
                                                  }

    break;

    case 18:
    $sql4="select * FROM recargo r where r.estado='Intangible' or r.estado='Activo';";
    $res4a=mysql_query($sql4) or die('error');
    while($row4a=mysql_fetch_array($res4a)){


                                                    echo '<input type="hidden" value="'.$row4a[2].'", id="desRG'.$row4a[0].'">';
                                                     echo '<input type="hidden" value="'.$row4a[3].'", id="tipoRG'.$row4a[0].'">';
                                                  }
                                                  
    break;

    case 19:

    $idDes=$_POST['v1'];
    $idRec=$_POST['v2'];
    $mon=$_POST['v3'];
    $idFil=$_POST['v4'];
    $boleta=$_POST['v5'];

    $idPer=$_POST['v6'];
    $idUsu=$_POST['v7'];
    $tipo=$_POST['v8'];
    $fec=$_POST['v9'];
    $nom=$_POST['v10'];

    $fec=substr($fec,6,4)."/".substr($fec,3,2)."/". substr($fec,0,2);


if($tipo==1){
$sql="CALL PagarGeneral('".$mon."','".$nom."','".$fec."','".$boleta."','".$idPer."','".$idDes."','".$idRec."','".$idUsu."');";
    if(mysql_query($sql)){
      echo "1";
    }
    else{
      echo'0';
    }

}
elseif ($tipo==2) {

     $sql="insert into pagorealizado values(null,'".$mon."','".$fec."','".$boleta."','".$idFil."','".$idPer."','".$idDes."','".$idRec."','".$idUsu."');";
    if(mysql_query($sql)){
      echo "1";
    }
    else{
      echo'0';
    }
}


    break;

}
break;


case 10:  //Modulo de reportes académicos

switch ($accion) {
    case 0:
     
    $selG=$_POST['v'];

    $selF=$_POST['v1'];

    $per=$_POST['v2'];

    $selS=$_POST['v3'];

    

                    //Ini ModA
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

                $fecin=$_POST['v4'];
                $fecfi=$_POST['v5'];

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

$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Monto Total: S/.'.$num.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Alumno</th>
                                        <th width="10%">DNI</th>
                                        <th width="15%"># de Boleta</th>
                                        <th width="10%">Fecha de Pago</th>
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
                        </div><br>';

        break;

        case 1:

        $selG=$_POST['v'];

    $selF=$_POST['v1'];

    $per=$_POST['v2'];

    $selS=$_POST['v3'];

    

                    //Ini ModA
            $sql="";
            $sql2="";
            $sql3="";

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

                $fecin=$_POST['v4'];
                $fecfi=$_POST['v5'];

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
s.nombre,pg.descripcion, p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario, p.fecha
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
s.nombre,concat(pc.descripcion,'-',year(pc.fechaini)), p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario, pc.fechafin 
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
    

$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Monto Total: S/.'.$num.'</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="4%">Año Académico</th>
                                        <th>Alumno</th>
                                        <th width="7%">DNI</th>
                                        <th width="7%">Grado</th>
                                        <th width="7%">Sección</th>
                                        <th width="15%">Concepto de Pago</th>
                                        <th width="7%">Fecha de Pago</th>
                                        <th width="7%">Vencimiento de Pago</th>
                                        <th width="8%"># de Boleta</th>
                                        <th width="7%">Monto S/.</th>
                                        <th width="7%">usuario que registró</th>


                                    </tr>
                                    </thead>
                                    <tbody>';


while($row0=mysql_fetch_array($result2)){

    $sqlz="(select p.idpago, ae.descripcion, concat(pe.apellidos,' ',pe.nombres), pe.dni,g.nombre,
s.nombre,pg.descripcion, p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario, p.fecha
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
s.nombre,concat(pc.descripcion,'-',year(pc.fechaini)), p.fecha, p.numboleta, p.pago, pe.idpersona, u.usuario, pc.fechafin 
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
$fechfa="".substr($row[12],8,2)."/".substr($row[12],5,2)."/". substr($row[12],0,4);

if($row[12]<$row[7]){
 echo '<tr style="background-color:#F7E989;">';
}
else{
   echo '<tr>';  
}

            echo '<td style="text-align:center;">'.$cont.'</td>';
            echo'<td>'.$row[1].'</td>';
            echo'<td>'.$row[2].'</td>';
            echo'<td>'.$row[3].'</td>';
            echo'<td>'.$row[4].'</td>';
            echo'<td>'.$row[5].'</td>';
            echo'<td>'.$row[6].'</td>';
            echo'<td>'.$fecha.'</td>';
            echo'<td>'.$fechfa.'</td>';
            echo'<td>'.$row[8].'</td>';
            echo'<td>'.$row[9].'</td>';
            echo'<td>'.$row[11].'</td>';
                

        

                $cont++;
    }
  
}






        

        
    

    echo' </tbody>
                                </table>
                            </div>
                        </div><br>';

        break;

        case 2:


            $selG=$_POST['v'];

    $selF=$_POST['v1'];

    $per=$_POST['v2'];

    $selS=$_POST['v3'];

    

                    //Ini ModA
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

                $fecin=$_POST['v4'];
                $fecfi=$_POST['v5'];

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


$num=number_format($sum, 2, ",", " ");
         echo' <div class="panel panel-grey" style="margin-top:20px;">
                            <div class="panel-heading">Monto Total: de Deudas S/.'.$num.'</div>
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

                echo '<tr style="background-color:#EBB3B3;">';
            }
            else{
                echo '<tr style="background-color:#F7E989;">';
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
                        </div><br>';



        break;
    
}
break;


 }

?>