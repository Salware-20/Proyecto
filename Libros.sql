use biblioteca;

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

select * from libros;




