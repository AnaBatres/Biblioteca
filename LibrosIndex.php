<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$libros = DAO::libroObtenerTodos();

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
           <a href="Perfil.php">Mi Perfil</a>
<!--        <a href="Sesiones/SesionCerrar.php">Cerrar Sesion</a>-->
    <?php } else { ?>
        <a href="Sesiones/SesionFormulario.php">Inicio Sesion</a>
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

    <?php foreach ($libros as $libro) { ?>
        <div class="contenedor">
            <div class="titulo-autor">
                <a id="titulo" href="LibrosShow.php?id=<?= $libro->getId() ?>"><img src="Imagenes/imagen<?= $libro->getId()?>.jpg" style="width: 180px; height: 230px;"></a>
                <div><a href="LibrosShow.php?id=<?= $libro->getId() ?>"><?= $libro->getTitulo() ?></a></div>
                <div><a href="AutoresShow.php?id=<?=$libro->getAutorID()?>"><?= DAO::autorObtenerPorId($libro->getAutorID())->getNombre() ?></a></div>
            </div>
            <div class="iconos">
                <?php if ($libro->getCorazon() == 1) { ?>
                    <a href="Favoritos.php?id=<?= $libro->getId() ?>&corazon=0"><img src="Imagenes/corazonLleno.jpg" style="width: 20px; height: 20px;"></a>
                <?php } else { ?>
                    <a href="Favoritos.php?id=<?= $libro->getId() ?>&corazon=1"><img src="Imagenes/corazonVacio.jpg" style="width: 20px; height: 20px;"></a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</body>
</html>
