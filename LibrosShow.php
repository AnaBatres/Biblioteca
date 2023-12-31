<?php
require_once "RequiresOnce/General.php";

$id=$_REQUEST["id"];

$libros = DAO::libroObtenerPorId($id);
$resenas = DAO::obtenerResenas($id);

if(sesionIniciada()) {
    $usuario = DAO::usuarioObtenerPorId($usuarioID = $_SESSION['id']);
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
    <title>LibrosShow</title>
</head>
<body>
<div class="contenedor2">
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
        <?php if(sesionIniciada()) { ?>
        <li><a href="FavoritosIndex.php">Mis favoritos</a></li>
        <?php } ?>
    </ul>
</div>

<?php if (isset($_REQUEST["resenaEliminada"])) { ?>
    <p style="color: red">Su reseña se eliminó correctamente</p>
<?php } elseif (isset($_REQUEST["error"])) {  ?>
    <p style="color: red">Inicia sesion para poder valorar el libro</p>
<?php } ?>

    <p>Titulo: <?=$libros->getTitulo()?></p>
    <p>ISBN: <?=$libros->getISBN()?></p>
    <p>Editorial: <?=$libros->getEditorial()?></p>
    <p>Genero: <?=$libros->getGenero()?></p>
    <p>Numero de paginas: <?=$libros->getPaginas()?></p>
    <p>Autor: <?= $libros->obtenerAutor()->getNombre()?></p>


    <form method="POST" action="Resena.php">
        <input type="hidden" name="libroID" value="<?=$libros->getId()?>">
        <label for="calificacion">Calificación (1-5):</label>
        <input type="number" name="calificacion" max="5" required>
        <br>
        <label for="comentario">Comentario:</label>
        <input type="text" name="comentario" required>
        <br>
        <input type="submit" value="Enviar Reseña">
    </form>

    <h2>Reseñas:</h2>

    <?php foreach ($resenas as $resena)  {?>
        <p>Usuario: <?= DAO::usuarioObtenerPorId($resena->getUsuarioId())->getNombre()?></p>
        <p>Calificación: <img src="Imagenes/estrella<?= $resena->getCalificacion()?>.png"></p>
        <p>Comentario:</p> <?= $resena->getComentario()?>
        <?php if(sesionIniciada()) { ?>
            <?php if (DAO::usuarioObtenerPorId($resena->getUsuarioId())->getNombre() === $usuario->getNombre() || DAO::usuarioObtenerRol($usuarioID) === "admin") { ?>
                <a href="EliminarResena.php?id=<?=$resena->getId()?>"><img style="width: 15px; height: 15px;" src="Imagenes/eliminar.png"></a>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</div>
</body>
</html>

