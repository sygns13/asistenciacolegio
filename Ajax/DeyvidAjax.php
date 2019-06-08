<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();
require '../Funciones/configuration.php';
//require '../util.php';
$module = $_POST['module'];
$action = $_POST['action'];

switch ($module) {
    case 0:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = "SELECT * FROM gnl_marca where descripcion like'" . $search . "%' and debaja<>1;";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>DESCRIPCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                            <input type="radio" name="codmarca" id="codmarca" value="' . $row[0] . '">
                                            </span><input type="hidden" id="' . $row[0] . '" name="' . $row[0] . '" value="' . $row[1] . '"></td>
                                        <td>' . $row[1] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $marca = $_POST['marca'];
                $sql = "insert into gnl_marca(descripcion,debaja) values('" . $marca . "','0')";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $marca . ' se guardo con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $marca . ' no se guardo con éxito</div>';
                break;
            case 2:
                $marca = $_POST['marca'];
                $idmarca = $_POST['idmarca'];
                $sql = " update gnl_marca set
                        descripcion='" . $marca . "' where idgnl_Marca='" . $idmarca . "';";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $idmarca . ' se actualizo  con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $idmarca . ' no se actualizo con éxito, Repita la Operaci�n o Comuniquese con la Area de Sistemas</div>';
                
                break;
            case 3:
                $codmarca = $_POST['codmarca'];
                $sql = "update gnl_marca set
                        debaja='1' where idGNL_Marca='" . $codmarca . "'";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $codmarca . ' se eliminó con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $codmarca . ' no se pudo eliminar</div>';
                break;
        }

        break;
    case 1:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = "SELECT * FROM cargo where descripcion like'" . $search . "%';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>DESCRIPCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                            <input type="checkbox">
                                            </span><input type="hidden" id="idcargo[]" value="' . $row[0] . '"></td>
                                        <td>' . $row[1] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $cargo = $_POST['cargo'];
                $sql = "insert into cargo(descripcion) values('" . $cargo . "')";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $cargo . ' se guardo con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $cargo . ' no se guardo con éxito</div>';
                break;
            case 2:
                //actualiza
                break;
            case 3:
                
                break;
        }
        break;

    case 2:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = "SELECT * FROM categoria  where descripcion like'" . $search . "%' and debaja<>1;";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>DESCRIPCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                            <input type="radio" name="codcategoria" id="codcategoria" value="' . $row[0] . '">
                                            </span><input type="hidden" id="' . $row[0] . '" name="' . $row[0] . '" value="' . $row[1] . '"></td>
                                        <td>' . $row[1] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $categoria = $_POST['categoria'];
                $sql = "insert into categoria(descripcion,debaja) values('" . $categoria . "','0')";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $categoria . ' se guardo con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $categoria . ' no se guardo con éxito</div>';
                break;
            case 2:
                $cate = $_POST['categoria'];
                $idcate = $_POST['idcate'];
                $sql = " update categoria set
                        descripcion='" . $cate . "' where idcategoria='" . $idcate . "';";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $idcate . ' se actualizo  con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $idcate . ' no se actualizo con éxito, Repita la Operaci�n o Comuniquese con la Area de Sistemas</div>';
                
                break;
                break;
            case 3:
                $codcate = $_POST['codcate'];
                $sql = "update categoria set
                        debaja='1' where idCategoria='" . $codcate . "'";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $codcate . ' se eliminó con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $codcate . ' no se pudo eliminar</div>';
             
                break;
        }
        break;
    case 3:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = "SELECT * FROM unidad  where descripcion like'" . $search . "%';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>DESCRIPCIÓN</th>
                                        <th>ABREVIATURA</th>
                                        <th>CANTIDAD</th>
                                    </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                            <input type="checkbox">
                                            </span><input type="hidden" id="idunidad[]" value="' . $row[0] . '"></td>
                                        <td>' . $row[1] . '</td>
                                        <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $unidad = $_POST['unidad'];
                $abreviatura = $_POST['abreviatura'];
                $cantidad = $_POST['cantidad'];
                $sql = "insert into unidad(descripcion,abreviatura,cantidadunidad) values('" . $unidad . "','" . $abreviatura . "','" . $cantidad . "')";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $unidad . ' se guardo con éxito</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $unidad . ' no se guardo con éxito</div>';
                break;
            case 2:
                //actualiza
                break;
            case 3:
                // Elimina
                break;
        }
        break;
    case 4:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = " select sc.idsubcategoria,c.idcategoria,c.descripcion,sc.descripcion
                        from subcategoria sc
                        INNER JOIN categoria c ON c.idcategoria=sc.idcategoria where sc.descripcion like '" . $search . "%';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>CATEGORIA</th>
                                        <th>SUBCATEGORIA</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                            <input type="checkbox">
                                            </span><input type="hidden" id="codmarca[]" value="' . $row[0] . '"></td>
                                        <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $categoria = $_POST['categoria'];
                $subcategoria = $_POST['subcategoria'];
                $sql = "insert into subcategoria(idcategoria,descripcion) values('" . $categoria . "','" . $subcategoria . "')";
                if (mysql_query($sql))
                    echo'<div class="alert alert-info">El registro: ' . $subcategoria . ' se guardo con éxito' . mysql_error() . '</div>';
                else
                    echo '<div class="alert alert-danger">Error:El registro ' . $subcategoria . ' no se guardo con éxito</div>';
                break;
            case 2:
                //actualiza
                break;
            case 3:
                // Elimina
                break;
        }
        break;
    case 5:
        switch ($action) {
            case 0:
                $search = $_POST['search'];
                $sql = " select p.idproducto, c.descripcion,sc.descripcion,m.descripcion,p.descripcion,stock,stockminimo,stockmax
                        from producto p
                        INNER JOIN gnl_marca m ON
                          m.idGNL_Marca=p.idGNL_Marca
                        INNER JOIN subcategoria sc  ON
                          sc.idsubcategoria=p.idsubcategoria
                        INNER JOIN categoria c ON
                          c.idcategoria=sc.idcategoria
                        where p.descripcion like '%" . $search . "%';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>CATEGORIA</th>
                                        <th>SUBCATEGORIA</th>
                                        <th>MARCA</th>
                                        <th>PRODUCTO</th>
                                        <th>STOCK</th>
                                        <th>STOCK MIN</th>
                                        <th>STOCK MAX</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idproducto[]" id="idproducto" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                        <td>' . $row[2] . '</td>
                                         <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>
                                         <td>' . $row[7] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';



                break;


            case 1:
                $subcategoria = $_POST['subcategoria'];
                $marca = $_POST['marca'];
                $producto = $_POST['producto'];
                $stockmin = $_POST['stockmin'];
                $stockmax = $_POST['stockmax'];
                $stockreal = $_POST['stockreal'];
                $costoprov = $_POST['costoprov'];

                if (strlen($stockreal) == 0) {
                    $stockreal = 0;
                }
                if ($stockmax < $stockmin) {
                    echo'<div class="alert alert-danger">Error: El registro ' . $producto . '  no se guardo con éxito, el Stock maximo no puede ser menor al stock minimo</div>';
                } else {

                    $sql = "CALL paProducto(0,'" . $marca . "','" . $subcategoria . "','" . $producto . "','" . $stockreal . "','" . $stockmin . "','" . $stockmax . "',1,'" . $costoprov . "')";
                    if (mysql_query($sql))
                        echo'<div class="alert alert-info">El registro: ' . $producto . ' se guardo con éxito</div>';
                    else
                        echo '<div class="alert alert-danger">Error:El registro ' . $producto . ' no se guardo con éxito</div>';
                }
                break;

            case 2:

                function SelectGeneral($sql, $value, $option, $idselect) {
                    $rs = mysql_query($sql) or die("Error de sistema.");
                    echo '<select id="' . $idselect . '"  class="form-control">';
                    while ($row = mysql_fetch_row($rs)) {
                        echo '<option value="' . $row[$value] . '" selected>' . $row[$option] . '</option>';
                    }
                    echo '</select>';
                }

                $idprod = $_POST['idprod'];
                $subcategoria = $_POST['subcategoria'];
                $marca = $_POST['marca'];
                $producto = $_POST['producto'];
                $stockmin = $_POST['stockmin'];
                $stockmax = $_POST['stockmax'];
                $stockreal = $_POST['stockreal'];
                $costoprov = $_POST['costoprov'];


                if (strlen($stockreal) == 0) {
                    $stockreal = 0;
                }
                if ($stockmax < $stockmin) {
                    echo'<div class="alert alert-danger">Error: El producto ' . $producto . '  no se modificó con éxito, el Stock maximo no puede ser menor al stock minimo</div>';
                } else {

                    $sql = "CALL paProducto('" . $idprod . "','" . $marca . "','" . $subcategoria . "','" . $producto . "','" . $stockreal . "','" . $stockmin . "','" . $stockmax . "',3,'" . $costoprov . "')";
                    if (mysql_query($sql)) {
                        echo'<div class="alert alert-info">El Producto: ' . $producto . ' se modificó con éxito</div>';
                    } else {
                        echo '<div class="alert alert-danger">Error:El producto ' . $producto . ' no se modificó con éxito</div>';
                    }
                }




                $sql = " select p.idproducto, c.descripcion,sc.descripcion,m.descripcion,p.descripcion,stock,stockminimo,stockmax,costoprov
                                                            from producto p
                                                            INNER JOIN gnl_marca m ON
                                                            m.idGNL_Marca=p.idGNL_Marca
                                                            INNER JOIN subcategoria sc  ON
                                                            sc.idsubcategoria=p.idsubcategoria
                                                            INNER JOIN categoria c ON
                                                            c.idcategoria=sc.idcategoria
                                                            where p.idproducto='" . $idprod . "';";
                $result = mysql_query($sql) or die("Error");

                while ($row = mysql_fetch_array($result)) {


                    $idProducto = "";
                    $categoria = "";
                    $subcategoria = "";
                    $marca = "";
                    $producto = "";
                    $stock = "";
                    $stockmin = "";
                    $stockmax = "";
                    $costoP = "";

                    $idProducto = $row[0];
                    $categoria = $row[1];
                    $subcategoria = $row[2];
                    $marca = $row[3];
                    $producto = $row[4];
                    $stock = $row[5];
                    $stockmin = $row[6];
                    $stockmax = $row[7];
                    $costoP = $row[8];


                    echo '<div style="display:none;"> <input type="checkbox" name="idprod" id="idprod" value="' . $row[0] . '"> </div>';
                }
                echo'

                                    <div style="display:none;"> <input type="checkbox" name="idsubc" id="idsubc" value="' . $subcategoria . '"> </div>
                                <div class="form-group form-group-sm">




                                    <label class="col-lg-2 control-label">Categoria:</label>
                                    <div class="col-lg-5">
                                        ';
                SelectGeneral("Select * from categoria where debaja<>1 order by descripcion='" . $categoria . "' ", 0, 1, "categoria");
                echo '</div>
                                </div><br><br>



                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">SubCategoria:</label>
                                    <div class="col-lg-5">
                                        <select id="subcategoria" class="form-control">
                                            <option></option>
                                        </select>

                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Marca:</label>
                                    <div class="col-lg-5">';
                SelectGeneral("SELECT * FROM gnl_marca  where debaja<>1 order by descripcion='" . $marca . "'; ", 0, 1, "marca");
                echo'
                                    </div>
                                </div><br><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Producto:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="producto" value="' . $producto . '">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Minimo:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="stockmin" value="' . $stockmin . '">
                                    </div>
                                </div><br>
                                <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Maximo:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="stockmax" value="' . $stockmax . '">
                                    </div>
                                </div><br>
                                 <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Stock Real:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="stockreal" value="' . $stock . '">
                                    </div><br><br>
                                    <div class="form-group form-group-sm">
                                    <label class="col-lg-2 control-label">Costo Prov:</label>
                                    <div class="col-lg-5">
                                        <input type="text" class="form-control input-sm" id="costoprov" value="' . $costoP . '">
                                    </div>
                                </div>


                            </div>';

                break;

            case 3:
                //elimina
                $eliminar = $_POST['idproducto'];

                $sql = "call paProducto('" . $eliminar . "',0,0,'',0,0,0,2,0);";
                if (mysql_query($sql)) {
                    
                }

                break;
        }

        break;
    case 6:
        switch ($action) {
            case 0:
                $sql = "update contizacion set ESTADO='2' where VALIDO<=now()";
                $result = mysql_query($sql) or die("Error");
                $search = $_POST['search'];
                $sql = "select c.idCONTIZACION,e.NOMBRES, cp.NUMERO ,c.FECHAHORA ,c.MONTOTAL ,t.USUARIO FROM contizacion c INNER JOIN trabajador t ON c.idTRABAJADOR=t.idTRABAJADOR INNER JOIN comprobante cp ON c.idCOMPROBANTE=cp.idCOMPROBANTE INNER JOIN entidad_empresa em ON c.idENTIDAD_EMPRESA=em.idENTIDAD_EMPRESA INNER JOIN entidad e ON e.idENTIDAD=em.idENTIDAD WHERE e.NOMBRES like '%" . $search . "%' AND c.ESTADO=1;";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>COMPRADOR</th>
                                        <th>NRO COTIZACION</th>
                                        <th>FECHA / HORA</th>
                                        <th>MONTO TOTAL</th>
                                        <th>VENDEDOR</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idcotizacion" id="idcotizacion" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                        <td>' . $row[0] . '</td>
                                         <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;
            case 1:
                $search = $_POST['search'];
                $categoria = $_POST['categoria'];
                $subcategoria = $_POST['subcategoria'];
                $marca = $_POST['marca'];
                if ($categoria == 0) {
                    $categoria = " like '%%'";
                } else {
                    $categoria = "='" . $categoria . "'";
                }
                if ($subcategoria == 0) {
                    $subcategoria = " like '%%'";
                } else {
                    $subcategoria = "='" . $subcategoria . "'";
                }
                if ($marca == 0) {
                    $marca = " like '%%'";
                } else {
                    $marca = "='" . $marca . "'";
                }
                $sql = "select pu.idproductounidad,p.descripcion,u.ABREVIATURA,p.stock,pu.precioestablecido,pu.precioespecial,u.cantidadunidad
                        FROM productounidad pu
                        INNER JOIN producto p ON p.idPRODUCTO=pu.idPRODUCTO
                        INNER JOIN gnl_marca m ON
                          m.idGNL_Marca=p.idGNL_Marca
                        INNER JOIN subcategoria sc  ON
                          sc.idsubcategoria=p.idsubcategoria
                        INNER JOIN categoria c ON
                          c.idcategoria=sc.idcategoria
                        INNER JOIN unidad u ON u.idUNIDAD=pu.idUNIDAD
                        where p.descripcion like '%" . $search . "%' AND c.idCATEGORIA " . $categoria . " AND sc.idSUBCATEGORIA " . $subcategoria . " AND m.idGNL_MARCA " . $marca . ";";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD</th>
                                        <th>STOCK UNIT</th>

                                        <th>PRECIO NORMAL</th>
                                        <th>PRECIO ESPECIAL</th>
                                        <th>CANTIDAD</th>
                                        <th>AGREGAR</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    $cantidadProd = floor($row[3] / $row[6]);
                    echo'
                                    <tr>
                                        <td>' . $row[1] . '</td>
                                        <td>' . $row[2] . '</td>
                                        <td>' . $cantidadProd . '</td>
                                         <td><div class="radio">
  <label>
    <input type="radio" name="rad' . $row[0] . '" id="rad' . $row[0] . '1" value="' . $row[4] . '" checked>' . $row[4] . '
  </label>
</div></td>
                                         <td><div class="radio">
  <label>
    <input type="radio" name="rad' . $row[0] . '" id="rad' . $row[0] . '2" value="' . $row[5] . '">' . $row[5] . '
  </label>
</div></td>
                                         <td><div class="col-xs-5"><input class="form-control" type="text" name="prod' . $row[0] . '" id="prod' . $row[0] . '" placeholder="0"></div></td>
                                         <td><div class="col-xs-5"><button type="button" class="btn btn-success" name="btn' . $row[0] . '" id="btn' . $row[0] . '" onclick="addLine(\'' . $row[1] . '\',\'' . $row[2] . '\',\'' . $row[5] . '\',\'' . $row[0] . '\',\'' . $row[0] . '\');"><span class="glyphicon glyphicon-plus-sign"></span></button></div></td>
                                         </tr>';
                }
                echo'</tbody></table></div>';
                break;

            case 2:
                session_start();
                $client = $_POST['client'];
                $dni = $_POST['dni'];
                $precTotal = $_POST['precTotal'];
                $copu[] = $_POST['cupu'];
                $sql = "select * from ENTIDAD where NOMBRES='" . $client . "' AND DNIRUC='" . $dni . "';";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    $idUser = $row[0];
                }
                if ($idUser == "") {
                    $sql1 = "insert into ENTIDAD (TidTIPOENTIDAD,NOMBRES,DNIRUC) values ('1','" . $client . "','" . $dni . "')";
                    mysql_query($sql1) or die("Error");
                    $result = mysql_query($sql) or die("Error");
                    while ($row = mysql_fetch_array($result)) {
                        $idUser = $row[0];
                    }
                    $sql1 = "insert into entidad_empresa (idTIPOENTIDADEMPRESA,idENTIDAD) values ('1','" . $idUser . "')";
                    mysql_query($sql1) or die("Error");
                } else {
                    //MODIFICAR SI EL TIPO ENTIDAD EMPRESA ES OTRO
                }
                $sql = "select * from entidad_empresa where idENTIDAD='" . $idUser . "' and idTIPOENTIDADEMPRESA='1';";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    $idEnEmp = $row[0];
                }
                $sql = "insert into CONTIZACION
(idENTIDAD_EMPRESA,idCOMPROBANTE,idTRABAJADOR,MONTOTAL,FECHAHORA,VALIDO,ESTADO)
VALUES ('" . $idEnEmp . "','1','1','" . $precTotal . "',now(),ADDTIME(now(),'05:00:00'),'1')";
                $result = mysql_query($sql) or die("Error");
                $sql = "select idCONTIZACION from contizacion where idENTIDAD_EMPRESA='" . $idEnEmp . "' and MONTOTAL='" . $precTotal . "' and ESTADO='1';";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    $codigoContizacion = $row[0];
                }
                for ($i = 0; $i < count($_SESSION['compra']); $i++) {
                    $sql = "insert into detallecotizacion (idCONTIZACION,idPRODUCTOUNIDAD,CANTIDAD,PRECIO,SUBTOTAL) values('" . $codigoContizacion . "','" . $_SESSION['compra'][$i][0] . "','" . $_SESSION['compra'][$i][1] . "','" . $_SESSION['compra'][$i][2] . "','" . $_SESSION['compra'][$i][3] . "');";
                    $result = mysql_query($sql) or die("Error");
                }
                echo '<div class="alert alert-success">La cotización se grabó correctamente.</div>';
                break;
            case 3:
                session_start();
                $posicionArray = $_POST['posicionArray'];
                $idproducto = $_POST['idproducto'];
                $cantidad = $_POST['cantidad'];
                $precioUnit = $_POST['precioUnit'];
                $precioTotal = $_POST['precioTotal'];
                $compra = $_SESSION['compra'];
                $compra[] = array($idproducto, $cantidad, $precioUnit, $precioTotal);
                $_SESSION['compra'] = $compra;
                break;
            case 4:
                $cotizacion = $_POST['cotizacion'];
                break;
            case 5:
                $cotizacion = $_POST['cotizacion'];
                $sql = "update contizacion set ESTADO='2' where idCONTIZACION='" . $cotizacion . "';";
                $result = mysql_query($sql) or die("Error");
                echo '<div class="alert alert-success">La cotizacion se eliminó correctamente.</div>';
                break;
            case 6:
                $cotizacion = $_POST['cotizacion'];
                $sql = "select e.NOMBRES, e.DNIRUC, c.FECHAHORA, c.VALIDO, c.MONTOTAL  from contizacion c
INNER JOIN entidad_empresa ee ON ee.idENTIDAD_EMPRESA=c.idENTIDAD_EMPRESA
INNER JOIN entidad e ON e.idENTIDAD=ee.idENTIDAD
where idcontizacion='" . $cotizacion . "'";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    echo '<h4>Pedido del sr(a) : ' . $row[0] . '</h4>';
                    echo '<h5><b>DNI/RUC:</b> ' . $row[1] . '</h5>';
                    echo '<h5><b>Fecha de Cotizacion: </b>' . $row[2] . '</h5>';
                    echo '<h5><b>Válido Hasta:</b> ' . $row[3] . '</h5>';
                    echo '<h5><b>Monto Total:</b> ' . $row[4] . '</h5>';
                }
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD</th>
                                        <th>CANTIDAD</th>

                                        <th>PRECIO</th>
                                        <th>SUB TOTAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                $sql = "select p.DESCRIPCION,u.DESCRIPCION,d.cantidad,d.precio,d.subtotal from detallecotizacion d
INNER JOIN productounidad pu ON pu.idPRODUCTOUNIDAD=d.idPRODUCTOUNIDAD
INNER JOIN producto p ON p.idPRODUCTO=pu.idPRODUCTO
INNER JOIN unidad u ON u.idUNIDAD=pu.idUNIDAD
where idcontizacion='" . $cotizacion . "'";
                $result = mysql_query($sql) or die("Error");
                while ($row = mysql_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row[0] . '</td>';
                    echo '<td>' . $row[1] . '</td>';
                    echo '<td>' . $row[2] . '</td>';
                    echo '<td>' . $row[3] . '</td>';
                    echo '<td>' . $row[4] . '</td>';
                    echo '</tr>';
                }
                break;
        }
        break;

    case 7:
        switch ($action) {

            case 0:
                //buscar
                $search = $_POST['search'];
                $sql = " select t.idtrabajador, e.Nombres, e.dniruc, c.descripcion, t.usuario, e.telefono, e.direccion, t.fechaini,t.fechafin
                            from trabajador t
                            inner join cargo c on
                            c.idcargo=t.idcargo
                            inner join entidad_empresa en on
                            en.identidad_empresa=t.identidad_empresa
                            inner join entidad e on
                            e.identidad=en.identidad
                        where e.Nombres like '%" . $search . "%';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>TRABAJADOR</th>
                                        <th>DNI</th>
                                        <th>CARGO</th>
                                        <th>USUARIO</th>
                                        <th>TELEFONO</th>
                                        <th>DIRECCION</th>
                                        <th>FECHA INICIAL</th>
                                        <th>FECHA FINAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idtrab[]" id="idtrab" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                        <td>' . $row[2] . '</td>
                                         <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>
                                         <td>' . $row[7] . '</td>
                                         <td>' . $row[7] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';
                break;

            case 1:
                //nuevo trabajador

                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $cargo = $_POST['cargo'];
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
                $fecini = $_POST['fecini'];
                $fecfin = $_POST['fecfin'];



                $validfecha = "select * from trabajador where '" . $fecini . "'<'" . $fecfin . "';";

                if (mysql_num_rows(mysql_query($validfecha)) > 0) {

                    $sql = "CALL paTrabajador(0,'" . $cargo . "','" . $dni . "','" . $nombre . "','" . $telefono . "','" . $direccion . "','" . $usuario . "','" . $clave . "','" . $fecini . "','" . $fecfin . "',1)";
                    if (mysql_query($sql))
                        echo'<div class="alert alert-info">El Trabajador: ' . $nombre . ' se guardo con éxito</div><br>';
                    else
                        echo '<div class="alert alert-danger">Error:El Trabajador ' . $nombre . ' no se guardo con éxito</div><br>';
                }
                else
                    echo '<div class="alert alert-danger">La Fecha Inicial no puede ser mayor a la Fecha Final, registro no guardado</div><br>';


                break;


            case 2:
                //modificar

                $idtrab = $_POST['idtrabajador'];
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $cargo = $_POST['cargo'];
                $usuario = $_POST['usuario'];
                $clave = $_POST['clave'];
                $fecini = $_POST['fecini'];
                $fecfin = $_POST['fecfin'];


                $validfecha = "select * from trabajador where '" . $fecini . "'<'" . $fecfin . "';";

                if (mysql_num_rows(mysql_query($validfecha)) > 0) {

                    $sql = "CALL paTrabajador('" . $idtrab . "','" . $cargo . "','" . $dni . "','" . $nombre . "','" . $telefono . "','" . $direccion . "','" . $usuario . "','" . $clave . "','" . $fecini . "','" . $fecfin . "',3)";
                    if (mysql_query($sql))
                        echo'<div class="alert alert-info">El Trabajador: ' . $nombre . ' se guardo con éxito</div><br>';
                    else
                        echo '<div class="alert alert-danger">Error:El Trabajador ' . $nombre . ' no se guardo con éxito</div><br>';
                }

                else {
                    echo '<div class="alert alert-danger">La Fecha Inicial no puede ser mayor a la Fecha Final, registro no editado</div><br>';
                }

                echo'<label class="col-lg-2 control-label" align="center">Trabajador:</label><br><br>';

                $sql = " select t.idtrabajador, e.Nombres, e.dniruc, c.descripcion, t.usuario, e.telefono, e.direccion, t.  fechaini,t.fechafin
                                            from trabajador t
                                            inner join cargo c on
                                            c.idcargo=t.idcargo
                                            inner join entidad_empresa en on
                                            en.identidad_empresa=t.identidad_empresa
                                            inner join entidad e on
                                            e.identidad=en.identidad
                                                            where t.idtrabajador='" . $idtrab . "';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                                            <thead>
                                                                <tr>
                                                            <th style="width:4%"> Codigo </th>
                                                            <th>TRABAJADOR</th>
                                                            <th>DNI</th>
                                                            <th>CARGO</th>
                                                            <th>IDUSUARIO</th>
                                                            <th>TELEFONO</th>
                                                            <th>DIRECCION</th>
                                                            <th>FECHA INICIAL</th>
                                                            <th>FECHA FINAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                            <tr>
                                            <td><span class="input-group-addon">' . $row[0] . '

                                               </span></td>
                                                <td>' . $row[1] . '</td>
                                                <td>' . $row[2] . '</td>
                                                <td>' . $row[3] . '</td>
                                                <td>' . $row[4] . '</td>
                                                <td>' . $row[5] . '</td>
                                                <td>' . $row[6] . '</td>
                                                <td>' . $row[7] . '</td>
                                                <td>' . $row[8] . '</td>

                                    </tr>';
                    echo '<div style="display:none;"> <input type="checkbox" name="idtrabajador" id="idtrabajador" value="' . $row[0] . '"> </div>';
                }
                echo'</tbody></table></div>';


                break;

            case 3:
                //eliminar
                $eliminar = $_POST['idtrab'];

                $sql = "call paTrabajador('" . $eliminar . "','0','0','0','0','0','0','0',curdate(),curdate(),2);";
                if (mysql_query($sql)) {
                    
                }

                break;
        }
        break;

    case 8:

        switch ($action) {
            case 0:

                $idtrab = $_POST['trabajador'];

                $sql = " select s.idsueldo,e.nombres,e.dniruc,c.descripcion,s.monto,s.desde,s.hasta
                                    from sueldo s
                                    inner join trabajador t on
                                    t.idtrabajador=s.idtrabajador
                                    inner join cargo c on
                                    c.idcargo=t.idcargo
                                    inner join entidad_empresa en on
                                    en.identidad_empresa=t.identidad_empresa
                                    inner join entidad e on
                                    e.identidad=en.identidad
                                where t.idtrabajador='" . $idtrab . "' order by desde;";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>TRABAJADOR</th>
                                        <th>DNI</th>
                                        <th>CARGO</th>
                                        <th>MONTO</th>
                                        <th>FECHA INICIAL</th>
                                        <th>FECHA FINAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idsueldo[]" id="idsueldo" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                         <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';






                break;

            case 1:
                //nuevo Sueldo


                $idtrab = $_POST['trabajador'];
                $monto = $_POST['monto'];
                $fecini = $_POST['desde'];
                $fecfin = $_POST['hasta'];



                $validfecha = "select * from trabajador where '" . $fecini . "'<'" . $fecfin . "';";

                if (mysql_num_rows(mysql_query($validfecha)) > 0) {

                    $sql = "call paSueldo(1,'" . $idtrab . "','" . $monto . "','" . $fecini . "','" . $fecfin . "',1);";
                    if (mysql_query($sql))
                        echo'<div class="alert alert-info">El Sueldo: se guardo con éxito</div><br>';
                    else
                        echo '<div class="alert alert-danger">Error:El Sueldo no se guardo con éxito</div><br>';
                }
                else
                    echo '<div class="alert alert-danger">La Fecha Inicial no puede ser mayor a la Fecha Final, registro no guardado</div><br>';



                $sql = " select s.idsueldo,e.nombres,e.dniruc,c.descripcion,s.monto,s.desde,s.hasta
                                    from sueldo s
                                    inner join trabajador t on
                                    t.idtrabajador=s.idtrabajador
                                    inner join cargo c on
                                    c.idcargo=t.idcargo
                                    inner join entidad_empresa en on
                                    en.identidad_empresa=t.identidad_empresa
                                    inner join entidad e on
                                    e.identidad=en.identidad
                                where t.idtrabajador='" . $idtrab . "' order by desde;";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>TRABAJADOR</th>
                                        <th>DNI</th>
                                        <th>CARGO</th>
                                        <th>MONTO</th>
                                        <th>FECHA INICIAL</th>
                                        <th>FECHA FINAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idsueldo[]" id="idsueldo" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                         <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';


                break;
            case 2:
                //eliminar

                $eliminar = $_POST['idsueldo'];

                $sql = "call paSueldo('" . $eliminar . "',1,1,'0001-01-01','0001-01-01',2);";
                if (mysql_query($sql)) {
                    
                }

                break;
        }

        break;


    case 9:

        switch ($action) {
            case 0:
                $idprod = $_POST['producto'];

                $sql = " select pu.idproductounidad, p.descripcion, u.descripcion, u.abreviatura, u.cantidadunidad, pu.precioestablecido, pu.precioespecial
                                from producto p
                                inner join productounidad pu on
                                pu.idproducto=p.idproducto
                                inner join unidad u on
                                u.idunidad=pu.idunidad
                                where p.idproducto='" . $idprod . "';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD</th>
                                        <th>ABREVIATURA</th>
                                        <th>CANTIDAD</th>
                                        <th>PRECIO ESTABLECIDO</th>
                                        <th>PRECIO ESPECIAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idprodunid[]" id="idprodunid" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                         <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';





                break;

            case 1:

                //Nuevo/Modificar

                $idprod = $_POST['producto'];
                $unidad = $_POST['unidad'];
                $precioest = $_POST['precioEstablecido'];
                $precioesp = $_POST['precioEspecial'];

                $sql = "call paProductoUnidad(1,'" . $idprod . "','" . $unidad . "','" . $precioest . "','" . $precioesp . "',1);";

                if (mysql_query($sql))
                    echo'<div class="alert alert-info">La Unidad: se guardo/modificó con éxito</div><br>';
                else
                    echo '<div class="alert alert-danger">Error: La unidad no se guardo/modificó con éxito</div><br>';


                $sql = " select pu.idproductounidad, p.descripcion, u.descripcion, u.abreviatura, u.cantidadunidad, pu.precioestablecido, pu.precioespecial
                                from producto p
                                inner join productounidad pu on
                                pu.idproducto=p.idproducto
                                inner join unidad u on
                                u.idunidad=pu.idunidad
                                where p.idproducto='" . $idprod . "';";
                $result = mysql_query($sql) or die("Error");
                echo' <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:4%"> </th>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD</th>
                                        <th>ABREVIATURA</th>
                                        <th>CANTIDAD</th>
                                        <th>PRECIO ESTABLECIDO</th>
                                        <th>PRECIO ESPECIAL</th>
                                      </tr>
                                </thead>
                                <tbody>';
                while ($row = mysql_fetch_array($result)) {
                    echo'
                                    <tr>
                                        <td><span class="input-group-addon">
                                        <input type="checkbox" name="idprodunid[]" id="idprodunid" value="' . $row[0] . '">
                                        </span></td>
                                        <td>' . $row[1] . '</td>
                                         <td>' . $row[2] . '</td>
                                        <td>' . $row[3] . '</td>
                                         <td>' . $row[4] . '</td>
                                         <td>' . $row[5] . '</td>
                                         <td>' . $row[6] . '</td>

                                    </tr>';
                }
                echo'</tbody></table></div>';








                break;

            case 2:
                //eliminar

                $eliminar = $_POST['idprodunid'];

                $sql = "call paProductoUnidad('" . $eliminar . "',1,1,1,1,2);";
                if (mysql_query($sql)) {
                    
                }

                break;
        }

        break;
}
?>
