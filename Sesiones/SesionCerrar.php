<?php
require_once "../RequiresOnce/General.php";

if(sesionIniciada()){
    destuirSesion();
}
redireccionar("SesionFormulario.php");