INSERT INTO Rolle (rolle_bezeichnung) VALUES
('Student'),
('Dozent'),
('Mitarbeiter'),
('Tutor');

INSERT INTO Eigenschaft (eigeschaft_bezeichnung) VALUES
('username'),
('matrNr'),
('vorname'),
('nachname'),
('idAdresse'),
('rechte'),
('telefonnummer'),
('fakultät'),
('dozent'),
('studiengang');

INSERT INTO Rolle_hat_Eigenschaft (eigenschaft_ID, rolle_ID, reihenfolge) VALUES
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

INSERT INTO Nutzer (nutzer_name, passwortHash, letzterLogin, rolle_ID) VALUES
('dozent', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', '1430339080', 2),
('mitarbeiter', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', NULL, 3),
('student', '$2y$10$8pEgYNZX7GW8FYfp8Mzbz.g./61axiS/wx2np.bWw92N361fBFNp6', '1430327378', 1),
('tutor', '$2y$10$kflo8og3yPg0cquTGK6nY.HOkx6JVjMGK8Dja4XXIzWURmZBVleZ6', '1430327729', 4),
('userTestDozent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 2),
('userTestMitarbeiter', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 3),
('userTestStudent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 1),
('userTestTutor', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 4);

INSERT INTO Wert (eigenschaft_ID, nutzer_name, inhalt) VALUES
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

INSERT INTO Email VALUES (email_name, nutzer_name)
('userTestDozent@hs-ulm.de', 'userTestDozent'),
('userTestMitarbeiter@hs-ulm.de', 'userTestMitarbeiter'),
('userTestStudent@hs-ulm.de', 'userTestStudent'),
('userTestTutor@hs-ulm.de', 'userTestTutor');

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

INSERT INTO Studiengang (stg_bezeichnung, stgTyp_ID, fak_ID) VALUES
('Technische Informatik', 1, 3),
('Wirtschaftsinformatik', 1, 3),
('Medizintechnik', 1, 6),
('Maschinenbau', 1, 4),
('Information Systems', 2, 3);

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

INSERT INTO Veranstaltung (veranst_bezeichnung, veranst_kurztext, credits, SWS, maxTeilnehmer, vArt_ID) VALUES
('Programmieren 1', 'Prog1', 5, 4, 32, 18),
('Programmieren 2', 'Prog2', 5, 4, 32, 18),
('Rechnernetze', 'RNET', 5, 4, 30, 16),
('Seminar Wirtschaftsinformatik', 'SEMWIF', 4, 2, 30, 10),
('Database Programming', 'DAPRO', 5, 4, 30, 17),
('Physik 1', 'PH1', 5, 4, 30, 16),
('Chemie 1', 'CH1', 5, 4, 30, 16),
('Strahlentechnik', 'STechnik', 5, 4, 30, 16),
('Maschinenbau Grundlagen', 'MBau-GRDL', 5, 4, 30, 16);

INSERT INTO User_beteiligtAn_Veranstaltung (veranst_ID, nutzer_name) VALUES
(1, 'dozent'),
(2, 'dozent'),
(3, 'dozent'),
(5, 'mitarbeiter'),
(1, 'student'),
(2, 'student'),
(1, 'tutor'),
(2, 'userTestStudent'),
(1, 'userTestTutor');

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
('Samstag'),
('Sonntag');

INSERT INTO Gebaeude (geb_bezeichnung) VALUES
('1'), -- 'Prittwitzstraße 10', '89075'
('2'), -- 'Albert-Einstein-Allee 55', '89081'
('3'); -- 'Eberhard-Finckh Straße 11', '89075'

INSERT INTO Adresse (straßenname, hausnummer, stadt, land, plz, nutzer_name, geb_bezeichnung) VALUES
('Prittwitzstraße', 10, 'Ulm', 'Deutschland', 89075, NULL, '1'),
('Albert-Einstein-Allee', 55, 'Ulm', 'Deutschland', 89081, NULL, '2'),
('Eberhard-Finckh Straße', 11, 'Ulm', 'Deutschland', 89075, NULL, '3'),
('Frauenstraße', 113, 'Ulm', 'Deutschland', 89073, 'userTestStudent', NULL),
('Schaffnerstraße', 5, 'Ulm', 'Deutschland', 89073, 'userTestDozent', NULL),
('Traminerweg', 72, 'Ulm', 'Deutschland', 89075, 'userTestMitarbeiter', NULL),
('Eberhardtstraße', 85, 'Ulm', 'Deutschland', 89073, 'userTestTutor', NULL);

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

INSERT INTO Vorlesungsraum (raum_bezeichnung) VALUES
('A100'),
('A104'),
('V001'),
('V101'),
('Q027');

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
