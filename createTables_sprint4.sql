/**
 * SPRINT 04
 *
 * @author: Roland Schmid
 * Datum: 16.5.2015
 *
 * User Story: Als Mitarbeiter möchte ich einer Veranstaltung ein Fachsemester zuordnen können. (Nacharbeit)
 * Task: Tabelle "Studiengang_hat_Veranstaltung" ändern
 * Nr:  	310a
 * Points: 	5
 * Zeit: 	0.5
 *
 */

/* 	
	---------- Autor: Alexander Mayer ----------
	
	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				29.04.2015
	- Sprint: 				3
*/



-- -----------------------------------------------------
-- Table `Rolle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Rolle` ;

CREATE  TABLE `Rolle` 
(
	`rolle_ID` INT NOT NULL AUTO_INCREMENT,
	`rolle_bezeichnung` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`rolle_ID`)
);


-- -----------------------------------------------------
-- Table `Gebaeude`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Gebaeude` ;

CREATE  TABLE `Gebaeude` 
(
	`geb_bezeichnung` CHAR NOT NULL ,
	PRIMARY KEY (`geb_bezeichnung`) 
);


-- -----------------------------------------------------
-- Table `Nutzer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Nutzer` ;

CREATE  TABLE `Nutzer` 
(
	`nutzer_name` VARCHAR(45) NOT NULL ,
	`passwortHash` VARCHAR(255),
	`letzterLogin` DATETIME,
	`rolle_ID` INT NOT NULL ,
	PRIMARY KEY (`nutzer_name`),
	FOREIGN KEY (`rolle_ID` ) REFERENCES `Rolle` (`rolle_ID` )
);


-- -----------------------------------------------------
-- Table `Adresse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Adresse` ;

CREATE  TABLE `Adresse` 
(
	`adresse_ID` INT NOT NULL AUTO_INCREMENT,
	`straßenname` VARCHAR(45) NOT NULL ,
	`hausnummer` INT NOT NULL ,
	`stadt` VARCHAR(45) NOT NULL ,
	`land` VARCHAR(45) NOT NULL ,
	`plz` INT NOT NULL ,
	`nutzer_name` VARCHAR(45),
	`geb_bezeichnung` CHAR,
	PRIMARY KEY (`adresse_ID`) ,
    FOREIGN KEY (`geb_bezeichnung` ) REFERENCES `Gebaeude` (`geb_bezeichnung` ),
	FOREIGN KEY (`nutzer_name` ) REFERENCES `Nutzer` (`nutzer_name` )
);


-- -----------------------------------------------------
-- Table `EMail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EMail` ;

CREATE  TABLE `EMail` 
(
	`email_name` VARCHAR(45) NOT NULL ,
	`nutzer_name` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`email_name`),
	FOREIGN KEY (`nutzer_name` ) REFERENCES `Nutzer` (`nutzer_name` )
);


-- -----------------------------------------------------
-- Table `Eigenschaft`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Eigenschaft` ;

CREATE  TABLE `Eigenschaft` 
(
	`eigenschaft_ID` INT NOT NULL AUTO_INCREMENT,
	`eigenschaft_bezeichnung` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`eigenschaft_ID`)
);


-- -----------------------------------------------------
-- Table `Wert`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Wert` ;

CREATE  TABLE `Wert` 
(
	`eigenschaft_ID` INT NOT NULL,
	`nutzer_name` VARCHAR(45) NOT NULL,
	`inhalt` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`eigenschaft_ID`, `nutzer_name`),
	FOREIGN KEY (`eigenschaft_ID` ) REFERENCES `Eigenschaft` (`eigenschaft_ID` ),
	FOREIGN KEY (`nutzer_name` ) REFERENCES `Nutzer` (`nutzer_name` )
);

-- -----------------------------------------------------
-- Table `Rolle_hat_Eigenschaft`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Rolle_hat_Eigenschaft` ;

CREATE  TABLE `Rolle_hat_Eigenschaft` 
(
	`eigenschaft_ID` INT NOT NULL,
	`rolle_ID` INT NOT NULL,
	`reihenfolge` INT,
	PRIMARY KEY (`eigenschaft_ID`, `rolle_ID`),
	FOREIGN KEY (`eigenschaft_ID` ) REFERENCES `Eigenschaft` (`eigenschaft_ID` ),
	FOREIGN KEY (`rolle_ID` ) REFERENCES `Rolle` (`rolle_ID` )
);


-- -----------------------------------------------------
-- Table `Veranstaltungsart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Veranstaltungsart` ;

CREATE  TABLE `Veranstaltungsart` 
(
	`vArt_ID` INT NOT NULL AUTO_INCREMENT ,
	`vArt_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`vArt_ID`) 
);


-- -----------------------------------------------------
-- Table `Veranstaltung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Veranstaltung` ;

CREATE  TABLE `Veranstaltung` 
(
	`veranst_ID` INT NOT NULL AUTO_INCREMENT ,
	`veranst_bezeichnung` VARCHAR(100) NOT NULL ,
	`veranst_kurztext` VARCHAR(45) NULL ,
	`credits` INT NOT NULL ,
	`SWS` INT NOT NULL ,
	`maxTeilnehmer` INT NULL ,
	`vArt_ID` INT NOT NULL ,
	PRIMARY KEY (`veranst_ID`) ,
    FOREIGN KEY (`vArt_ID` ) REFERENCES `Veranstaltungsart` (`vArt_ID` )
);


-- -----------------------------------------------------
-- Table `Nutzer_beteiligtAn_Veranstaltung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Nutzer_beteiligtAn_Veranstaltung` ;

CREATE  TABLE `Nutzer_beteiligtAn_Veranstaltung` 
(
	`veranst_ID` INT NOT NULL,
	`nutzer_name` VARCHAR(45) NOT NULL,
	PRIMARY KEY (`veranst_ID`, `nutzer_name`),
	FOREIGN KEY (`veranst_ID` ) REFERENCES `Veranstaltung` (`veranst_ID` ),
	FOREIGN KEY (`nutzer_name` ) REFERENCES `Nutzer` (`nutzer_name` )
);


-- -----------------------------------------------------
-- Table `Raum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Raum` ;

CREATE  TABLE `Raum` 
(
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	`geb_bezeichnung` CHAR NOT NULL ,
	PRIMARY KEY (`raum_bezeichnung`) ,
    FOREIGN KEY (`geb_bezeichnung` ) REFERENCES `Gebaeude` (`geb_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Vorlesungsraum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Vorlesungsraum` ;

CREATE  TABLE `Vorlesungsraum` 
(
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`raum_bezeichnung`) ,
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Raum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Buero`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Buero` ;

CREATE  TABLE `Buero` 
(
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`raum_bezeichnung`) ,
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Raum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Laborart`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Laborart` ;

CREATE  TABLE `Laborart` 
(
	`lArt_ID` INT NOT NULL AUTO_INCREMENT ,
	`lArt_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`lArt_ID`) 
);


-- -----------------------------------------------------
-- Table `Laborraum`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Laborraum` ;

CREATE  TABLE `Laborraum` 
(
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	`lArt_ID` INT NOT NULL ,
	PRIMARY KEY (`raum_bezeichnung`) ,
    FOREIGN KEY (`lArt_ID` ) REFERENCES `Laborart` (`lArt_ID` ),
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Raum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Bibliothek`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bibliothek` ;

CREATE  TABLE `Bibliothek` 
(
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`raum_bezeichnung`) ,
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Raum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Stundenzeit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Stundenzeit` ;

CREATE  TABLE `Stundenzeit` 
(
	`stdZeit_ID` INT NOT NULL AUTO_INCREMENT ,
	`stdZeit_von` TIME NOT NULL ,
	`stdZeit_bis` TIME NOT NULL ,
	PRIMARY KEY (`stdZeit_ID`) 
);


-- -----------------------------------------------------
-- Table `Wochentag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Wochentag` ;

CREATE  TABLE `Wochentag` 
(
	`tag_ID` INT NOT NULL AUTO_INCREMENT ,
	`tag_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`tag_ID`) 
);


-- -----------------------------------------------------
-- Table `Veranstaltungstermin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Veranstaltungstermin` ;

CREATE  TABLE `Veranstaltungstermin` 
(
	`veranst_ID` INT NOT NULL ,
	`tag_ID` INT NOT NULL ,
	`stdZeit_ID` INT NOT NULL ,
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`veranst_ID`, `tag_ID`, `stdZeit_ID`) ,
    FOREIGN KEY (`stdZeit_ID` ) REFERENCES `Stundenzeit` (`stdZeit_ID` ),
    FOREIGN KEY (`tag_ID` ) REFERENCES `Wochentag` (`tag_ID` ),
    FOREIGN KEY (`veranst_ID` ) REFERENCES `Veranstaltung` (`veranst_ID` ),
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Raum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Studiengangtyp`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Studiengangtyp` ;

CREATE  TABLE `Studiengangtyp` 
(
	`stgTyp_ID` INT NOT NULL AUTO_INCREMENT ,
	`stgTyp_bezeichnung` VARCHAR(45) NOT NULL ,
	`stgTyp_kuerzel` VARCHAR(45) NULL ,
	PRIMARY KEY (`stgTyp_ID`) 
);


-- -----------------------------------------------------
-- Table `Fakultaet`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Fakultaet` ;

CREATE  TABLE `Fakultaet` 
(
	`fak_ID` INT NOT NULL AUTO_INCREMENT ,
	`fak_bezeichnung` VARCHAR(100) NOT NULL ,
	PRIMARY KEY (`fak_ID`) 
);


-- -----------------------------------------------------
-- Table `Studiengang`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Studiengang` ;

CREATE  TABLE `Studiengang` 
(
	`stg_ID` INT NOT NULL AUTO_INCREMENT ,
	`stg_bezeichnung` VARCHAR(100) NOT NULL ,
	`stgTyp_ID` INT NOT NULL ,
	`fak_ID` INT NOT NULL ,
	PRIMARY KEY (`stg_ID`) ,
    FOREIGN KEY (`stgTyp_ID` ) REFERENCES `Studiengangtyp` (`stgTyp_ID` ),
    FOREIGN KEY (`fak_ID` ) REFERENCES `Fakultaet` (`fak_ID` )
);



-- -----------------------------------------------------
-- Table `Studiengang_hat_Veranstaltung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Studiengang_hat_Veranstaltung` ;

CREATE  TABLE `Studiengang_hat_Veranstaltung` 
(
	`stg_ID` INT NOT NULL ,
	`veranst_ID` INT NOT NULL ,
	`pflicht_im_Semester` TINYINT(1) NOT NULL DEFAULT 1 ,
	PRIMARY KEY (`stg_ID`, `veranst_ID`) ,
    FOREIGN KEY (`stg_ID` ) REFERENCES `Studiengang` (`stg_ID` ),
    FOREIGN KEY (`veranst_ID` ) REFERENCES `Veranstaltung` (`veranst_ID` )
);


-- -----------------------------------------------------
-- Table `Buchkategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Buchkategorie` ;

CREATE  TABLE `Buchkategorie` 
(
	`buchKat_ID` INT NOT NULL AUTO_INCREMENT ,
	`buchKat_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`buchKat_ID`) 
);


-- -----------------------------------------------------
-- Table `Bibliothek_hat_Buchkategorie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Bibliothek_hat_Buchkategorie` ;

CREATE  TABLE `Bibliothek_hat_Buchkategorie` 
(
	`buchKat_ID` INT NOT NULL ,
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`buchKat_ID`, `raum_bezeichnung`) ,
    FOREIGN KEY (`buchKat_ID` ) REFERENCES `Buchkategorie` (`buchKat_ID` ),
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Bibliothek` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Ausstattung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ausstattung` ;

CREATE  TABLE `Ausstattung` 
(
	`ausstattung_ID` INT NOT NULL AUTO_INCREMENT ,
	`ausstattung_bezeichnung` VARCHAR(45) NOT NULL ,
	PRIMARY KEY (`ausstattung_ID`) 
);


-- -----------------------------------------------------
-- Table `Vorlesungsraum_hat_Ausstattung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Vorlesungsraum_hat_Ausstattung` ;

CREATE  TABLE `Vorlesungsraum_hat_Ausstattung` 
(
	`ausstattung_ID` INT NOT NULL ,
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	`anzahl` INT NOT NULL ,
	PRIMARY KEY (`ausstattung_ID`, `raum_bezeichnung`) ,
    FOREIGN KEY (`ausstattung_ID` ) REFERENCES `Ausstattung` (`ausstattung_ID` ),
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Vorlesungsraum` (`raum_bezeichnung` )
);


-- -----------------------------------------------------
-- Table `Veranstaltung_erfordert_Ausstattung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Veranstaltung_erfordert_Ausstattung` ;

CREATE  TABLE `Veranstaltung_erfordert_Ausstattung` 
(
	`veranst_ID` INT NOT NULL ,
	`ausstattung_ID` INT NOT NULL ,
	`anzahl` INT NOT NULL ,
	PRIMARY KEY (`veranst_ID`, `ausstattung_ID`) ,
    FOREIGN KEY (`ausstattung_ID` ) REFERENCES `Ausstattung` (`ausstattung_ID` ),
    FOREIGN KEY (`veranst_ID` ) REFERENCES `Veranstaltung` (`veranst_ID` )
);


-- -----------------------------------------------------
-- Table `Laborraum_hat_Ausstattung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Laborraum_hat_Ausstattung` ;

CREATE  TABLE `Laborraum_hat_Ausstattung` 
(
	`ausstattung_ID` INT NOT NULL ,
	`raum_bezeichnung` VARCHAR(45) NOT NULL ,
	`anzahl` INT NOT NULL ,
	PRIMARY KEY (`ausstattung_ID`, `raum_bezeichnung`) ,
    FOREIGN KEY (`ausstattung_ID` ) REFERENCES `Ausstattung` (`ausstattung_ID` ),
    FOREIGN KEY (`raum_bezeichnung` ) REFERENCES `Laborraum` (`raum_bezeichnung` )
);

