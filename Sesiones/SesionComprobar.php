<?php
require_once "../RequiresOnce/General.php";


if (sesionIniciada()) {
    redireccionar("../LibrosIndex.php");
    exit;

}if (isset($_COOKIE['usuarioID'])) {
    $usuarioID = $_COOKIE['usuarioID'];

    $usuario = DAO::usuarioObtenerPorId($usuarioID);

    if ($usuario) {
        $_SESSION["id"] = $usuarioID;
        redireccionar("../LibrosIndex.php");
        exit;
    }
}

if (isset($_POST['usuario'])) {
    $identificador = $_POST["usuario"];
    $contrasenna = $_POST["contrasenna"];

    $usuario = DAO::usuarioObtener($identificador, $contrasenna);

    if ($usuario != null) {
            $_SESSION["id"] = $usuario->getId();
            $_SESSION["usuario"] = $usuario->getUsuario();
            $_SESSION["contrasenna"] = $usuario->getContrasenna();

        if (isset($_POST["recuerdame"])) {
            $usuarioID = $usuario->getId();
            setcookie("usuarioID", $usuarioID, time() + 3600 * 24 * 7);
        } else {
            redireccionar("../LibrosIndex.php");
        }
        redireccionar("../LibrosIndex.php");
    } else {
        redireccionar("SesionFormulario.php?error");
    }
} else {
    redireccionar("SesionFormulario.php");
}

?>