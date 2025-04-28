DROP DATABASE IF EXISTS roulette;
CREATE DATABASE roulette;
USE roulette;

CREATE TABLE `class` (
    `idClass` int(11) NOT NULL AUTO_INCREMENT,
    `nameClass` varchar(30) NOT NULL,
    PRIMARY KEY (`idClass`),
    UNIQUE (`nameClass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `class` (`nameClass`) VALUES 
('BTS SIO'),
('BTS MCO'),
('BTS NDRC');

CREATE TABLE `student` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `surname` varchar(60) NOT NULL,
    `firstname` varchar(30) NOT NULL,
    `idClass` int(11),  -- ✅ Remplacement de nameClass par idClass
    `ldap` tinyint(1) NOT NULL DEFAULT 0,
    `bool` tinyint(1) NOT NULL DEFAULT 0,
    `passage` int(5) NOT NULL DEFAULT 0,
    `absence` tinyint(1) NOT NULL DEFAULT 0,
    `noteaddition` FLOAT DEFAULT NULL,
    `notetotal` FLOAT DEFAULT NULL,
    `average` FLOAT DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`idClass`) REFERENCES `class`(`idClass`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `student` (`surname`, `firstname`, `idClass`, `ldap`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
('OZTAS', 'Efecan', (SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('ALTINTOP', 'Ilhan',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('ASLAN', 'Gokhan',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('BAUDRILLARD', 'Matthéo',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('BENNADI', 'Nabil',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('BERRIDGE', 'Matéo',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('BINET', 'Pierre',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('BLAVIER', 'Nathys',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('CHAFAI', 'Yacine',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('CHANTEREAU--LEBEAU', 'Killian',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('DAUBANGE', 'Noa',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('DIZY', 'Hugo',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('ED-DAHMI', 'Achraf',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('FLAMION', 'Alexis',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('GERARD', 'David',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('GRIFFON--DUMONT', 'Ange-Lubin',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('JAMIN', 'Lilou',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('KUMPS', 'Mathys',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('LEFEVRE', 'Enzo',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('LEONARD', 'Tom',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('MAROT', 'Matthias',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Paul',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Tommy',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('MOLARD', 'Hugo',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('NORMAND', 'Trystan',(SELECT idClass FROM class WHERE nameClass = 'BTS NDRC'), 0, 0, 0, 0, 0, NULL, NULL),
('ROBERT', 'Nathan',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL),
('SCHAAF', 'Enzo',(SELECT idClass FROM class WHERE nameClass = 'BTS MCO'), 0, 0, 0, 0, 0, NULL, NULL),
('SCHMITT', 'Noe',(SELECT idClass FROM class WHERE nameClass = 'BTS SIO'), 0, 0, 0, 0, 0, NULL, NULL);

CREATE TABLE tirage_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idStudent INT NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    dateTirage DATETIME DEFAULT CURRENT_TIMESTAMP
);
