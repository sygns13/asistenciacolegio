
<?php
    $db_host="localhost";
    $db_usu="root";
    $db_psw="13111991";
    $db_base="CristoReyAsistencia";
    $cnx = @mysql_connect($db_host, $db_usu, $db_psw) or die(mysql_error());
    $base = @mysql_select_db($db_base, $cnx) or die(mysql_error());
?>