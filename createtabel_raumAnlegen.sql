/*
	author: Kris Klamser
    datum: 17.04.2015
    Lehrveranstaltungsmanagement: version 2 von raum_gebaeude_tabellen
    create tabels
    sprint: 02
    zeitaufwand: 0,5 h
*/
-- -----------------------------------------------------
-- Table 'Gebaeude'
-- -----------------------------------------------------
DROP TABLE IF EXISTS Gebaeude;

CREATE TABLE IF NOT EXISTS Gebaeude (
  gebaeudeID CHAR(1) NOT NULL,
  anschrift   VARCHAR(45) NOT NULL,
  plz   VARCHAR(45) NOT NULL,
  PRIMARY KEY (  gebaeudeID  ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  .  Vorlesungsraum  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Vorlesungsraum   ;

CREATE TABLE IF NOT EXISTS Vorlesungsraum   (
    bezeichnung   VARCHAR(45) NOT NULL,
    Gebaeude_gebaeudeID   CHAR(1) NOT NULL,
  PRIMARY KEY (  bezeichnung  ),
  INDEX   fk_Raum_Gebaeude_idx   (  Gebaeude_gebaeudeID   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Büro  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Büro;

CREATE TABLE IF NOT EXISTS Büro   (
    bezeichnung   VARCHAR(45) NOT NULL,
    Gebaeude_gebaeudeID   CHAR(1) NOT NULL,
  PRIMARY KEY (  bezeichnung  ),
  INDEX   fk_Büro_Gebaeude1_idx   (  Gebaeude_gebaeudeID   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Labor  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Labor   ;

CREATE TABLE IF NOT EXISTS Labor   (
    bezeichnung   VARCHAR(45) NOT NULL,
    Gebaeude_gebaeudeID   CHAR(1) NOT NULL,
    kapazitaet   INT NOT NULL,
  PRIMARY KEY (  bezeichnung  ),
  INDEX   fk_Labor_Gebaeude1_idx   (  Gebaeude_gebaeudeID   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Bibliothek  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Bibliothek   ;

CREATE TABLE IF NOT EXISTS Bibliothek   (
    bibliothekID   INT NOT NULL,
    Gebaeude_gebaeudeID   CHAR(1) NOT NULL,
  PRIMARY KEY (  bibliothekID  ),
  INDEX   fk_Bibliothek_Gebaeude1_idx   (  Gebaeude_gebaeudeID   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Buchkategorie  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Buchkategorie   ;

CREATE TABLE IF NOT EXISTS Buchkategorie   (
    kategorieID   INT NOT NULL,
    bezeichnung   VARCHAR(45) NOT NULL,
  PRIMARY KEY (  kategorieID  ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Laborart  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Laborart   ;

CREATE TABLE IF NOT EXISTS  Laborart   (
    labArtID   INT NOT NULL,
    fachschaft   VARCHAR(45) NOT NULL,
    Labor_bezeichnung   VARCHAR(45) NOT NULL,
  PRIMARY KEY (  labArtID  ),
  INDEX   fk_Laborart_Labor1_idx   (  Labor_bezeichnung   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table Bibliothek_has_Buchkategorie  
-- -----------------------------------------------------
DROP TABLE IF EXISTS Bibliothek_has_Buchkategorie   ;

CREATE TABLE IF NOT EXISTS Bibliothek_has_Buchkategorie   (
    Bibliothek_bibliothekID   INT NOT NULL,
    Buchkategorie_kategorieID   INT NOT NULL,
  PRIMARY KEY (  Bibliothek_bibliothekID  ,   Buchkategorie_kategorieID  ),
  INDEX   fk_Bibliothek_has_Buchkategorie_Buchkategorie1_idx   (  Buchkategorie_kategorieID   ASC),
  INDEX   fk_Bibliothek_has_Buchkategorie_Bibliothek1_idx   (  Bibliothek_bibliothekID   ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Ausstattung  
-- -----------------------------------------------------
DROP TABLE IF EXISTS  Ausstattung   ;

CREATE TABLE IF NOT EXISTS Ausstattung   (
    ausstattungID   INT NOT NULL,
    bezeichnung   VARCHAR(45) NOT NULL,
  PRIMARY KEY (  ausstattungID  ))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table  Vorlesungsraum_has_Ausstattung  
-- -----------------------------------------------------
DROP TABLE IF EXISTS  Vorlesungsraum_has_Ausstattung;

CREATE TABLE IF NOT EXISTS Vorlesungsraum_has_Ausstattung   (
    Vorlesungsraum_bezeichnung   VARCHAR(45) NOT NULL,
    Ausstattung_ausstattungID   INT NOT NULL,
    anzahl   INT NOT NULL,
  PRIMARY KEY (  Vorlesungsraum_bezeichnung  ,   Ausstattung_ausstattungID  ),
  INDEX   fk_Vorlesungsraum_has_Ausstattung_Ausstattung1_idx   (  Ausstattung_ausstattungID   ASC),
  INDEX   fk_Vorlesungsraum_has_Ausstattung_Vorlesungsraum1_idx   (  Vorlesungsraum_bezeichnung   ASC))
ENGINE = InnoDB;
