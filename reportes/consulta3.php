<?php 

	require "conexion/conexion.php";
	class consulta{
		var $conn;
		var $conexion;
		function consulta(){		
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
			
		}	
		//-----------------------------------------------------------------------------------------------------------------------
			
		//-----------------------------------------------------------------------------------------------------------------------
		function reportePdfUsuarios(){	
				
			$html="";
			$hoy = date("d/m/y"); 

			/********************* Defuncion *******************/
			$sql="select d.fecha, d.numOrdenDev, p.descripcion, concat(t.nombres,' ',t.apellidos), t.dni, c.cargo, d.idDevolución
						from devolucion d
						inner join proyecto p on p.idproyecto=d.idproyecto
						inner join trabajador t on t.idtrabajador=p.idtrabajador
						inner join tipotrabajador c on c.idtipotrabajador=t.idtipotrabajador;";
						
			
			
			$i=1;

			$html=$html.'<div align="center" >
			<h1>Reportes de Devoluciones de los Productos al Almacen ';
			$html=$html.$hoy;
			$html=$html.'</h1>';
				
			
			$monto=0;
			$rs=mysqli_query($this->conn,$sql);
			while ($row = mysqli_fetch_array($rs)){
				$fecha=substr($row[0], -2).'-'.substr($row[0], -5,2).'-'.substr($row[0], -10,4);

				$html=$html.'<br /><br />	</div>	<div align="left" ><h2>'.$i.'.- Devolución de fecha: '.$fecha.'</h2></div>';
				
				$html=$html.'Proyecto: '.$row[2];

				$html=$html.'<br>Responsable: '.$row[3]. ' | DNI: '.$row[4].' | Cargo: '.$row[5];

				$html=$html.'<br>Num de Orden de Despacho: '.$row[1];

			$sql1="select  p.descripcion, d.cantidad
					FROM detdevproducto d
					inner join producto p on p.idproducto=d.idproducto where d.idDevolución='".$row[6]."';";
			$num=1;

			

			$html=$html.'<br><table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#FF0000"><th width="5%"><font color="#FFFFFF">#</font></th><th width="70%"><font color="#FFFFFF">Producto</font></th><th widht="25%"><font color="#FFFFFF">Cantidad</font></th></tr>';
				$res=mysqli_query($this->conn,$sql1);

				while ($row1 = mysqli_fetch_array($res)){
					if($num%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $num.'.-';
				$html = $html.'</td><td>';
				$html = $html. $row1[0];
				$html = $html.'</td><td>';
	
	
				$html = $html. $row1[1];
				$html = $html.'</td></tr>';	


				$num++;
				}

				$i++;
				$html=$html.'</table></div>';
				
			}			
	
		
			


			


     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

