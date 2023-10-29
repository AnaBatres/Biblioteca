<?php
require_once "../RequiresOnce/General.php";

if (sesionIniciada()) {
    redireccionar("../LibrosIndex.php");
    exit;
}

$identificador = $_POST["usuario"];
$contrasenna = $_POST["contrasenna"];

$usuario = DAO::usuarioObtener($identificador, $contrasenna);


if ($usuario != null) {
    $_SESSION["id"] = $usuario->getId();
    $_SESSION["usuario"] = $usuario->getUsuario();
    $_SESSION["contrasenna"] = $usuario->getContrasenna();

    if(isset($_REQUEST["recuerdame"])){
        $user=htmlentities($_POST["usuario"]);
        setcookie("usuario", $user, time()+3600);
        $conn=htmlentities($_POST["contrasenna"]);
        setcookie("contrasenna", $conn, time()+3600);

        redireccionar("../LibrosIndex.php");

    } else {
        redireccionar("../LibrosIndex.php");
    }
} else {
    redireccionar("SesionFormulario.php?error");
}

?>