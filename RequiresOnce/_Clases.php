<?php
abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Autor extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private string $nacionalidad;

    public function __construct(int $id, string $nombre, string $nacionalidad)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "nacionalidad" => $this->nacionalidad,
        ];
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(string $nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

}

class Libro extends Dato implements JsonSerializable
{
    use Identificable;

    private string $titulo;
    private string $isbn;
    private string $editorial;
    private string $genero;
    private int $paginas;
    private string $idioma;
    private int $corazon;
    private int $valoracion;
    private int $autorID;

    public function __construct(
        int    $id,
        string $titulo,
        string $isbn,
        string $editorial,
        string $genero,
        int    $paginas,
        string $idioma,
        int    $corazon,
        int    $valoracion,
        int    $autorID
    )
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->editorial = $editorial;
        $this->genero = $genero;
        $this->paginas = $paginas;
        $this->idioma = $idioma;
        $this->corazon = $corazon;
        $this->valoracion = $valoracion;
        $this->autorID = $autorID;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "titulo" => $this->titulo,
            "isbn" => $this->isbn,
            "editorial" => $this->editorial,
            "genero" => $this->genero,
            "paginas" => $this->paginas,
            "idioma" => $this->idioma,
            "corazon" => $this->corazon,
            "valoracion" => $this->valoracion,
            "autorID" => $this->autorID,
        ];
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setISBN(string $isbn)
    {
        $this->isbn = $isbn;
    }

    public function getISBN(): string
    {
        return $this->isbn;
    }

    public function setEditorial(string $editorial)
    {
        $this->editorial = $editorial;
    }

    public function getEditorial(): string
    {
        return $this->editorial;
    }

    public function setGenero(string $genero)
    {
        $this->genero = $genero;
    }

    public function getGenero(): string
    {
        return $this->genero;
    }

    public function setPaginas(int $paginas)
    {
        $this->paginas = $paginas;
    }

    public function getPaginas(): int
    {
        return $this->paginas;
    }

    public function setIdioma(string $idioma)
    {
        $this->idioma = $idioma;
    }

    public function getIdioma(): string
    {
        return $this->idioma;
    }

    public function setCorazon(int $corazon)
    {
        $this->corazon = $corazon;
    }

    public function getCorazon(): int
    {
        return $this->corazon;
    }

    public function setValoracion(int $valoracion)
    {
        $this->valoracion = $valoracion;
    }

    public function getValoracion(): int
    {
        return $this->valoracion;
    }

    public function setAutorID(int $autorID)
    {
        $this->autorID = $autorID;
    }

    public function getAutorID(): int
    {
        return $this->autorID;
    }

    public function obtenerAutor(): Autor
    {
        if ($this->autorID == null) {
            // Si el autorID es nulo, retornamos un objeto Autor vacío o manejarlo como prefieras.
            return new Autor();
        }

        // Llamamos a la función DAO para obtener el autor por ID.
        return DAO::autorObtenerPorId($this->autorID);
    }

    public function obtenerResena(): Resena
    {
        if ($this->ResenaID == null) {
            // Si el autorID es nulo, retornamos un objeto Autor vacío o manejarlo como prefieras.
            return new Resena();
        }

        // Llamamos a la función DAO para obtener el autor por ID.
        return DAO::resenaObtenerPorId($this->ResenaID);
    }
}

class Usuario extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private string $usuario;
    private string $contrasenna;

    public function __construct(int $id, string $nombre, string $usuario, string $contrasenna)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->contrasenna = $contrasenna;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "usuario" => $this->usuario,
            "contrasenna" => $this->contrasenna,
        ];
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario)
    {
        $this->usuario = $usuario;
    }

    public function getContrasenna(): string
    {
        return $this->contrasenna;
    }

    public function setContrasenna(string $contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }
}
class Resena extends Dato implements JsonSerializable
{
    use Identificable;

    private int $LibroID;
    private int $UsuarioID;
    private int $Calificacion;
    private string $Comentario;

    public function __construct(int $id, int $libroID, int $usuarioID, int $calificacion, string $comentario)
    {
        $this->ResenaID = $id;
        $this->LibroID = $libroID;
        $this->UsuarioID = $usuarioID;
        $this->Calificacion = $calificacion;
        $this->Comentario = $comentario;
    }

    public function jsonSerialize()
    {
        return [
            "ResenaID" => $this->ResenaID,
            "LibroID" => $this->LibroID,
            "UsuarioID" => $this->UsuarioID,
            "calificacion" => $this->Calificacion,
            "comentario" => $this->Comentario,
        ];
    }

    public function getId(): int
    {
        return $this->ResenaID;
    }

    public function setId(int $resenaID)
    {
        $this->ResenaID = $resenaID;
    }

    public function getLibroId(): int
    {
        return $this->LibroID;
    }

    public function setLibroId(int $libroID)
    {
        $this->LibroID = $libroID;
    }

    public function getUsuarioId(): int
    {
        return $this->UsuarioID;
    }

    public function setUsuarioId(int $usuarioID)
    {
        $this->UsuarioID = $usuarioID;
    }

    public function getCalificacion(): int
    {
        return $this->Calificacion;
    }

    public function setCalificacion(int $calificacion)
    {
        $this->Calificacion = $calificacion;
    }

    public function getComentario(): string
    {
        return $this->Comentario;
    }

    public function setComentario(string $comentario)
    {
        $this->Comentario = $comentario;
    }



}