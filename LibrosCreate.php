<?php
require_once "_Varios.php";
require_once "_Clases.php";
require_once "_DAO.php";

$libros = DAO::autorObtenerTodos();

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Nuevo libro</h1>

<form method='get' action='LibrosStore.php'>

    <h3>Datos sobre el libro</h3>
    <label for='titulo'>Titulo</label>
    <input pattern="[A-Za-z0-9]+" minlength="3" type='text' id='titulo' name='titulo' />
    <br>
    <br>
    <label for='ISBN'>ISBN</label>
    <input type='text' id='ISBN' name='ISBN' />
    <br>
    <br>
    <label for='Editorial'>Editorial</label>
    <input type='text' id='editorial' name='editorial' />
    <br>
    <br>
    <label for='Genero'>Genero</label>
    <input type='text' id='genero' name='genero' />
    <br>
    <br>
    <label for='paginas'>Paginas</label>
    <input type='text' id='paginas' name='paginas' />
    <br>
    <br>
    <label for='idioma'>Idioma</label>
    <input type='text' id='idioma' name='idioma' />
    <br>
    <br>
    <label for='corazon'>Añadir a favoritos</label>
    <input checked type="radio" id="corazon" name="corazon" value="1" />
    <label for="corazon">Si</label>
    <input type="radio" id="corazon" name="corazon" value="0" />
    <label for="corazon">No</label>
    <br>
    <br>
    <label for='valoracion'>Valoracion</label>
    <input type='text' id='valoracion' name='valoracion' />
    <br>
    <br>
    <input type='submit' name='crear' value='Añadir Libro' />

</form>

<a href='LibrosIndex.php'>Volver al listado de personas.</a>

</body>

</html>