CREATE DATABASE Prestamos;
USE prestamos;


CREATE TABLE Libros (
    id_libro INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255),
    genero VARCHAR(100),
    anio_publicacion YEAR,
    disponible BOOLEAN DEFAULT TRUE
);

select * from Libros;

CREATE TABLE Usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255)
);

select * from Usuarios;

CREATE TABLE Prestamos (
    id_prestamo INT PRIMARY KEY AUTO_INCREMENT,
    id_libro INT,
    id_usuario INT,
    fecha_prestamo DATE,
    fecha_devolucion DATE,
    FOREIGN KEY (id_libro) REFERENCES Libros(id_libro),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

Select * from Prestamos;

INSERT INTO Libros (titulo, autor, anio_publicacion) VALUES ('El Quijote', 'Miguel de Cervantes', 1605);
INSERT INTO Usuarios (nombre, email) VALUES ('Juan Pérez', 'juan.perez@example.com');
INSERT INTO Prestamos (id_libro, id_usuario, fecha_prestamo, fecha_devolucion) VALUES (1, 1, '2024-08-09', '2024-08-23');


SELECT l.titulo, u.nombre, p.fecha_prestamo
FROM Prestamos p
JOIN Libros l ON p.id_libro = l.id_libro
JOIN Usuarios u ON p.id_usuario = u.id_usuario;

