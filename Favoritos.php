<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$id = $_REQUEST["id"];
$valorCorazon = $_REQUEST["corazon"];
$correcto = DAO::libroActualizarCorazon($id, $valorCorazon);

if ($correcto) redireccionar("LibrosIndex.php?id=$id&corazonCambiado");

?>

