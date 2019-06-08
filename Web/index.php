<?php 
session_start();
if(isset($_SESSION["userCR"]))
{ header("Location:Principal.php");
}
$m=$_GET['m'];
?>
<!DOCTYPE html>
<html lang="es">
  
<head>
    <meta charset="utf-8">
    <title>Acceso al Sistema</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="../Acceso/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../Acceso/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="../Acceso/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="../Acceso/css/style.css" rel="stylesheet" type="text/css">
<link href="../Acceso/css/pages/signin.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" href="../Acceso/dist/sweetalert.css">
</head>

<body>
	<?php
	echo'<input type="hidden" id="ms" value="'.$m.'">';
	?>
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner" style="background: #141716 !important;">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				Acceso al Sistema				
			</a>		
			
			<div class="nav-collapse">
			
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->
<div id="msj"></div>



<div class="account-container">
	
	<div class="content clearfix">
		
		<form action="../Funciones/loggin.php" method="post">
		
			<h1>Formulario de Acceso</h1>		
			
			<div class="login-fields">
				
				<p>Ingrese sus credenciales de Acceso</p>
				
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="" placeholder="Usuario" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				

				<button type="reset" class="button btn btn-large" >Cancelar</button>				
				<button type="submit" id="btn1" class="button btn btn-info btn-large" style="margin-right:10px;">Iniciar Sessión</button>

				<!-- <span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Mantenme Conectado</label>

					<span class="label label-danger">Usuario o password incorrecto</span> 
				</span> -->
				
				 
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	

</div> <!-- /account-container -->


<script src="../Acceso/js/jquery-1.7.2.min.js"></script>
<script src="../Acceso/js/bootstrap.js"></script>

<script src="../Acceso/js/signin.js"></script>
<script src="../Acceso/dist/sweetalert.min.js"></script>

<script>
$(document).ready(function(e) {

//$("#msj").hide();
//alert("really");
$("#username").focus();
var aux;
aux=parseInt($("#ms").val());


if(aux==1){

$("#msj").html("<div class='alert'  style='width: 50%;margin-left: 25%;margin-bottom: 100px;z-index: 100;position: absolute;top: 4.9em;text-shadow: 0 0px 0 rgba(113, 40, 40, 0.5);background-color: rgb(214, 176, 176);color:#9C0000;'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> Usuario o password incorrectos.</div>");
}



});


</script>

</body>

</html>
