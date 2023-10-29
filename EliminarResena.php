<?php
require_once "RequiresOnce/General.php";

$idResena = $_GET["id"];
$libroID = DAO::obtenerLibroPorResena($idResena);
$correcto = DAO::resenaEliminar(DAO::resenaObtenerPorId($idResena));

if ($correcto) redireccionar("LibrosShow.php?id=" . $libroID . "&&resenaEliminada");

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
