<?php



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php if (isset($_REQUEST["error"])) { ?>
    <h1 style="color: red">Fallo en el registro, intentelo de nuevo</h1>
<?php } ?>
<?php if (isset($_REQUEST["success"])) { ?>
    <h1 style="color: green">Usuario registrado correctamente</h1>
<?php } ?>

<div class="container">
    <h1>Registro</h1>
    <form action="RegistroComprobar.php" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contrasenna">Contraseña</label>
        <input type="password" name="contrasenna" id="contrasenna" required>

        <label for="rcontrasenna">Repite la contraseña</label>
        <input type="password" name="rcontrasenna" id="rcontrasenna" required>

        <button type="submit">Registrarse</button>
        <a type="submit" href="SesionFormulario.php" >Iniciar Sesion</a>
    </form>
</div>
</body>
</html>