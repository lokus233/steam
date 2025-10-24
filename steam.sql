--Tabla de clientes de la tienda online

DROP TABLE IF EXISTS clientes CASCADE;

DROP TABLE IF EXISTS juegos CASCADE;
DROP TABLE IF EXISTS desarrolladoras CASCADE;
DROP TABLE IF EXISTS usuarios CASCADE;
--Tabla de clientes de la tienda online
CREATE TABLE usuarios (
    id          BIGSERIAL       PRIMARY KEY,
    nick     VARCHAR(255)    NOT NULL UNIQUE,
    password    VARCHAR(255)    NOT NULL
);

CREATE TABLE clientes (
    id         BIGSERIAL       PRIMARY KEY,
    dni         VARCHAR(9)      NOT NULL UNIQUE,
    nombre      VARCHAR(255)    NOT NULL,
    apellidos   VARCHAR(255),
    direccion   VARCHAR(255),
    codpostal   NUMERIC(5)      CHECK(codpostal >= 0),
    telefono    VARCHAR(255)
);


--Tabla de desarrolladores
CREATE TABLE desarrolladoras(
    id BIGSERIAL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

--Tabla de juegos de la tienda online
CREATE TABLE juegos (
    id         BIGSERIAL       PRIMARY KEY,
    titulo      VARCHAR(255)     NOT NULL,
    genero      VARCHAR(255)    NOT NULL,
    fecha_salida    TIMESTAMP(0)   NOT NULL,
    precio      NUMERIC(6,2),
    desarrolladora_id   BIGINT  NOT NULL REFERENCES desarrolladoras(id)
);

--DATOS DE PRUEBA

INSERT INTO usuarios(nick, password)
VALUES('usuario', crypt('usuario', gen_salt('bf', 10)));

INSERT INTO clientes(dni, nombre, apellidos, direccion, codpostal, telefono)
VALUES('11111111A', 'Pepe', 'Florencio', 'C/ micasa', 11540, '639870912'),
      ('22222222B', 'Maria', 'de la o', 'C/ sucasa', 11540, '683928173');

INSERT INTO desarrolladoras(nombre)
VALUES('The Game Kitchen'),
      ('Valve');

INSERT INTO juegos(titulo, genero, precio, fecha_salida, desarrolladora_id)
VALUES ('Hollow Knight Silksong', '2D', 39.99, '2025-09-04 14:12:00', 1),
       ('Silent hill', 'Terror', 59.99, '2021-05-17 18:09:00', 2);

