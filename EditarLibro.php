<?php
require_once "RequiresOnce/General.php";

$id=$_SESSION["id"];
$libro=DAO::libroObtenerPorId($id);

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
<form method='post' action='LibroUpdate.php'>

<input type='hidden' name='id' value='<?=$libro->getId()?>'/>

    <label for='titulo'>Titulo</label>
    <input type='text' id='titulo' name='titulo' value='<?=$libro->getTitulo()?>'/>
    <br>
    <br>
    <label for='ISBN'>ISBN</label>
    <input type='text' id='ISBN' name='ISBN' value='<?=$libro->getISBN()?>'/>
    <br>
    <br>
    <label for='editorial'>Editorial</label>
    <input type='text' id='editorial' name='editorial' value='<?=$libro->getEditorial()?>'/>
    <br>
    <br>
    <label for='genero'>Genero</label>
    <input type='text' id='genero' name='genero' value='<?=$libro->getGenero()?>'/>
    <br>
    <br>
    <label for='paginas'>Paginas</label>
    <input type='text' id='paginas' name='paginas' value='<?=$libro->getPaginas()?>'/>
    <br>
    <br>
    <label for='idioma'>Idioma</label>
    <input type='text' id='idioma' name='idioma' value='<?=$libro->getIdioma()?>'/>
    <br>
    <br>
    <input type='submit' name='actualizar' value='Actualizar cambios' />
</form>
</body>
</html>