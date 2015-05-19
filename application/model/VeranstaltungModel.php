<?php
/**
 * SPRINT 04
 *
 * @author : Roland Schmid
 * Datum: 	16.5.2015
 * User­ Story: Als Mitarbeiter möchte ich einer Veranstaltung ein Fachsemester zuordnen können. (Nacharbeit)
 * Task: 	Semester in Abhängigkeit von gewähltem Studiengang eintragen
 * Nr:		310a
 * Points:	5
 * Zeit: 	0.5
 * 
 * Datum: 	19.5.2015
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können. (Nacharbeit)
 * Task: 	Model erweitern
 * Nr:		210a
 * Points:	13
 * Zeit: 
 *
 */

/**
 * SPRINT 03
 *
 * @author: Roland Schmid
 * Datum: 	6.5.2015
 * User­ Story: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * Task: Werte in (neue) Tabelle eintragen. 
 * Task: Eingabeformular für Veranstaltungen anpassen.
 * Nr:		130b
 * Points:	5
 * Zeit: 	2
 *
 * User Story: Als Entwickler möchte ich im MVC-Pattern programmieren können
 * Task: Bisherigen Code in MVC einfügen und anpassen.
 * Nr:  	340
 * Points: 	40
 * Zeit: 	4
 *
 */

/**
 * SPRINT 01
 *
 * @author: Roland Schmid
 * Datum: 	8.4.2015
 * User­ Story: Als Verwalter möchte ich Veranstaltungen anlegen können.
 * Nr:		120
 * Task: Daten aus Datenbank für die Maske auslesen. 
 * Task: Daten in Datenbank schreiben.
 * Points:	13 
 * Zeit: 	2
 *
 */



/**
 *
 * @author Roland Schmid
 *         Model für Veranstaltungen
 */
class VeranstaltungModel {
	/**
	 *
	 * @author Roland Schmid
	 *        
	 *        
	 */
	
	// TODO
	public function ausstattungEintragen($vid) {
		
		// POST-Inhalt auslesen
		$insertValues = "";
		$veranstaltungAusstattung = $_POST ["veranstaltung_ausstattung"];
		
		// TODO vorhandene Einträge löschen (für Veranstaltung aktualisieren
		// $deleteString = "delete from VeranstaltungBrauchtAusstattung where VeranstaltungID = " . $vid . ";";
		$deleteString = "delete from Veranstaltung_erfordert_Ausstattung where veranst_ID = " . $vid . ";";
		
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();

		// Plausibilität prüfen
		for($i = 0; $i < count ( $veranstaltungAusstattung ); $i ++) {
			// prüft, ob eingegebener Wert wirklich eine Zahl ist
			if (is_numeric ( $veranstaltungAusstattung [$i] )) {
				
				// prüft, ob die angebenen Zahlen sinnvoll sind
				if($veranstaltungAusstattung[$i] < 100 && $veranstaltungAusstattung[$i] > 0) {
					$insertValues = $vid . ", " . ($i + 1) . ", " . $veranstaltungAusstattung[$i];
					
					// insert für mysql vorbereiten
					$insertString = "INSERT INTO Veranstaltung_erfordert_Ausstattung" 
									. " (veranst_ID, ausstattung_ID, anzahl)" 
									. " VALUES (" . $insertValues . ");";
					
					if (! $database->insert ( $insertString )) {
						// error ausgeben
					}
				}
			}
		}
	}
	
	/* sprint 3 Anfang 
	 * Methode zur Prüfung von Integer-Eingabewerten eingefügt
	 */
		
	/*
	 * prüft, ob die Eingabe ein int im Bereich [$min, $max] ist
	 *
	 * von http://phpsecurity.readthedocs.org/en/latest/Input-Validation.html
	 */
	
	//
	public function checkIntegerInput($int, $min, $max) {
		if (is_string ( $int ) && ! ctype_digit ( $int )) {
			return false; // enthält Zeichen, die keine Ziffern sind
		}
		if (! is_int ( ( int ) $int )) {
			return false; // nicht-Integer oder größer PHP_MAX_INT
		}
		return ($int >= $min && $int <= $max);
	}

	/* sprint 3 Ende */

	
	/*
	 * @author Roland Schmid
	 *
	 * gibt die ID der eingetragenen Veranstaltung zurück, sonst -1
	 *
	 */
	public function veranstaltungAnlegen() {
		$valid = true;
		// Request::post('name')
		// altes Format: $bez = $_POST['veranstaltung_bezeichnung'];
		$bez = Request::post ( 'veranstaltung_bezeichnung' );
		$kurztext = Request::post ( 'veranstaltung_kurztext' );
		$credits = Request::post ( 'veranstaltung_credits' );
		$sws = Request::post ( 'veranstaltung_sws' );
		$maxNo = Request::post ( 'veranstaltung_max_Teilnehmer' );
		$art = Request::post ( 'veranstaltung_veranstaltungsart' );
		
		$stg_ID = Request::post ( 'veranstaltung_pflichtvorlesung' );
		
		/* sprint 4 Anfang
		 * neue Variable fürs Fachsemester angelegt
		 */
		$fachsemester = Request::post('veranstaltung_fachsemester');
		/* sprint 4 Ende
		 */
		
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();
		
		// TO-DO : Ausstattung löschen (inbes. für Änderungen)
		
		// einfache Prüfung, ob überall was drin steht
		if (strlen ( $bez ) < 1)
			$valid = false;
		if (strlen ( $kurztext ) < 1)
			$valid = false;
			
		/* sprint 3 Anfang 
		 * Prüfung angepasst 
		 */

		if (! ($this->checkIntegerInput ( $maxNo, 1, 1000 ))) {
			$valid = false;
			/* TODO : Fehlermeldung ausgeben */
		}
		
		/* sprint 3 Ende */
		
		// wenn alle Prüfungen positiv, führe insert aus
		if ($valid) {
			
			$insertString = "INSERT INTO Veranstaltung (`veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, " . "`maxTeilnehmer`, `vArt_ID`) " . "VALUES ('$bez', '$kurztext', '$credits', '$sws', '$maxNo', '$art');";
			
			if ($database->insert ( $insertString )) {
				// speichert die ID, unter der die neue Veranstaltung eingetragen wurde
				$vID = $database->insert_id;
				
				// Veranstaltung wird als Pflichtveranstaltung in Tabelle
				// "Studiengang_hat_Veranstaltung" eingetragen, wenn die gewählte ID > 0
				if ($stg_ID > 0) {
					/* sprint 4 Anfang
					 * Paramterliste angepasst, jetzt wird das Fachsemsester mit übergeben.
					 */
					$this->setPflichtVeranstaltung ( $stg_ID, $vID, $fachsemester );
					/* sprint 4 Ende
					 */
				}
				
				// echo "<br>im model, in methode vAnlegen, nach insert<br>";
				// echo "<br>$database->insert_id<br>";
				
				// holt die letzte eingetragene ID
				return $vID;
			} else {
				return - 1;
			}
		}
	}
	
	/*
	 * Macht einen Eintrag in die Tabelle Studiengang_hat_Veranstaltung, in der festgehalten wird,
	 * dass eine Vorlesung $veranst_ID eine Pflichtveranstaltung im Studiengang $stg_ID ist
	 *
	 */
	public function setPflichtVeranstaltung($stg_ID, $veranst_ID, $fachsemester) {
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();
		/* sprint 4 Anfang
		 * Paramterliste angepasst, jetzt wird das Fachsemsester mit übergeben.
		 */
		//$vID = $veranst_ID;
		//$this->setPflichtVeranstaltung ( $stg_ID, $vID, $fachsemester );
		
		//alter Insertstring:
		//$insertString = "INSERT INTO Studiengang_hat_Veranstaltung (stg_ID, " . "veranst_ID, pflicht) VALUES ($stg_ID, $veranst_ID, 1);";
		
		$insertString = "INSERT INTO Studiengang_hat_Veranstaltung (stg_ID, " 
						. "veranst_ID, pflicht_im_Semester) VALUES ($stg_ID, $veranst_ID, $fachsemester);";
		
		/* sprint 4 Ende
		 */
		$database->insert ( $insertString );
	}
	
	
	
	/* sprint 3 Ende */
	
	/* sprint 4 Anfang
	 * alle Veranstaltungen aus der Datenbank auslesen
	 */
	
	// gibt ein array zurück mit allen vorhandenen Veranstaltungen
	public function getAlleVeranstaltungen() {
		// query-String
		/*
		 * $q = "SELECT VeranstaltungID, Bezeichnung, Kurztext, Credits, SWS, "
		 * . "max_Teilnehmer, Veranstaltungsart "
		 * . "from Veranstaltung;";
		 */
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		
		// Query-String, mit dem alle Veranstaltungen ausgelesen werden
		$q = "select Veranstaltung.veranst_ID, Veranstaltung.veranst_bezeichnung, Veranstaltung.veranst_kurztext, "
			 . "Veranstaltung.credits, Veranstaltung.SWS, "
			 . "Veranstaltung.maxTeilnehmer, Veranstaltungsart.vArt_bezeichnung as Veranstaltungsart "
		     . "from Veranstaltung join Veranstaltungsart on Veranstaltung.vArt_ID = Veranstaltungsart.vArt_ID;";
			 //. " where Veranstaltung.veranst_ID = $vID;";
		
		// führt die Abfrage aus und speichert das resultset in $result
		$result = $this->abfrage($q);
		
		return $result;
	}
	
/*	UNNÖTIG. normale getVeranstaltung und nicht alles nutzen tuts auch
	// holt die Grunddaten einer Veranstaltung mit $vID 
	// (Bezeichnung, Kurztext, SWS, Credits, max. Anzahl Teilnehmer) aus der Datenbank
	public function getVeranstaltungGrunddaten($vID) {
		
		//Query-String
		$q = "select Veranstaltung.veranst_ID, Veranstaltung.veranst_bezeichnung, Veranstaltung.veranst_kurztext, "
				. "Veranstaltung.credits, Veranstaltung.SWS, "
				. "Veranstaltung.maxTeilnehmer, Veranstaltungsart.vArt_bezeichnung as Veranstaltungsart "
			    . "from Veranstaltung"
			    . " where Veranstaltung.veranst_ID = $vID;";
	
		//führt die Abfrage aus und speichert sie in $result
		$result = $this->abfrage($q);
	
		return $result;
	}
*/
	/* sprint 4 Ende */
	// holt die veranstaltung mit id = $vID
	public function getVeranstaltung($vID) {

		$q = "select Veranstaltung.veranst_ID, Veranstaltung.veranst_bezeichnung, Veranstaltung.veranst_kurztext, "
		     . "Veranstaltung.credits, Veranstaltung.SWS, " 
		     . "Veranstaltung.maxTeilnehmer, Veranstaltungsart.vArt_bezeichnung as Veranstaltungsart "
		     . "from Veranstaltung join Veranstaltungsart on Veranstaltung.vArt_ID = Veranstaltungsart.vArt_ID" 
		     . " where Veranstaltung.veranst_ID = $vID;";
		
		$result = $this->abfrage ( $q );
		
		return $result;
	}
	

	
	/*
	 * Holt alle Veranstaltungsarten aus der Datenbank
	 */
	public function getVeranstaltungsarten() {
		// query-string
		$q = "SELECT vArt_ID, vArt_bezeichnung from Veranstaltungsart;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		$result = $this->abfrage ( $q );
		
		return $result;
	}
	
	/*
	 * Holt alle Ausstattungsgegenstände aus der Datenbank
	 */
	public function getAusstattung() {
		// query-string
		$q = "SELECT ausstattung_ID, ausstattung_bezeichnung from Ausstattung";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		$result = $this->abfrage ( $q );
		
		return $result;
	}
	
	/*
	 * Liest alle Studiengaenge aus der Datenbank
	 *
	 */
	public function getStudiengaenge() {
		// query-string
		$q = "select stg_ID, stg_bezeichnung, stgTyp_kuerzel from Studiengang " . "join Studiengangtyp on Studiengang.stgTyp_ID = Studiengangtyp.stgTyp_ID;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		$result = $this->abfrage ( $q );
		
		return $result;
	}
	
	
	/* sprint 4 Anfang
	 * Methode für User Story "Veranstaltung bearbeiten"
	 * */
	
	// Schreibt Veranstaltungsart zur Veranstaltung in Datenbank
	public function setVeranstaltungsart() {
		
		
	}
	/* sprint 4 Ende
	 */
	
	
	private function abfrage($q) {
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();
		
		// erzeugt ein Resultset
		$result = $database->query ( $q );
		
		return $result;
	}
}
