<?php

require_once "RequiresOnce/General.php";


$id = (int)$_REQUEST["id"];
$titulo = $_POST["titulo"];
$ISBN = $_POST["ISBN"];
$editorial = $_POST["editorial"];
$genero = $_POST["genero"];
$paginas = $_POST["paginas"];
$idioma=$_POST["idioma"];
$autor = DAO::autorObtenerPorId($libro=DAO::libroObtenerPorId($id)->getAutorID());
$autorID=$autor->getId();

$correcto = true;
$libroNuevo = new Libro($id, $titulo, $ISBN, $editorial, $genero, $paginas, $idioma, $autorID);
$usuarioNuevo = DAO::libroActualizar($libroNuevo);
redireccionar("LibrosShow.php?id=" . $id);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>


