<?php
require_once "../RequiresOnce/General.php";

if (sesionIniciada()) {
    redireccionar("../LibrosIndex.php");
}


?>



<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="../biblioteca.css">

</head>

<div class="contenedor6"><body>
<?php if (isset($_REQUEST["error"])) { ?>
    <p style="color: red">Error de autenticación, inténtelo de nuevo.</p>
<?php } ?>

<?php if (isset($_REQUEST["sesionCerrada"])) { ?>
    <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
<?php } ?>

<form action="SesionComprobar.php" method="post">

    <?php if(isset($_COOKIE["usuario"]) && isset($_COOKIE["contrasenna"])) { ?>
    <label for='usuario'>Usuario</label><br>
    <input type="text" name="usuario" value="<?php echo $_COOKIE["usuario"]?>"><br><br>
    <label for='contrasenna'>Contraseña</label><br>
    <input type="password" name="contrasenna" value="<?php echo $_COOKIE["contrasenna"]?>"><br><br>
    <?php } else {?>
    <label for='usuario'>Usuario</label><br>
    <input type="text" name="usuario"><br><br>
    <label for='contrasenna'>Contraseña</label><br>
    <input type="password" name="contrasenna"><br><br>
    <input type='checkbox' name='recuerdame'>Recuérdame<br><br>
    <?php } ?>

    <input type="submit" name="enviar">
    <a href="Registro.php">Registrarse</a>
</form>
</body>
</div>

</html>