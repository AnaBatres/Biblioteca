<?php

require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$id=$_SESSION["id"];
$usuario=DAO::usuarioObtenerPorId($id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrosIndex</title>
    <link rel="stylesheet" href="biblioteca.css">
</head>
<body>
<header>
    <h2>BIBLIOTECA VIRTUAL</h2>
    <?php
    if(sesionIniciada()){ ?>
            <div class="botones">
                <a href="EditarPerfil.php">Editar Perfil</a>
                <a href="Sesiones/SesionCerrar.php">Cerrar Sesion</a>
            </div>
    <?php } ?>
</header>

<div class="menu">
    <ul>
        <li><a href="LibrosIndex.php">Inicio</a></li>
        <li><a href="FavoritosIndex.php">Mis favoritos</a></li>
        <li><a href="#">Productos</a></li>
        <li><a href="#">Acerca de</a></li>
        <li><a href="#">Contacto</a></li>
    </ul>
</div>

<?php if (isset($_REQUEST["error"])) { ?>
    <h1 style="color: red">Fallo al actualizar los datos, intentelo de nuevo</h1>
<?php } ?>

<form method='post' action='PerfilUpdate.php'>
<div class="contenedor3">
    <input type='hidden' name='id' value='<?=$usuario->getId()?>' />

    <label for='usuario'>Nombre de usuario</label>
    <input type='text' id='usuario' name='usuario' value='<?=$usuario->getUsuario()?>' />
    <br>
    <br>
    <label for='nombre'>Nombre</label>
    <input type='text' id='nombre' name='nombre' value='<?=$usuario->getNombre()?>' />
    <br>
    <br>
    <label for='contrasenaActual'>Contraseña actual</label>
    <input type='password' id='contrasenaActual' name='contrasenaActual' required />
    <br>
    <br>
    <label for='contrasenaNueva'>Contraseña nueva</label>
    <input type='password' id='contrasenaNueva' name='contrasenaNueva' required />
    <br>
    <br>
    <label for='rContrasenaNueva'>Confirmar contraseña</label>
    <input type='password' id='rContrasenaNueva' name='rContrasenaNueva' required />
    <br>
    <br>
    <input type='submit' name='actualizar' value='Actualizar cambios' />
    <br>
    <br>
    <?php if (isset($_REQUEST["error1"])) { ?>
        <h3 style="color: red">Fallo al actualizar los datos, intentelo de nuevo.</h3>
    <?php } ?>
    <?php if (isset($_REQUEST["error2"])) { ?>
        <h3 style="color: red">La contraseña actual no es correcta.</h3>
    <?php } ?>
    <?php if (isset($_REQUEST["error3"])) { ?>
        <h3 style="color: red">Las contraseñas no coinciden.</h3>
    <?php } ?>

</div>
</form>
</body>
</html>

