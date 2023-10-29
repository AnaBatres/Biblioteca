<?php
require_once "../RequiresOnce/General.php";

if (sesionIniciada()) {
    redireccionar("../LibrosIndex.php");
    exit;
}

$identificador = $_REQUEST["usuario"];
$contrasenna = $_REQUEST["contrasenna"];

$usuario = DAO::usuarioObtener($identificador, $contrasenna);

if ($usuario != null) {
    $_SESSION["id"] = $usuario->getId();
    $_SESSION["usuario"] = $usuario->getUsuario();
    $_SESSION["contrasenna"] = $usuario->getContrasenna();
    redireccionar("../LibrosIndex.php");
} else {
    redireccionar("SesionFormulario.php?error");
}
?>