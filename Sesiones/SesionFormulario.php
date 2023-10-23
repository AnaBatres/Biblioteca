<?php
require_once "../RequiresOnce/_Varios.php";
require_once "../RequiresOnce/_Clases.php";
require_once "../RequiresOnce/_DAO.php";

if (sesionIniciada()) {
    redireccionar("../LibrosIndex.php");
}


?>



<html>

<head>
    <meta charset='UTF-8'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            color: red;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
            display: block;
            text-align: center;
        }


    </style>

</head>
<body>

<?php if (isset($_REQUEST["error"])) { ?>
    <p style="color: red">Error de autenticación, inténtelo de nuevo.</p>
<?php } ?>

<?php if (isset($_REQUEST["sesionCerrada"])) { ?>
    <p style="color: blue">Se ha cerrado correctamente la sesión.</p>
<?php } ?>

<form action="SesionComprobar.php" method="post">
    <label for='usuario'>Usuario</label><br>
    <input type="text" name="usuario"><br><br>
    <label for='contrasenna'>Contraseña</label><br>
    <input type="password" name="contrasenna"><br><br>
    <input type='checkbox' name='recuerdame'>Recuérdame<br><br>

    <input type="submit" name="enviar">
    <a href="Registro.php">Registrarse</a>
</form>

</body>

</html>