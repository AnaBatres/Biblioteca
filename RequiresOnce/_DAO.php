<?php
require_once "_Clases.php";
require_once "_Varios.php";

class DAO
{
    private static ?PDO $conexion = null;

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "biblioteca";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            echo "\n\nError al conectar:\n" . $e->getMessage();
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        }

        return $pdo;
    }

    private static function garantizarConexion()
    {
        if (self::$conexion == null) {
            self::$conexion = self::obtenerPdoConexionBd();
        }
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        self::garantizarConexion();

        $select = self::$conexion->prepare($sql);
        $select->execute($parametros);
        return $select->fetchAll(); // Se devuelve "el $rs"
    }

    private static function ejecutarInsert(string $sql, array $parametros): ?int
    {
        self::garantizarConexion();

        $insert = self::$conexion->prepare($sql);
        $sqlConExito = $insert->execute($parametros);

        if (!$sqlConExito) return null;
        else return self::$conexion->lastInsertId();
    }


    private static function ejecutarUpdel(string $sql, array $parametros): ?int
    {
        self::garantizarConexion();

        $updel = self::$conexion->prepare($sql);
        $sqlConExito = $updel->execute($parametros);

        if (!$sqlConExito) return null;
        else return $updel->rowCount();
    }
    private static function autorCrearDesdeFila(array $fila): Autor
    {
        return new Autor($fila["AutorID"], $fila["Nombre"], $fila["Nacionalidad"]);
    }

    public static function autorObtenerPorId(int $id): ?Autor
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Autores WHERE AutorID=?",
            [$id]
        );

        if ($rs) {
            $fila = $rs[0];
            return self::autorCrearDesdeFila($fila);
        } else {
            return null;
        }
    }

    public static function autorObtenerTodos(): array
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Autores",
            []
        );

        $autores = [];
        foreach ($rs as $fila) {
            $autor = self::autorCrearDesdeFila($fila);
            $autores[]= $autor;
        }

        return $autores;
    }

    public static function autorCrear(string $nombre, string $nacionalidad): ?Autor
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO Autor (Nombre, Nacionalidad) VALUES (?, ?)",
            [$nombre, $nacionalidad]
        );

        if ($idAutogenerado == null) return null;
        else return self::autorObtenerPorId($idAutogenerado);
    }

    public static function autorActualizar(Autor $autores): ?Autor
    {
        $filasAfectadas = self::ejecutarUpdel(
            "UPDATE Autores SET nombre=?, nacionalidad=? WHERE id=?",
            [$autores->getNombre(), $autores->getAutorID(), $autores->getNacionalidad()]
        );

        if ($filasAfectadas == null) return null;
        else return $autores;
    }

    public static function autorEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM Autores WHERE AutorID=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function autorEliminar(Autor $autor): bool
    {
            return self::autorEliminarPorId($autor->getId());
    }


    private static function libroCrearDesdeFila(array $fila): Libro
    {
        return new Libro(
            $fila["LibroID"],
            $fila["Titulo"],
            $fila["ISBN"],
            $fila["Editorial"],
            $fila["Genero"],
            $fila["Paginas"],
            $fila["Idioma"],
            $fila["corazon"],
            $fila["valoracion"],
            $fila["AutorID"]
        );
    }


    public static function libroObtenerPorId(int $id): ?Libro
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Libros WHERE LibroID=? ",
            [$id]
        );

        if ($rs) return self::libroCrearDesdeFila($rs[0]);
        else return null;
    }

    public static function libroObtenerTodos(): array
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM libros ORDER BY titulo",
            []
        );

        $datos = [];

        foreach ($rs as $fila) {
            $libro = self::libroCrearDesdeFila($fila);
            $datos[] = $libro;
        }

        return $datos;
    }

    public static function libroOrdenadoGenero(): array
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM libros ORDER BY genero",
            []
        );

        $datos = [];

        foreach ($rs as $fila) {
            $libro = self::libroCrearDesdeFila($fila);
            $datos[] = $libro;
        }

        return $datos;
    }

    public static function libroCrear(
        string $titulo,
        string $ISBN,
        string $editorial,
        string $genero,
        int    $paginas,
        string $idioma,
        int    $autorID,
        int    $corazon,
        int    $valoracion
    ): ?Libro
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO Libros (Titulo, ISBN, Editorial, Genero, Paginas, Idioma, AutorID, corazon, valoracion) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $titulo,
                $ISBN,
                $editorial,
                $genero,
                $paginas,
                $idioma,
                $autorID,
                $corazon,
                $valoracion
            ]
        );

        if ($idAutogenerado == null) return null;
        else return self::libroObtenerPorId($idAutogenerado);
    }

    public static function libroActualizar(Libro $libro): ?Libro
    {
        $filasAfectadas = self::ejecutarUpdel(
            "UPDATE Libros SET Titulo=?, ISBN=?, Editorial=?, Genero=?, Paginas=?, Idioma=?, AutorID=?, corazon=?, valoracion=? WHERE LibroID=?",
            [
                $libro->getTitulo(),
                $libro->getISBN(),
                $libro->getEditorial(),
                $libro->getGenero(),
                $libro->getPaginas(),
                $libro->getIdioma(),
                $libro->getAutorID(),
                $libro->getCorazon(),
                $libro->getValoracion(),
                $libro->getId()
            ]
        );

        if ($filasAfectadas == null) return null;
        else return $libro;
    }

    public static function libroEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM Libros WHERE LibroID=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function libroActualizarCorazon(int $id, int $corazon): bool
    {
        $sql = "UPDATE Libros SET corazon = ? WHERE libroID = ?";
        $conexion = self::obtenerPdoConexionBD();

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([$corazon, $id]);

        return $sentencia->rowCount() > 0;
    }

    public static function actualizarCorazon(int $usuarioID, int $libroID): bool
    {
        $sql = "INSERT INTO favoritos SET usuarioID = ? AND libroID = ?";
        $conexion = self::obtenerPdoConexionBD();

        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([$usuarioID, $libroID]);

        return $sentencia->rowCount() > 0;
    }

    public static function libroEliminar(Libro $libro): bool
    {
        return self::libroEliminarPorId($libro->getId());
    }


    public static function obtenerTodo(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT Libros.LibroID, Libros.Titulo, Libros.ISBN, Libros.Editorial, Libros.Genero, Libros.Paginas, Libros.Idioma, Libros.AutorID, Libros.corazon, Libros.valoracion, autores.nombre as autorNombre
            FROM Libros
            INNER JOIN Autores ON Libros.AutorID = Autores.AutorID",
            []
        );

        foreach ($rs as $fila) {
            $libro = self::libroCrearDesdeFila($fila);
            array_push($datos, $libro);
        }

        return $datos;
    }


    public static function listaFavoritos(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM Libros WHERE corazon=1",
            []
        );

        foreach ($rs as $fila) {
            $libro = self::libroCrearDesdeFila($fila);
            array_push($datos, $libro);
        }

        return $datos;
    }

    private static function usuarioCrearDesdeFila(array $fila): Usuario
    {
        return new Usuario($fila["id"], $fila["nombre"], $fila["usuario"], $fila["contrasenna"]);
    }

    public static function usuarioObtener(string $usuario, string $contrasenna): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE usuario=? AND contrasenna=?",
            [$usuario, $contrasenna]
        );

        if ($rs) {
            $fila = $rs[0];
            return self::usuarioCrearDesdeFila($fila);
        } else {
            return null;
        }
    }

    public static function usuarioObtenerPorId(int $id): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Usuario WHERE id=?",
            [$id]
        );

        if ($rs) {
            $fila = $rs[0];
            return self::usuarioCrearDesdeFila($fila);
        } else {
            return null;
        }
    }

    public static function usuarioCrear(string $nombre, string $usuario, string $contrasenna): ?Usuario
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO usuario (nombre,usuario,contrasenna) VALUES (?, ?,?)",
            [$nombre, $usuario, $contrasenna]
        );

        if ($idAutogenerado == null) return null;
        else return self::usuarioObtenerPorId($idAutogenerado);
    }

    private static function resenaCrearDesdeFila(array $fila): Resena
    {
        return new Resena($fila["ResenaID"], $fila["LibroID"], $fila["UsuarioID"], $fila["Calificacion"], $fila["Comentario"]);
    }

    public static function resenaObtenerPorId(int $id): ?Resena
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM resena WHERE resenaID=?",
            [$id]
        );

        if ($rs) {
            $fila = $rs[0];
            return self::resenaCrearDesdeFila($fila);
        } else {
            return null;
        }
    }
    public static function resenaCrear(int $libroId, int $usuarioId, int $calificacion, string $comentario): ?Resena
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO resena (libroID, usuarioID, calificacion, comentario) VALUES (?, ?, ?, ?)",
            [$libroId, $usuarioId, $calificacion, $comentario]
        );

        if ($idAutogenerado == null) return null;
        else return self::resenaObtenerPorId($idAutogenerado);
    }

    public static function obtenerResenas(int $libroId): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM Resena WHERE LibroID = ?",
            [$libroId]
        );

        foreach ($rs as $fila) {
            $resena = self::resenaCrearDesdeFila($fila);
            array_push($datos, $resena);
        }

        return $datos;
    }

    public static function resenaEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM Resena WHERE ResenaID=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function resenaEliminar(Resena $resena): bool
    {
        return self::resenaEliminarPorId($resena->getId());
    }

    public static function obtenerLibroPorResena($resenaID) {
        $rs = self::ejecutarConsulta(
            "SELECT LibroID FROM Resena WHERE ResenaID = ?",
            [$resenaID]
        );

        if ($rs) {
            $fila = $rs[0];
            return $fila["LibroID"];
        } else {
            return null;
        }
    }
    private static function favoritosCrearDesdeFila(array $fila): Favoritos
    {
        return new Favoritos($fila["id"], $fila["usuarioID"], $fila["libroID"]);
    }
    public static function favoritosObtenerPorId(int $id): ?Favoritos
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM favoritos WHERE id=?",
            [$id]
        );

        if ($rs) {
            $fila = $rs[0];
            return self::favoritosCrearDesdeFila($fila);
        } else {
            return null;
        }
    }

    public static function favoritoCrear(int $libroID, int $usuarioID): ?Favoritos
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO favoritos (libroID, usuarioID) VALUES (?,?)",
            [$libroID, $usuarioID]
        );

        if ($idAutogenerado == null) return null;
        else return self::favoritosObtenerPorId($idAutogenerado);
    }

    public static function favoritoBorrar(int $libroID, int $usuarioID): bool
    {
        $filasAfectadas = self::ejecutarUpdel(
            "DELETE FROM favoritos WHERE libroID=? AND usuarioID=?",
            [$libroID, $usuarioID]
        );

        return ($filasAfectadas == 1);
    }

    public static function favoritosObtener(): array
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM favoritos",
            []
        );

        $favoritos = [];
        foreach ($rs as $fila) {
            $favorito = self::favoritosCrearDesdeFila($fila);
            $favoritos[] = $favorito;
        }

        return $favoritos;
    }

    public static function listafavoritosObtener(int $usuarioID): array
    {
        $rs = self::ejecutarConsulta(
            "SELECT libroID FROM favoritos WHERE usuarioID = ?",
            [$usuarioID]
        );

        $favoritos = [];
        foreach ($rs as $fila) {
            $libroID = $fila["libroID"];
            $favoritos[] = $libroID;
        }

        return $favoritos;
    }

    public static function esFavorito(int $usuarioID, int $libroID): bool
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM favoritos WHERE usuarioID = ? AND libroID = ?",
            [$usuarioID, $libroID]
        );

        return $rs ? true : false;
    }


}