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
  `codice_utente` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email` char(50) NOT NULL,
  `password` char(200) NOT NULL,
  `nickname` char(50) NOT NULL,
  `nome` char(50) NOT NULL,
  `cognome` char(50) NOT NULL,
  `telefono` char(50) DEFAULT NULL,
  `email_recupero` char(50) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `nazionalita` char(10) NOT NULL,
  PRIMARY KEY (`codice_utente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.account: ~6 rows (circa)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`codice_utente`, `email`, `password`, `nickname`, `nome`, `cognome`, `telefono`, `email_recupero`, `data_nascita`, `nazionalita`) VALUES
	(0000000001, 'roberto.rudi04@gmail.com', '$2y$10$Zq8feZiFPC8O88lt8WypjezO1uw9sH7GnbuWIBpceGJ885BO0IgM6', 'dragonero2704', 'Roberto', 'Rudi', '3926043632', '', '2004-09-27', 'Italia'),
	(0000000004, 'andrea.mattavelli@liceobanfi.eu', '$2y$10$slPTO035Jn.UWb33DYNDC.4ZJWuzpj3Ma27fSs6YbstStFcUKJEcS', 'andreji12', 'Andrea', 'Mattavelli', '', '', '2004-09-20', 'Italia'),
	(0000000005, 'sessopazzo@gmail.com', '$2y$10$aVTaHsEMS9UshpkHMBj4EOe1Z3kgAZakj91FHVtU2/n9PCYytQRly', 'cocksucker69', 'dio', 'cane', '', '', '2001-09-11', 'Siria'),
	(0000000006, 'asd.asd@fadf.com', '$2y$10$zzj96vm.O8AaDKCe9xutX.WQb0PiGrc6mBrcweN98JunUvlIG94n2', 'asd', 'asd', 'asd', '', '', '1986-04-09', ''),
	(0000000007, 'grazieperiltuosaldosteam@gmail.com', '$2y$10$DI.KrBMpzzAJsPNWsYd20OjrdKsdBBNedMidzf/osQYw2hBzH/pEi', 'yuukigerma', 'Riccardo', 'Cavenati', '', 'yuukigerma@gmail.com', '2019-01-01', 'Sburroland'),
	(0000000008, 'roberto.rudi@liceobanfi.eu', '$2y$10$N4OTHOfqxTcPcIjAkgsSn.YVkG846Ns9xZH1d7IcJtURGj4sOAQt.', 'sium', 'Roberto', 'Rudi', '+39 392 604 3632', '', '2004-09-27', 'Napoletana');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.account_servizion_clienti
CREATE TABLE IF NOT EXISTS `account_servizion_clienti` (
  `codice_account` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `email_recapito` char(50) NOT NULL,
  `telefono_recapito` char(50) NOT NULL,
  `ruolo` char(50) NOT NULL,
  PRIMARY KEY (`codice_account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.account_servizion_clienti: ~0 rows (circa)
/*!40000 ALTER TABLE `account_servizion_clienti` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_servizion_clienti` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.agenzia
CREATE TABLE IF NOT EXISTS `agenzia` (
  `codice_agenzia` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL DEFAULT '',
  `recapito_telefonico` char(13) NOT NULL DEFAULT '',
  `recapito_mail` char(50) NOT NULL DEFAULT '',
  `nazionalita` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`codice_agenzia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.agenzia: ~0 rows (circa)
/*!40000 ALTER TABLE `agenzia` DISABLE KEYS */;
/*!40000 ALTER TABLE `agenzia` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.aiuta
CREATE TABLE IF NOT EXISTS `aiuta` (
  `codice_utente` int(10) unsigned zerofill NOT NULL,
  `risolto` char(50) NOT NULL DEFAULT '',
  `codice_account` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`codice_utente`,`codice_account`),
  KEY `codice_account` (`codice_account`),
  KEY `codice_utente` (`codice_utente`),
  CONSTRAINT `codice_account` FOREIGN KEY (`codice_account`) REFERENCES `account_servizion_clienti` (`codice_account`) ON UPDATE CASCADE,
  CONSTRAINT `codice_utente` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.aiuta: ~0 rows (circa)
/*!40000 ALTER TABLE `aiuta` DISABLE KEYS */;
/*!40000 ALTER TABLE `aiuta` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.giochi
CREATE TABLE IF NOT EXISTS `giochi` (
  `codice_gioco` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `descrizione` tinytext NOT NULL,
  `titolo` char(50) NOT NULL,
  `prezzo` float NOT NULL DEFAULT 0,
  `anno_pubblicazione` int(10) unsigned NOT NULL,
  `codice_agenzia` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`codice_gioco`),
  KEY `codice_agenzia` (`codice_agenzia`),
  CONSTRAINT `codice_agenzia__` FOREIGN KEY (`codice_agenzia`) REFERENCES `agenzia` (`codice_agenzia`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.giochi: ~0 rows (circa)
/*!40000 ALTER TABLE `giochi` DISABLE KEYS */;
/*!40000 ALTER TABLE `giochi` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.possiede
CREATE TABLE IF NOT EXISTS `possiede` (
  `codice_utente` int(10) unsigned NOT NULL,
  `codice_account` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codice_utente`,`codice_account`),
  KEY `codice_account` (`codice_account`),
  KEY `codice_utente` (`codice_utente`),
  CONSTRAINT `codice_account__` FOREIGN KEY (`codice_account`) REFERENCES `account_servizion_clienti` (`codice_account`) ON UPDATE CASCADE,
  CONSTRAINT `codice_utente__` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.possiede: ~0 rows (circa)
/*!40000 ALTER TABLE `possiede` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.recensione: ~0 rows (circa)
/*!40000 ALTER TABLE `recensione` DISABLE KEYS */;
/*!40000 ALTER TABLE `recensione` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
