<?php

require_once "RequiresOnce/General.php";

$id = $_GET["id"];
$correcto = DAO::libroEliminarPorId($id);

if ($correcto) redireccionar("LibrosIndex.php");


?>
