/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				23.06.2015
	
	********************************************************************************************************************
	
	- User Story (Nr. 650):	Als Mitarbeiter möchte ich festlegen können, welcher Dozent welche Veranstaltungen halten kann.
	- User Story Punkte:	5
	- Task 650.1:			Insert-Statement erstellen
	- Zeitaufwand:			0.1h
*/

/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				09.06.2015
	
	********************************************************************************************************************
	
	- User Story (Nr. 520):	Als Entwickler möchte ich genügend Spiel-/Testdaten zur Verfügung haben.
	- User Story Punkte:	3
	- Task 520.1:			Insert-Statements an die veränderte Tabellenstruktur anpassen.
	- Zeitaufwand:			2h
	
	//////////
	
	- User Story (Nr. 520):	Als Entwickler möchte ich genügend Spiel-/Testdaten zur Verfügung haben.
	- User Story Punkte:	3
	- Task 520.2:			Testdaten erweitern.
	- Zeitaufwand:			2h
*/

/* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 01.06.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/
 
 
 INSERT INTO Rolle (rolle_bezeichnung) VALUES
('Student'),
('Dozent'),
('Mitarbeiter');
 
 
INSERT INTO Gebaeude (geb_bezeichnung) VALUES
('1'), -- 'Prittwitzstraße 10', '89075'
('2'), -- 'Albert-Einstein-Allee 55', '89081'
('3'); -- 'Eberhard-Finckh Straße 11', '89075'

INSERT INTO Raum (raum_bezeichnung, geb_bezeichnung) VALUES
('A100', '1'),
('A104', '1'),
('V001', '2'),
('V101', '2'),
('Q027', '2'),
('B107', '1'),
('Q209', '2'),
('B055', '1'),
('Z107', '3'),
('F007', '1');

INSERT INTO Vorlesungsraum (raum_bezeichnung) VALUES
('A100'),
('A104'),
('V001'),
('V101'),
('Q027');

INSERT INTO Laborart (lArt_bezeichnung) VALUES
('Rechnerlabor'),
('Chemielabor'),
('Physiklabor'),
('Strahlenlabor'),
('Maschinenbaulabor');

INSERT INTO Laborraum (raum_bezeichnung, lArt_ID) VALUES
('B107', 1),
('Q209', 2),
('B055', 3),
('Z107', 4),
('F007', 5);

INSERT INTO Studiengangtyp (stgTyp_bezeichnung, stgTyp_kuerzel) VALUES
('Bachelor', 'BA'),
('Master of Science', 'M.Sc.'),
('Master of Arts', 'M.A.');

INSERT INTO Fakultaet (fak_bezeichnung) VALUES
('Elektrotechnik und Informationstechnik'),
('Mathematik, Natur- und Wirtschaftswissenschaften'),
('Informatik'),
('Maschinenbau und Fahrzeugtechnik'),
('Produktionstechnik und Produktionswirtschaft'),
('Mechatronik und Medizintechnik');

INSERT INTO Studiengang (stg_bezeichnung, stg_kurztext, stgTyp_ID, fak_ID) VALUES
('Technische Informatik', 'TI', 1, 3),
('Wirtschaftsinformatik', 'WF', 1, 3),
('Medizintechnik', 'MT', 1, 6),
('Maschinenbau', 'MB', 1, 4),
('Information Systems', 'IS', 2, 3);

INSERT INTO Nutzer (nutzer_name, vorname, nachname, geschlecht, passwortHash, rolle_ID) VALUES
-- ------------------------- Studenten -------------------------:
	-- Medizintechnik3:
('student', 'Max', 'Mustermann', 'm', '$2y$10$8pEgYNZX7GW8FYfp8Mzbz.g./61axiS/wx2np.bWw92N361fBFNp6', 1),
	-- Maschinenbau1:
('modoof', 'Moritz', 'Doof', 'm', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', 1),
	-- WF1:
('cadoll', 'Carson', 'Doll', 'w', '$2y$10$dUrEcPXXPhy5orEJ94h8gOgphtEoMXQ0YC.Ypmo7/350UypGBDydC', 1),
('loluke', 'Logan', 'Luke', 'm', '$2y$10$GKFQfhKsznb8tBmUhvWSnu/214UjM8ZOauWDPJylKSM2aZtfnU3S.', 1),
('doritc', 'Dolan', 'Ritch', 'm', '$2y$10$/o//as2zOyJEfh/qqj7H2usxRvAgdcAuHlMR.1qth7VTOx9tkovUa', 1),
	-- WF2:
('saetoo', 'Samuel', 'Etoo', 'm', '$2y$10$0InZ0F.FVITduZdnQqVaTOTuQB1BWZSVZJVz1.dEDRr.7ADZrbCPe', 1),
('jobeck', 'Jonas', 'Beck', 'm', '$2y$10$gn3NDRELjTHIi6mdHmAR3ebbKwaKv9N.n7r8ocR5LdGVTaylHM7Jm', 1),
	-- WF3:
('nicarr', 'Nicholas', 'Carr', 'm', '$2y$10$FiJKmwNpggknuG2VARNt2Ooc/wgcMubzE7t8t38zzoyh5whM1SdDG', 1),
('kaabdu', 'Kasimir', 'Abdu', 'm', '$2y$10$LRDBw8eHBlgGimwnzDlBw.g.49xHHi2zYekAWG3wW5qhENhMRSVNi', 1),
	-- WF4:
('ahali', 'Ahmed', 'Ali', 'm', '$2y$10$9zzYgoAvyb4KmVZNw25OXuJGWMlwxW.7udnz6bzMKY.OM6qM8tjk2', 1),
('deduck', 'Derek', 'Duck', 'm', '$2y$10$.FTBgX1J5pK5eHyngJenc.b4nlaesV443oAfqHcGmeLEQgcEh9nhC', 1),
('otott', 'Otto', 'Ott', 'm', '$2y$10$y9DTJq4lQNt6/5CT9bNGNeyVn1wRqRDkdsI/txxYVkhUa/FQczxFm', 1),
	-- WF5:
('orwest', 'Orlanda', 'West', 'w', '$2y$10$pUZB1hAW6BfFu6BNMHCmTu9wrztM5l3rcVQSSYtJJTF.IRd45NoRq', 1),
('ladanz', 'Lars', 'Danzer', 'm', '$2y$10$zLltvCGGyMVfXVNak8oAMOXwQ1ufend6PxjW658QdjUk0i6ueEss.', 1),
	-- WF6:
('phklug', 'Philip', 'Kluge', 'm', '$2y$10$jQ7J9xtxF5XZCicAjEELseMGA44Ev7XtV9aCc4VIHR9R/rHLyV7mq', 1),
('thtonn', 'Theodor', 'Tonne', 'm', '$2y$10$Zg7q98xbVHRW6BS24KAx/euCTp6k.0a6LHfkfe0sACPOjdqkRQxUi', 1),
	-- WF7:
('kebroo', 'Kelly', 'Brook', 'w', '$2y$10$ZkGNdjHHzhyU85.xIQa.CufPGsxrdDCWDSNXpmadyvsNAdJFEaTI.', 1),
('mefox', 'Megan', 'Fox', 'w', '$2y$10$b4evX1//cP3HJKzvMrNrP.XNfHnss6cpc5ewc9voGZ.KARLdzHgo2', 1),

-- ------------------------- Dozenten -------------------------:
('dozent', 'Klaus', 'Kopf', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('clstei', 'Claudia', 'Stein', 'w', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', 2),

-- ------------------------- Mitarbeiter -------------------------:
('mitarbeiter', 'Roberto', 'Firmino', 'm', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', 3),
('masail', 'Marina', 'Sailer', 'w', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', 3);


INSERT INTO Student (nutzer_name, stg_ID, matrikelnummer, fachsemester, studiensemester) VALUES
	-- Medizintechnik3:
('student', 3, 1111111, 3, 3),
	-- Machinenbau1:
('modoof', 4, 2111111, 1, 1),
	-- WF1:
('cadoll', 2, 3111111, 1, 1),
('loluke', 2, 4111111, 1, 1),
('doritc', 2, 5111111, 1, 1),
	-- WF2:
('saetoo', 2, 6111111, 2, 2),	
('jobeck', 2, 7111111, 2, 2),
	-- WF3:
('nicarr', 2, 8111111, 3, 3),	
('kaabdu', 2, 9111111, 3, 3),
	-- WF4:
('ahali', 2, 1211111, 4, 4),
('deduck', 2, 1311111, 4, 4),
('otott', 2, 1411111, 4, 4),	
	-- WF5:
('orwest', 2, 1511111, 5, 5),
('ladanz', 2, 1611111, 5, 5),	
	-- WF6:
('phklug', 2, 1711111, 6, 6),
('thtonn', 2, 1811111, 6, 6),
	-- WF7:
('kebroo', 2, 1911111, 7, 7),
('mefox', 2, 1121111, 7, 7);


INSERT INTO Dozent (nutzer_name, titel) VALUES
('dozent', 'Prof. Dr.'),
('clstei', 'Prof. Dipl.-Ing.');


INSERT INTO Mitarbeiter (nutzer_name) VALUES
('mitarbeiter'),
('masail');


INSERT INTO Adresse (straßenname, hausnummer, stadt, land, plz, nutzer_name, geb_bezeichnung) VALUES
-- ------------------------- Gebäude -------------------------:
('Prittwitzstraße', 10, 'Ulm', 'Deutschland', 89075, NULL, '1'),
('Albert-Einstein-Allee', 55, 'Ulm', 'Deutschland', 89081, NULL, '2'),
('Eberhard-Finckh Straße', 11, 'Ulm', 'Deutschland', 89075, NULL, '3'),

-- ------------------------- Studenten -------------------------:
('Turmstraße', 5, 'Berlin', 'Deutschland', 15028, 'student', NULL),
('Frauenstraße', 113, 'Ulm', 'Deutschland', 89073, 'modoof', NULL),
('Turmstraße', 16, 'Berlin', 'Deutschland', 15028, 'cadoll', NULL),
('Unter den Linden', 113, 'Berlin', 'Deutschland', 13065, 'loluke', NULL),
('Schlossalle', 7, 'Ulm', 'Deutschland', 89073, 'doritc', NULL),
('Bahnofgasse', 15, 'Ulm', 'Deutschland', 89075, 'saetoo', NULL),
('Mirabellenweg', 6, 'Neu-Ulm', 'Deutschland', 89233, 'jobeck', NULL),
('Leipheimer Straße', 1, 'Neu-Ulm', 'Deutschland', 89233, 'nicarr', NULL),
('Hauptstraße', 4, 'Neu-Ulm', 'Deutschland', 89233, 'kaabdu', NULL),
('Kirschenweg', 12, 'Neu-Ulm', 'Deutschland', 89233, 'ahali', NULL),
('Olivenweg', 45, 'Ulm', 'Deutschland', 89073, 'deduck', NULL),
('Carl-Zeiss-Straße', 55, 'Neu-Ulm', 'Deutschland', 89231, 'otott', NULL),
('Otto-Hahn-Straße', 5, 'Neu-Ulm', 'Deutschland', 89231, 'orwest', NULL),
('Eulesweg', 4, 'Neu-Ulm', 'Deutschland', 89231, 'ladanz', NULL),
('Lupinenweg', 36, 'Neu-Ulm', 'Deutschland', 89231, 'phklug', NULL),
('Magirusstraße', 15, 'Ulm', 'Deutschland', 89073, 'thtonn', NULL),
('Steingrube', 6, 'Neu-Ulm', 'Deutschland', 89231, 'kebroo', NULL),
('Sesamstraße', 85, 'Stuttgart', 'Deutschland', 87873, 'mefox', NULL),

-- ------------------------- Dozenten -------------------------:
('Schaffnerstraße', 10, 'Ulm', 'Deutschland', 89073, 'dozent', NULL),
('Schaffnerstraße', 5, 'Ulm', 'Deutschland', 89073, 'clstei', NULL),

-- ------------------------- Mitarbeiter -------------------------:
('Traminerweg', 35, 'Ulm', 'Deutschland', 89075, 'mitarbeiter', NULL),
('Traminerweg', 72, 'Ulm', 'Deutschland', 89075, 'masail', NULL);


INSERT INTO EMail (email_name, nutzer_name) VALUES
-- ------------------------- Studenten -------------------------:
('student@hs-ulm.de', 'student'),
('modoof@hs-ulm.de', 'modoof'),
('cadoll@hs-ulm.de', 'cadoll'),
('loluke@hs-ulm.de', 'loluke'),
('doritc@hs-ulm.de','doritc'),
('saetoo@hs-ulm.de','saetoo'),
('jobeck@hs-ulm.de','jobeck'),
('nicarr@hs-ulm.de','nicarr'),
('kaabdu@hs-ulm.de','kaabdu'),
('ahali@hs-ulm.de','ahali'),
('deduck@hs-ulm.de','deduck'),
('otott@hs-ulm.de','otott'),
('orwest@hs-ulm.de','orwest'),
('ladanz@hs-ulm.de','ladanz'),
('phklug@hs-ulm.de','phklug'),
('thtonn@hs-ulm.de','thtonn'),
('kebroo@hs-ulm.de','kebroo'),
('mefox@hs-ulm.de','mefox'),

-- ------------------------- Dozenten -------------------------:
('dozent@hs-ulm.de', 'dozent'),
('claudia.stein@hs-ulm.de', 'clstei'),

-- ------------------------- Mitarbeiter -------------------------:
('mitarbeiter@hs-ulm.de', 'mitarbeiter'),
('masail@hs-ulm.de', 'masail');


INSERT INTO Veranstaltungsart (vArt_bezeichnung) VALUES
('Blockveranstaltung'),
('Kurs'),
('Labor'),
('Labor/Seminar'),
('Praktikum'),
('Praktische Übung'),
('Praxissemester'),
('Projekt'),
('Projektgruppe'),
('Seminar'),
('Seminar/Vorlesung'),
('Sonstiges'),
('Tutorium'),
('Übung'),
('Vorlesung'),
('Vorlesung/Labor'),
('Vorlesung/Projekt'),
('Vorlesung/Übung'),
('Zusatzübung');

INSERT INTO Veranstaltung (veranst_bezeichnung, veranst_kurztext, credits, SWS, maxTeilnehmer, vArt_ID, dozent_nutzer_name) VALUES
('Programmieren 1', 'Prog1', 5, 4, 32, 18, 'dozent'),
('Programmieren 2', 'Prog2', 5, 4, 32, 18, 'dozent'),
('Rechnernetze', 'RNET', 5, 4, 30, 16, 'dozent'),
('Seminar Wirtschaftsinformatik', 'SEMWIF', 4, 2, 30, 10, 'clstei'),
('Database Programming', 'DAPRO', 5, 4, 30, 17, NULL),
('Physik 1', 'PH1', 5, 4, 30, 16, NULL),
('Chemie 1', 'CH1', 5, 4, 30, 16, NULL),
('Strahlentechnik', 'STechnik', 5, 4, 30, 16, NULL),
('Maschinenbau Grundlagen', 'MBau-GRDL', 5, 4, 30, 16, NULL);


/*	Autor: Alexander Mayer 
	Sprint 6, Task 650.1 BEGIN */
	
INSERT INTO Dozent_berechtigtFuer_Veranstaltung (dozent_nutzer_name, veranst_ID) VALUES
('dozent', 1),
('dozent', 2),
('dozent', 5),
('clstei', 6),
('clstei', 7),
('clstei', 8);

/*	Autor: Alexander Mayer 
	Sprint 6, Task 650.1 END */
	

INSERT INTO Student_angemeldetAn_Veranstaltung (veranst_ID, student_nutzer_name) VALUES
	-- Medizintechnik3, Strahlentechnik:
	(8, 'student'),
	
	-- Maschinenbau1, Physik 1:
	(6, 'modoof'),
	
	-- Maschinenbau1, Maschinenbau Grundlagen:
	(9, 'modoof'),

	-- WF1, Programmieren 1:
	(1, 'cadoll'),
	(1, 'loluke'),
	(1, 'doritc'),
	
	-- WF2, Programmieren 2:
	(2, 'saetoo'),
	(2, 'jobeck'),
	
	-- WF3:
	
	-- WF4, Rechnernetze:
	(3, 'ahali'),
	(3, 'deduck'),
	(3, 'otott'),
	
	-- WF4, Database Programming:
	(5, 'ahali'),
	(5, 'deduck'),
	(5, 'otott'),
	
	-- WF5, Seminar Wirtschaftsinformatik:
	(4, 'orwest'),
	(4, 'ladanz');
	
	-- WF6:
	
	-- WF7:

	
INSERT INTO Stundenzeit (stdZeit_von, stdZeit_bis) VALUES
('08:00:00', '09:30:00'),
('09:50:00', '11:20:00'),
('11:30:00', '13:00:00'),
('14:00:00', '15:30:00'),
('15:45:00', '17:15:00'),
('17:25:00', '18:55:00'),
('19:00:00', '20:30:00');

INSERT INTO Wochentag (tag_bezeichnung) VALUES
('Montag'),
('Dienstag'),
('Mittwoch'),
('Donnerstag'),
('Freitag'),
('Samstag');

INSERT INTO Studiengang_hat_Veranstaltung (`stg_ID`, `veranst_ID`, `pflicht_im_Semester`) VALUES
-- Technische Informatik:

-- Wirtschaftsinformatik: 
(2, 1, 1), -- Programmieren 1
(2, 2, 2), -- Programmieren 2
(2, 3, 4), -- Rechnernetze
(2, 4, 5), -- Seminar Wirtschaftsinformatik
(2, 5, 4), -- Database Programming

-- Medizintechnik:
(3, 7, 1), -- Chemie 1
(3, 8, 3), -- Strahlentechnik

-- Maschinenbau:
(4, 6, 1), -- Physik 1
(4, 9, 1); -- Maschinenbau Grundlagen

-- Information Systems:


INSERT INTO Ausstattung(ausstattung_bezeichnung) VALUES
('Stuhl'),
('Computer'),
('Beamer'),
('Projektor'),
('Overheadprojektor'),
('Praesentations-Computer'),
('HDMI-Anschluss'),
('Whiteboard'),
('Kreidetafel'),
('Telefon');

INSERT INTO Vorlesungsraum_hat_Ausstattung (raum_bezeichnung, ausstattung_ID, anzahl) VALUES
('A100', 1, 40),
('A100', 2, 0),
('A100', 3, 1),
('A100', 4, 1),
('A100', 5, 1),
('A100', 6, 1),
('A100', 7, 1),
('A100', 8, 1),
('A100', 9, 0),
('A100', 10, 0),

('A104', 1, 40),
('A104', 2, 0),
('A104', 3, 1),
('A104', 4, 1),
('A104', 5, 1),
('A104', 6, 1),
('A104', 7, 1),
('A104', 8, 1),
('A104', 9, 0),
('A104', 10, 0),

('V001', 1, 40),
('V001', 2, 40),
('V001', 3, 1),
('V001', 4, 1),
('V001', 5, 1),
('V001', 6, 1),
('V001', 7, 1),
('V001', 8, 1),
('V001', 9, 0),
('V001', 10, 0),

('V101', 1, 40),
('V101', 2, 0),
('V101', 3, 1),
('V101', 4, 1),
('V101', 5, 1),
('V101', 6, 1),
('V101', 7, 1),
('V101', 8, 1),
('V101', 9, 0),
('V101', 10, 0),

('Q027', 1, 30),
('Q027', 2, 30),
('Q027', 3, 1),
('Q027', 4, 1),
('Q027', 5, 1),
('Q027', 6, 1),
('Q027', 7, 1),
('Q027', 8, 1),
('Q027', 9, 0),
('Q027', 10, 0);

INSERT INTO Veranstaltung_erfordert_Ausstattung (veranst_ID, ausstattung_ID, anzahl) VALUES
-- Prog1:
('1', '1', 32), 
('1', '2', 0),
('1', '3', 1),
('1', '4', 1),
('1', '5', 1),
('1', '6', 1),
('1', '7', 1),
('1', '8', 1), 
('1', '9', 0),
('1', '10', 0),

-- Prog2:
('2', '1', 32), 
('2', '2', 32),
('2', '3', 1),
('2', '4', 1),
('2', '5', 1),
('2', '6', 1),
('2', '7', 1),
('2', '8', 1), 
('2', '9', 0),
('2', '10', 0),

-- RNET:
('3', '1', 30), 
('3', '2', 30),
('3', '3', 1),
('3', '4', 1),
('3', '5', 1),
('3', '6', 0),
('3', '7', 1),
('3', '8', 1), 
('3', '9', 0),
('3', '10', 0),

-- SEMWIF:
('4', '1', 30), 
('4', '2', 0),
('4', '3', 1),
('4', '4', 1),
('4', '5', 1),
('4', '6', 1),
('4', '7', 1),
('4', '8', 1), 
('4', '9', 0),
('4', '10', 0),

-- DAPRO:
('5', '1', 30), 
('5', '2', 30),
('5', '3', 1),
('5', '4', 1),
('5', '5', 1),
('5', '6', 1),
('5', '7', 1),
('5', '8', 1), 
('5', '9', 0),
('5', '10', 0),

-- PH1:
('6', '1', 20), 
('6', '2', 0),
('6', '3', 1),
('6', '4', 1),
('6', '5', 1),
('6', '6', 0),
('6', '7', 1),
('6', '8', 1), 
('6', '9', 0),
('6', '10', 0),

-- CH1:
('7', '1', 20), 
('7', '2', 0),
('7', '3', 1),
('7', '4', 1),
('7', '5', 1),
('7', '6', 0),
('7', '7', 1),
('7', '8', 1), 
('7', '9', 0),
('7', '10', 0),

-- STechnik:
('8', '1', 20), 
('8', '2', 0),
('8', '3', 1),
('8', '4', 1),
('8', '5', 1),
('8', '6', 1),
('8', '7', 1),
('8', '8', 1), 
('8', '9', 0),
('8', '10', 0),

-- MBau-GRDL:
('9', '1', 20), 
('9', '2', 0),
('9', '3', 1),
('9', '4', 1),
('9', '5', 1),
('9', '6', 1),
('9', '7', 1),
('9', '8', 1), 
('9', '9', 0),
('9', '10', 0);

INSERT INTO Laborraum_hat_Ausstattung (raum_bezeichnung, ausstattung_ID, anzahl) VALUES
('B107', 1, 30),
('B107', 2, 30),
('B107', 3, 1),
('B107', 4, 1),
('B107', 5, 1),
('B107', 6, 0),
('B107', 7, 1),
('B107', 8, 1),
('B107', 9, 0),
('B107', 10, 0),

('Q209', 1, 20),
('Q209', 2, 0),
('Q209', 3, 1),
('Q209', 4, 1),
('Q209', 5, 1),
('Q209', 6, 0),
('Q209', 7, 1),
('Q209', 8, 1),
('Q209', 9, 0),
('Q209', 10, 0),

('B055', 1, 20),
('B055', 2, 0),
('B055', 3, 1),
('B055', 4, 1),
('B055', 5, 1),
('B055', 6, 0),
('B055', 7, 1),
('B055', 8, 1),
('B055', 9, 0),
('B055', 10, 0),

('Z107', 1, 20),
('Z107', 2, 0),
('Z107', 3, 1),
('Z107', 4, 1),
('Z107', 5, 1),
('Z107', 6, 1),
('Z107', 7, 1),
('Z107', 8, 1),
('Z107', 9, 0),
('Z107', 10, 0),

('F007', 1, 20),
('F007', 2, 0),
('F007', 3, 1),
('F007', 4, 1),
('F007', 5, 1),
('F007', 6, 1),
('F007', 7, 1),
('F007', 8, 1),
('F007', 9, 0),
('F007', 10, 0);

INSERT INTO Veranstaltungstermin (`veranst_ID`, `tag_ID`, `stdZeit_ID`, `raum_bezeichnung`) VALUES
(1, 1, 1, 'A100'), -- Programmieren 1
(1, 1, 2, 'A100'), -- Programmieren 1
(1, 5, 4, 'A100'), -- Programmieren 1
(1, 5, 5, 'A100'), -- Programmieren 1

(4, 4, 1, 'A104'), -- Seminar Wirtschaftsinformatik
(4, 4, 2, 'A104'), -- Seminar Wirtschaftsinformatik
(4, 4, 3, 'A104'), -- Seminar Wirtschaftsinformatik

(6, 1, 1, 'B055'), -- Physik 1
(6, 1, 2, 'B055'), -- Physik 1
(6, 5, 1, 'B055'), -- Physik 1

(3, 2, 1, 'B107'), -- Rechnernetze
(3, 2, 2, 'B107'), -- Rechnernetze
(3, 2, 3, 'B107'), -- Rechnernetze

(9, 3, 3, 'F007'), -- Maschinenbau Grundlagen
(9, 3, 4, 'F007'), -- Maschinenbau Grundlagen
(9, 3, 5, 'F007'), -- Maschinenbau Grundlagen

(5, 3, 2, 'Q027'), -- Database Programming
(5, 3, 3, 'Q027'), -- Database Programming
(5, 3, 4, 'Q027'), -- Database Programming

(7, 4, 1, 'Q209'), -- Chemie 1
(7, 4, 2, 'Q209'), -- Chemie 1
(7, 4, 3, 'Q209'), -- Chemie 1

(2, 1, 4, 'V001'), -- Programmieren 2
(2, 1, 5, 'V001'), -- Programmieren 2
(2, 3, 1, 'V001'), -- Programmieren 2
(2, 3, 2, 'V001'), -- Programmieren 2

(8, 2, 4, 'Z107'), -- Strahlentechnik
(8, 2, 5, 'Z107'); -- Strahlentechnik


/*-----------------------------------------------------------------------------------------
	* START SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/01  Beschreibung: SQL Tabellen anlegen
	* Zeitaufwand (in Stunden): 0,1
	* START SPRINT 04
	*/

-- -----------------------------------------------------
-- Table `Notenliste`
-- -----------------------------------------------------

INSERT INTO Notenliste (note, student_nutzer_name, veranst_ID) VALUES
-- Programmieren 1:
(1.7 ,'cadoll', 1),
(1.7 ,'loluke', 1),
(1.7 ,'doritc', 1),

-- Programmieren 2:
(1.7 ,'saetoo', 2),
(1.7 ,'jobeck', 2),

-- Rechnernetze:
(1.7 ,'ahali', 3),
(1.7 ,'deduck', 3),
(1.7 ,'otott', 3),

-- Seminar Wirtschaftsinformatik:
(1.7 ,'orwest', 4),
(1.7 ,'ladanz', 4),

-- Database Programming:
(1.7 ,'ahali', 5),
(1.7 ,'deduck', 5),
(1.7 ,'otott', 5),

-- Physik 1:
(1.7 ,'modoof', 6),

-- Strahlentechnik:
(1.7 ,'student', 8),

-- Maschinenbau Grundlagen:
(1.7 ,'modoof', 9);

/*
	* ENDE SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)   Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/01  Beschreibung: SQL Tabellen anlegen
	* Zeitaufwand (in Stunden): 0,1
	* ENDE SPRINT 05
	**-----------------------------------------------------------------------------------------*/
