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


INSERT INTO `student` (`surname`, `firstname`, `nameClass`, `ldap`, `bool`, `passage`, `absence`, `noteaddition`, `notetotal`, `average`) VALUES
('OZTAS', 'Efecan','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('ALTINTOP', 'Ilhan','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('ASLAN', 'Gokhan','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('BAUDRILLARD', 'Matthéo','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('BENNADI', 'Nabil','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('BERRIDGE', 'Matéo','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('BINET', 'Pierre','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('BLAVIER', 'Nathys','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('CHAFAI', 'Yacine','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('CHANTEREAU--LEBEAU', 'Killian','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('DAUBANGE', 'Noa','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('DIZY', 'Hugo','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('ED-DAHMI', 'Achraf','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('FLAMION', 'Alexis','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('GERARD', 'David','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('GRIFFON--DUMONT', 'Ange-Lubin','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('JAMIN', 'Lilou','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('KUMPS', 'Mathys','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('LEFEVRE', 'Enzo','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('LEONARD', 'Tom','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('MAROT', 'Matthias','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Paul','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('MASSON', 'Tommy','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('MOLARD', 'Hugo','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('NORMAND', 'Trystan','BTS NDRC', 0, 0, 0, 0, 0, NULL, NULL),
('ROBERT', 'Nathan','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL),
('SCHAAF', 'Enzo','BTS MCO', 0, 0, 0, 0, 0, NULL, NULL),
('SCHMITT', 'Noe','BTS SIO', 0, 0, 0, 0, 0, NULL, NULL);
