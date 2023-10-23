<?php
require_once "_Varios.php";
$conexion=obtenerPdoConexionBD();

$filtroSeleccionado=$_REQUEST["filtro"];


$conexionBD = obtenerPdoConexionBD();
$sql = "SELECT l.titulo,l.genero, l.editorial,l.libroID, a.nombre FROM libros AS l INNER JOIN autores AS a ON l.AutorID=a.AutorID ORDER BY l.?";
$sentencia = $conexionBD->prepare($sql);
$correcto = $sentencia->execute([$filtroSeleccionado]); // Se añade el parámetro a la consulta preparada.

//redirigimos al index con un mensaje de eliminado
//header("Location: CompositoresIndex.php?id=$id&mensaje=eliminado");
if ($correcto) redireccionar("LibrosIndex.php?id=$filtroSeleccionado&mensaje=eliminado");
?>

?>
