SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS biblioteca DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE biblioteca;

DROP TABLE IF EXISTS Autores;
CREATE TABLE IF NOT EXISTS Autores (
                                       AutorID INT NOT NULL AUTO_INCREMENT,
                                       Nombre VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    Nacionalidad VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
    PRIMARY KEY (AutorID)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

TRUNCATE TABLE Autores;
INSERT INTO Autores (AutorID,Nombre, Nacionalidad) VALUES
                                               (1, 'Jane Austen', 'Inglesa'),
                                               (2, 'Dan Brown', 'Estadounidense'),
                                               (3, 'Agatha Christie', 'Británica'),
                                               (4, 'Pablo Neruda', 'Chileno'),
                                               (5, 'Emily Brontë', 'Inglesa'),
                                               (6, 'Edgar Allan Poe', 'Estadounidense');

DROP TABLE IF EXISTS Libros;
CREATE TABLE IF NOT EXISTS Libros (
                                      LibroID INT NOT NULL AUTO_INCREMENT,
                                      Titulo VARCHAR(255) NOT NULL,
    ISBN VARCHAR(20),
    Editorial VARCHAR(255),
    Genero VARCHAR(50),
    Paginas INT,
    Idioma VARCHAR(50),
    AutorID INT,
    corazon INT,
    valoracion INT,
    PRIMARY KEY (LibroID),
    KEY fk_AutorID (AutorID),
    CONSTRAINT fk_AutorID FOREIGN KEY (AutorID) REFERENCES Autores (AutorID) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

TRUNCATE TABLE Libros;
INSERT INTO Libros (Titulo, ISBN, Editorial, Genero, Paginas, Idioma, AutorID, corazon, valoracion) VALUES
                                                                                                        ('Orgullo y Prejuicio', '978-1-85326-488-3', 'Alma', 'Romance', 384, 'Inglés', 1, 1, 4),
                                                                                                        ('Persuasión', '978-1-85326-117-2', 'Alma', 'Romance', 336, 'Inglés', 1, 1, 5),
                                                                                                        ('El Código Da Vinci', '978-84-08-06324-4', 'Planeta', 'Misterio', 600, 'Español', 2, 1, 4),
                                                                                                        ('El símbolo perdido', '978-84-08-10762-3', 'Planeta', 'Misterio', 670, 'Español', 2, 1, 5),
                                                                                                        ('Asesinato en el Orient Express', '978-84-206-7272-7', 'Alianza', 'Misterio', 264, 'Español', 3, 0, 4),
                                                                                                        ('Muerte en el Nilo', '978-84-206-8405-8', 'Alianza', 'Misterio', 288, 'Español', 3, 0, 3),
                                                                                                        ('Residencia en la Tierra', '978-84-206-1976-4', 'Alianza Editorial', 'Poesía', 176, 'Español', 4, 1, 5),
                                                                                                        ('Cumbres Borrascosas', '978-84-15-84009-9', 'Ediciones Alianza', 'Novela Gótica', 400, 'Español', 5, 1, 4),
                                                                                                        ('Los Crímenes de la Calle Morgue', '978-84-487-0444-0', 'Editorial Renacimiento', 'Misterio', 256, 'Español', 6, 1, 5),
                                                                                                        ('La Máscara de la Muerte Roja', '978-84-607-7851-0', 'Ediciones Cátedra', 'Terror', 88, 'Español', 6, 0, 3);

CREATE TABLE IF NOT EXISTS Usuario (
    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    usuario VARCHAR(255) NOT NULL,
    contrasenna VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS Resenas (
                                       ResenaID INT NOT NULL AUTO_INCREMENT,
                                       LibroID INT NOT NULL,
                                       UsuarioID INT NOT NULL,
                                       Calificacion INT NOT NULL,
                                       Comentario TEXT,
                                       PRIMARY KEY (ResenaID),
    KEY fk_LibroID (LibroID),
    KEY fk_UsuarioID (UsuarioID),
    CONSTRAINT fk_LibroID FOREIGN KEY (LibroID) REFERENCES Libros (LibroID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_UsuarioID FOREIGN KEY (UsuarioID) REFERENCES Usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;
