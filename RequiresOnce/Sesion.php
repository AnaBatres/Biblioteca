<?php


declare(strict_types=1);


function destuirSesion()
{
    session_destroy();
    unset($_SESSION);
}
function entrarSiSesionIniciada()
{
    if (comprobarRenovarSesion()) redireccionar("LibrosIndex.php");
}

function salirSiSesionFalla()
{
    if (!comprobarRenovarSesion()) redireccionar("SesionFormulario.php");
}

function comprobarRenovarSesion(): bool
{
    if (haySesionRAM()) {
        if (isset($_COOKIE["id"])) {
            generarRenovarSesionCookie();
        }
        return true;
    } else {
        $usuario = obtenerUsuarioPorCookie();
        if ($usuario) {
            generarSesionRAM($usuario);
            generarRenovarSesionCookie();
            return true;
        } else {
            return false;
        }
    }
}

function haySesionRAM(): bool
{
    return isset($_SESSION["id"]);
}

function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
{
    $conexion = obtenerPdoConexionBD();
    $sql = "SELECT id, identificador, nombre FROM usuario
            WHERE identificador=? AND BINARY contrasenna=?";
    $select = $conexion->prepare($sql);
    $select->execute([$identificador, $contrasenna]);
    $filasObtenidas = $select->rowCount();

    if ($filasObtenidas == 0) return null;
    else return $select->fetch();
}

function obtenerUsuarioPorCookie(): ?array
{
    if (isset($_COOKIE["id"])) {
        $conexion = obtenerPdoConexionBD();

        $sql = "SELECT id, identificador, nombre FROM usuario
                WHERE id = ? AND BINARY codigoCookie = ? AND caducidadCodigoCookie >= ?";
        $select = $conexion->prepare($sql);
        $select->execute([
            $_COOKIE["id"],
            $_COOKIE["codigoCookie"],
            date("Y-m-d H:i:s", time())
        ]);
        $filasObtenidas = $select->rowCount();

        if ($filasObtenidas == 0) return null;
        else return $select->fetch();
    } else {
        return null;
    }
}

function generarSesionRAM(array $usuario)
{
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["identificador"] = $usuario["identificador"];
    $_SESSION["nombre"] = $usuario["nombre"];
}

function generarRenovarSesionCookie()
{
    $codigoCookie = uniqid();

    $fechaCaducidad = time() + 24 * 60 * 60;
    $fechaCaducidadParaBD = date("Y-m-d H:i:s", $fechaCaducidad);


    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=?, caducidadCodigoCookie=? WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$codigoCookie, $fechaCaducidadParaBD, $_SESSION["id"]]);
    
    setcookie('id', strval($_SESSION["id"]), $fechaCaducidad);
    setcookie('codigoCookie', $codigoCookie, $fechaCaducidad);
}

function cerrarSesion()
{

    $conexion = obtenerPdoConexionBD();
    $sql = "UPDATE usuario SET codigoCookie=NULL, caducidadCodigoCookie=NULL WHERE id=?";
    $select = $conexion->prepare($sql);
    $select->execute([$_SESSION["id"]]);

    setcookie('id', "", time() - 3600);
    setcookie('codigoCookie', "", time() - 3600);

    session_destroy();
}

?>