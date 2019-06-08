<?php

    function loggin($user,$password){
        $resp=false;
          $sql=sprintf("select * from usuario u where u.usuario='%s' and u.clave='%s';",$user,$password) ;
        $rs=mysql_query($sql)or die ("IT: Problema con el query");
        $_SESSION['nivelCR']=0;
        if($row=mysql_fetch_row($rs)){
            $_SESSION['userCR']=$user;
            $_SESSION['claveCR']=$password;
            $_SESSION['idCR']=$row[0];
            $_SESSION['nivelCR']=$row[6];
            $resp=true;
        }
        
        return $resp;
    }

    



    ?>