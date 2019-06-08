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
			$sql="select c.idCompra,c.fecha,c.numOrdenCompra, c.montoTotal, p.razonSocial, p.ruc, p.direccion, p.telefono
					FROM compra c
					inner join proveedor p on p.idproveedor=c.idproveedor order by c.fecha;";
			$rs=mysqli_query($this->conn,$sql);
			$i=1;

			$html=$html.'<div align="center" >
			<h1>Reportes de Compras de Productos ';
			$html=$html.$hoy;
			$html=$html.'</h1>';
				
			
			$monto=0;
			
			while ($row = mysqli_fetch_array($rs)){

				$fecha=substr($row[1], -2).'-'.substr($row[1], -5,2).'-'.substr($row[1], -10,4);

				$html=$html.'<br /><br />	</div>	<div align="left" ><h2>'.$i.'.- Compra de fecha: '.$fecha.'</h2></div>';
				
				$html=$html.'Proveedor: '.$row[4];

				$html=$html.'<br>Dirección: '.$row[6]. ' | RUC: '.$row[5].' | Teléfono: '.$row[6];

				$html=$html.'<br>Num de Orden de Compra: '.$row[2];

			$sql1="select  p.descripcion, d.cantidad, d.precioUnitario,(d.cantidad*d.precioUnitario)
					FROM detcompraproducto d
					inner join producto p on p.idproducto=d.idproducto where d.idCompra='".$row[0]."';";
			$num=1;

			

			$html=$html.'<br><table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#FF0000"><th width="5%"><font color="#FFFFFF">#</font></th><th width="40%"><font color="#FFFFFF">Producto</font></th><th widht="10%"><font color="#FFFFFF">Cantidad</font></th>
			<th widht="20%"><font color="#FFFFFF">Precio Unitario</font></th><th widht="25%"><font color="#FFFFFF">Precio x Cantidad</font></th></tr>';
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
				$html = $html.'</td><td>S/';
				$html = $html. $row1[2];
				$html = $html.'</td><td>S/';
	
				$html = $html. $row1[3];
				$html = $html.'</td></tr>';	


				$num++;
				}

				$i++;
				$html = $html.'<tr><td colspan="5"></td></tr><tr><td colspan="4">Monto Total</td><td>S/'.$row[3].'</td></tr>';
				$html=$html.'</table></div>';
			}			
	
		
			


			


     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------		
	}

?>

