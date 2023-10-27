<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$id = $_REQUEST["id"];
$accion = $_REQUEST["accion"];

if (sesionIniciada()) {
    $usuarioID = $_SESSION['id'];

    if ($accion === "agregar") {
        $correcto = DAO::favoritoCrear($id, $usuarioID);
    } elseif ($accion === "eliminar") {
        $correcto = DAO::favoritoBorrar($id, $usuarioID);
    }
}

redireccionar("LibrosIndex.php");
exit();

?>

