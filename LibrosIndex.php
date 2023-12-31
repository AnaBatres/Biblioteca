<?php
require_once "RequiresOnce/General.php";

$libros = DAO::libroObtenerTodos();

if (sesionIniciada()) {
    $rol = DAO::usuarioObtenerRol($_SESSION["id"]);
}
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
<body class="indice">
<header>
    <h2>BIBLIOTECA VIRTUAL</h2>
    <?php
    if (sesionIniciada()) { ?>
        <a href="Perfil.php">Mi Perfil</a>
    <?php } else { ?>
        <a href="Sesiones/SesionFormulario.php">Inicio Sesion</a>
    <?php } ?>
</header>
<div class="menu">
    <ul>
        <li><a href="LibrosIndex.php">Inicio</a></li>
        <?php if (sesionIniciada() && $rol != "admin") { ?>
            <li><a href="FavoritosIndex.php">Mis favoritos</a></li>
        <?php } ?>
    </ul>
</div>

<?php foreach ($libros as $libro) {
    if (sesionIniciada()) {
        $esFavorito = false;
        if (DAO::esFavorito($_SESSION['id'], $libro->getId())) {
            $esFavorito = true;
        }
    } ?>
    <div class="contenedor">
        <div class="titulo-autor">
            <a id="titulo" href="LibrosShow.php?id=<?= $libro->getId() ?>"><img src="Imagenes/imagen<?= $libro->getId() ?>.jpg"></a>
            <div><a href="LibrosShow.php?id=<?= $libro->getId() ?>"><?= $libro->getTitulo() ?></a></div>
            <div><a href="AutoresShow.php?id=<?= $libro->getAutorID() ?>"><?= DAO::autorObtenerPorId($libro->getAutorID())->getNombre() ?></a></div>
        </div>
        <div class="iconos">
            <?php if (sesionIniciada() && $rol !== "admin") { ?>
                <?php if ($esFavorito) { ?>
                    <a href="Favoritos.php?id=<?= $libro->getId() ?>&accion=eliminar"><img src="Imagenes/corazonLleno.jpg"></a>
                <?php } else { ?>
                    <a href="Favoritos.php?id=<?= $libro->getId() ?>&accion=insertar"><img src="Imagenes/corazonVacio.jpg"></a>
                <?php } ?>
            <?php } elseif (sesionIniciada() && $rol === "admin") { ?>
                <a href="EliminarLibro.php?id=<?= $libro->getId() ?>&accion=eliminar"><img src="Imagenes/basura.jpg"></a>
                <a href="EditarLibro.php?id=<?= $libro->getId() ?>&accion=editar"><img src="Imagenes/editar.png"></a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
</body>
</html>