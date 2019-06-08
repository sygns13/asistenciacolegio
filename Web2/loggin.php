<?php
	//header('Location:http://localhost/Tutorias/principal.html');
	
	include('Funciones/General.php');

	 require 'funciones/configuration.php'; 
	mysql_query("set names 'utf8'");

	if (!isset($_SESSION)) {
  	session_start();
	}
	//$user=$_SESSION["user"];
	$username=$_POST['username'];
	$password=$_POST['password'];
	//$tipo=$_POST['cargo'];
	if(loggin($username,$password)){
			mysql_close();
			
			header('Location:Principal.php');

		}
		else{
		mysql_close();
		header('Location:cerrar.php');

		}
	
	
?>