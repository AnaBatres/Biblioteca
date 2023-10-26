<?php
require_once "RequiresOnce/_DAO.php";
require_once "RequiresOnce/_Varios.php";
require_once "RequiresOnce/_Clases.php";

$id=$_REQUEST["id"];

$libros = DAO::libroObtenerPorId($id);
$resenas = DAO::obtenerResenas($id);

if(!sesionIniciada()){

}else{
    $usuario = DAO::usuarioObtenerPorId($usuarioID = $_SESSION['id']);
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LibrosShow</title>
    <style>
        body, h1, h2, p, form {
            margin: 0;
            padding: 0;
        }

        /* Estilo para el cuerpo de la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Estilo para el encabezado */
        h1 {
            font-size: 24px;
            color: #333;
        }

        /* Estilo para los párrafos */
        p {
            font-size: 16px;
            color: #333;
        }

        /* Estilo para el formulario */
        form {
            margin-top: 20px;
        }

        /* Estilo para etiquetas de formulario */
        label {
            font-weight: bold;
        }

        /* Estilo para campos de entrada de formulario */
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Estilo para el botón de envío del formulario */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php if (isset($_REQUEST["resenaEliminada"])) { ?>
    <p style="color: red">Su reseña se eliminó correctamente</p>
<?php } elseif (isset($_REQUEST["error"])) {  ?>
    <p style="color: red">Inicia sesion para poder valorar el libro</p>
<?php } ?>

    <p>Titulo: <?=$libros->getTitulo()?></p>
    <p>ISBN: <?=$libros->getISBN()?></p>
    <p>Editorial: <?=$libros->getEditorial()?></p>
    <p>Genero: <?=$libros->getGenero()?></p>
    <p>Numero de paginas: <?=$libros->getPaginas()?></p>
    <p>Autor: <?= $libros->obtenerAutor()->getNombre()?></p>


    <form method="POST" action="Resena.php">
        <input type="hidden" name="libroID" value="<?=$libros->getId()?>">
        <label for="calificacion">Calificación (1-5):</label>
        <input type="number" name="calificacion" min="1" max="5" required>
        <br>
        <label for="comentario">Comentario:</label>
        <textarea name="comentario" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" value="Enviar Reseña">
    </form>

    <h2>Reseñas:</h2>
    <?php foreach ($resenas as $resena)  {?>
        <p>Usuario: <?= DAO::usuarioObtenerPorId($resena->getUsuarioId())->getNombre()?></p>
        <p>Calificación:      <img style="width: 50px; height: 10px;" src="Imagenes/estrella<?= $resena->getCalificacion()?>.png"></p>
        <p>Comentario:</p> <?= $resena->getComentario()?>
        <?php if (DAO::usuarioObtenerPorId($resena->getUsuarioId())->getNombre() === $usuario->getNombre()) { ?>
            <a href="EditarResena.php?id=<?=$resena->getId()?>"><img style="width: 15px; height: 15px;" src="Imagenes/editar.png"></a>
            <a href="EliminarResena.php?id=<?=$resena->getId()?>"><img style="width: 15px; height: 15px;" src="Imagenes/eliminar.png"></a>
        <?php } ?>
    <?php } ?>
</body>
</html>

