<?php
require_once "../RequiresOnce/_Varios.php";
require_once "../RequiresOnce/_Clases.php";
require_once "../RequiresOnce/_DAO.php";


session_destroy();
unset($_SESSION);

redireccionar("SesionFormulario.php");