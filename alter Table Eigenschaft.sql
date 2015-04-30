-- -----------------------------------------------------
--  Projekt: Lehrveranstaltungssoftware
--  Name:  Marc Rölke
--	Sprint: 3
--  Version: 1
-- -----------------------------------------------------
 
--  User-Story (Nr. ): 220 Als Verwalter möchte ich Personen mit Rollen anlegen kÃ¶nnen. (42 Points)
--  Task: Erstellung einer einheitlichen generischen Tabellenstruktur zum anlegen für Rollen und deren Eigenschaften
--  Zeitaufwand: 0.5 Stunden
--
--
-- -----------------------------------------------------
-- Änderung der Tabelle Eigenschaft auf der Teamdatenbank

ALTER TABLE eigenschaft
ADD notNull boolean;