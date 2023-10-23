<?php
require_once "_Varios.php";
require_once "_DAO.php";
require_once "_Clases.php";


// Se recogen los datos del formulario de la request, Y NO VIENE id (no tiene que venir).
$titulo = $_REQUEST["titulo"];
$ISBN = $_REQUEST["ISBN"];
$editorial = $_REQUEST["editorial"];
$genero = $_REQUEST["genero"];
$paginas = $_REQUEST["paginas"];
$idioma = $_REQUEST["idioma"];
$corazon=$_REQUEST["corazon"];
$valoracion=$_REQUEST["valoracion"];

$libro=DAO::libroCrear($titulo, $ISBN, $editorial, $genero, $paginas, $idioma, $corazon, $valoracion);

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Inserción completada</h1>
<p>Se ha insertado correctamente la nueva entrada de <?=$libro->getTitulo()?>.</p>

<a href='PersonasIndex.php'>Volver al listado de personas.</a>

</body>

</html>