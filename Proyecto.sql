CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    Administrador boolean not null default 0
    
);

INSERT INTO usuarios (nombre, apellido, correo, clave, Administrador) VALUES ('El', 'Administrator', 'El.Administrator@example.com', 'clave', 1);

create table libros (
id_libro INT auto_increment primary key,
titulo varchar(255) not null,
autor varchar(255) not null,
isbn bigint not null unique,
categoria varchar(100) not null,
descripcion text not null,
anio year not null,
estado boolean not null default 0
)



