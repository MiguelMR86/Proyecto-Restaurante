DROP DATABASE IF EXISTS restaurant;
CREATE DATABASE IF NOT EXISTS restaurant;
USE restaurant;

CREATE TABLE IF NOT EXISTS User (
    email VARCHAR(100) PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    telephone INT(9) NOT NULL,
    admin BOOLEAN DEFAULT 0,
    password VARCHAR(60)
);

CREATE TABLE IF NOT EXISTS Booking (
    id INT PRIMARY KEY AUTO_INCREMENT,
    bemail VARCHAR(100) NOT NULL,
    reserveDate DATE NOT NULL,
    nclients INT NOT NULL,
    FOREIGN KEY(bemail) REFERENCES User(email) ON DELETE CASCADE
);

--  admin123
INSERT INTO User VALUES ("admin@gmail.com", "Admin", "admin", 123456789, 1, "$2y$10$OD2bzhYFXt/qircUkmddAeZiUno6FTzKAttzfl2d6QxZVVAhVsFSK");
