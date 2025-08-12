CREATE DATABASE biblioteca;
Use Biblioteca;

CREATE TABLE Library (
	id_libro INT PRIMARY KEY AUTO_INCREMENT,
	titulo VARCHAR(255) NOT NULL,
	isbn VARCHAR(20),
	id_autor INT,
	id_editorial INT,
	anio_publicacion INT,
	genero VARCHAR(50),
	FOREIGN KEY (id_autor) REFERENCES autores(id_autor),
	FOREIGN KEY (id_editorial) REFERENCES editoriales(id_editorial)
);
    
    select * from Library;
    
    
CREATE TABLE autores (
	id_autor INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	nacionalidad VARCHAR(50)
);
    
    select * from autores;
    
CREATE TABLE editoriales (
	id_editorial INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(255) NOT NULL,
	ciudad VARCHAR(100)
);
    
    select * from editoriales;
    
        CREATE TABLE ejemplares (
        id_ejemplar INT PRIMARY KEY AUTO_INCREMENT,
        id_libro INT,
        numero_inventario VARCHAR(20),
        estado VARCHAR(50),
        FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
    );
    
    
    INSERT INTO Library (titulo, isbn, id_autor, id_editorial, anio_publicacion, genero) VALUES
('El Quijote', '978-84-206-5697-2', 1, 1, 1605, 'Novela'),
('Cien años de soledad', '978-03-217-2597-7', 2, 2, 1967, 'Realismo mágico');

INSERT INTO autores (nombre, nacionalidad) VALUES
('Miguel de Cervantes', 'Español'),
('Gabriel García Márquez', 'Colombiano');

INSERT INTO editoriales (nombre, ciudad) VALUES
('`Editorial Planeta`', 'Barcelona'),
('`Penguin Random House`', 'Nueva York');

INSERT INTO ejemplares (id_libro, numero_inventario, estado) VALUES
(1, 'A001', 'Disponible'),
(1, 'A002', 'Prestado'),
(2, 'B001', 'Disponible');
    