-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.21-MariaDB - mariadb.org binary distribution
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
DROP DATABASE IF EXISTS `php_gamestore`;
CREATE DATABASE IF NOT EXISTS `php_gamestore` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `php_gamestore`;

-- Dump della struttura di tabella php_gamestore.account
DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `email` char(50) NOT NULL,
  `password` char(200) NOT NULL,
  `codice_utente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` char(50) NOT NULL,
  `nome` char(50) DEFAULT NULL,
  `cognome` char(50) DEFAULT NULL,
  `telefono` char(50) DEFAULT NULL,
  `email_recupero` char(50) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  `nazionalita` char(10) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `codice_utente` (`codice_utente`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.account: ~5 rows (circa)
DELETE FROM `account`;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`email`, `password`, `codice_utente`, `nickname`, `nome`, `cognome`, `telefono`, `email_recupero`, `data_nascita`, `nazionalita`) VALUES
	('andrea.mattavelli@liceobanfi.eu', '$2y$10$slPTO035Jn.UWb33DYNDC.4ZJWuzpj3Ma27fSs6YbstStFcUKJEcS', 4, 'andreji12', 'Andrea', 'Mattavelli', '', '', '2004-09-20', 'Italia'),
	('asdasd@asd.com', '$2y$10$Bf/XkMM4RnCaYN3OWgAELO1IhU95C5LUoYE7Tk02Ed81yWB6RPnde', 9, 'sium', '', '', '', '', '0000-00-00', ''),
	('grazieperiltuosaldosteam@gmail.com', '$2y$10$DI.KrBMpzzAJsPNWsYd20OjrdKsdBBNedMidzf/osQYw2hBzH/pEi', 7, 'yuukigerma', 'Riccardo', 'Cavenati', '', 'yuukigerma@gmail.com', '2019-01-01', 'Sburroland'),
	('roberto.rudi04@gmail.com', '$2y$10$Zq8feZiFPC8O88lt8WypjezO1uw9sH7GnbuWIBpceGJ885BO0IgM6', 1, 'dragonero2704', 'Roberto', 'Rudi', '3926043632', '', '2004-09-27', 'Italia'),
	('sessopazzo@gmail.com', '$2y$10$aVTaHsEMS9UshpkHMBj4EOe1Z3kgAZakj91FHVtU2/n9PCYytQRly', 5, 'cocksucker69', 'dio', 'cane', '', '', '2001-09-11', 'Siria');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.aiuta
DROP TABLE IF EXISTS `aiuta`;
CREATE TABLE IF NOT EXISTS `aiuta` (
  `codice_utente` int(10) unsigned NOT NULL,
  `risolto` char(50) NOT NULL DEFAULT '',
  `codice_account` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codice_utente`,`codice_account`),
  KEY `codice_account` (`codice_account`),
  KEY `codice_utente` (`codice_utente`),
  CONSTRAINT `codice_account` FOREIGN KEY (`codice_account`) REFERENCES `account_servizio_clienti` (`codice_account`) ON UPDATE CASCADE,
  CONSTRAINT `codice_utente` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.aiuta: ~2 rows (circa)
DELETE FROM `aiuta`;
/*!40000 ALTER TABLE `aiuta` DISABLE KEYS */;
INSERT INTO `aiuta` (`codice_utente`, `risolto`, `codice_account`) VALUES
	(4, 'no', 1),
	(6, 'si', 2);
/*!40000 ALTER TABLE `aiuta` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.appartiene
DROP TABLE IF EXISTS `appartiene`;
CREATE TABLE IF NOT EXISTS `appartiene` (
  `codice_gioco` int(11) unsigned NOT NULL,
  `genere` char(50) NOT NULL,
  PRIMARY KEY (`genere`,`codice_gioco`) USING BTREE,
  KEY `FK_appartiene_giochi` (`codice_gioco`),
  CONSTRAINT `FK_appartiene_genere` FOREIGN KEY (`genere`) REFERENCES `genere` (`genere`) ON UPDATE CASCADE,
  CONSTRAINT `FK_appartiene_giochi` FOREIGN KEY (`codice_gioco`) REFERENCES `giochi` (`codice_gioco`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='Relazione N a N tra gioco e genere';

-- Dump dei dati della tabella php_gamestore.appartiene: ~8 rows (circa)
DELETE FROM `appartiene`;
/*!40000 ALTER TABLE `appartiene` DISABLE KEYS */;
INSERT INTO `appartiene` (`codice_gioco`, `genere`) VALUES
	(6, 'Avventura'),
	(14, 'Avventura'),
	(6, 'Fantascienza'),
	(22, 'Fantascienza'),
	(16, 'Open World'),
	(6, 'Sparatutto'),
	(6, 'Strategico'),
	(25, 'Strategico');
/*!40000 ALTER TABLE `appartiene` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.genere
DROP TABLE IF EXISTS `genere`;
CREATE TABLE IF NOT EXISTS `genere` (
  `genere` char(50) NOT NULL,
  `descrizione` text DEFAULT NULL,
  PRIMARY KEY (`genere`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dump dei dati della tabella php_gamestore.genere: ~9 rows (circa)
DELETE FROM `genere`;
/*!40000 ALTER TABLE `genere` DISABLE KEYS */;
INSERT INTO `genere` (`genere`, `descrizione`) VALUES
	('Avventura', NULL),
	('Fantascienza', NULL),
	('Open World', 'Mappa aperta da esplorare'),
	('Prima Persona', 'Il giocatore vede il mondo con gli occhi del protagonista'),
	('RPG', 'Role Play Game'),
	('Sparatutto', NULL),
	('Strategico', NULL),
	('Survival', 'Il giocatore accumola risorse e crea strumenti per soppravvivere e progredire'),
	('Terza Persona', NULL);
/*!40000 ALTER TABLE `genere` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.giochi
DROP TABLE IF EXISTS `giochi`;
CREATE TABLE IF NOT EXISTS `giochi` (
  `codice_gioco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titolo` char(50) NOT NULL,
  `descrizione` text NOT NULL,
  `prezzo` float unsigned NOT NULL,
  `pegi` char(2) NOT NULL,
  `software_house` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codice_gioco`),
  KEY `FK_giochi_pegi` (`pegi`),
  KEY `FK_giochi_software_house` (`software_house`),
  CONSTRAINT `FK_giochi_pegi` FOREIGN KEY (`pegi`) REFERENCES `pegi` (`pegi`) ON UPDATE CASCADE,
  CONSTRAINT `FK_giochi_software_house` FOREIGN KEY (`software_house`) REFERENCES `software_house` (`codice_software_house`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.giochi: ~18 rows (circa)
DELETE FROM `giochi`;
/*!40000 ALTER TABLE `giochi` DISABLE KEYS */;
INSERT INTO `giochi` (`codice_gioco`, `titolo`, `descrizione`, `prezzo`, `pegi`, `software_house`) VALUES
	(6, 'Battlefront 2', 'Metti alla prova la tua padronanza di blaster, spada laser e potere della Forza online e offline in STAR WARS™ Battlefront™ II: Celebration Edition.', 39.99, '12', 5),
	(7, 'Red Dead Redemption 2', 'America, 1899. Arthur Morgan e la banda di Van der Linde sono in fuga. Con gli agenti federali e i migliori cacciatori di teste del Paese alle calcagna, la banda deve attraversare il cuore dell\'America, rapinando, rubando e combattendo per sopravvivere. E quando dei confitti interni sempre più profondi minacciano di lacerare il gruppo, Arthur sarà costretto a scegliere tra seguire i propri ideali o restare fedele alla banda che l\'ha cresciuto.', 49.99, '18', 1),
	(9, 'Destiny 2', 'Destiny 2 è un MMO d\'azione con un unico mondo in continua evoluzione, accessibile ovunque, gratuitamente e in qualsiasi momento con gli amici.', 0, '16', 1),
	(10, 'Minecraft', 'Minecraft è un gioco in cui potrai costruire con i blocchi e vivere avventure.', 16.99, ' 7', 1),
	(11, 'Sifu', 'Sifu è il nuovo gioco di Sloclap, lo studio indipendente che ha realizzato Absolver. Un gioco d\'azione in terza persona con intensi combattimenti a mani nude, in cui vestirai i panni di un giovane studente di Kung Fu sulla via della vendetta.', 39.99, '16', 4),
	(13, 'Hitman', 'Divertiti con il parco giochi definitivo dell\'Agente 47 e diventa l\'assassino più letale del mondo. Viaggia in luoghi esotici e elimina i tuoi bersagli con katane, fucili, palline da golf esplosive, sughi per la pasta scaduti e molto altro.', 29.99, '18', 6),
	(14, 'Hitman 2', 'Viaggia in tutto il mondo e rintraccia i tuoi bersagli in fantastici luoghi esotici su HITMAN™ 2. Da strade assolate all\'ombra di pericolose foreste tropicali, nessun luogo è al sicuro dall\'Agente 47, l\'assassino più creativo del mondo, in questo incredibile thriller di spionaggio.', 49.99, '18', 6),
	(15, 'Hitman 3', 'La morte attende. L\'Agente 47 ritorna in HITMAN 3, la drammatica conclusione della trilogia del mondo degli assassini.', 69.99, '18', 6),
	(16, 'Lego star wars the skywalker saga', 'In LEGO® Star Wars™: The Skywalker Saga, la galassia è tua. Vivi momenti memorabili e azione senza fine da tutti i nove film della saga di Skywalker, reinventati nel classico umorismo LEGO.', 59.99, ' 0', 1),
	(17, 'Assassin\'s creed 2', 'Assassin\'s Creed II è il seguito del titolo non derivato da una proprietà intellettuale esistente che ha venduto più rapidamente nella storia dei videogiochi. L\'attesissimo capitolo introduce un nuovo eroe, il giovane nobile italiano Ezio Auditore da Firenze', 29.99, '18', 3),
	(18, 'Far cry 6', 'Ti diamo il benvenuto a Yara, un paradiso tropicale congelato nel tempo. Antón Castillo, dittatore di Yara, vuole riportare la sua nazione alla gloria di un tempo. Per farlo è pronto a tutto, insieme al figlio Diego, che segue le sue orme insanguinate. ', 49.99, '18', 3),
	(19, 'Grand Theft Auto V', 'Un giovane truffatore, un rapinatore di banche in pensione e uno spaventoso psicopatico sono costretti da una serie di difficoltà a mettere in atto una serie di audaci colpi in una città dove non possono fidarsi di nessuno, men che meno l\'uno dell\'altro.', 39.99, '18', 1),
	(20, 'Genshin impact', 'Genshin Impact è un action RPG open world, che ruota attorno alla costruzione ed all\'uso sinergico di un gruppo di quattro elementi, scelti tra i numerosi personaggi disponibili', 0, '12', 1),
	(21, 'Assassin\'s creed odissey', 'Vivi una vera e propria odissea per svelare i segreti del tuo passato, cambia il destino dell\'antica Grecia e diventa una leggenda vivente.', 69.99, '18', 3),
	(22, 'Among us', 'La vita di un astronauta: completa tutti gli incarichi per vincere, ma fai attenzione agli impostori! Segnala i cadaveri e convoca riunioni d\'emergenza per espellere gli impostori. Scegli con attenzione!', 0, ' 0', 1),
	(23, 'Stranger of paradise final fantasy', 'In questo GDR d\'azione duro e puro, Jack affronta numerose sfide per restituire la luce ai Cristalli di Cornelia, regno invaso dall\'oscurità.', 59.99, '16', 1),
	(24, 'Football manager 2022', 'La gestione del calcio non è solo vincere, è superare le avversità e conquistare il successo. Lottare fino a raggiungere la vetta o salvarti dal baratro; sono questi i momenti più belli.', 45, '12', 1),
	(25, 'Rocket league', 'Rocket League è un ibrido arcade che unisce il calcio a una frenetica scorrazzata di veicoli potentissimi, con comandi semplici e gare basate sulle leggi della fisica.', 0, '12', 1);
/*!40000 ALTER TABLE `giochi` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.motivazione_pegi
DROP TABLE IF EXISTS `motivazione_pegi`;
CREATE TABLE IF NOT EXISTS `motivazione_pegi` (
  `codice_gioco` int(11) unsigned NOT NULL,
  `motivazione` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`codice_gioco`,`motivazione`) USING BTREE,
  CONSTRAINT `FK_motivazione_pegi_giochi` FOREIGN KEY (`codice_gioco`) REFERENCES `giochi` (`codice_gioco`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dump dei dati della tabella php_gamestore.motivazione_pegi: ~2 rows (circa)
DELETE FROM `motivazione_pegi`;
/*!40000 ALTER TABLE `motivazione_pegi` DISABLE KEYS */;
INSERT INTO `motivazione_pegi` (`codice_gioco`, `motivazione`) VALUES
	(11, 'Linguaggio scurrile'),
	(11, 'Violenza');
/*!40000 ALTER TABLE `motivazione_pegi` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.pegi
DROP TABLE IF EXISTS `pegi`;
CREATE TABLE IF NOT EXISTS `pegi` (
  `pegi` char(2) NOT NULL DEFAULT 'E',
  `descrizione` tinytext DEFAULT NULL,
  PRIMARY KEY (`pegi`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dump dei dati della tabella php_gamestore.pegi: ~6 rows (circa)
DELETE FROM `pegi`;
/*!40000 ALTER TABLE `pegi` DISABLE KEYS */;
INSERT INTO `pegi` (`pegi`, `descrizione`) VALUES
	(' 0', 'Adatto a tutti'),
	(' 3', 'Adatto dai 3 anni in su'),
	(' 7', 'Adatto dai 7 anni in su'),
	('12', 'Adatto dai 12 anni in su'),
	('16', 'Adatto dai 16 anni in su'),
	('18', 'Adatto ai maggiorenni');
/*!40000 ALTER TABLE `pegi` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.possiede
DROP TABLE IF EXISTS `possiede`;
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

-- Dump dei dati della tabella php_gamestore.possiede: ~0 rows (circa)
DELETE FROM `possiede`;
/*!40000 ALTER TABLE `possiede` DISABLE KEYS */;
INSERT INTO `possiede` (`codice_utente`, `codice_gioco`, `data_acquisto`) VALUES
	(1, 13, '2022-04-14');
/*!40000 ALTER TABLE `possiede` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.recensione
DROP TABLE IF EXISTS `recensione`;
CREATE TABLE IF NOT EXISTS `recensione` (
  `codice_recensione` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `testo` text NOT NULL DEFAULT ' ',
  `valutazione` int(2) unsigned DEFAULT 0,
  `codice_gioco` int(10) unsigned NOT NULL,
  `codice_utente` int(10) unsigned NOT NULL,
  PRIMARY KEY (`codice_recensione`),
  KEY `FK_recensione_giochi` (`codice_gioco`),
  KEY `FK_recensione_account` (`codice_utente`),
  CONSTRAINT `FK_recensione_account` FOREIGN KEY (`codice_utente`) REFERENCES `account` (`codice_utente`) ON UPDATE CASCADE,
  CONSTRAINT `FK_recensione_giochi` FOREIGN KEY (`codice_gioco`) REFERENCES `giochi` (`codice_gioco`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.recensione: ~0 rows (circa)
DELETE FROM `recensione`;
/*!40000 ALTER TABLE `recensione` DISABLE KEYS */;
/*!40000 ALTER TABLE `recensione` ENABLE KEYS */;

-- Dump della struttura di tabella php_gamestore.software_house
DROP TABLE IF EXISTS `software_house`;
CREATE TABLE IF NOT EXISTS `software_house` (
  `codice_software_house` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` char(50) NOT NULL DEFAULT '',
  `telefono` char(13) NOT NULL DEFAULT '',
  `email` char(50) NOT NULL DEFAULT '',
  `nazionalita` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`codice_software_house`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dump dei dati della tabella php_gamestore.software_house: ~6 rows (circa)
DELETE FROM `software_house`;
/*!40000 ALTER TABLE `software_house` DISABLE KEYS */;
INSERT INTO `software_house` (`codice_software_house`, `nome`, `telefono`, `email`, `nazionalita`) VALUES
	(1, 'Rockstar Games', '+122346759476', 'rockstar.games@gmail.com', 'svedese'),
	(2, 'Square Enix', '+346752987465', 'square.enix@gmail.com', 'francese'),
	(3, 'Ubisoft', '+567894326475', 'ubisoft@gmail.com', 'messicana'),
	(4, 'Sloclap', '', '', ''),
	(5, 'Eletronic Arts', '', 'ea@gmail.com', 'americana'),
	(6, 'IOI interactive', '', 'ioisupport@gmail.com', 'americana');
/*!40000 ALTER TABLE `software_house` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
