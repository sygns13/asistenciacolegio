<?php
echo'<ul id="side-menu" class="nav">
                    
                     <div class="clearfix"></div>

                    <li class="active"><a href="Principal.php"><i class="fa fa-home">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Inicio</span></a></li>

                    <li><a href="marca.php"><i class="fa fa-buysellads">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Marcas</span></a>
                    </li>

                    <li><a href="categorias.php"><i class="fa fa-archive">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Categorías</span></a>
                       
                    </li>
                    <li><a href="Productos.php"><i class="fa fa-cubes">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Producto</span></a>

                    </li>
                  

                  
                    <li><a href="trabajadores.php"><i class="fa fa-users">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Trabajadores</span></a>
                      
                    </li>
                    <li><a href="proyectos.php"><i class="fa fa-gavel">
                        <div class="icon-bg bg-blue"></div>
                    </i><span class="menu-title">Proyectos</span></a>
                          
                    </li>
                    <li><a href="despachos.php"><i class="fa fa-truck">
                        <div class="icon-bg bg-red"></div>
                    </i><span class="menu-title">Despachos</span></a>
                      
                    </li>
                    <li><a href="devoluciones.php"><i class="fa fa-exchange">
                        <div class="icon-bg bg-yellow"></div>
                    </i><span class="menu-title">Devoluciones</span></a>
                    </li>
                    
                    <li><a href="proveedores.php"><i class="fa fa-user-secret">
                        <div class="icon-bg bg-dark"></div>
                    </i><span class="menu-title">Proveedores</span></a>
                      
                    </li>
                    <li><a href="compras.php"><i class="fa fa-usd">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">Compras</span></a>
                      
                    </li>';
                    
                    if($_SESSION['nivel']==1){
                        echo '<li><a href="usuarios.php"><i class="fa fa-user-plus">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Usuarios</span></a></li>';


                    }    
                echo'</ul>';
?>