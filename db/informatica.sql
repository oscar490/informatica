------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS aulas CASCADE;

CREATE TABLE aulas
(
      id           BIGSERIAL PRIMARY KEY
    , numero       NUMERIC(5,0) UNIQUE
    , denominacion VARCHAR(255)
);



DROP TABLE IF EXISTS ordenadores CASCADE;

CREATE TABLE ordenadores
(
      id      BIGSERIAL    PRIMARY KEY
    , codigo  NUMERIC(5,0) UNIQUE
    , marca   VARCHAR(255) NOT NULL
    , modelo  VARCHAR(255) NOT NULL
    , aula_id BIGINT       REFERENCES aulas (id) ON DELETE
                           NO ACTION ON UPDATE CASCADE

);

DROP TABLE IF EXISTS tipo CASCADE;

CREATE TABLE tipo
(
      id           BIGSERIAL PRIMARY KEY
    , denominacion VARCHAR(255) UNIQUE
);


DROP TABLE IF EXISTS dispositivos CASCADE;

CREATE TABLE dispositivos
(
      id           BIGSERIAL    PRIMARY KEY
    , codigo       NUMERIC(5,0) UNIQUE
    , marca        VARCHAR(255) NOT NULL
    , modelo       VARCHAR(255) NOT NULL
    , tipo_id      BIGINT       REFERENCES tipo (id) ON DELETE
                                NO ACTION ON UPDATE CASCADE
    , ordenador_id BIGINT       REFERENCES ordenadores (id) ON DELETE
                                NO ACTION ON UPDATE CASCADE
                                DEFAULT NULL
    , aula_id      BIGINT       REFERENCES aulas (id) ON DELETE
                                NO ACTION ON UPDATE CASCADE
);

/* DROP TABLE IF EXISTS cambios CASCADE;

CREATE TABLE cambios
(
      id             BIGSERIAL PRIMARY KEY
    , ordenador_id   BIGINT    REFERENCES ordenadores (id) ON DELETE
                               NO ACTION ON UPDATE CASCADE
    , dispositivo_id BIGINT    REFERENCES dispositivos (id) ON DELETE
                               NO ACTION ON UPDATE CASCADE
    ,
); */

INSERT INTO aulas (numero, denominacion)
    VALUES (100, 'Departamento de informática'),
            (200, 'P8'),
            (300, 'P10');

INSERT INTO ordenadores (codigo, marca, modelo, aula_id)
    VALUES (1000, 'ASUS', 'm1245', 1),
            (2000, 'HP', 'A540S', 1),
            (3000, 'Lenovo', 'AR3456', 2);

INSERT INTO tipo (denominacion)
    VALUES ('Tarjeta gráfica'),
            ('Grabadora DVD'),
            ('Adaptador puertos USB'),
            ('Tarjeta de sonido');

INSERT INTO dispositivos (codigo, marca, modelo, tipo_id, ordenador_id, aula_id)
    VALUES (10, 'NVIDIA', 'Geforce', 1, 1, null),
            (20, 'DVDROM', 'SuperDVD', 2, 1, null),
            (30, 'Sandisk', 'ARTGF', 3, default, 1);
