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

<div class="contenedor3">
    <p>Nombre de Usuario: <?=$usuario->getUsuario()?></p>
    <p>Nombre: <?=$usuario->getNombre()?></p>
</div>

</body>
</html>