<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libroID = $_POST['libroID'];
    $usuarioID = $_SESSION['id'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    DAO::resenaCrear($libroID, $usuarioID, $calificacion, $comentario);

    redireccionar("LibrosShow.php?id=" . $libroID);
    exit;
}
?>