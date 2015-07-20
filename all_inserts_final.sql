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
-- ALT:
/*
('Technische Informatik', 'TI', 1, 3),
('Wirtschaftsinformatik', 'WF', 1, 3),
('Medizintechnik', 'MT', 1, 6),
('Maschinenbau', 'MB', 1, 4),
('Information Systems', 'IS', 2, 3);
*/

-- FAK 1 Elektrotechnik und Informationstechnik

('Digital Media', 'DM', 1, 1),
('Elektrotechnik und Informationstechnik', 'ETIT', 1, 1),
('Fahrzeugelektronik', 'FZE', 1, 1),
('Industrieelektronik', 'IE', 1, 1),
('Nachrichtentechnik', 'NT', 1, 1),
('Systems Engineering and Management, Electrical Engineering', 'SEMEE', 2, 1),
('Elektrische Energiesysteme und Elektromobilität', 'EESEM', 2, 1),
('Systems Engineering and Management (International Program)', 'SEMINT', 2, 1),

-- FAK 2 Mathematik und Naturwissenschaften
('Computational Science and Engineering', 'CSE', 1, 2),
('Computational Science and Engineering (Master)', 'CSEM', 2, 2),

-- FAK 3 Informatik
('Computer Science', 'CS', 1, 3),
('Computer Science - International Program', 'CSI', 1, 3),
('Data Science in der Medizin', 'DSM', 1, 3),
('Informatik', 'INF', 1, 3),
('Technische Informatik', 'TI', 1, 3),
('Wirtschaftsinformatik', 'WF', 1, 3),
('Information Systems', 'IS', 2, 3),


-- FAK 4 Maschinenbau und Fahrzeugtechnik
('Fahrzeugtechnik', 'FT', 1, 4),
('Maschinenbau', 'MB', 1, 4),
('Systems Engineering and Management, Mechanical Engineering', 'SEMME', 2, 3),


-- FAK 5 Produktionstechnik und Produktionswirtschaft
('Energiesysteme', 'ES', 1, 5),
('Energiesystemtechnik', 'EST', 1, 5),
('Internationale Energiewirtschaft', 'IEW', 1, 5),
('Produktionstechnik und Organisation', 'PTO', 1, 5),
('Wirtschaftsingenieurwesen', 'WIN', 1, 5),
('Wirtschaftsingenieurwesen - Logistik', 'WINL', 1, 5),
('Systems Engineering and Management, Industrial Management', 'SEMIM', 2, 5),
('Systems Engineering and Management, Logistics', 'SEMLO', 2, 5),
('Sustainable Energy Competence', 'SEC', 2, 5),

-- FAK 6 Mechatronik und Medizintechnik
('Mechatronik', 'MC', 1, 6),
('Medizintechnik', 'MT', 1, 6),
('Medizintechnik', 'MTM', 2, 6);



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
('erklip', 'Erich', 'Klippel', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('geschi', 'Georg', 'Schied', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('hegewa', 'Heiko', 'Gewald', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('olvogt', 'Oliver', 'Vogt', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('heferc', 'Herbert', 'Ferchenbauer', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('gugram', 'Günther', 'Gramlich', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('uwfeed', 'Uwe', 'Feeder', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('johalt', 'John', 'Halton', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('acdehn', 'Achim', 'Dehnert', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('frneyh', 'Frederik', 'Neyheusel', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('revons', 'Reinhold', 'von Schwerin', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('ulreis', 'Ulrike', 'Reisach', 'w', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('thhasb', 'Thorsten', 'Hasbargen', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('lescho', 'Leopold', 'Schöndorf', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('kllang', 'Klaus', 'Lang', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('phgraf', 'Philipp', 'Graf', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('voherb', 'Volker', 'Herbort', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('olgrie', 'Oliver', 'Grieble', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),
('hewald', 'Herbert', 'Waldert', 'm', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 2),

-- ------------------------- Mitarbeiter -------------------------:
('mitarbeiter', 'Roberto', 'Firmino', 'm', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', 3),
('masail', 'Marina', 'Sailer', 'w', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', 3);


INSERT INTO Student (nutzer_name, stg_ID, matrikelnummer, fachsemester, studiensemester) VALUES
	-- Medizintechnik3:
('student', 16, 1111111, 5, 5),
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
('geschi', 'Prof. Dr.'),
('hegewa', 'Prof. Dr.'),
('olvogt', 'Prof. Dr.'),
('heferc', 'Prof. Dr.'),
('erklip', 'Prof. Dr.'),
('gugram', 'Prof. Dr.'),
('uwfeed', 'Prof. Dr.'),
('johalt', 'Prof. Dr.'),
('acdehn', 'Prof. Dr.'),
('frneyh', 'Prof. Dr.'),
('revons', 'Prof. Dr.'),
('ulreis', 'Prof. Dr.'),
('thhasb', 'Prof. Dr.'),
('lescho', 'Prof. Dr.'),
('kllang', 'Prof. Dr.'),
('phgraf', 'Prof. Dr.'),
('voherb', 'Prof. Dr.'),
('olgrie', 'Prof. Dr.'),
('hewald', 'Prof. Dr.');


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
('Schaffnerstraße', 5, 'Ulm', 'Deutschland', 89073, 'erklip', NULL),

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
('erich.klippel@hs-ulm.de', 'erklip'),

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
-- WF1
('Programmieren 1', 'PROG1', 5, 4, 32, 18, 'geschi'),
('Grundlagen BWL', 'ABWL', 5, 4, 32, 18, 'hegewa'),
('Grundzüge Wirtschaftsinformatik', 'GRWF', 5, 4, 32, 18, 'olvogt'),
('Rechnungswesen', 'RW', 5, 4, 32, 18, 'heferc'),
('Mathematik 1', 'MATH', 5, 4, 32, 18, 'gugram'),
('Technologische Grundlagen', 'TEGR', 5, 4, 32, 18, 'erklip'),

-- WF2 
('Programmieren 2', 'PROG2', 5, 4, 32, 18, 'geschi'),
('Schwerpunkt BWL', 'SBWL', 5, 4, 32, 18, 'uwfeed'),
('Business Englisch', 'BUSE-NU', 5, 4, 32, 18, 'johalt'),
('Projektmanagement', 'PMAN', 5, 4, 32, 18, 'acdehn'),
('Mathematik 2', 'MATH', 5, 4, 32, 18, 'gugram'),
('Wirtschafts- und IT-Recht', 'WIPR', 5, 4, 32, 18, 'frneyh'),
('Datenbanken', 'DABA', 5, 4, 32, 18, 'revons'),

-- WF3
('Business and Technical English', 'BTENG', 5, 4, 32, 18, 'johalt'),
('Marketing', 'MARK', 5, 4, 32, 18, 'ulreis'),
('ERP Systeme', 'ERPS', 5, 4, 32, 18, 'olvogt'),
('Betriebssysteme', 'BSYS', 5, 4, 32, 18, 'thhasb'),
('Alorithmen und Datenstrukturen', 'ALDS', 5, 4, 32, 18, 'geschi'),
('Statistik', 'STAK', 5, 4, 32, 18, 'gugram'),

-- WF4
('Rechnernetze', 'RNET', 5, 4, 32, 18, 'lescho'),
('Database Programming', 'DAPRO', 5, 4, 32, 18, 'erklip'),
('Informationsmanagement', 'INFM', 5, 4, 32, 18, 'kllang'),
('Corporate Communication', 'COCM', 5, 4, 32, 18, 'ulreis'),
('Software Engeneering', 'SOFEN', 5, 4, 32, 18, 'phgraf'),

-- WF5
('Operations Research', 'OR', 5, 4, 32, 18, 'gugram'),
('Datawarehouse', 'DAWA', 5, 4, 32, 18, 'voherb'),
('Seminar der Wirtschaftsinformatik', 'SEMWF', 5, 4, 32, 18, 'olgrie'),
('Interkulturelle Kommunikation', 'IKOM', 5, 4, 32, 18, 'ulreis'),
('IT Anwendungen', 'ITA', 5, 4, 32, 18, 'hegewa'),
('Führungsinstrumente', 'FUEBIT', 5, 4, 32, 18, 'hewald'),
('Wirtschaftsinformatik Projekt', 'WFPRJ', 5, 4, 32, 18, 'erklip');





/*	Autor: Alexander Mayer 
	Sprint 6, Task 650.1 BEGIN */
	
INSERT INTO Dozent_berechtigtFuer_Veranstaltung (dozent_nutzer_name, veranst_ID) VALUES
('geschi', 1),
('hegewa', 2),
('olvogt', 3),
('heferc', 4),
('gugram', 5),
('erklip', 6),
('geschi', 7),
('uwfeed', 8),
('johalt', 9),
('acdehn', 10),
('gugram', 11),
('frneyh', 12),
('revons', 13),
('johalt', 14),
('ulreis', 15),
('olvogt', 16),
('thhasb', 17),
('geschi', 18),
('gugram', 19),
('lescho', 20),
('erklip', 21),
('kllang', 22),
('ulreis', 23),
('phgraf', 24),
('gugram', 25),
('voherb', 26),
('olgrie', 27),
('ulreis', 28),
('hegewa', 29),
('hewald', 30),
('erklip', 31);

/*	Autor: Alexander Mayer 
	Sprint 6, Task 650.1 END */
	

INSERT INTO Student_angemeldetAn_Veranstaltung (veranst_ID, student_nutzer_name) VALUES
	
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
	
	-- WF5:
	(25, 'student'), -- OR
	(26, 'student'), -- DAWA
	(27, 'student'), -- SEMWIF
	(28, 'student'), -- IKOM
	(29, 'student'), -- ITA
	(30, 'student'), -- FÜBIT
	(31, 'student'); -- WFPRJ

	
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

-- WF1
(16, 1, 1), 
(16, 2, 1), 
(16, 3, 1), 
(16, 4, 1), 
(16, 5, 1), 
(16, 6, 1), 

-- WF2
(16, 7, 2), 
(16, 8, 2), 
(16, 9, 2), 
(16, 10, 2), 
(16, 11, 2), 
(16, 12, 2),
(16, 13, 2),

-- WF3
(16, 14, 3), 
(16, 15, 3), 
(16, 16, 3), 
(16, 17, 3), 
(16, 18, 3), 
(16, 19, 3),

-- WF4
(16, 20, 4), 
(16, 21, 4), 
(16, 22, 4), 
(16, 23, 4), 
(16, 24, 4), 

-- WF5
(16, 25, 5), 
(16, 26, 5), 
(16, 27, 5), 
(16, 28, 5), 
(16, 29, 5), 
(16, 30, 5),
(16, 31, 5); 



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

 ('2', '1', 32),
('2', '2', 0),
('2', '3', 1),
('2', '4', 1),
('2', '5', 1),
('2', '6', 1),
('2', '7', 1),
('2', '8', 1),
('2', '9', 0),
('2', '10', 0),

 ('3', '1', 32),
('3', '2', 0),
('3', '3', 1),
('3', '4', 1),
('3', '5', 1),
('3', '6', 1),
('3', '7', 1),
('3', '8', 1),
('3', '9', 0),
('3', '10', 0),

 ('4', '1', 32),
('4', '2', 0),
('4', '3', 1),
('4', '4', 1),
('4', '5', 1),
('4', '6', 1),
('4', '7', 1),
('4', '8', 1),
('4', '9', 0),
('4', '10', 0),

 ('5', '1', 32),
('5', '2', 0),
('5', '3', 1),
('5', '4', 1),
('5', '5', 1),
('5', '6', 1),
('5', '7', 1),
('5', '8', 1),
('5', '9', 0),
('5', '10', 0),

 ('6', '1', 32),
('6', '2', 0),
('6', '3', 1),
('6', '4', 1),
('6', '5', 1),
('6', '6', 1),
('6', '7', 1),
('6', '8', 1),
('6', '9', 0),
('6', '10', 0),

 ('7', '1', 32),
('7', '2', 0),
('7', '3', 1),
('7', '4', 1),
('7', '5', 1),
('7', '6', 1),
('7', '7', 1),
('7', '8', 1),
('7', '9', 0),
('7', '10', 0),

 ('8', '1', 32),
('8', '2', 0),
('8', '3', 1),
('8', '4', 1),
('8', '5', 1),
('8', '6', 1),
('8', '7', 1),
('8', '8', 1),
('8', '9', 0),
('8', '10', 0),

 ('9', '1', 32),
('9', '2', 0),
('9', '3', 1),
('9', '4', 1),
('9', '5', 1),
('9', '6', 1),
('9', '7', 1),
('9', '8', 1),
('9', '9', 0),
('9', '10', 0),

 ('10', '1', 32),
('10', '2', 0),
('10', '3', 1),
('10', '4', 1),
('10', '5', 1),
('10', '6', 1),
('10', '7', 1),
('10', '8', 1),
('10', '9', 0),
('10', '10', 0),

 ('11', '1', 32),
('11', '2', 0),
('11', '3', 1),
('11', '4', 1),
('11', '5', 1),
('11', '6', 1),
('11', '7', 1),
('11', '8', 1),
('11', '9', 0),
('11', '10', 0),

 ('12', '1', 32),
('12', '2', 0),
('12', '3', 1),
('12', '4', 1),
('12', '5', 1),
('12', '6', 1),
('12', '7', 1),
('12', '8', 1),
('12', '9', 0),
('12', '10', 0),

 ('13', '1', 32),
('13', '2', 0),
('13', '3', 1),
('13', '4', 1),
('13', '5', 1),
('13', '6', 1),
('13', '7', 1),
('13', '8', 1),
('13', '9', 0),
('13', '10', 0),

 ('14', '1', 32),
('14', '2', 0),
('14', '3', 1),
('14', '4', 1),
('14', '5', 1),
('14', '6', 1),
('14', '7', 1),
('14', '8', 1),
('14', '9', 0),
('14', '10', 0),

 ('15', '1', 32),
('15', '2', 0),
('15', '3', 1),
('15', '4', 1),
('15', '5', 1),
('15', '6', 1),
('15', '7', 1),
('15', '8', 1),
('15', '9', 0),
('15', '10', 0),

 ('16', '1', 32),
('16', '2', 0),
('16', '3', 1),
('16', '4', 1),
('16', '5', 1),
('16', '6', 1),
('16', '7', 1),
('16', '8', 1),
('16', '9', 0),
('16', '10', 0),

 ('17', '1', 32),
('17', '2', 0),
('17', '3', 1),
('17', '4', 1),
('17', '5', 1),
('17', '6', 1),
('17', '7', 1),
('17', '8', 1),
('17', '9', 0),
('17', '10', 0),

 ('18', '1', 32),
('18', '2', 0),
('18', '3', 1),
('18', '4', 1),
('18', '5', 1),
('18', '6', 1),
('18', '7', 1),
('18', '8', 1),
('18', '9', 0),
('18', '10', 0),

 ('19', '1', 32),
('19', '2', 0),
('19', '3', 1),
('19', '4', 1),
('19', '5', 1),
('19', '6', 1),
('19', '7', 1),
('19', '8', 1),
('19', '9', 0),
('19', '10', 0),

 ('20', '1', 32),
('20', '2', 0),
('20', '3', 1),
('20', '4', 1),
('20', '5', 1),
('20', '6', 1),
('20', '7', 1),
('20', '8', 1),
('20', '9', 0),
('20', '10', 0),

 ('21', '1', 32),
('21', '2', 0),
('21', '3', 1),
('21', '4', 1),
('21', '5', 1),
('21', '6', 1),
('21', '7', 1),
('21', '8', 1),
('21', '9', 0),
('21', '10', 0),

 ('22', '1', 32),
('22', '2', 0),
('22', '3', 1),
('22', '4', 1),
('22', '5', 1),
('22', '6', 1),
('22', '7', 1),
('22', '8', 1),
('22', '9', 0),
('22', '10', 0),

 ('23', '1', 32),
('23', '2', 0),
('23', '3', 1),
('23', '4', 1),
('23', '5', 1),
('23', '6', 1),
('23', '7', 1),
('23', '8', 1),
('23', '9', 0),
('23', '10', 0),

 ('24', '1', 32),
('24', '2', 0),
('24', '3', 1),
('24', '4', 1),
('24', '5', 1),
('24', '6', 1),
('24', '7', 1),
('24', '8', 1),
('24', '9', 0),
('24', '10', 0),

 ('25', '1', 32),
('25', '2', 0),
('25', '3', 1),
('25', '4', 1),
('25', '5', 1),
('25', '6', 1),
('25', '7', 1),
('25', '8', 1),
('25', '9', 0),
('25', '10', 0),

 ('26', '1', 32),
('26', '2', 0),
('26', '3', 1),
('26', '4', 1),
('26', '5', 1),
('26', '6', 1),
('26', '7', 1),
('26', '8', 1),
('26', '9', 0),
('26', '10', 0),

 ('27', '1', 32),
('27', '2', 0),
('27', '3', 1),
('27', '4', 1),
('27', '5', 1),
('27', '6', 1),
('27', '7', 1),
('27', '8', 1),
('27', '9', 0),
('27', '10', 0),

 ('28', '1', 32),
('28', '2', 0),
('28', '3', 1),
('28', '4', 1),
('28', '5', 1),
('28', '6', 1),
('28', '7', 1),
('28', '8', 1),
('28', '9', 0),
('28', '10', 0),

 ('29', '1', 32),
('29', '2', 0),
('29', '3', 1),
('29', '4', 1),
('29', '5', 1),
('29', '6', 1),
('29', '7', 1),
('29', '8', 1),
('29', '9', 0),
('29', '10', 0),

 ('30', '1', 32),
('30', '2', 0),
('30', '3', 1),
('30', '4', 1),
('30', '5', 1),
('30', '6', 1),
('30', '7', 1),
('30', '8', 1),
('30', '9', 0),
('30', '10', 0),

 ('31', '1', 32),
('31', '2', 0),
('31', '3', 1),
('31', '4', 1),
('31', '5', 1),
('31', '6', 1),
('31', '7', 1),
('31', '8', 1),
('31', '9', 0),
('31', '10', 0);
/* ALT:
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
*/

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

/*INSERT INTO Veranstaltungstermin (`veranst_ID`, `tag_ID`, `stdZeit_ID`, `raum_bezeichnung`) VALUES
(1, 1, 1, 'A100'), -- Programmieren 1*/


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
