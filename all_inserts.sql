
--
-- Datenbank: 'wfprj_wf5_09'
--
--
-- Daten für Tabelle 'rolle'
--

INSERT INTO rolle VALUES
(1, 'Student'),
(2, 'Dozent'),
(3, 'Mitarbeiter'),
(4, 'Tutor');

--
-- Daten für Tabelle 'gebaeude'
--

INSERT INTO gebaeude VALUES
('1'),
('2'),
('3');

--
-- Daten für Tabelle 'user'
--

INSERT INTO Nutzer VALUES
('dozent', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', '1430339080', 2),
('mitarbeiter', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', NULL, 3),
('student', '$2y$10$8pEgYNZX7GW8FYfp8Mzbz.g./61axiS/wx2np.bWw92N361fBFNp6', '1430327378', 1),
('tutor', '$2y$10$kflo8og3yPg0cquTGK6nY.HOkx6JVjMGK8Dja4XXIzWURmZBVleZ6', '1430327729', 4),
('userTestDozent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 2),
('userTestMitarbeiter', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 3),
('userTestStudent', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 1),
('userTestTutor', '$2y$10$2amC8qNgJE6n/YkOnB82d.Dxmv.aMXppzaDqwcT.oxBcSd6PkMUOu', NULL, 4);


--
-- Daten für Tabelle 'adresse'
--

INSERT INTO adresse VALUES
(1, 'Prittwitzstraße', 10, 'Ulm', 'Deutschland', 89075, NULL, '1'),
(2, 'Albert-Einstein-Allee', 55, 'Ulm', 'Deutschland', 89081, NULL, '2'),
(3, 'Eberhard-Finckh Straße', 11, 'Ulm', 'Deutschland', 89075, NULL, '3'),
(4, 'Frauenstraße', 113, 'Ulm', 'Deutschland', 89073, 'userTestStudent', NULL),
(5, 'Schaffnerstraße', 5, 'Ulm', 'Deutschland', 89073, 'userTestDozent', NULL),
(6, 'Traminerweg', 72, 'Ulm', 'Deutschland', 89075, 'userTestMitarbeiter', NULL),
(7, 'Eberhardtstraße', 85, 'Ulm', 'Deutschland', 89073, 'userTestTutor', NULL);


--
-- Daten für Tabelle 'email'
--

INSERT INTO email VALUES
('userTestDozent@hs-ulm.de', 'userTestDozent'),
('userTestMitarbeiter@hs-ulm.de', 'userTestMitarbeiter'),
('userTestStudent@hs-ulm.de', 'userTestStudent'),
('userTestTutor@hs-ulm.de', 'userTestTutor');

--
-- Daten für Tabelle 'eigenschaft'
--

INSERT INTO eigenschaft VALUES
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

--
-- Daten für Tabelle 'wert'
--

INSERT INTO wert VALUES
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

--
-- Daten für Tabelle 'rolle_hat_eigenschaft'
--

INSERT INTO rolle_hat_eigenschaft VALUES
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


--
-- Daten für Tabelle 'veranstaltungsart'
--

INSERT INTO veranstaltungsart VALUES
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

--
-- Daten für Tabelle 'veranstaltung'
--

INSERT INTO veranstaltung VALUES
(1, 'Programmieren 1', 'Prog1', 5, 4, 32, 18),
(2, 'Programmieren 2', 'Prog2', 5, 4, 32, 18),
(3, 'Rechnernetze', 'RNET', 5, 4, 30, 16),
(4, 'Seminar Wirtschaftsinformatik', 'SEMWIF', 4, 2, 30, 10),
(5, 'Database Programming', 'DAPRO', 5, 4, 30, 17),
(6, 'Physik 1', 'PH1', 5, 4, 30, 16),
(7, 'Chemie 1', 'CH1', 5, 4, 30, 16),
(8, 'Strahlentechnik', 'STechnik', 5, 4, 30, 16),
(9, 'Maschinenbau Grundlagen', 'MBau-GRDL', 5, 4, 30, 16);

--
-- Daten für Tabelle 'user_beteiligtan_veranstaltung'
--

INSERT INTO user_beteiligtan_veranstaltung VALUES
(1, 'dozent'),
(2, 'dozent'),
(3, 'dozent'),
(5, 'mitarbeiter'),
(1, 'student'),
(2, 'student'),
(1, 'tutor'),
(2, 'userTestStudent'),
(1, 'userTestTutor');

--
-- Daten für Tabelle 'raum'
--

INSERT INTO raum VALUES
('', '1'),
('A100', '1'),
('A104', '1'),
('B055', '1'),
('B107', '1'),
('F007', '1'),
('Q027', '2'),
('Q209', '2'),
('V001', '2'),
('V101', '2'),
('Z107', '3');

--
-- Daten für Tabelle 'vorlesungsraum'
--

INSERT INTO vorlesungsraum VALUES
(''),
('A100'),
('A104'),
('Q027'),
('V001'),
('V101');

--
-- Daten für Tabelle 'laborart'
--

INSERT INTO laborart VALUES
(1, 'Rechnerlabor'),
(2, 'Chemielabor'),
(3, 'Physiklabor'),
(4, 'Strahlenlabor'),
(5, 'Maschinenbaulabor');

--
-- Daten für Tabelle 'laborraum'
--

INSERT INTO laborraum VALUES
('B107', 1),
('Q209', 2),
('B055', 3),
('Z107', 4),
('F007', 5);

--
-- Daten für Tabelle 'stundenzeit'
--

INSERT INTO stundenzeit VALUES
(1, '08:00:00', '09:30:00'),
(2, '09:50:00', '11:20:00'),
(3, '11:30:00', '13:00:00'),
(4, '14:00:00', '15:30:00'),
(5, '15:45:00', '17:15:00'),
(6, '17:25:00', '18:55:00'),
(7, '19:00:00', '20:30:00');

--
-- Daten für Tabelle 'wochentag'
--

INSERT INTO wochentag VALUES
(1, 'Montag'),
(2, 'Dienstag'),
(3, 'Mittwoch'),
(4, 'Donnerstag'),
(5, 'Freitag'),
(6, 'Samstag'),
(7, 'Sonntag');

--
-- Daten für Tabelle 'studiengangtyp'
--

INSERT INTO studiengangtyp VALUES
(1, 'Bachelor', 'BA'),
(2, 'Master of Science', 'M.Sc.'),
(3, 'Master of Arts', 'M.A.');


--
-- Daten für Tabelle 'fakultaet'
--

INSERT INTO fakultaet VALUES
(1, 'Elektrotechnik und Informationstechnik'),
(2, 'Mathematik, Natur- und Wirtschaftswissenschaften'),
(3, 'Informatik'),
(4, 'Maschinenbau und Fahrzeugtechnik'),
(5, 'Produktionstechnik und Produktionswirtschaft'),
(6, 'Mechatronik und Medizintechnik');


--
-- Daten für Tabelle 'studiengang'
--

INSERT INTO studiengang VALUES
(1, 'Technische Informatik', 1, 3),
(2, 'Wirtschaftsinformatik', 1, 3),
(3, 'Medizintechnik', 1, 6),
(4, 'Maschinenbau', 1, 4),
(5, 'Information Systems', 2, 3);

--
-- Daten für Tabelle 'ausstattung'
--

INSERT INTO ausstattung VALUES
(1, 'Stuhl'),
(2, 'Computer'),
(3, 'Beamer'),
(4, 'Projektor'),
(5, 'Overheadprojektor'),
(6, 'Praesentations-Computer'),
(7, 'HDMI-Anschluss'),
(8, 'Whiteboard'),
(9, 'Schiefertafel'),
(10, 'Telefon');


--
-- Daten für Tabelle 'vorlesungsraum_hat_ausstattung'
--

INSERT INTO vorlesungsraum_hat_ausstattung VALUES
(1, 'A100', 40),
(1, 'A104', 40),
(1, 'Q027', 30),
(1, 'V001', 40),
(1, 'V101', 40),
(2, 'A100', 0),
(2, 'A104', 0),
(2, 'Q027', 30),
(2, 'V001', 40),
(2, 'V101', 0),
(3, 'A100', 1),
(3, 'A104', 1),
(3, 'Q027', 1),
(3, 'V001', 1),
(3, 'V101', 1),
(4, 'A100', 1),
(4, 'A104', 1),
(4, 'Q027', 1),
(4, 'V001', 1),
(4, 'V101', 1),
(5, 'A100', 1),
(5, 'A104', 1),
(5, 'Q027', 1),
(5, 'V001', 1),
(5, 'V101', 1),
(6, 'A100', 1),
(6, 'A104', 1),
(6, 'Q027', 1),
(6, 'V001', 1),
(6, 'V101', 1),
(7, 'A100', 1),
(7, 'A104', 1),
(7, 'Q027', 1),
(7, 'V001', 1),
(7, 'V101', 1),
(8, 'A100', 1),
(8, 'A104', 1),
(8, 'Q027', 1),
(8, 'V001', 1),
(8, 'V101', 1),
(9, 'A100', 0),
(9, 'A104', 0),
(9, 'Q027', 0),
(9, 'V001', 0),
(9, 'V101', 0),
(10, 'A100', 0),
(10, 'A104', 0),
(10, 'Q027', 0),
(10, 'V001', 0),
(10, 'V101', 0);


--
-- Daten für Tabelle 'veranstaltung_erfordert_ausstattung'
--

INSERT INTO veranstaltung_erfordert_ausstattung VALUES
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

--
-- Daten für Tabelle 'laborraum_hat_ausstattung'
--

INSERT INTO laborraum_hat_ausstattung VALUES
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




















