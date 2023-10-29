<?php



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../biblioteca.css">
    <title>Registro</title>


</head>
<body>


<div class="contenedor4">
    <h1>Registro</h1>
    <form action="RegistroComprobar.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasenna">Contraseña</label>
        <input type="password" name="contrasenna" id="contrasenna" required pattern=".{4,}" title="La contraseña debe tener al menos 4 caracteres">

        <label for="rcontrasenna">Repite la contraseña</label>
        <input type="password" name="rcontrasenna" id="rcontrasenna" required pattern=".{4,}">

        <button type="submit">Registrarse</button>
        <a type="submit" href="SesionFormulario.php" >Iniciar Sesion</a>

        <br>
        <br>
        <?php if (isset($_REQUEST["error"])) { ?>
            <h3 style="color: red">Completa todos los campos</h3>
        <?php } ?>
        <?php if (isset($_REQUEST["error2"])) { ?>
            <h3 style="color: red">Las contraseñas no coinciden</h3>
        <?php } ?>
        <?php if (isset($_REQUEST["success"])) { ?>
            <h3 style="color: green">Usuario registrado correctamente</h3>
        <?php } ?>
    </form>
</div>
</body>
</html>