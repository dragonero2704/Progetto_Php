-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.22-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database php_gamestore
CREATE DATABASE IF NOT EXISTS `php_gamestore` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `php_gamestore`;

-- Dump della struttura di tabella php_gamestore.account
CREATE TABLE IF NOT EXISTS `account` (
  `email` char(50) NOT NULL,
  `password` char(200) NOT NULL,
  `codice_utente` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nickname` char(50) NOT NULL,
  `nome` char(50) DEFAULT NULL,
  `cognome` char(50) DEFAULT NULL,
  `telefono` char(50) DEFAULT NULL,
  `email_recupero` char(50) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `nazionalita` char(10) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `codice_utente` (`codice_utente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.account: ~6 rows (circa)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`email`, `password`, `codice_utente`, `nickname`, `nome`, `cognome`, `telefono`, `email_recupero`, `data_nascita`, `nazionalita`) VALUES
	('andrea.mattavelli@liceobanfi.eu', '$2y$10$slPTO035Jn.UWb33DYNDC.4ZJWuzpj3Ma27fSs6YbstStFcUKJEcS', 0000000004, 'andreji12', 'Andrea', 'Mattavelli', '', '', '2004-09-20', 'Italia'),
	('asd.asd@fadf.com', '$2y$10$zzj96vm.O8AaDKCe9xutX.WQb0PiGrc6mBrcweN98JunUvlIG94n2', 0000000006, 'asd', 'asd', 'asd', '', '', '1986-04-09', ''),
	('grazieperiltuosaldosteam@gmail.com', '$2y$10$DI.KrBMpzzAJsPNWsYd20OjrdKsdBBNedMidzf/osQYw2hBzH/pEi', 0000000007, 'yuukigerma', 'Riccardo', 'Cavenati', '', 'yuukigerma@gmail.com', '2019-01-01', 'Sburroland'),
	('roberto.rudi04@gmail.com', '$2y$10$Zq8feZiFPC8O88lt8WypjezO1uw9sH7GnbuWIBpceGJ885BO0IgM6', 0000000001, 'dragonero2704', 'Roberto', 'Rudi', '3926043632', '', '2004-09-27', 'Italia'),
	('roberto.rudi@liceobanfi.eu', '$2y$10$N4OTHOfqxTcPcIjAkgsSn.YVkG846Ns9xZH1d7IcJtURGj4sOAQt.', 0000000008, 'sium', 'Roberto', 'Rudi', '+39 392 604 3632', '', '2004-09-27', 'Napoletana'),
	('sessopazzo@gmail.com', '$2y$10$aVTaHsEMS9UshpkHMBj4EOe1Z3kgAZakj91FHVtU2/n9PCYytQRly', 0000000005, 'cocksucker69', 'dio', 'cane', '', '', '2001-09-11', 'Siria');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.account_servizio_clienti
CREATE TABLE IF NOT EXISTS `account_servizio_clienti` (
  `codice_account` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` char(50) NOT NULL,
  `password` char(200) NOT NULL,
  `telefono` char(50) NOT NULL,
  `ruolo` char(50) NOT NULL,
  PRIMARY KEY (`codice_account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.account_servizio_clienti: ~2 rows (circa)
/*!40000 ALTER TABLE `account_servizio_clienti` DISABLE KEYS */;
INSERT INTO `account_servizio_clienti` (`codice_account`, `email`, `password`, `telefono`, `ruolo`) VALUES
	(0000000001, 'tizio.caio@gmail.com', 'asdf', '+39 456 789 1234', 'bug'),
	(0000000002, 'graziello.girello@gmail.com', 'girandola', '+39 567 890 3124', 'problemi acquisto');
/*!40000 ALTER TABLE `account_servizio_clienti` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.aiuta
CREATE TABLE IF NOT EXISTS `aiuta` (
  `codice_utente` int(10) unsigned zerofill NOT NULL,
  `risolto` char(50) NOT NULL DEFAULT '',
  `codice_account` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`codice_utente`,`codice_account`),
  KEY `codice_account` (`codice_account`),
  KEY `codice_utente` (`codice_utente`),
  CONSTRAINT `codice_account` FOREIGN KEY (`codice_account`) REFERENCES `account_servizio_clienti` (`codice_account`) ON UPDATE CASCADE,
  CONSTRAINT `codice_utente` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.aiuta: ~2 rows (circa)
/*!40000 ALTER TABLE `aiuta` DISABLE KEYS */;
INSERT INTO `aiuta` (`codice_utente`, `risolto`, `codice_account`) VALUES
	(0000000004, 'no', 0000000001),
	(0000000006, 'si', 0000000002);
/*!40000 ALTER TABLE `aiuta` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.giochi
CREATE TABLE IF NOT EXISTS `giochi` (
  `codice_gioco` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `descrizione` tinytext NOT NULL,
  `titolo` char(50) NOT NULL,
  `prezzo` float NOT NULL DEFAULT 0,
  `codice_software_house` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`codice_gioco`),
  KEY `FK_giochi_software_house` (`codice_software_house`),
  CONSTRAINT `FK_giochi_software_house` FOREIGN KEY (`codice_software_house`) REFERENCES `software_house` (`codice_software_house`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.giochi: ~2 rows (circa)
/*!40000 ALTER TABLE `giochi` DISABLE KEYS */;
INSERT INTO `giochi` (`codice_gioco`, `descrizione`, `titolo`, `prezzo`, `codice_software_house`) VALUES
	(0000000001, 'non so che scrivere', 'siberia: survival', 59, 0000000003),
	(0000000002, 'vai e mangia tutto quello che puoi', 'zombimon', 33, 0000000001);
/*!40000 ALTER TABLE `giochi` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.possiede
CREATE TABLE IF NOT EXISTS `possiede` (
  `codice_utente` int(10) unsigned NOT NULL,
  `codice_gioco` int(10) unsigned NOT NULL,
  `data_acquisto` date NOT NULL,
  PRIMARY KEY (`codice_utente`,`codice_gioco`) USING BTREE,
  KEY `codice_utente` (`codice_utente`),
  KEY `codice_account` (`codice_gioco`) USING BTREE,
  CONSTRAINT `codice_gioco__` FOREIGN KEY (`codice_gioco`) REFERENCES `giochi` (`codice_gioco`) ON UPDATE CASCADE,
  CONSTRAINT `codice_utente__` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.possiede: ~2 rows (circa)
/*!40000 ALTER TABLE `possiede` DISABLE KEYS */;
INSERT INTO `possiede` (`codice_utente`, `codice_gioco`, `data_acquisto`) VALUES
	(7, 1, '2022-04-07'),
	(8, 2, '2016-09-11');
/*!40000 ALTER TABLE `possiede` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.recensione
CREATE TABLE IF NOT EXISTS `recensione` (
  `codice_recensione` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `testo` text NOT NULL DEFAULT ' ',
  `valutazione` int(10) unsigned zerofill DEFAULT 0000000000,
  `codice_gioco` int(10) unsigned zerofill NOT NULL,
  `codice_utente` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`codice_recensione`),
  KEY `FK_recensione_giochi` (`codice_gioco`),
  KEY `FK_recensione_account` (`codice_utente`),
  CONSTRAINT `FK_recensione_account` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE,
  CONSTRAINT `FK_recensione_giochi` FOREIGN KEY (`codice_gioco`) REFERENCES `giochi` (`codice_gioco`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.recensione: ~2 rows (circa)
/*!40000 ALTER TABLE `recensione` DISABLE KEYS */;
INSERT INTO `recensione` (`codice_recensione`, `testo`, `valutazione`, `codice_gioco`, `codice_utente`) VALUES
	(0000000001, 'molto bello soprattutto la parte dove non muori', 0000000005, 0000000001, 0000000006),
	(0000000002, ' semplicemente orribile', 0000000001, 0000000001, 0000000005);
/*!40000 ALTER TABLE `recensione` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.software_house
CREATE TABLE IF NOT EXISTS `software_house` (
  `codice_software_house` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL DEFAULT '',
  `recapito_telefonico` char(13) NOT NULL DEFAULT '',
  `recapito_mail` char(50) NOT NULL DEFAULT '',
  `nazionalita` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`codice_software_house`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.software_house: ~3 rows (circa)
/*!40000 ALTER TABLE `software_house` DISABLE KEYS */;
INSERT INTO `software_house` (`codice_software_house`, `nome`, `recapito_telefonico`, `recapito_mail`, `nazionalita`) VALUES
	(0000000001, 'rockmoon game', '+122346759476', 'rock.moon@gmail.com', 'svedese'),
	(0000000002, 'circle enix', '+346752987465', 'circle.enix@gmail.com', 'francese'),
	(0000000003, 'ubihard', '+567894326475', 'ubi.hard@gmail.com', 'messicana');
/*!40000 ALTER TABLE `software_house` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
