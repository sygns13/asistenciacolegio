<?php
//session_start();
require "../Funciones/General.php";
include "../Funciones/conexion.php";
mysql_query("SET NAMES 'utf8'");
$module = $_POST['module'];
$action = $_POST['action'];

switch ($module) {
	case 0:
		switch ($action) {
			case 0:


				
				$search = $_POST['search'];
				$sql="select * from marca where descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Marcas</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idmarca[]" id="idmarca" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td id="n' . $row[0] . '">' . $row[1] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="3"> No Existen Marcas registradas aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			

				
				break;


				case 1:
				$eliminar = $_POST['idmarca'];
				 $sql = "delete from marca where idMarca='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }

				
				break;

				case 2:
				$nombre=$_POST['marca'];
				$sql="insert into marca(descripcion) values('".$nombre."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente la marca '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

				break;

				case 3:
				$id=$_POST['id'];
				$sql="select * from marca where idMarca='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<input type="text" class="form-control input-sm" style="border: solid 1px;color: rgb(102, 101, 110);" id="marca" name="marca" value="'.$row[1].'">';
				}

				break;
				case 4:
				$id=$_POST['id'];
				$nombre=$_POST['marca'];
				$sql="update Marca set descripcion='".$nombre."' where idMarca='".$id."'";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente la marca '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

				break;



			
			
		}
		break;// Fin del mòdulo 1 Marca

	
		case 1:
			switch ($action) {
			case 0:
			//echo'<script>alert("'.$module.' '.$action.'")</script>';
				
			$search = $_POST['search'];
				$sql="select * from categoria where descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Categorias</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idcat[]" id="idcat" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td id="n' . $row[0] . '">' . $row[1] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="3"> No Existen Categorías registradas aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
			break;

			case 1:
				$eliminar = $_POST['idcat'];
				 $sql = "delete from categoria where idcategoria='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
                    
                
			break;
			
			case 2:

				$nombre=$_POST['cat'];
				$sql="insert into categoria(descripcion) values('".$nombre."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente la categoría '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}
				
			break;

			case 3:
			
			$id=$_POST['id'];
				$sql="select * from categoria where idcategoria='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<input type="text" class="form-control input-sm" style="border: solid 1px;color: rgb(102, 101, 110);" id="cat" name="cat" value="'.$row[1].'">';
				}

				break;	

			
				case 4:
				
				$id=$_POST['id'];
				$nombre=$_POST['cat'];
				$sql="update Categoria set descripcion='".$nombre."' where idcategoria='".$id."'";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente la categoría '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

				break;

				

			}


		break;//fin del modulo 2 Categorías

		case 2:
		switch ($action) {
			case 0:
				$search = $_POST['search'];
				$sql="select p.idProducto,p.descripcion,m.descripcion,c.descripcion,p.stock,p.stockMin,p.stockMax, p.costounitario
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Productos</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Stock</th>
                                        <th>Stock Minimo</th>
                                        <th>Stock Máximo</th>
                                        <th>Costo Unitario</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idprod[]" id="idprod" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td >' . $row[1] . '</td>
                                    		<td >' . $row[2] . '</td>
                                    		<td >' . $row[3] . '</td>
                                    		<td >' . $row[4] . '</td>
                                    		<td >' . $row[5] . '</td>
                                    		<td >' . $row[6] . '</td>
                                    		<td >S/' . $row[7] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="9"> No Existen Productos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			break;

			case 1:
				$eliminar = $_POST['idprod'];
				 $sql = "delete from producto where idProducto='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
                    

			break;

			case 2:
				
				$nombre=$_POST['producto'];
				$stock=$_POST['stock'];
				$smin=$_POST['smin'];
				$smax=$_POST['smax'];
				$costo=$_POST['costo'];
				$marca=$_POST['marca'];
				$cat=$_POST['cat'];


				$sql="insert into producto(descripcion,stock,stockMin,stockMax,costounitario,idcategoria,idMarca)
						values('".$nombre."','".$stock."','".$smin."','".$smax."','".$costo."','".$cat."','".$marca."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el Producto '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se ingresó el Producto '.$nombre.' debido a un error en las cantidades
                                            de los stock o mal formato de ingreso del costo.
                                        </div>';

				}
			break;

			case 3:

			$id=$_POST['id'];
				$sql="select p.idProducto,p.descripcion,m.descripcion,c.descripcion,p.stock,p.stockMin,p.stockMax, p.costounitario
						from producto p
						inner join marca m on m.idMarca=p.idMarca
						inner join categoria c on c.idCategoria=p.idCategoria where p.idProducto='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Categoria:</label>
                                    <div class="col-lg-5"><select id="categoria" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';

                     $sql1="select * from categoria;";
                     $result1 = mysql_query($sql1) or die("Error");
                     while ($row1 = mysql_fetch_array($result1)) {

                        if($row[3]==$row1[1]){
                     		echo'<option value="'.$row1[0].'" selected>'.$row1[1].'</option>'; 
                     	}
                     	else {
                     		echo'<option value="'.$row1[0].'" >'.$row1[1].'</option>'; 
                     	} 
                    }


                    echo' </select>
                                    </div>
                                </div><br><br>
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Marca:</label>
                                    <div class="col-lg-5">
                                        <select id="marca" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';

					 $sql2="select * from marca;";
                     $result2 = mysql_query($sql2) or die("Error");
                     while ($row2 = mysql_fetch_array($result2)) {

                     	if($row[2]==$row2[1]){
                     		echo'<option value="'.$row2[0].'" selected>'.$row2[1].'</option>'; 
                     	}
                     	else {
                     		echo'<option value="'.$row2[0].'" >'.$row2[1].'</option>'; 
                     	}
                        	

                    }

                        echo '
                        </select>
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Producto:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="Nombre" value="'.$row[1].'" id="producto" type="text" class="form-control input-sm" id="producto" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Minimo:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" value="'.$row[5].'" id="stockmin" type="text" class="form-control input-sm" id="stockmin" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Maximo:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" value="'.$row[6].'" id="stockmax" type="text" class="form-control input-sm" id="stockmax" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Real:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00" value="'.$row[4].'" id="stock" type="text" class="form-control input-sm" id="stockreal" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div><br><br>
                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Costo Unitario:</label>
                                    <div class="col-lg-5">
                                        <input placeholder="00.00" value="'.$row[7].'" id="costo" type="text" class="form-control input-sm" id="costoprov" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div>

                            </div>
                        ';
				}
				
			break;

			case 4:

			$id=$_POST['id'];
			$nombre=$_POST['producto'];
			$stock=$_POST['stock'];
			$smin=$_POST['smin'];
			$smax=$_POST['smax'];
			$costo=$_POST['costo'];
			$marca=$_POST['marca'];
			$cat=$_POST['cat'];
			$sql="update Producto set descripcion='".$nombre."' , stock='".$stock."' , stockMin='".$smin."' , stockMax='".$smax."' , costounitario='".$costo."' , idcategoria='".$cat."' , idMarca='".$marca."' where idProducto='".$id."'";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente el producto '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se editó '.$nombre.' debido a un error en las cantidades
                                            de los stock o mal formato de ingreso del costo.
                                        </div>';

				}
			break;

			case 5:


				$sql="select d.idDet, p.descripcion,u.descripcion,u.cantidad, d.precioE
							from producto p
							inner join detprodunidad d on p.idProducto=d.idProducto
							inner join unidades u on d.idunidad=u.idunidad;";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-red">
                            <div class="panel-heading">Unidades x Producto</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered" id="table2">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Producto</th>
                                        <th>Unidad</th>
                                        <th>Cantidad</th>
                                        <th>PrecioE</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idpu[]" id="idpu" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td >' . $row[1] . '</td>
                                    		<td >' . $row[2] . '</td>
                                    		<td >' . $row[3] . '</td>
                                    		<td >S/' . $row[4] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="6"> No Se han asignado Unidades a Productos aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
			break;

			case 6:

			$costoE=$_POST['costo'];
			$prod=$_POST['prod'];
			$unid=$_POST['unid'];
			$sql="insert into detprodunidad(idProducto,idUnidad,precioE) values('".$prod."','".$unid."','".$costoE."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se asignó correctamente la unidad.
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se asignó la unidad debido a un error en el formato del precio.
                                        </div>';

				}

			break;

			case 7:

				$eliminar = $_POST['idprodu'];
				 $sql = "delete from detprodunidad where idDet='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
			break;

			case 8:

				$sql="select * FROM unidades u;";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Unidades: </div>
                            <div class="panel-body">
                                <div id="table3"></div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idunid[]" id="idunid" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		<td>' . $row[2] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="3"> No Existen Marcas registradas aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			break;

			case 9:

			$nombre=$_POST['nombre'];
			$cant=$_POST['cant'];
		
			$sql="insert into unidades(descripcion,cantidad) values('".$nombre."','".$cant."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se registró correctamente la unidad '.$nombre.'
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se registro la unidad
                                        </div>';

				}

			break;

			case 10:

			echo'<select id="lisuni" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';
                                        

                                        $sql="select * FROM unidades u;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        
                                    echo'</select>';

			break;

			case 11:
					$eliminar = $_POST['idunid'];
				 $sql = "delete from unidades where idUnidad='".$eliminar."';";

				 if (mysql_query($sql)) {
                	 }
			break;

			case 12:
			echo '<select id="lispro" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';
                                       

                                        $sql="select * from producto;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }
                                    echo '</select>';
			break;

			

		} 

		break; //fin del modulo 3 Productos

		case 3:
		switch ($action) {
			case 0:
				
				$search = $_POST['search'];
				$sql="select t.idTrabajador,concat(t.nombres,' ',t.apellidos),t.dni,t.direccion,t.telefono, tt.cargo
						from trabajador t
						inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador where t.nombres like '%".$search."%'
						order by tt.idtipotrabajador;";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Trabajadores</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Nombres</th>
                                        <th>DNI</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Cargo</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idtrab[]" id="idtrab" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		<td>' . $row[2] . '</td>
                                    		<td>' . $row[3] . '</td>
                                    		<td>' . $row[4] . '</td>
                                    		<td>' . $row[5] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="7"> No Existen Trabajadores registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			
			break;


			case 1:
				echo '<select id="cargo" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';
                                        

                                        $sql="select * FROM tipotrabajador t;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {

                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>';

                                         }

                                        


                                    echo '</select>';

			break;

			case 2:

				$eliminar = $_POST['idtrab'];

				 $sql = "delete from trabajador where idTrabajador='".$eliminar."';";
                if (mysql_query($sql)) {
                	echo'<br><br><span class="success">Semestre Eliminado</span>';
                	 }
                	 else
                	 	{echo'<br><br><span class="error">No se pudo eliminar</span>';}
			break;


			case 3:

			$nombre=$_POST['nombre'];
			$ape=$_POST['ape'];
			$dni=$_POST['dni'];
			$dir=$_POST['dir'];
			$telf=$_POST['telf'];
			$cargo=$_POST['cargo'];
				$sql="insert into trabajador(nombres,apellidos,dni,direccion,telefono,idtipotrabajador)
						values('".$nombre."','".$ape."','".$dni."','".$dir."','".$telf."','".$cargo."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el trabajador '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}
                
			break;

			case 4:
				$id=$_POST['id'];
				$sql="select * FROM trabajador  where idTrabajador='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Cargo:</label>
                                    <div class="col-lg-5" id="selC"><select id="cargo" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';
                                       

                                        $sql2="select * FROM tipotrabajador t;";
                                        $result2 = mysql_query($sql2) or die("Error");
                                         while ($row2 = mysql_fetch_array($result2)) {

                                         	if($row[6]==$row2[0]){
                                         		echo'<option value="'.$row2[0].'" selected>'.$row2[1].'</option>';

                                         	}

                                         		else{
                                            echo'<option value="'.$row2[0].'">'.$row2[1].'</option>';
                                            }

                                         }

                                        


                                    echo'</select>
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Nombres:</label>
                                    <div class="col-lg-5">
                                        <input value="'.$row[1].'" type="text" class="form-control input-sm" id="nombres" placeholder="Nombres" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Apellidos:</label>
                                    <div class="col-lg-5">
                                        <input value="'.$row[2].'" type="text" class="form-control input-sm" id="ape" placeholder="Apellidos" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">DNI:</label>
                                    <div class="col-lg-5">
                                        <input value="'.$row[3].'" type="text" class="form-control input-sm" id="dni" placeholder="DNI" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                              
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Direccion:</label>
                                    <div class="col-lg-5">
                                        <input value="'.$row[4].'" type="text" class="form-control input-sm" id="dir" placeholder="Dirección" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Telefono:</label>
                                    <div class="col-lg-5">
                                        <input value="'.$row[5].'" type="text" class="form-control input-sm" id="telf" placeholder="Teléfono" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>

                            </div>';
				}

			break;

			case 5:
			$id=$_POST['id'];
			$nombre=$_POST['nombre'];
			$ape=$_POST['ape'];
			$dni=$_POST['dni'];
			$dir=$_POST['dir'];
			$telf=$_POST['telf'];
			$cargo=$_POST['cargo'];

				$sql="update trabajador set nombres='".$nombre."', apellidos='".$ape."', 
				dni='".$dni."', direccion='".$dir."', telefono='".$telf."', idtipotrabajador='".$cargo."' where idTrabajador='".$id."'";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente el trabajador '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}
			break;

			case 6:

				$sql="select * FROM tipotrabajador t;";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Cargos:</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idca[]" id="idca" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="3"> No Existen Cargos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
			break;

			case 7:
				$nombre=$_POST['cargo'];
				$sql="insert into tipotrabajador(cargo) values('".$nombre."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el cargo '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

			break;

			case 8:
				$eliminar = $_POST['idca'];
				 $sql = "delete from tipotrabajador where idTipotrabajador='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
			break;


			
			
		}
		break;  //fin del modulo 4 Trabajadores


		case 4:
		switch ($action) {
			case 0:
			$search = $_POST['search'];
				$sql="select p.idProyecto, p.descripcion, p.presupuesto, p.fecini,p.fecfin, p.Estado,concat(t.nombres,' ',t.apellidos)
						from proyecto p
						inner join trabajador t on t.idTrabajador=p.idtrabajador where p.descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Proyectos</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Proyecto</th>
                                        <th>Presupuesto</th>
                                        <th>Estado</th>
                                        <th>Responsable</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha Final</th>
                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {

                                    	$fecini=substr($row[3], -2).'-'.substr($row[3], -5,2).'-'.substr($row[3], -10,4);
                                    	$fecfin=substr($row[4], -2).'-'.substr($row[4], -5,2).'-'.substr($row[4], -10,4);
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idproy[]" id="idproy" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		<td>S/ ' . $row[2] . '</td>
                                    		<td>' . $row[5] . '</td>
                                    		<td>' . $row[6] . '</td>
                                    		<td>' . $fecini . '</td>
                                    		<td>' . $fecfin. '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="8"> No Existen Proyectos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			break;

			case 1:
				$eliminar = $_POST['idproy'];
				 $sql = "delete from Proyecto where idProyecto='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
			break;

			case 2:

			$trab=$_POST['trab'];
			$proy=$_POST['proy'];
			$presu=$_POST['presu'];
			$estado=$_POST['estado'];
			$fecini=$_POST['fecini'];
			$fecfin=$_POST['fecfin'];


			$fecini=substr($fecini, -4).'-'.substr($fecini, -7,2).'-'.substr($fecini, -10,2);
			$fecfin=substr($fecfin, -4).'-'.substr($fecfin, -7,2).'-'.substr($fecfin, -10,2);

			$sql="insert into proyecto(descripcion,presupuesto,fecini,fecfin,estado,idTrabajador)
						values ('".$proy."','".$presu."','".$fecini."','".$fecfin."','".$estado."','".$trab."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el Proyecto '.$proy.'.
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se guardó el registro debido a un error en el ingreso del formato de las fechas
                                            o del presupuesto!
                                        </div>';

				}
			break;

			case 3:
			$id=$_POST['id'];
			$sql="select * from proyecto where idProyecto='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {
					$fecini=substr($row[3], -2).'/'.substr($row[3], -5,2).'/'.substr($row[3], -10,4);
                    $fecfin=substr($row[4], -2).'/'.substr($row[4], -5,2).'/'.substr($row[4], -10,4);
					echo '<div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Trabajador Responsable:</label>
                                    <div class="col-lg-5"><select id="trab" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="1">Seleccione...</option>';

                     $sql1="select t.idTrabajador,concat(t.nombres,' ',t.apellidos,'-',tt.cargo)
                                        from trabajador t
                                        inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador;";
                                        $result1 = mysql_query($sql1) or die("Error");
                                         while ($row1 = mysql_fetch_array($result1)) {

                                         	if($row1[0]==$row[6]){

                                         		echo'<option value="'.$row1[0].'" selected>'.$row1[1].'</option>';
                                         	}
                                         		else {
                                            echo'<option value="'.$row1[0].'">'.$row1[1].'</option>'; }

                                         }
                    echo '</select>
                                    </div>
                                </div>
                                <br><br><br>
                                
                                
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Nombre Proyecto:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[1].'" class="form-control input-sm" id="proyecto" placeholder="Nombre" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Presupuesto:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[2].'" class="form-control input-sm" id="presu" placeholder="00.00" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Estado:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[5].'" class="form-control input-sm" id="estado" placeholder="Estado" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Fecha Inicial:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$fecini.'" class="form-control input-sm" id="fecini" placeholder="dd/mm/aaaa" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div><br><br>
                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Fecha Final:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$fecfin.'" class="form-control input-sm" id="fecfin" placeholder="dd/mm/aaaa" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div>

                            </div>';

				}
			break;

			case 4:

				$id=$_POST['id'];
				$trab=$_POST['trab'];
				$proy=$_POST['proy'];
				$presu=$_POST['presu'];
				$estado=$_POST['estado'];
				$fecini=$_POST['fecini'];
				$fecfin=$_POST['fecfin'];


			$fecini=substr($fecini, -4).'-'.substr($fecini, -7,2).'-'.substr($fecini, -10,2);
			$fecfin=substr($fecfin, -4).'-'.substr($fecfin, -7,2).'-'.substr($fecfin, -10,2);
				
				$sql="update proyecto set descripcion='".$proy."' , presupuesto='".$presu."' , fecini='".$fecini."', fecfin='".$fecfin."', estado='".$estado."' , idTrabajador='".$trab."' where idProyecto='".$id."';";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente el Proyecto '.$proy.'.
                                        </div>';

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se guardó el registro debido a un error en el ingreso del formato de las fechas
                                            o del presupuesto!
                                        </div>';

				}
			break;
		
			
		}

		break; //fin del modulo 5 Proyectos

		case 5:
		switch ($action) {
			case 0:
				$search = $_POST['search'];
				$sql="select p.idProducto,p.descripcion,m.descripcion,c.descripcion,p.stock,p.stockMin,p.stockMax, p.costounitario
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Productos General</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>
                                        <th>Marca</th>
                                        
                                        <th>Stock</th>
                                        <th>Stock Minimo</th>

                                        <th>Cantidad</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr id="f'.$row[0].'">
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idprod[]" id="idprod" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td >' . $row[1] . '</td>
                                    		<td >' . $row[2] . '</td>
                              
                                    		<td >' . $row[4] . '</td>
                                    		<td >' . $row[5] . '</td>

                                    		<td ><input type="text" id="cos'.$row[0].'" placeholder="00"></td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="7"> No Existen Productos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
			break;

			case 1:
			echo '<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Lista de Productos del Despacho</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla2">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        
                                        <th>Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   </tbody></table>';


			break;

			case 2:
				$id=$_POST['idprod'];

				$sql="select p.idProducto,p.descripcion,m.descripcion,p.stock
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.idProducto='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="codProd">';
					echo '<input type="hidden" value="'.$row[1].'" id="nomProd">';
					echo '<input type="hidden" value="'.$row[2].'" id="marProd">';
					echo '<input type="hidden" value="'.$row[3].'" id="cantProd">';
				}

			break;

			case 3:

			$proy=$_POST['proy'];
			$estado=$_POST['estado'];
			$fecha=$_POST['fecha'];
			$orden=$_POST['orden'];


			$fecha=substr($fecha, -4).'-'.substr($fecha, -7,2).'-'.substr($fecha, -10,2);

			$sql="insert into despacho(Estado,fecha,numOrdenDespacho, idProyecto)
					values('".$estado."','".$fecha."','".$orden."','".$proy."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el Despacho.
                                        </div>';
                     $sql1="select * from despacho  order by idPedido desc limit 1;";
                     $result = mysql_query($sql1) or die("Error");
                     while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="idPedido">';
			
				}

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se guardó el registro debido a un error en el ingreso del formato de la fecha
                                          
                                        </div>';
                     echo '<input type="hidden" value="0" id="idPedido">';                   
				}
			break;

			case 4:
				$idProd=$_POST['idprod'];
				$idPed=$_POST['idPed'];
				$cant=$_POST['cant'];

				$sql="insert into detdespachoproducto values('".$cant."','".$idPed."','".$idProd."');";
				if (mysql_query($sql)){

					$sql1="update producto set stock=stock-".$cant." where idProducto=".$idProd.";";
						if (mysql_query($sql1)){}
				}
					else{
					                  
				}


			break;

		}

		break; //fin del modulo 6 Despacho

		case 6:
		switch ($action) {
			case 0:
				
				$search = $_POST['search'];
				$sql="select p.idProducto,p.descripcion,m.descripcion,c.descripcion,p.stock,p.stockMin,p.stockMax, p.costounitario
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Productos General</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>
                                        <th>Marca</th>
                                        
                                        <th>Stock</th>
                                        <th>Stock Minimo</th>

                                        <th>Cantidad</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr id="f'.$row[0].'">
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idprod[]" id="idprod" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td >' . $row[1] . '</td>
                                    		<td >' . $row[2] . '</td>
                              
                                    		<td >' . $row[4] . '</td>
                                    		<td >' . $row[5] . '</td>

                                    		<td ><input type="text" id="cos'.$row[0].'" placeholder="00"></td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="7"> No Existen Productos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';

			break;

			case 1:
				echo '<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Lista de Productos Devueltos</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla2">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        
                                        <th>Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   </tbody></table>';
			break;

			case 2:

				$id=$_POST['idprod'];

				$sql="select p.idProducto,p.descripcion,m.descripcion,p.stock
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.idProducto='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="codProd">';
					echo '<input type="hidden" value="'.$row[1].'" id="nomProd">';
					echo '<input type="hidden" value="'.$row[2].'" id="marProd">';
					echo '<input type="hidden" value="'.$row[3].'" id="cantProd">';
				}
			break;

			case 3:
			$proy=$_POST['proy'];
			$fecha=$_POST['fecha'];
			$orden=$_POST['orden'];


			$fecha=substr($fecha, -4).'-'.substr($fecha, -7,2).'-'.substr($fecha, -10,2);

			$sql="insert into devolucion(fecha, numOrdenDev, idProyecto) 
				values('".$fecha."','".$orden."','".$proy."');";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el Despacho.
                                        </div>';
                     $sql1="select * from devolucion order by idDevolución desc limit 1;";
                     $result = mysql_query($sql1) or die("Error");
                     while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="idDevolucion">';
			
				}

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se guardó el registro debido a un error en el ingreso del formato de la fecha
                                          
                                        </div>';
                     echo '<input type="hidden" value="0" id="idPedido">';                   
				}
			break;

			case 4:

				$idProd=$_POST['idprod'];
				$idDev=$_POST['idDev'];
				$cant=$_POST['cant'];

				$sql="insert into detDevProducto values('".$cant."','".$idDev."','".$idProd."');";
				if (mysql_query($sql)){

					$sql1="update producto set stock=stock+".$cant." where idProducto=".$idProd.";";
						if (mysql_query($sql1)){}
				}
					else{
					                  
				}
			break;
			

		}


		break; //fin del modulo 7 Devoluciones

		case 7:
			switch ($action) {
				case 0:
				$search = $_POST['search'];
				$sql="select * from proveedor where razonSocial like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Proveedores</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Razón Social</th>
                                        <th>RUC</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>

                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idprov[]" id="idprov" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		<td>' . $row[2] . '</td>
                                    		<td>' . $row[3] . '</td>
                                    		<td>' . $row[4] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="6"> No Existen Proveedores registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
				break;

				case 1:
				$nombre=$_POST['nombre'];
				$ruc=$_POST['ruc'];
				$dir=$_POST['dir'];
				$telf=$_POST['telf'];

				$sql="insert into proveedor(razonSocial,ruc,direccion,telefono)
 						values('".$nombre."','".$ruc."','".$dir."','".$telf."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente al Proveedor '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

					}

				break;

				case 2:
					$eliminar = $_POST['idprov'];
				 $sql = "delete from proveedor  where idProveedor='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
				break;

				case 3:
				$id=$_POST['id'];
				$sql="select * from proveedor where idProveedor='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<div class="panel-body">
                                <div id="msj"></div>
						<div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Razón Social:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[1].'" class="form-control input-sm" id="nombre" placeholder="Nombre" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Ruc:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[2].'" class="form-control input-sm" id="ruc" placeholder="RUC" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Direccion:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[3].'" class="form-control input-sm" id="dir" placeholder="Dirección" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Telefono:</label>
                                    <div class="col-lg-5">
                                        <input type="text" value="'.$row[4].'" class="form-control input-sm" id="telf" placeholder="Teléfono" style="border: solid 1px;color: rgb(102, 101, 110);">
                                    </div>

                            </div></div>';
				}

				break;

				case 4:
					$id=$_POST['id'];
					$nombre=$_POST['nombre'];
					$ruc=$_POST['ruc'];
					$dir=$_POST['dir'];
					$telf=$_POST['telf'];

				$sql="update proveedor set razonSocial='".$nombre."', ruc='".$ruc."' , direccion='".$dir."' , telefono='".$telf."'
						where idProveedor='".$id."';";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente al Proveedor '.$nombre.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

				break;



			}
		break; // Fin del Módulo 08 Proveedores

		case 8:
			switch ($action) {
				case 0:
					$search = $_POST['search'];
				$sql="select p.idProducto,p.descripcion,m.descripcion,c.descripcion,p.stock,p.stockMin,p.stockMax, p.costounitario
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.descripcion like '%".$search."%';";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">Lista de Productos General</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Descripcion</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Stock</th>
                                        <th>Stock Minimo</th>
                                        <th>Stock Maximo</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {
                                    	$aux=1;
                                    	echo'<tr id="f'.$row[0].'">
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idprod[]" id="idprod" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td >' . $row[1] . '</td>
                                    		<td >' . $row[2] . '</td>
                              				<td >' . $row[3] . '</td>
                                    		<td >' . $row[4] . '</td>
                                    		<td >' . $row[5] . '</td>
                                    		<td >' . $row[6] . '</td>
                                    		<td ><input type="text" id="ca'.$row[0].'" placeholder="00"></td>
                                    		<td ><input type="text" id="cos'.$row[0].'" placeholder="00.00"></td>
                                    		</tr>
                                    	';
                                    	$num++;
                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="10"> No Existen Productos registrados aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
				
				break;

				case 1:
					echo '<div class="panel panel-blue" style="background:#FFF;">
                            <div class="panel-heading">Lista de Productos Devueltos</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla2">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Precio x Cantidad</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   </tbody></table>';

				break;

				case 2:

				$id=$_POST['idprod'];

				$sql="select p.idProducto,p.descripcion,m.descripcion,p.stock
							from producto p
							inner join marca m on m.idMarca=p.idMarca
							inner join categoria c on c.idCategoria=p.idCategoria where p.idProducto='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="codProd">';
					echo '<input type="hidden" value="'.$row[1].'" id="nomProd">';
					echo '<input type="hidden" value="'.$row[2].'" id="marProd">';
					echo '<input type="hidden" value="'.$row[3].'" id="cantProd">';
				}
			break;

			case 3:

			$prov=$_POST['prov'];
			$fecha=$_POST['fecha'];
			$orden=$_POST['orden'];
			$cost=$_POST['cost'];

			$fecha=substr($fecha, -4).'-'.substr($fecha, -7,2).'-'.substr($fecha, -10,2);

			$sql="insert into compra(montoTotal,fecha, numOrdenCompra, idProveedor)
				values('".$cost."','".$fecha."','".$orden."','".$prov."');";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el la Compra
                                        </div>';
                     $sql1="select * from compra order by idCompra desc limit 1;";
                     $result = mysql_query($sql1) or die("Error");
                     while ($row = mysql_fetch_array($result)) {

					echo '<input type="hidden" value="'.$row[0].'" id="idCompra">';
			
				}

				}
				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se guardó el registro debido a un error en el ingreso del formato de la fecha
                                          
                                        </div>';
                     echo '<input type="hidden" value="0" id="idCompra">';                   
				}
			break;

			case 4:
				$idProd=$_POST['idprod'];
				$idCom=$_POST['idCom'];
				$cant=$_POST['cant'];
				$cosu=$_POST['cosu'];

				$sql="insert into detcompraproducto values('".$cant."','".$cosu."','".$idCom."','".$idProd."');";
				if (mysql_query($sql)){

					$sql1="update producto set stock=stock+".$cant." where idProducto=".$idProd.";";
						if (mysql_query($sql1)){}
				}
					else{
					                  
				}
			break;
			

			}
		break; // Fin del Módulo 09 Compras

		case 9:
			switch ($action) {
				case 0:
					$search = $_POST['search'];
				$sql="select u.idUsuario , concat(t.nombres,' ',t.apellidos), u.usuario,u.nivel , tt.cargo, t.dni, t.telefono,t.direccion
					from usuario u
					inner join trabajador t on t.idtrabajador=u.idtrabajador
					inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador where t.nombres like '%".$search."%' order by u.nivel;";
				$num=1;
				$aux=0;
				$result = mysql_query($sql) or die("Error");
				echo '<div class="panel panel-grey" >
                            <div class="panel-heading">usuarios del Sistema</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered id="tabla1">
                                    <thead>
                                    <tr>
                                        <th width="1em"></th>
                                        <th width="1em">#</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Nivel</th>
                                        <th>Cargo</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                    </tr>
                                    </thead>
                                    <tbody>';

                                    while ($row = mysql_fetch_array($result)) {


                                    	$aux=1;
                                    	echo'<tr>
                                    		<td><span class="input-group-addon">
                                        <input type="checkbox" name="idusu[]" id="idusu" value="' . $row[0] . '">
                                        </span></td>
                                    		<td>'.$num.'.-</td>
                                    		<td>' . $row[1] . '</td>
                                    		<td>' . $row[2] . '</td>
                                    		<td>' . $row[3] . '</td>
                                    		<td>' . $row[4] . '</td>
                                    		<td>' . $row[5] . '</td>
                                    		<td>' . $row[6] . '</td>
                                    		<td>' . $row[7] . '</td>
                                    		</tr>
                                    	';
                                    	$num++;



                                    }
                                    if($aux==0){
                                    	echo '<tr><td colspan="9"> No Existen Marcas registradas aun</td></tr>';
                                    }

		                                    echo '
		                                    </tbody>
		                                </table>
		                            </div>
		                        </div>';
				break;

				case 1:
				$trab=$_POST['trab'];
				$nivel=$_POST['nivel'];
				$usu=$_POST['usu'];
				$clave=$_POST['clave'];

				$sql0="select * from usuario where Usuario='".$usu."';";
				$auxUsu=0;
				$result = mysql_query($sql0) or die("Error");
				while ($row = mysql_fetch_array($result)) { 
					$auxUsu=1;
				}

				if($auxUsu==0){
					$sql="insert into usuario(Usuario,clave,nivel,idTrabajador) values('".$usu."','".$clave."','".$nivel."', '".$trab."');";
				if (mysql_query($sql)){
					echo'
					<div class="alert alert-success alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se ingresó correctamente el Usuario '.$usu.'.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}

				}

				else{
					echo'<div class="alert alert-danger alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Error!</strong> No se ingresó el Usuario '.$usu.' porque ya existe ese Usuario!
                                        </div>';
				}
				
				break;

				case 2:
					echo '<select id="trab" class="form-control" style="border: solid 1px;color: rgb(102, 101, 110);">
                                        <option value="0">Seleccione...</option>';
                                        

                                        $sql="select t.idTrabajador,concat(t.nombres,' ',t.apellidos,'-',tt.cargo)
                                        from trabajador t
                                        inner join tipotrabajador tt on tt.idtipotrabajador=t.idtipotrabajador;";
                                        $result = mysql_query($sql) or die("Error");
                                         while ($row = mysql_fetch_array($result)) {
                                            $sql1="select * from usuario where idtrabajador='".$row[0]."';";
                                            $result1 = mysql_query($sql1) or die("Error");
                                            $auxU=0;
                                                while ($row1 = mysql_fetch_array($result1)) {
                                                    $auxU=1;
                                                 }
                                                 if($auxU==0) {
                                            echo'<option value="'.$row[0].'">'.$row[1].'</option>'; }

                                         }

                                        


                                    echo '</select>';
				break;

				case 3:
				 $eliminar = $_POST['idusu'];
				 $sql = "delete from usuario where idUsuario='".$eliminar."';";
                if (mysql_query($sql)) {
                	 }
				break;

				case 4:
				$id=$_POST['id'];
				$sql="select * from Usuario where idUsuario='".$id."';";

				$result = mysql_query($sql) or die("Error");

				while ($row = mysql_fetch_array($result)) {

					echo '<h4 class="modal-title">
                                Cambiar Contraseña del Usuario: '.$row[1].'</h4>';
				}
				break;

				case 5:

				$id=$_POST['id'];
				$clave=$_POST['clave'];
				$sql="update Usuario set clave='".$clave."' where idUsuario='".$id."'";

				if (mysql_query($sql)){
					echo'
					<div class="alert alert-info alert-dismissable">
                                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                            <strong>Bien hecho!</strong> Se editó correctamente la Contraseña!.
                                        </div>';

				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}
				break;
				
			}
		break; // Fin del Modulo 10 Usuarios

		case 10:
		switch ($action) {
			case 0:
				
				$id=$_POST['id'];
				$idT=$_POST['idT'];
				$clave=$_POST['clave'];
				$dir=$_POST['dir'];
				$telf=$_POST['telf'];
				$sql="update Usuario set clave='".$clave."' where idUsuario='".$id."'";

				if (mysql_query($sql)){
					
					$sql1="update Trabajador set direccion='".$dir."' , telefono='".$telf."' where idTrabajador='".$id."'";
						if (mysql_query($sql1)){}
				}
				else{
					echo'<span class="error">Error no se pudo guardar el registro.</span>';

				}
			break;
			

		}
		break; // Fin del módulo 11 Mi Cuenta

		case 11:
			switch ($action) {
				case 0:
				
				$sql="select * from producto p where p.stock<p.stockMin;";
					$result = mysql_query($sql) or die("Error");

				$aux=0;	$con=0;

				while ($row = mysql_fetch_array($result)) {
				$aux=1;	$con++;
				}

				if($aux==1){
 
					echo '<a data-hover="dropdown" class="dropdown-toggle" href="javascript:void(0);" onclick="rep1();"  id="rep1"><i class="fa fa-cubes"></i>
                        <span class="badge badge-red">'.$con.'</span></a>';
				}

					else{
						echo '<a data-hover="dropdown" href="javascript:void(0);"  onclick="rep1();" class="dropdown-toggle" id="rep1"><i class="fa fa-cubes"></i>
                        <span class="badge ">0</span></a>';
					}


				break;
			
			}
		break; // Fin del Módulo Reportes







	




	
	
}

?>