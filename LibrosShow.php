<?php
require_once "_Varios.php";
require_once "_Clases.php";
require_once "_DAO.php";
$id=$_REQUEST["id"];


$libros = DAO::libroObtenerPorId($id);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrosShow</title>
</head>
<body>
    <p>Titulo: <?=$libros->getTitulo()?></p>
    <p>ISBN: <?=$libros->getISBN()?></p>
    <p>Editorial: <?=$libros->getEditorial()?></p>
    <p>Genero: <?=$libros->getGenero()?></p>
    <p>Numero de paginas: <?=$libros->getPaginas()?></p>
    <p>Autor: <?= $libros->obtenerAutor()->getNombre()?></p>
</body>
</html>

