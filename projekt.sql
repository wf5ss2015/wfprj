--
-- Daten für Tabelle `user`
--
CREATE TABLE IF NOT EXISTS `user` (
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Passwort hashed & salted',
  `user_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '',
  `user_role` varchar(64) NOT NULL DEFAULT 'null' COMMENT '',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp des letzten login'
) ENGINE=InnoDB COMMENT='Nutzerdaten';

--
-- Daten für Tabelle `user`
--
INSERT INTO `user` (`user_name`, `user_password_hash`, `user_email`, `user_role`, `user_last_login_timestamp`) VALUES
('dozent', '$2y$10$9hp5twC0HZKV4iDzE5pVku/wlMcG7GyazH.hUAzxNQkac.j0yuZwW', 'dozent@dozent.de', 'docent', 1429477277),
('student', '$2y$10$8pEgYNZX7GW8FYfp8Mzbz.g./61axiS/wx2np.bWw92N361fBFNp6', 'student@student.de', 'student', 1429477271),
('mitarbeiter', '$2y$10$PfLvMjTQ/6xNaodgDPcdP.edJJ17bK3vvexaF6sknagAvW.YBeu1.', 'mitarbeiter@mitarbeiter.de', 'employee', 1429477287),
('tutor', '$2y$10$kflo8og3yPg0cquTGK6nY.HOkx6JVjMGK8Dja4XXIzWURmZBVleZ6', 'tutor@tutor.de', 'tutor', 1429477292);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY `user_name` (`user_name`), ADD UNIQUE KEY `user_email` (`user_email`);


