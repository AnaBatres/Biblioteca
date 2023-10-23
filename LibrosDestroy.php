<?php
require_once "_Varios.php";

$id = (int)$_REQUEST["id"];

$conexionBD = obtenerPdoConexionBD();
$sql = "DELETE FROM libros WHERE id=?";
$sentencia = $conexionBD->prepare($sql);
$correcto = $sentencia->execute([$id]);

if ($correcto) redireccionar("LibrosIndex.php?id=$id&mensaje=eliminado");
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
</head>
<body>
<p>Error al eliminar.</p>
</body>
</html>