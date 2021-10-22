CREATE DATABASE IF NOT EXISTS appsalon;

/* Tabla para usuarios */
CREATE TABLE appsalon.users
(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(32) NOT NULL,
    password VARCHAR(60) NOT NULL,
    name VARCHAR(64) NOT NULL,
    surname VARCHAR(64) NOT NULL,
    tel VARCHAR(16),
    isAdmin TINYINT(1),
    isConfirmed TINYINT(1),
    token VARCHAR(16)
);

/* Tabla para servicios */
CREATE TABLE appsalon.services
(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(64) NOT NULL,
    price DECIMAL(5,2) NOT NULL
);
INSERT INTO appsalon.services (text, price) 
VALUES
    ('Corte de Cabello Mujer', '90.00'),
    ('Corte de Cabello Hombre', '80.00'),
    ('Corte de Cabello Niño', '60.00'),
    ('Peinado Mujer', '80.00'),
    ('Peinado Hombre', '60.00'),
    ('Peinado Niño', '60.00'),
    ('Corte de Barba', '60.00'),
    ('Tinte Mujer', '300.00'),
    ('Uñas', '400.00'),
    ('Lavado de Cabello', '50.00'),
    ('Tratamiento Capilar', '150.00')
;

/* Tabla para citas */
CREATE TABLE appsalon.dates 
(
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    services TINYTEXT NOT NULL,
    userId INT(11),
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE SET NULL
);
