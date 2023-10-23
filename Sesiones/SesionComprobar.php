<?php
require_once "../RequiresOnce/_Varios.php";
require_once "../RequiresOnce/_Clases.php";
require_once "../RequiresOnce/_DAO.php";

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