<!DOCTYPE html>
<html lang="es">
<head>
    <title>GYD CONS</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
</head>
<body style="background: url('images/bg/bg.png') center center fixed;">
    <div class="page-form">
        <div class="panel panel-blue">
            <div class="panel-body pan">
                <form action="loggin.php" class="form-horizontal" method="POST">
                <div class="form-body pal">
                    <div class="col-md-12 text-center">
                        <h1 style="margin-top: -125px; font-size: 48px;">Ingreso al Sistema de Existencia de Productos
                            </h1>
                        <br /> <br />
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <img src="images/avatar/profile-pic.png" class="img-responsive" style="margin-top: -35px;" />
                        </div>
                        <div class="col-md-9 text-center">
                            <h1>
                                Formulario de Acceso</h1>
                            <br />
                            <p>
                                Iniciar Sessión</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-md-3 control-label">
                            Ususario:</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-user"></i>
                                <input id="username" name="username" type="text" placeholder="usuario" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-3 control-label">
                            Password:</label>
                        <div class="col-md-9">
                            <div class="input-icon right">
                                <i class="fa fa-lock"></i>
                                <input id="password" name="password" type="password" placeholder="contraseña" class="form-control" /></div>
                        </div>
                    </div>
                    <div class="form-group mbn">
                        <div class="col-lg-12" align="right">
                            <div class="form-group mbn">
                                <div class="col-lg-3">
                                    &nbsp;
                                </div>
                                <div class="col-lg-9">
                                    <button type="reset" class="btn btn-default">Cancelar</button>&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-default">
                                        Acceder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <p>
                ¿Olvidó Su Contraseña?
            </p>
        </div>
    </div>
</body>
</html>
