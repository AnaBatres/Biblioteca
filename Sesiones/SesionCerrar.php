<?php
require_once "../RequiresOnce/General.php";


session_destroy();
unset($_SESSION);

redireccionar("SesionFormulario.php");