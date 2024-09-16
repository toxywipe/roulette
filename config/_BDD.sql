DROP DATABASE IF EXISTS roulette;
CREATE DATABASE roulette;
USE roulette;

CREATE TABLE `class` (
    `idClass` int(11) NOT NULL AUTO_INCREMENT,
    `nameClass` varchar(30) NOT NULL,
    PRIMARY KEY (`idClass`),
    UNIQUE (`nameClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `class` (`nameClass`) VALUES ('BTS SIO');



CREATE TABLE `student` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `surname` varchar(60) NOT NULL,
    `firstname` varchar(30) NOT NULL,
    `nameClass` varchar(30),
    `ldap` tinyint(1) NOT NULL DEFAULT 0,
    `bool` tinyint(1) NOT NULL DEFAULT 0,
    `passage` int(5) NOT NULL DEFAULT 0,
    `absence` tinyint(1) NOT NULL DEFAULT 0,
    `noteaddition` int(100) DEFAULT NULL,
    `notetotal` int(10) DEFAULT NULL,
    `average` int(10) DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`nameClass`) REFERENCES `class`(`nameClass`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `student` (`surname`, `firstname`, `ldap`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
('OZTAS', 'Efecan', 0, 0, 0, 0, 0, NULL, NULL),
('ALTINTOP', 'Ilhan', 0, 0, 0, 0, 0, NULL, NULL),
('ASLAN', 'Gokhan', 0, 0, 0, 0, 0, NULL, NULL),
('BAUDRILLARD', 'Matthéo', 0, 0, 0, 0, 0, NULL, NULL),
('BENNADI', 'Nabil', 0, 0, 0, 0, 0, NULL, NULL),
('BERRIDGE', 'Matéo', 0, 0, 0, 0, 0, NULL, NULL),
('BINET', 'Pierre', 0, 0, 0, 0, 0, NULL, NULL),
('BLAVIER', 'Nathys', 0, 0, 0, 0, 0, NULL, NULL),
('CHAFAI', 'Yacine', 0, 0, 0, 0, 0, NULL, NULL),
('CHANTEREAU--LEBEAU', 'Killian', 0, 0, 0, 0, 0, NULL, NULL),
('DAUBANGE', 'Noa', 0, 0, 0, 0, 0, NULL, NULL),
('DIZY', 'Hugo', 0, 0, 0, 0, 0, NULL, NULL),
('ED-DAHMI', 'Achraf', 0, 0, 0, 0, 0, NULL, NULL),
('FLAMION', 'Alexis', 0, 0, 0, 0, 0, NULL, NULL),
('GERARD', 'David', 0, 0, 0, 0, 0, NULL, NULL),
('GRIFFON--DUMONT', 'Ange-Lubin', 0, 0, 0, 0, 0, NULL, NULL),
('JAMIN', 'Lilou', 0, 0, 0, 0, 0, NULL, NULL),
('KUMPS', 'Mathys', 0, 0, 0, 0, 0, NULL, NULL),
('LEFEVRE', 'Enzo', 0, 0, 0, 0, 0, NULL, NULL),
('LEONARD', 'Tom', 0, 0, 0, 0, 0, NULL, NULL),
('MAROT', 'Matthias', 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Paul', 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Tommy', 0, 0, 0, 0, 0, NULL, NULL),
('MOLARD', 'Hugo', 0, 0, 0, 0, 0, NULL, NULL),
('NORMAND', 'Trystan', 0, 0, 0, 0, 0, NULL, NULL),
('ROBERT', 'Nathan', 0, 0, 0, 0, 0, NULL, NULL),
('SCHAAF', 'Enzo', 0, 0, 0, 0, 0, NULL, NULL),
('SCHMITT', 'Noe', 0, 0, 0, 0, 0, NULL, NULL);


UPDATE `student` SET `nameClass` = 'BTS SIO';
