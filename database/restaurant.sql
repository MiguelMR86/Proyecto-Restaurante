CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

CREATE TABLE IF NOT EXISTS User (
    dni VARCHAR(9) PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    telephone INT(9) NOT NULL,
    email VARCHAR(100) NOT NULL,
    admin BOOLEAN DEFAULT 0,
    password VARCHAR(60)
);

CREATE TABLE IF NOT EXISTS Booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dnir VARCHAR(9) NOT NULL,
    reservDate DATE NOT NULL,
    nclients INT NOT NULL,
);

--  admin123
-- INSERT INTO User VALUES ("12345678A", "Admin", "admin", 123456789, "admin@gmail.com", 1, "$2y$10$OD2bzhYFXt/qircUkmddAeZiUno6FTzKAttzfl2d6QxZVVAhVsFSK");