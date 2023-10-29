<?php
require_once "../RequiresOnce/General.php";

if(sesionIniciada()) {
    destuirSesion();
}

if(isset($_COOKIE["usuarioID"])){
    unset($_COOKIE["usuarioID"]);
    setcookie("usuarioID", "", time() - 3600);
}




redireccionar("SesionFormulario.php");