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

require_once "RequiresComunes.php";

//if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
//    $usuario = $_POST['usuario'];
//    $contrasena = $_POST['contrasena'];
//
//    $usuarioAutenticado = DAO::comprobarUsuarios($usuario, $contrasena);
//
//    if ($usuarioAutenticado != null) {
//        $id = $usuarioAutenticado->getId();
//        $nombre = $usuarioAutenticado->getNombreUsuario();
//        $pass = $usuarioAutenticado->getContrasena();
//
//        $_SESSION['idUsuario'] = $id;
//        $_SESSION['nombreUsuario'] = $nombre;
//        $_SESSION['contrasena'] = $pass;
//
//        if (isset($_POST["recuerdame"])) {
//            $codigoCookie = uniqid();
//            $usuarioID = $id;
//            setcookie("cookie", $codigoCookie, time() + 3600 * 24 * 7);
//
//            $almacenar = DAO::almacenarCookie($usuarioID, $codigoCookie);
//        }
//        redireccionar("GenerosIndex.php?sesionIniciada");
//    } else {
//        redireccionar("FormularioInicio.php?error");
//    }
//} else {
//    redireccionar("FormularioInicio.php?error");
//}

?>