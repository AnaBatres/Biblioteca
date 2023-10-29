<?php
require_once "RequiresOnce/General.php";

$id = $_REQUEST["id"];
$accion = $_REQUEST["accion"];

if (sesionIniciada()) {
    $usuarioID = $_SESSION['id'];

    if ($accion === "insertar") {
        $correcto = DAO::favoritoCrear($id, $usuarioID);
    } elseif ($accion === "eliminar") {
        $correcto = DAO::favoritoBorrar($id, $usuarioID);
    }
}

redireccionar("LibrosIndex.php");
exit();

?>