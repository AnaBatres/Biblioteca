<?php
require_once "RequiresOnce/General.php";


$id = (int)$_REQUEST["id"];
$usuarioActual = DAO::usuarioObtenerPorId($id);
$usuario = $_POST["usuario"];
$nombre = $_POST["nombre"];
$contrasenaActual = $_POST["contrasenaActual"];
$contrasenaNueva = $_POST["contrasenaNueva"];
$rContrasenaNueva = $_POST["rContrasenaNueva"];
$rol = $usuarioActual->getRol();


$correcto = true;

if ($contrasenaNueva === $rContrasenaNueva) {
    $usuarioActual = DAO::usuarioObtenerPorId($id);
    if ($usuarioActual && $usuarioActual->getContrasenna() === $contrasenaActual) {
        $usuarioNuevo = new Usuario($id, $nombre, $usuario, $contrasenaNueva,$rol);
        $usuarioNuevo = DAO::usuarioActualizar($usuarioNuevo);
        if ($usuarioNuevo) {
            redireccionar("Perfil.php");
        } else{
            redireccionar("EditarPerfil.php?error1=Error al actualizar el perfil");
            exit();
        }
    } else {
        redireccionar("EditarPerfil.php?error2=Contraseña actual erronea");
        exit();
    }
} else {
    redireccionar("EditarPerfil.php?error3=Las contraseñas no coinciden");
    exit(); }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
