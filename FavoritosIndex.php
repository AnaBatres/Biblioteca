<?php
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";
require_once "RequiresOnce/_DAO.php";

$libros = DAO::listaFavoritosObtener($_SESSION['id']);

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
            <div><a href="LibrosShow.php?id=<?= $libro->getId() ?>"><?= $libro->getTitulo   () ?></a></div>
            <div><a href="AutoresShow.php?id=<?=$libro->getAutorID()?>"><?= DAO::autorObtenerPorId($libro->getAutorID())->getNombre() ?></a></div>
        </div>
    </div>
<?php } ?>

</body>
</html>