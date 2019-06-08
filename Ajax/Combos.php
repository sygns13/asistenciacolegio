<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
require '../Funciones/configuration.php';
//require '../util.php';
$caso = $_POST['caso'];
switch ($caso) {
    case 0:
        $categoria = $_POST['categoria'];
         $sql = "SELECT idSubcategoria,descripcion FROM subcategoria where idcategoria='" . $categoria . "';";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    echo'<option value="'.$row[0].'">'.$row[1].'</option>';
                }
        break;
}
?>
