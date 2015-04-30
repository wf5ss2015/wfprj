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
-- Änderung der Tabelle User auf der Teamdatenbank
-- Erstellung einer Verbindung zwischen User und dem Studiengang dem ein User zugeordnet ist.
-- Die Lösung ist noch nicht ideal, da der Studiengang nur für Studenten benötigt wird, so aber auch für 
-- alle anderen Rollen bereitgestellt wird. Allerdings bin ich mir noch nicht sicher, wie ich das
-- anderst am besten verknüpfen kann.
-- TODO: Die Testdaten müssen dementsprechend geändert werden, da in Eigenschaften derzeit noch das 
-- die Eigenschaft Studiengang besteht. Die DB sollte aber trozdem funktionieren.

ALTER TABLE user
ADD stgTyp_ID INT,

ADD FOREIGN KEY (stgTyp_ID)
REFERENCES Studiengangtyp(stgTyp_ID);

