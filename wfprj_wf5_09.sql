-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: i-intra-03.informatik.hs-ulm.de
-- Erstellungszeit: 07. Mai 2015 um 12:57
-- Server Version: 5.6.14-log
-- PHP-Version: 5.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `wfprj_wf5_09`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `adresse_ID` int(11) NOT NULL AUTO_INCREMENT,
  `straßenname` varchar(45) NOT NULL,
  `hausnummer` int(11) NOT NULL,
  `stadt` varchar(45) NOT NULL,
  `land` varchar(45) NOT NULL,
  `plz` int(11) NOT NULL,
  `nutzer_name` varchar(45) DEFAULT NULL,
  `geb_bezeichnung` char(1) DEFAULT NULL,
  PRIMARY KEY (`adresse_ID`),
  KEY `geb_bezeichnung` (`geb_bezeichnung`),
  KEY `nutzer_name` (`nutzer_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`adresse_ID`, `straßenname`, `hausnummer`, `stadt`, `land`, `plz`, `nutzer_name`, `geb_bezeichnung`) VALUES
(1, 'Prittwitzstraße', 10, 'Ulm', 'Deutschland', 89075, NULL, '1'),
(2, 'Albert-Einstein-Allee', 55, 'Ulm', 'Deutschland', 89081, NULL, '2'),
(3, 'Eberhard-Finckh Straße', 11, 'Ulm', 'Deutschland', 89075, NULL, '3'),
(4, 'Frauenstraße', 113, 'Ulm', 'Deutschland', 89073, 'userTestStudent', NULL),
(5, 'Schaffnerstraße', 5, 'Ulm', 'Deutschland', 89073, 'userTestDozent', NULL),
(6, 'Traminerweg', 72, 'Ulm', 'Deutschland', 89075, 'userTestMitarbeiter', NULL),
(7, 'Eberhardtstraße', 85, 'Ulm', 'Deutschland', 89073, 'userTestTutor', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ausstattung`
--

CREATE TABLE IF NOT EXISTS `ausstattung` (
  `ausstattung_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ausstattung_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`ausstattung_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `ausstattung`
--

INSERT INTO `ausstattung` (`ausstattung_ID`, `ausstattung_bezeichnung`) VALUES
(1, 'Stuhl'),
(2, 'Computer'),
(3, 'Beamer'),
(4, 'Projektor'),
(5, 'Overheadprojektor'),
(6, 'Praesentations-Computer'),
(7, 'HDMI-Anschluss'),
(8, 'Whiteboard'),
(9, 'Kreidetafel'),
(10, 'Telefon');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bibliothek`
--

CREATE TABLE IF NOT EXISTS `bibliothek` (
  `raum_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bibliothek_hat_buchkategorie`
--

CREATE TABLE IF NOT EXISTS `bibliothek_hat_buchkategorie` (
  `buchKat_ID` int(11) NOT NULL,
  `raum_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`buchKat_ID`,`raum_bezeichnung`),
  KEY `raum_bezeichnung` (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buchkategorie`
--

CREATE TABLE IF NOT EXISTS `buchkategorie` (
  `buchKat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `buchKat_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`buchKat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `buero`
--

CREATE TABLE IF NOT EXISTS `buero` (
  `raum_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigenschaft`
--

CREATE TABLE IF NOT EXISTS `eigenschaft` (
  `eigenschaft_ID` int(11) NOT NULL AUTO_INCREMENT,
  `eigenschaft_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`eigenschaft_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `eigenschaft`
--

INSERT INTO `eigenschaft` (`eigenschaft_ID`, `eigenschaft_bezeichnung`) VALUES
(1, 'username'),
(2, 'matrNr'),
(3, 'vorname'),
(4, 'nachname'),
(5, 'idAdresse'),
(6, 'rechte'),
(7, 'telefonnummer'),
(8, 'fakultät'),
(9, 'dozent'),
(10, 'studiengang');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `email_name` varchar(45) NOT NULL,
  `nutzer_name` varchar(45) NOT NULL,
  PRIMARY KEY (`email_name`),
  KEY `nutzer_name` (`nutzer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `email`
--

INSERT INTO `email` (`email_name`, `nutzer_name`) VALUES
('userTestDozent@hs-ulm.de', 'userTestDozent'),
('userTestMitarbeiter@hs-ulm.de', 'userTestMitarbeiter'),
('userTestStudent@hs-ulm.de', 'userTestStudent'),
('userTestTutor@hs-ulm.de', 'userTestTutor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fakultaet`
--

CREATE TABLE IF NOT EXISTS `fakultaet` (
  `fak_ID` int(11) NOT NULL AUTO_INCREMENT,
  `fak_bezeichnung` varchar(100) NOT NULL,
  PRIMARY KEY (`fak_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `fakultaet`
--

INSERT INTO `fakultaet` (`fak_ID`, `fak_bezeichnung`) VALUES
(1, 'Elektrotechnik und Informationstechnik'),
(2, 'Mathematik, Natur- und Wirtschaftswissenschaften'),
(3, 'Informatik'),
(4, 'Maschinenbau und Fahrzeugtechnik'),
(5, 'Produktionstechnik und Produktionswirtschaft'),
(6, 'Mechatronik und Medizintechnik');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gebaeude`
--

CREATE TABLE IF NOT EXISTS `gebaeude` (
  `geb_bezeichnung` char(1) NOT NULL,
  PRIMARY KEY (`geb_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `gebaeude`
--

INSERT INTO `gebaeude` (`geb_bezeichnung`) VALUES
('1'),
('2'),
('3');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laborart`
--

CREATE TABLE IF NOT EXISTS `laborart` (
  `lArt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `lArt_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`lArt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `laborart`
--

INSERT INTO `laborart` (`lArt_ID`, `lArt_bezeichnung`) VALUES
(1, 'Rechnerlabor'),
(2, 'Chemielabor'),
(3, 'Physiklabor'),
(4, 'Strahlenlabor'),
(5, 'Maschinenbaulabor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laborraum`
--

CREATE TABLE IF NOT EXISTS `laborraum` (
  `raum_bezeichnung` varchar(45) NOT NULL,
  `lArt_ID` int(11) NOT NULL,
  PRIMARY KEY (`raum_bezeichnung`),
  KEY `lArt_ID` (`lArt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `laborraum`
--

INSERT INTO `laborraum` (`raum_bezeichnung`, `lArt_ID`) VALUES
('B107', 1),
('Q209', 2),
('B055', 3),
('Z107', 4),
('F007', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `laborraum_hat_ausstattung`
--

CREATE TABLE IF NOT EXISTS `laborraum_hat_ausstattung` (
  `ausstattung_ID` int(11) NOT NULL,
  `raum_bezeichnung` varchar(45) NOT NULL,
  `anzahl` int(11) NOT NULL,
  PRIMARY KEY (`ausstattung_ID`,`raum_bezeichnung`),
  KEY `raum_bezeichnung` (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `laborraum_hat_ausstattung`
--

INSERT INTO `laborraum_hat_ausstattung` (`ausstattung_ID`, `raum_bezeichnung`, `anzahl`) VALUES
(1, 'B055', 20),
(1, 'B107', 30),
(1, 'F007', 20),
(1, 'Q209', 20),
(1, 'Z107', 20),
(2, 'B055', 0),
(2, 'B107', 30),
(2, 'F007', 0),
(2, 'Q209', 0),
(2, 'Z107', 0),
(3, 'B055', 1),
(3, 'B107', 1),
(3, 'F007', 1),
(3, 'Q209', 1),
(3, 'Z107', 1),
(4, 'B055', 1),
(4, 'B107', 1),
(4, 'F007', 1),
(4, 'Q209', 1),
(4, 'Z107', 1),
(5, 'B055', 1),
(5, 'B107', 1),
(5, 'F007', 1),
(5, 'Q209', 1),
(5, 'Z107', 1),
(6, 'B055', 0),
(6, 'B107', 0),
(6, 'F007', 1),
(6, 'Q209', 0),
(6, 'Z107', 1),
(7, 'B055', 1),
(7, 'B107', 1),
(7, 'F007', 1),
(7, 'Q209', 1),
(7, 'Z107', 1),
(8, 'B055', 1),
(8, 'B107', 1),
(8, 'F007', 1),
(8, 'Q209', 1),
(8, 'Z107', 1),
(9, 'B055', 0),
(9, 'B107', 0),
(9, 'F007', 0),
(9, 'Q209', 0),
(9, 'Z107', 0),
(10, 'B055', 0),
(10, 'B107', 0),
(10, 'F007', 0),
(10, 'Q209', 0),
(10, 'Z107', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE IF NOT EXISTS `nutzer` (
  `nutzer_name` varchar(45) NOT NULL,
  `passwortHash` varchar(255) DEFAULT NULL,
  `letzterLogin` datetime DEFAULT NULL,
  `rolle_ID` int(11) NOT NULL,
  PRIMARY KEY (`nutzer_name`),
  KEY `rolle_ID` (`rolle_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`nutzer_name`, `passwortHash`, `letzterLogin`, `rolle_ID`) VALUES
('dozent', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', NULL, 2),
('mitarbeiter', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', NULL, 3),
('student', '$2y$10$8pEgYNZX7GW8FYfp8Mzbz.g./61axiS/wx2np.bWw92N361fBFNp6', NULL, 1),
('tutor', '$2y$10$kflo8og3yPg0cquTGK6nY.HOkx6JVjMGK8Dja4XXIzWURmZBVleZ6', NULL, 4),
('userTestDozent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 2),
('userTestMitarbeiter', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 3),
('userTestStudent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 1),
('userTestTutor', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `raum`
--

CREATE TABLE IF NOT EXISTS `raum` (
  `raum_bezeichnung` varchar(45) NOT NULL,
  `geb_bezeichnung` char(1) NOT NULL,
  PRIMARY KEY (`raum_bezeichnung`),
  KEY `geb_bezeichnung` (`geb_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `raum`
--

INSERT INTO `raum` (`raum_bezeichnung`, `geb_bezeichnung`) VALUES
('A100', '1'),
('A101', '1'),
('A102', '1'),
('A103', '1'),
('A104', '1'),
('B055', '1'),
('B107', '1'),
('F007', '1'),
('Q027', '2'),
('Q209', '2'),
('V001', '2'),
('V101', '2'),
('Z107', '3');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rolle`
--

CREATE TABLE IF NOT EXISTS `rolle` (
  `rolle_ID` int(11) NOT NULL AUTO_INCREMENT,
  `rolle_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`rolle_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `rolle`
--

INSERT INTO `rolle` (`rolle_ID`, `rolle_bezeichnung`) VALUES
(1, 'Student'),
(2, 'Dozent'),
(3, 'Mitarbeiter'),
(4, 'Tutor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rolle_hat_eigenschaft`
--

CREATE TABLE IF NOT EXISTS `rolle_hat_eigenschaft` (
  `eigenschaft_ID` int(11) NOT NULL,
  `rolle_ID` int(11) NOT NULL,
  `reihenfolge` int(11) DEFAULT NULL,
  PRIMARY KEY (`eigenschaft_ID`,`rolle_ID`),
  KEY `rolle_ID` (`rolle_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rolle_hat_eigenschaft`
--

INSERT INTO `rolle_hat_eigenschaft` (`eigenschaft_ID`, `rolle_ID`, `reihenfolge`) VALUES
(1, 1, 4),
(1, 2, 3),
(1, 3, 3),
(1, 4, 3),
(2, 1, 3),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 1),
(4, 1, 2),
(4, 2, 2),
(4, 3, 2),
(4, 4, 2),
(5, 1, 5),
(5, 2, 4),
(5, 3, 5),
(5, 4, 4),
(6, 1, 7),
(6, 2, 6),
(6, 3, 6),
(6, 4, 6),
(7, 1, 6),
(7, 2, 5),
(7, 3, 7),
(7, 4, 5),
(8, 1, 8),
(8, 2, 7),
(8, 4, 7),
(9, 4, 8),
(10, 1, 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student_extended`
--
-- in Benutzung(#1356 - View 'wfprj_wf5_09.student_extended' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)
-- Fehler beim Lesen der Daten: (#1356 - View 'wfprj_wf5_09.student_extended' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiengang`
--

CREATE TABLE IF NOT EXISTS `studiengang` (
  `stg_ID` int(11) NOT NULL AUTO_INCREMENT,
  `stg_bezeichnung` varchar(100) NOT NULL,
  `stgTyp_ID` int(11) NOT NULL,
  `fak_ID` int(11) NOT NULL,
  PRIMARY KEY (`stg_ID`),
  KEY `stgTyp_ID` (`stgTyp_ID`),
  KEY `fak_ID` (`fak_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `studiengang`
--

INSERT INTO `studiengang` (`stg_ID`, `stg_bezeichnung`, `stgTyp_ID`, `fak_ID`) VALUES
(1, 'Technische Informatik', 1, 3),
(2, 'Wirtschaftsinformatik', 1, 3),
(3, 'Medizintechnik', 1, 6),
(4, 'Maschinenbau', 1, 4),
(5, 'Information Systems', 2, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiengangtyp`
--

CREATE TABLE IF NOT EXISTS `studiengangtyp` (
  `stgTyp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `stgTyp_bezeichnung` varchar(45) NOT NULL,
  `stgTyp_kuerzel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`stgTyp_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `studiengangtyp`
--

INSERT INTO `studiengangtyp` (`stgTyp_ID`, `stgTyp_bezeichnung`, `stgTyp_kuerzel`) VALUES
(1, 'Bachelor', 'BA'),
(2, 'Master of Science', 'M.Sc.'),
(3, 'Master of Arts', 'M.A.');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `studiengang_hat_veranstaltung`
--

CREATE TABLE IF NOT EXISTS `studiengang_hat_veranstaltung` (
  `stg_ID` int(11) NOT NULL,
  `veranst_ID` int(11) NOT NULL,
  `pflicht` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`stg_ID`,`veranst_ID`),
  KEY `veranst_ID` (`veranst_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `studiengang_hat_veranstaltung`
--

INSERT INTO `studiengang_hat_veranstaltung` (`stg_ID`, `veranst_ID`, `pflicht`) VALUES
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 10, 1),
(4, 9, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stundenzeit`
--

CREATE TABLE IF NOT EXISTS `stundenzeit` (
  `stdZeit_ID` int(11) NOT NULL AUTO_INCREMENT,
  `stdZeit_von` time NOT NULL,
  `stdZeit_bis` time NOT NULL,
  PRIMARY KEY (`stdZeit_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `stundenzeit`
--

INSERT INTO `stundenzeit` (`stdZeit_ID`, `stdZeit_von`, `stdZeit_bis`) VALUES
(1, '08:00:00', '09:30:00'),
(2, '09:50:00', '11:20:00'),
(3, '11:30:00', '13:00:00'),
(4, '14:00:00', '15:30:00'),
(5, '15:45:00', '17:15:00'),
(6, '17:25:00', '18:55:00'),
(7, '19:00:00', '20:30:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_beteiligtan_veranstaltung`
--

CREATE TABLE IF NOT EXISTS `user_beteiligtan_veranstaltung` (
  `veranst_ID` int(11) NOT NULL,
  `nutzer_name` varchar(45) NOT NULL,
  PRIMARY KEY (`veranst_ID`,`nutzer_name`),
  KEY `nutzer_name` (`nutzer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_beteiligtan_veranstaltung`
--

INSERT INTO `user_beteiligtan_veranstaltung` (`veranst_ID`, `nutzer_name`) VALUES
(1, 'dozent'),
(2, 'dozent'),
(3, 'dozent'),
(5, 'mitarbeiter'),
(1, 'student'),
(2, 'student'),
(1, 'tutor'),
(2, 'userTestStudent'),
(1, 'userTestTutor');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veranstaltung`
--

CREATE TABLE IF NOT EXISTS `veranstaltung` (
  `veranst_ID` int(11) NOT NULL AUTO_INCREMENT,
  `veranst_bezeichnung` varchar(100) NOT NULL,
  `veranst_kurztext` varchar(45) DEFAULT NULL,
  `credits` int(11) NOT NULL,
  `SWS` int(11) NOT NULL,
  `maxTeilnehmer` int(11) DEFAULT NULL,
  `vArt_ID` int(11) NOT NULL,
  PRIMARY KEY (`veranst_ID`),
  KEY `vArt_ID` (`vArt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `veranstaltung`
--

INSERT INTO `veranstaltung` (`veranst_ID`, `veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, `maxTeilnehmer`, `vArt_ID`) VALUES
(1, 'Programmieren 1', 'Prog1', 5, 4, 32, 18),
(2, 'Programmieren 2', 'Prog2', 5, 4, 32, 18),
(3, 'Rechnernetze', 'RNET', 5, 4, 30, 16),
(4, 'Seminar Wirtschaftsinformatik', 'SEMWIF', 4, 2, 30, 10),
(5, 'Database Programming', 'DAPRO', 5, 4, 30, 17),
(6, 'Physik 1', 'PH1', 5, 4, 30, 16),
(7, 'Chemie 1', 'CH1', 5, 4, 30, 16),
(8, 'Strahlentechnik', 'STechnik', 5, 4, 30, 16),
(9, 'Maschinenbau Grundlagen', 'MBau-GRDL', 5, 4, 30, 16),
(10, 'Studium als Projekt', 'SAPR', 2, 1, 60, 1),
(11, 'Geschäftsprozessmanagement', 'GPM', 5, 4, 40, 18),
(12, 'Software Engineering', 'SOFEN', 5, 5, 30, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veranstaltungsart`
--

CREATE TABLE IF NOT EXISTS `veranstaltungsart` (
  `vArt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `vArt_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`vArt_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `veranstaltungsart`
--

INSERT INTO `veranstaltungsart` (`vArt_ID`, `vArt_bezeichnung`) VALUES
(1, 'Blockveranstaltung'),
(2, 'Kurs'),
(3, 'Labor'),
(4, 'Labor/Seminar'),
(5, 'Praktikum'),
(6, 'Praktische Übung'),
(7, 'Praxissemester'),
(8, 'Projekt'),
(9, 'Projektgruppe'),
(10, 'Seminar'),
(11, 'Seminar/Vorlesung'),
(12, 'Sonstiges'),
(13, 'Tutorium'),
(14, 'Übung'),
(15, 'Vorlesung'),
(16, 'Vorlesung/Labor'),
(17, 'Vorlesung/Projekt'),
(18, 'Vorlesung/Übung'),
(19, 'Zusatzübung');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veranstaltungstermin`
--

CREATE TABLE IF NOT EXISTS `veranstaltungstermin` (
  `veranst_ID` int(11) NOT NULL,
  `tag_ID` int(11) NOT NULL,
  `stdZeit_ID` int(11) NOT NULL,
  `raum_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`veranst_ID`,`tag_ID`,`stdZeit_ID`),
  KEY `stdZeit_ID` (`stdZeit_ID`),
  KEY `tag_ID` (`tag_ID`),
  KEY `raum_bezeichnung` (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `veranstaltungstermin`
--

INSERT INTO `veranstaltungstermin` (`veranst_ID`, `tag_ID`, `stdZeit_ID`, `raum_bezeichnung`) VALUES
(1, 1, 1, 'A100'),
(1, 1, 2, 'A100'),
(1, 1, 3, 'A100'),
(4, 3, 1, 'A100'),
(4, 3, 2, 'A100'),
(4, 3, 3, 'A100'),
(10, 3, 4, 'A101'),
(10, 3, 5, 'A101'),
(2, 1, 2, 'A102'),
(2, 1, 3, 'A102'),
(2, 5, 1, 'A102'),
(11, 5, 2, 'A102'),
(11, 5, 3, 'A102'),
(11, 5, 4, 'A102'),
(11, 5, 5, 'A102'),
(6, 2, 2, 'B055'),
(6, 2, 3, 'B055'),
(6, 4, 4, 'B055'),
(6, 4, 5, 'B055'),
(3, 1, 1, 'B107'),
(3, 1, 2, 'B107'),
(3, 1, 3, 'B107'),
(9, 1, 1, 'F007'),
(9, 1, 2, 'F007'),
(9, 1, 3, 'F007'),
(12, 2, 4, 'Q027'),
(12, 2, 5, 'Q027'),
(7, 3, 1, 'Q209'),
(7, 3, 2, 'Q209'),
(7, 3, 3, 'Q209'),
(5, 4, 1, 'V001'),
(5, 4, 2, 'V001'),
(5, 4, 3, 'V001'),
(8, 5, 2, 'Z107'),
(8, 5, 3, 'Z107');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `veranstaltung_erfordert_ausstattung`
--

CREATE TABLE IF NOT EXISTS `veranstaltung_erfordert_ausstattung` (
  `veranst_ID` int(11) NOT NULL,
  `ausstattung_ID` int(11) NOT NULL,
  `anzahl` int(11) NOT NULL,
  PRIMARY KEY (`veranst_ID`,`ausstattung_ID`),
  KEY `ausstattung_ID` (`ausstattung_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `veranstaltung_erfordert_ausstattung`
--

INSERT INTO `veranstaltung_erfordert_ausstattung` (`veranst_ID`, `ausstattung_ID`, `anzahl`) VALUES
(1, 1, 32),
(1, 2, 0),
(1, 3, 1),
(1, 4, 1),
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 0),
(1, 10, 0),
(2, 1, 32),
(2, 2, 32),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 8, 1),
(2, 9, 0),
(2, 10, 0),
(3, 1, 30),
(3, 2, 30),
(3, 3, 1),
(3, 4, 1),
(3, 5, 1),
(3, 6, 0),
(3, 7, 1),
(3, 8, 1),
(3, 9, 0),
(3, 10, 0),
(4, 1, 30),
(4, 2, 0),
(4, 3, 1),
(4, 4, 1),
(4, 5, 1),
(4, 6, 1),
(4, 7, 1),
(4, 8, 1),
(4, 9, 0),
(4, 10, 0),
(5, 1, 30),
(5, 2, 30),
(5, 3, 1),
(5, 4, 1),
(5, 5, 1),
(5, 6, 1),
(5, 7, 1),
(5, 8, 1),
(5, 9, 0),
(5, 10, 0),
(6, 1, 20),
(6, 2, 0),
(6, 3, 1),
(6, 4, 1),
(6, 5, 1),
(6, 6, 0),
(6, 7, 1),
(6, 8, 1),
(6, 9, 0),
(6, 10, 0),
(7, 1, 20),
(7, 2, 0),
(7, 3, 1),
(7, 4, 1),
(7, 5, 1),
(7, 6, 0),
(7, 7, 1),
(7, 8, 1),
(7, 9, 0),
(7, 10, 0),
(8, 1, 20),
(8, 2, 0),
(8, 3, 1),
(8, 4, 1),
(8, 5, 1),
(8, 6, 1),
(8, 7, 1),
(8, 8, 1),
(8, 9, 0),
(8, 10, 0),
(9, 1, 20),
(9, 2, 0),
(9, 3, 1),
(9, 4, 1),
(9, 5, 1),
(9, 6, 1),
(9, 7, 1),
(9, 8, 1),
(9, 9, 0),
(9, 10, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorlesungsraum`
--

CREATE TABLE IF NOT EXISTS `vorlesungsraum` (
  `raum_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vorlesungsraum`
--

INSERT INTO `vorlesungsraum` (`raum_bezeichnung`) VALUES
('A100'),
('A101'),
('A102'),
('A103'),
('A104'),
('Q027'),
('V001'),
('V101');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vorlesungsraum_hat_ausstattung`
--

CREATE TABLE IF NOT EXISTS `vorlesungsraum_hat_ausstattung` (
  `ausstattung_ID` int(11) NOT NULL,
  `raum_bezeichnung` varchar(45) NOT NULL,
  `anzahl` int(11) NOT NULL,
  PRIMARY KEY (`ausstattung_ID`,`raum_bezeichnung`),
  KEY `raum_bezeichnung` (`raum_bezeichnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `vorlesungsraum_hat_ausstattung`
--

INSERT INTO `vorlesungsraum_hat_ausstattung` (`ausstattung_ID`, `raum_bezeichnung`, `anzahl`) VALUES
(1, 'A100', 40),
(1, 'A101', 60),
(1, 'A102', 40),
(1, 'A103', 30),
(1, 'A104', 40),
(1, 'Q027', 30),
(1, 'V001', 40),
(1, 'V101', 40),
(2, 'A100', 0),
(2, 'A101', 0),
(2, 'A102', 40),
(2, 'A103', 0),
(2, 'A104', 0),
(2, 'Q027', 30),
(2, 'V001', 40),
(2, 'V101', 0),
(3, 'A100', 1),
(3, 'A101', 1),
(3, 'A102', 1),
(3, 'A103', 1),
(3, 'A104', 1),
(3, 'Q027', 1),
(3, 'V001', 1),
(3, 'V101', 1),
(4, 'A100', 1),
(4, 'A101', 1),
(4, 'A102', 1),
(4, 'A103', 1),
(4, 'A104', 1),
(4, 'Q027', 1),
(4, 'V001', 1),
(4, 'V101', 1),
(5, 'A100', 1),
(5, 'A101', 1),
(5, 'A102', 1),
(5, 'A103', 1),
(5, 'A104', 1),
(5, 'Q027', 1),
(5, 'V001', 1),
(5, 'V101', 1),
(6, 'A100', 1),
(6, 'A101', 1),
(6, 'A102', 1),
(6, 'A103', 1),
(6, 'A104', 1),
(6, 'Q027', 1),
(6, 'V001', 1),
(6, 'V101', 1),
(7, 'A100', 1),
(7, 'A101', 1),
(7, 'A102', 1),
(7, 'A103', 1),
(7, 'A104', 1),
(7, 'Q027', 1),
(7, 'V001', 1),
(7, 'V101', 1),
(8, 'A100', 1),
(8, 'A101', 1),
(8, 'A102', 1),
(8, 'A103', 1),
(8, 'A104', 1),
(8, 'Q027', 1),
(8, 'V001', 1),
(8, 'V101', 1),
(9, 'A100', 0),
(9, 'A101', 0),
(9, 'A102', 0),
(9, 'A103', 0),
(9, 'A104', 0),
(9, 'Q027', 0),
(9, 'V001', 0),
(9, 'V101', 0),
(10, 'A100', 0),
(10, 'A101', 0),
(10, 'A102', 0),
(10, 'A103', 0),
(10, 'A104', 0),
(10, 'Q027', 0),
(10, 'V001', 0),
(10, 'V101', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wert`
--

CREATE TABLE IF NOT EXISTS `wert` (
  `eigenschaft_ID` int(11) NOT NULL,
  `nutzer_name` varchar(45) NOT NULL,
  `inhalt` varchar(45) NOT NULL,
  PRIMARY KEY (`eigenschaft_ID`,`nutzer_name`),
  KEY `nutzer_name` (`nutzer_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `wert`
--

INSERT INTO `wert` (`eigenschaft_ID`, `nutzer_name`, `inhalt`) VALUES
(2, 'userTestStudent', '3112493'),
(3, 'userTestDozent', 'vornameTestDozent'),
(3, 'userTestMitarbeiter', 'vornameTestMitarbeiter'),
(3, 'userTestStudent', 'vornameTestStudent'),
(3, 'userTestTutor', 'vornameTestTutor'),
(4, 'userTestDozent', 'nachnameTestDozent'),
(4, 'userTestMitarbeiter', 'nachnameTestMitarbeiter'),
(4, 'userTestStudent', 'nachnameTestStudent'),
(4, 'userTestTutor', 'nachnameTestTutor'),
(5, 'userTestDozent', '5'),
(5, 'userTestMitarbeiter', '6'),
(5, 'userTestStudent', '4'),
(5, 'userTestTutor', '7'),
(6, 'userTestDozent', '0'),
(6, 'userTestMitarbeiter', '0'),
(6, 'userTestStudent', '0'),
(6, 'userTestTutor', '0'),
(7, 'userTestDozent', '0731 12398123'),
(7, 'userTestMitarbeiter', '0731 237252342'),
(7, 'userTestStudent', '0731 12345678'),
(7, 'userTestTutor', '0731 812371231'),
(8, 'userTestDozent', 'Informatik'),
(8, 'userTestStudent', 'Informatik'),
(10, 'userTestStudent', 'WF');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wochentag`
--

CREATE TABLE IF NOT EXISTS `wochentag` (
  `tag_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tag_bezeichnung` varchar(45) NOT NULL,
  PRIMARY KEY (`tag_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `wochentag`
--

INSERT INTO `wochentag` (`tag_ID`, `tag_bezeichnung`) VALUES
(1, 'Montag'),
(2, 'Dienstag'),
(3, 'Mittwoch'),
(4, 'Donnerstag'),
(5, 'Freitag'),
(6, 'Samstag'),
(7, 'Sonntag');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `adresse_ibfk_1` FOREIGN KEY (`geb_bezeichnung`) REFERENCES `gebaeude` (`geb_bezeichnung`),
  ADD CONSTRAINT `adresse_ibfk_2` FOREIGN KEY (`nutzer_name`) REFERENCES `nutzer` (`nutzer_name`);

--
-- Constraints der Tabelle `bibliothek`
--
ALTER TABLE `bibliothek`
  ADD CONSTRAINT `bibliothek_ibfk_1` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `raum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `bibliothek_hat_buchkategorie`
--
ALTER TABLE `bibliothek_hat_buchkategorie`
  ADD CONSTRAINT `bibliothek_hat_buchkategorie_ibfk_1` FOREIGN KEY (`buchKat_ID`) REFERENCES `buchkategorie` (`buchKat_ID`),
  ADD CONSTRAINT `bibliothek_hat_buchkategorie_ibfk_2` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `bibliothek` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `buero`
--
ALTER TABLE `buero`
  ADD CONSTRAINT `buero_ibfk_1` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `raum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`nutzer_name`) REFERENCES `nutzer` (`nutzer_name`);

--
-- Constraints der Tabelle `laborraum`
--
ALTER TABLE `laborraum`
  ADD CONSTRAINT `laborraum_ibfk_1` FOREIGN KEY (`lArt_ID`) REFERENCES `laborart` (`lArt_ID`),
  ADD CONSTRAINT `laborraum_ibfk_2` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `raum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `laborraum_hat_ausstattung`
--
ALTER TABLE `laborraum_hat_ausstattung`
  ADD CONSTRAINT `laborraum_hat_ausstattung_ibfk_1` FOREIGN KEY (`ausstattung_ID`) REFERENCES `ausstattung` (`ausstattung_ID`),
  ADD CONSTRAINT `laborraum_hat_ausstattung_ibfk_2` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `laborraum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD CONSTRAINT `nutzer_ibfk_1` FOREIGN KEY (`rolle_ID`) REFERENCES `rolle` (`rolle_ID`);

--
-- Constraints der Tabelle `raum`
--
ALTER TABLE `raum`
  ADD CONSTRAINT `raum_ibfk_1` FOREIGN KEY (`geb_bezeichnung`) REFERENCES `gebaeude` (`geb_bezeichnung`);

--
-- Constraints der Tabelle `rolle_hat_eigenschaft`
--
ALTER TABLE `rolle_hat_eigenschaft`
  ADD CONSTRAINT `rolle_hat_eigenschaft_ibfk_1` FOREIGN KEY (`eigenschaft_ID`) REFERENCES `eigenschaft` (`eigenschaft_ID`),
  ADD CONSTRAINT `rolle_hat_eigenschaft_ibfk_2` FOREIGN KEY (`rolle_ID`) REFERENCES `rolle` (`rolle_ID`);

--
-- Constraints der Tabelle `studiengang`
--
ALTER TABLE `studiengang`
  ADD CONSTRAINT `studiengang_ibfk_1` FOREIGN KEY (`stgTyp_ID`) REFERENCES `studiengangtyp` (`stgTyp_ID`),
  ADD CONSTRAINT `studiengang_ibfk_2` FOREIGN KEY (`fak_ID`) REFERENCES `fakultaet` (`fak_ID`);

--
-- Constraints der Tabelle `studiengang_hat_veranstaltung`
--
ALTER TABLE `studiengang_hat_veranstaltung`
  ADD CONSTRAINT `studiengang_hat_veranstaltung_ibfk_1` FOREIGN KEY (`stg_ID`) REFERENCES `studiengang` (`stg_ID`),
  ADD CONSTRAINT `studiengang_hat_veranstaltung_ibfk_2` FOREIGN KEY (`veranst_ID`) REFERENCES `veranstaltung` (`veranst_ID`);

--
-- Constraints der Tabelle `user_beteiligtan_veranstaltung`
--
ALTER TABLE `user_beteiligtan_veranstaltung`
  ADD CONSTRAINT `user_beteiligtan_veranstaltung_ibfk_1` FOREIGN KEY (`veranst_ID`) REFERENCES `veranstaltung` (`veranst_ID`),
  ADD CONSTRAINT `user_beteiligtan_veranstaltung_ibfk_2` FOREIGN KEY (`nutzer_name`) REFERENCES `nutzer` (`nutzer_name`);

--
-- Constraints der Tabelle `veranstaltung`
--
ALTER TABLE `veranstaltung`
  ADD CONSTRAINT `veranstaltung_ibfk_1` FOREIGN KEY (`vArt_ID`) REFERENCES `veranstaltungsart` (`vArt_ID`);

--
-- Constraints der Tabelle `veranstaltungstermin`
--
ALTER TABLE `veranstaltungstermin`
  ADD CONSTRAINT `veranstaltungstermin_ibfk_1` FOREIGN KEY (`stdZeit_ID`) REFERENCES `stundenzeit` (`stdZeit_ID`),
  ADD CONSTRAINT `veranstaltungstermin_ibfk_2` FOREIGN KEY (`tag_ID`) REFERENCES `wochentag` (`tag_ID`),
  ADD CONSTRAINT `veranstaltungstermin_ibfk_3` FOREIGN KEY (`veranst_ID`) REFERENCES `veranstaltung` (`veranst_ID`),
  ADD CONSTRAINT `veranstaltungstermin_ibfk_4` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `raum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `veranstaltung_erfordert_ausstattung`
--
ALTER TABLE `veranstaltung_erfordert_ausstattung`
  ADD CONSTRAINT `veranstaltung_erfordert_ausstattung_ibfk_1` FOREIGN KEY (`ausstattung_ID`) REFERENCES `ausstattung` (`ausstattung_ID`),
  ADD CONSTRAINT `veranstaltung_erfordert_ausstattung_ibfk_2` FOREIGN KEY (`veranst_ID`) REFERENCES `veranstaltung` (`veranst_ID`);

--
-- Constraints der Tabelle `vorlesungsraum`
--
ALTER TABLE `vorlesungsraum`
  ADD CONSTRAINT `vorlesungsraum_ibfk_1` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `raum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `vorlesungsraum_hat_ausstattung`
--
ALTER TABLE `vorlesungsraum_hat_ausstattung`
  ADD CONSTRAINT `vorlesungsraum_hat_ausstattung_ibfk_1` FOREIGN KEY (`ausstattung_ID`) REFERENCES `ausstattung` (`ausstattung_ID`),
  ADD CONSTRAINT `vorlesungsraum_hat_ausstattung_ibfk_2` FOREIGN KEY (`raum_bezeichnung`) REFERENCES `vorlesungsraum` (`raum_bezeichnung`);

--
-- Constraints der Tabelle `wert`
--
ALTER TABLE `wert`
  ADD CONSTRAINT `wert_ibfk_1` FOREIGN KEY (`eigenschaft_ID`) REFERENCES `eigenschaft` (`eigenschaft_ID`),
  ADD CONSTRAINT `wert_ibfk_2` FOREIGN KEY (`nutzer_name`) REFERENCES `nutzer` (`nutzer_name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
