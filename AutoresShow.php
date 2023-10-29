<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$id=$_REQUEST["id"];

$autor=DAO::autorObtenerPorId($id);
$libros=DAO::libroObtenerPorAutor($id);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="biblioteca.css">
</head>
<body>
<header>
    <h2>BIBLIOTECA VIRTUAL</h2>
    <?php
    if(sesionIniciada()){ ?>
        <a href="Perfil.php">Mi Perfil</a>
    <?php } else { ?>
        <a href="Sesiones/SesionFormulario.php">Inicio Sesion</a>
    <?php } ?>
</header>
<div class="menu">
    <ul>
        <li><a href="LibrosIndex.php">Inicio</a></li>
        <li><a href="FavoritosIndex.php">Mis favoritos</a></li>
    </ul>
</div>
    <div class="contenedor5">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Libros</th>
        </tr>
        <tr>
            <td><?=$autor->getNombre()?></td>
            <td><?=$autor->getNacionalidad()?></td>
            <td>
            <?php foreach ($libros as $libro) { ?>
                <?=$libro->getTitulo()?> <br>
            <?php } ?>
            </td>
        </tr>
    </table>
    </div>
</body>
</html>
