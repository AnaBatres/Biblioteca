<?php
require_once "RequiresOnce/General.php";

if(sesionIniciada()){
    $libros = DAO::listaFavoritosObtener($_SESSION['id']);
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="biblioteca.css">
    <title>Document</title>
</head>
<body>
<?php if(sesionIniciada()){ ?>
<header>
    <h2>BIBLIOTECA VIRTUAL</h2>
        <a href="Perfil.php">Mi Perfil</a>
</header>
<div class="menu">
    <ul>
        <li><a href="LibrosIndex.php">Inicio</a></li>
        <li><a href="FavoritosIndex.php">Mis favoritos</a></li>
    </ul>
</div>

    <?php foreach ($libros as $libro) { ?>
    <div class="contenedor">
        <div class="titulo-autor">
            <a id="titulo" href="LibrosShow.php?id=<?= $libro->getId() ?>"><img src="Imagenes/imagen<?= $libro->getId()?>.jpg" style="width: 180px; height: 230px;"></a>
            <div><a href="LibrosShow.php?id=<?= $libro->getId() ?>"><?= $libro->getTitulo   () ?></a></div>
            <div><a href="AutoresShow.php?id=<?=$libro->getAutorID()?>"><?= DAO::autorObtenerPorId($libro->getAutorID())->getNombre() ?></a></div>
        </div>
    </div>
<?php } ?>
<?php } else { ?>
    <h3 style="color: red">Inicia sesión para acceder a tus favoritos</h3>
    <a href="LibrosIndex.php">Volver a la página principal</a>
<?php } ?>
</body>
</html>