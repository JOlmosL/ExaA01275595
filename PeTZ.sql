CREATE TABLE ZOMBIE
(
    NumZombie int AUTO_INCREMENT,
    NombreZombie varchar(45) UNIQUE NOT NULL,
    PRIMARY KEY (NumZombie)
);

INSERT INTO ZOMBIE (NombreZombie) VALUES
('Eduardo'),
('Ricardo'),
('Jesús');

CREATE TABLE ESTADO
(
    NumEstado int AUTO_INCREMENT,
    NombreEstado varchar(45) UNIQUE NOT NULL,
    PRIMARY KEY (NumEstado)
);

INSERT INTO ESTADO (NombreEstado) VALUES
('Infección'),
('Desorientación'),
('Violencia'),
('Desmayo'),
('Transformación');

CREATE TABLE REGISTRO
(
    NumZombie int,
    NumEstado int,
    FechaHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (NumZombie, NumEstado),
    FOREIGN KEY (NumZombie) REFERENCES ZOMBIE (NumZombie) ON DELETE RESTRICT,
    FOREIGN KEY (NumEstado) REFERENCES ESTADO (NumEstado) ON DELETE RESTRICT
);

INSERT INTO REGISTRO VALUES
(1,1,'2003-08-11 07:05:00'),
(1,2,'2005-08-14 11:35:00'),
(1,3,'2013-08-12 10:05:00'),
(1,4,'2019-10-25 13:05:00'),
(2,1,'2005-08-14 11:35:00'),
(2,2,'2013-08-12 10:05:00'),
(2,3,'2014-08-12 10:05:00'),
(3,1,'2019-10-25 13:05:00');

/*
1. Nuevos zombis con su nombre completo.
2. El estado actual del zombi (infección, desorientación, violencia, desmayo, transformación), con su fecha y hora de registro del nuevo estado, de tal forma que sea posible tener el histórico de todos los estados por los que ha pasado un zombi. El usuario no debe ingresar la fecha y hora, la aplicación debe hacerlo de manera automática.
*/
DELIMITER $$
CREATE PROCEDURE NuevoZombie(NombreZombie varchar(45))
BEGIN
    INSERT INTO ZOMBIE (NombreZombie) VALUES (NombreZombie);
END$$

CREATE PROCEDURE Estado_Actual(NumZombie int, NumEstado int)
BEGIN
    INSERT INTO REGISTRO (NumZombie, NumEstado) VALUES (NumZombie, NumEstado);
END$$

/*
1. Todos los registros de zombis con todas las actualizaciones de cada uno.
2. La cantidad total de zombis registrados, y la cantidad de zombis en cada estado.
3. Todos los registros de actualización de estado de zombis del más reciente al más antiguo por la fecha de su registro.
4. Los registros de zombis con el estado elegido por el usuario y la cantidad de ellos.
*/

CREATE PROCEDURE Registros_Zombies()
BEGIN
    SELECT ZOMBIE.NombreZombie, ESTADO.NombreEstado, REGISTRO.FechaHora
    FROM ZOMBIE, ESTADO, REGISTRO 
    WHERE ZOMBIE.NumZombie = REGISTRO.NumZombie AND ESTADO.NumEstado = REGISTRO.NumEstado
    GROUP BY ZOMBIE.NombreZombie, ESTADO.NombreEstado;
END$$

CREATE PROCEDURE Cant_Zombies()
BEGIN
    SELECT ESTADO.NombreEstado, COUNT(REGISTRO.NumEstado) AS 'Zombies por Estado'
    FROM REGISTRO, ESTADO
    WHERE REGISTRO.NumEstado = ESTADO.NumEstado
    GROUP BY REGISTRO.NumEstado;
END$$

CREATE PROCEDURE Registros_Actualizados()
BEGIN
    SELECT * 
    FROM REGISTRO
    ORDER BY FechaHora;
END$$

CREATE PROCEDURE Registro_Especial(NumEstado int)
BEGIN
    SELECT * 
    FROM REGISTRO
    WHERE NumEstado = 2
    LIMIT 2;
END$$