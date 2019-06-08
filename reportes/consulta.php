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
			$sql="select * from producto p where p.stock<p.stockMin;
						";
			$rs=mysqli_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="center" >
			<h1>Reporte de Productos con un Stock por debajo del Mínimo ';
			$html=$html.$hoy;
			$html=$html.'</h1>
			<br /><br />	</div>	<div align="center" >
			<table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#FF0000"><th><font color="#FFFFFF">Producto</font></th><th><font color="#FFFFFF">Stock</font>
			</th><th><font color="#FFFFFF">Stock Mínimo</font></th><th><font color="#FFFFFF">Stock Maximo</font></th> <th><font color="#FFFFFF">Precio Compra Unid</font></th></tr>';
			$monto=0;
			
			while ($row = mysqli_fetch_array($rs)){
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#95B1CE">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row[1];
				$html = $html.'</td><td>';
				$html = $html. $row[2];
				$html = $html.'</td><td>';
				$html= $html. $row[3];
				$html= $html.'</td><td>';
				$html= $html. $row[4];
				$html= $html.'</td><td>';
				$html = $html. $row[5];
				$html = $html.'</td></tr>';	
				
				$i++;
			}			
	
		
			$html=$html.'</table></div>';		


			


     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

