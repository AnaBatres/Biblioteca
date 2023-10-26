<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$libroID = $_POST['libroID'];

if(!sesionIniciada()){
    redireccionar("LibrosShow.php?id=" . $libroID . "&&error");
} else {
    $usuarioID = $_SESSION['id'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    DAO::resenaCrear($libroID, $usuarioID, $calificacion, $comentario);

    redireccionar("LibrosShow.php?id=" . $libroID);
    exit;
}
?>