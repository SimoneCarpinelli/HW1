CREATE DATABASE fuzerecords;
use fuzerecords;

CREATE TABLE `people` (
  `CF` varchar(16) NOT NULL,
  `data_di_nascita` date DEFAULT NULL,
  `Domicilio` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`CF`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `CF` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Username` (`Username`),
  KEY `CF` (`CF`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`CF`) REFERENCES `people` (`CF`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(20) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `costo` decimal(10, 2) DEFAULT NULL,
  `copies_available` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;


CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `accounts_id` int(11) DEFAULT NULL,
  `product_ids` VARCHAR(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cost_tot` float DEFAULT 0,
  `indirizzo` VARCHAR(255) DEFAULT 'Valore_predefinito',
  PRIMARY KEY (`order_id`),
  KEY `newacquirente` (`accounts_id`),
  CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`accounts_id`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `consulenza` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telefono` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `accounts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `consulenza_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `studios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE Cookie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hash VARCHAR(255) NOT NULL,
  expires TIMESTAMP NOT NULL,
  user_id INT
);

INSERT INTO products VALUES ('', 'Akai', 'Akai.png', 'Akai mini', 100.00, 10);
INSERT INTO products VALUES ('', 'Akai', 'Akai_mpc.png', 'Akai MPC', 500.00, 5);
INSERT INTO products VALUES ('', 'Apollo', 'Apollo.png', 'Apollo Twin', 800.00, 3);
INSERT INTO products VALUES ('', 'akg', 'akg_c414.png', 'akg c414', 350.00, 8);
INSERT INTO products VALUES ('', 'audio tecnica', 'audiotecnica_mx50.png', 'mx50', 150.00, 12);
INSERT INTO products VALUES ('', 'makie', 'casse.png', 'cr4bt', 200.00, 6);
INSERT INTO products VALUES ('', 'sennheiser', 'cuffie.png', 'dh 558', 100.00, 10);
INSERT INTO products VALUES ('', 'edifier', 'edifier_r1280t.png', 'r1280T', 120.00, 15);
INSERT INTO products VALUES ('', 'korg', 'korg_minilogue.png', 'minilogue', 600.00, 2);
INSERT INTO products VALUES ('', 'korg', 'korg_nts.png', 'nts', 700.00, 4);
INSERT INTO products VALUES ('', 'krk', 'krk_v6.png', 'krk v6', 400.00, 6);
INSERT INTO products VALUES ('', 'm-audio', 'maudio_air.png', 'air 192', 250.00, 8);
INSERT INTO products VALUES ('', 'm-audio', 'maudio_oxygen.png', 'oxygen', 150.00, 10);
INSERT INTO products VALUES ('', 'rode', 'mic.png', 'nt1-a', 300.00, 5);
INSERT INTO products VALUES ('', 'newmann', 'neumann_u67.png', 'u-67', 1500.00, 2);
INSERT INTO products VALUES ('', 'novation', 'novation_launchpad.png', 'launchpad mk2', 200.00, 7);
INSERT INTO products VALUES ('', 'samson', 'samson_sr850.png', 'sr850', 80.00, 10);
INSERT INTO products VALUES ('', 'focusrite', 'scarlett_kit.png', 'scarlett kit', 300.00, 4);
INSERT INTO products VALUES ('', 'moog', 'synth.png', 'subsequent', 1000.00, 3);

INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('mast', 'Via Ipogeo 6 Catania', 'mast.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('bunkerino', 'Via Valsugana 58 Roma', 'bunkerino.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('icon collective', 'Via Grivola 8 Milano', 'icon_collective.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('redbull64', 'Via Foligno 41 Torino', 'redbull.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('toto sound', 'Via Argine 313 Napoli', 'toto_sound.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('curdimmo', 'Via della Liberta 97 Palermo', 'curdimmo.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('tanta roba', 'Corso Alcide De Gaspari 320 Bari', 'tantaroba.png');
INSERT INTO `studios` (`nome`, `indirizzo`, `img`) VALUES ('max sound', 'Via Francoforte 31 Bologna', 'max_sound.png');