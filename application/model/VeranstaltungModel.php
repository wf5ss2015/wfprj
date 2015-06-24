<?php
/**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: Als Mitarbeiter möcht ich einem Studiengang Wahlfächer zuordnen könnenn.
 * Task: 	Model anpassen. 
 * Nr:		630
 * Points:	8
 * Zeit:	1.25
 *
 */

/**
 * SPRINT 05
 *
 * @author : Roland Schmid
 * Datum: 	09.6.2015
 * User­ Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern. (erneut)
 * Task: 	Bei Veranstaltung anlegen und bei bearbeiten im Punkt "Ausstattung eintragen" Nullen für leeres Feld eintragen.
 * Nr:		370a
 * Points:	5
 * Zeit: 	0.75
 * 
 * 
 * User­ Story: Als Mitarbeiter möchte ich eine mit Fakultät Studiengang Veranstaltung codierte Veranstaltungs-ID haben.
 * Task: 	Methode schreiben, die die Veranstaltungs-ID nach Muster generiert.
 * Nr:		540
 * Points:	5
 * Zeit: 	4
 *
 */
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.25 
 * User Story Nr.: 490
 * User Story: Als Verwalter möchte ich angeben können, ob für eine Veranstaltung eine Scheinleistung zu erbringen ist.
 * Task: model erweitern
 * ===============================================
 */
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
	
	
	
	
	public function dbgPrint($val , $name) {		
		print "<br>";
		print $name;
		print ": " . $val;
		print "<br>";		
	}

	
	
	/* sprint 5 Anfang
	 *
	 */
	
	
	/* Erstellt eine mit Fakultät-Studiengang-Veranstaltung codierte Veranstaltungs-ID.
	 * FFSSVVVV, VVVV in Zehner-Schritten (später sollen noch Tutorien, 
	 * 			 Übungsgruppen etc angehängt werden können in Einer-Schritten)
	 * F = fakultät
	 * S = studiengang
	 * V = veranstaltung (dynamisch)
	 */
	public function erstelleVID($stg_ID) {
		
		$vID = "0";		
	
		if($stg_ID > 0) {

			//Query-String
			$q = "select fak_ID from Studiengang where stg_ID = $stg_ID;";
			
			//Query ausführen
			$result = $this->abfrage($q);

			
			//Enthält die Fakultäts-ID			
			$fak_ID = $result[0]->fak_ID;

				
			//vID soll aussehen: FFSSVVVV. Dafür ist es u.U. nötig, der Fakultäts-ID eine führende Null zu geben
			if($fak_ID < 10) {
				$fak_ID = str_pad($fak_ID, 2, '0', STR_PAD_LEFT);	
			}
			

			
			//vID soll aussehen: FFSSVVVV. Dafür ist es u.U. nötig, der Fakultäts-ID eine führende Null zu geben
			if($stg_ID < 10) {
				$stg_ID = str_pad($stg_ID, 2, '0', STR_PAD_LEFT);
			}

			
			
			//erste Hälfte der erstellten $vID zusammensetzen
			$vID = $fak_ID . $stg_ID;			

		} else {
			//wenn die Veranstaltung keinem Studiengang zugeordnet werden soll, nimm 0000 als führende Ziffern	
			$vID = "0000";
		}

		

		//Query-String
		//gesucht wird die größte vID, die bereits der Fakultät/dem Studiengang zugeordnet ist
		//(Anm.: QUOTING wichtig: '_expr_', '%expr%')
		$q = "select max(veranst_ID) as vID from Veranstaltung where veranst_ID like '" . ($vID . "____") . "';";



		//Query ausführen
		$result = $this->abfrage($q);
		



		//sollte noch keine Veranstaltungs-ID für den Studiengang vorhanden sein, nimm 0000
		$max_vID = "0";
		if(empty($result[0]->vID)) {
			$max_vID = "0000";

		} else {
			$max_vID = $result[0]->vID;
			//die ersten vier Ziffern (FFSS) entfernen
			$max_vID = substr($max_vID, -4);

		}
		

		

		//entferne führende Nullen
		$count = 0;
//alt:		
// 		for($i=1; $i<3; $i++) {
// 			if($max_vID[$i] == "0") {
// 				$count++;
// 			}
// 		}
		//zählt nur so lange, wie Nullen links stehen; bei erster Ziffer ungleich 0 wird abgebrochen.
		for($i=1; $i<3; $i++) {
			if($max_vID[$i] != "0") {
				$i=3;
			} else {
				$count++;
			}
		}
		
		//liefert Substring ab $count (exklusiv)
		$max_vID = substr($max_vID, $count);		
// 		// größte vorhandene Veranstaltungs-ID auf nach unten 10 runden und 10 addieren
		$max_vID = $max_vID - ($max_vID % 10) + 10;

// 		// füllt den String VVVV links mit Nullen auf
		$max_vID = str_pad($max_vID, 4, '0', STR_PAD_LEFT);
// 		//setze die Veranstaltungs-ID zusammen
		$vID = $vID . $max_vID;
		
		return $vID;	
	}
	
	
	/* sprint 5 Ende
	 */
	
	
	
// Methode trägt benötigte Ausstattung im Array $ausstattung für eine Veranstaltung $vID ein 
	public function ausstattungEintragen($vID, $ausstattung) {
		
		// POST-Inhalt auslesen
		$insertValues = "";
		$veranstaltungAusstattung = $ausstattung;


		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();


		// Plausibilität prüfen
		for($i = 0; $i < count ( $veranstaltungAusstattung ); $i ++) {
			// prüft, ob eingegebener Wert wirklich eine Zahl ist
			if (is_numeric ( $veranstaltungAusstattung [$i] )) {
				
				// prüft, ob die angebenen Zahlen sinnvoll sind
				if($veranstaltungAusstattung[$i] < 100 && $veranstaltungAusstattung[$i] > 0) {
					$insertValues = $vID . ", " . ($i + 1) . ", " . $veranstaltungAusstattung[$i];
					
					// insert für mysql vorbereiten
					$insertString = "INSERT INTO Veranstaltung_erfordert_Ausstattung" 
									. " (veranst_ID, ausstattung_ID, anzahl)" 
									. " VALUES (" . $insertValues . ");";
					
					
				}
				/* sprint 5 Anfang
				 * Roland Schmid. Bei Veranstaltung anlegen und bei bearbeiten im Punkt "Ausstattung eintragen" Nullen für leeres Feld eintragen.
				 */
			} else {
				//Null eintragen, wenn im Formular nichts eingetragen worden ist.
				$insertValues = $vID . ", " . ($i + 1) . ", " . "0";
					
				// insert für mysql vorbereiten
				$insertString = "INSERT INTO Veranstaltung_erfordert_Ausstattung"
						. " (veranst_ID, ausstattung_ID, anzahl)"
						. " VALUES (" . $insertValues . ");";
				
			}
			
			//insert ausführen
			if (! $database->insert ( $insertString )) {
				// error ausgeben
			}
		}
	/* sprint 5 Ende
	 */
	 
	}

	/* sprint 4 Anfang
	 * 
	 */
	//löscht vorhandene Einträge aus der Koppeltabelle Veranstaltung_erfordert_Ausstattung
	public function ausstattungLoeschen($vID) {
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();

		$deleteString = "delete from Veranstaltung_erfordert_Ausstattung where veranst_ID = " . $vID . ";";

		$database->insert($deleteString);		
	}
	
	/* sprint 4 Ende
	 */
	
	
	
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
		
		$bez = Request::post ( 'veranstaltung_bezeichnung' );
		$kurztext = Request::post ( 'veranstaltung_kurztext' );
		$credits = Request::post ( 'veranstaltung_credits' );
		$sws = Request::post ( 'veranstaltung_sws' );
		$maxNo = Request::post ( 'veranstaltung_max_Teilnehmer' );
		$art = Request::post ( 'veranstaltung_veranstaltungsart' );
		
	/*
	 * ===============================================
	 * Start Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Verwalter möchte ich angeben können, ob für eine Veranstaltung eine Scheinleistung zu erbringen ist.
	 * ===============================================
	 */
		$scheinleistung = Request::post('veranstaltung_scheinleistung');
	/*
	 * ===============================================
	 * Ende Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Verwalter möchte ich angeben können, ob für eine Veranstaltung eine Scheinleistung zu erbringen ist.
	 * ===============================================
	 */
		$stg_ID = Request::post ( 'veranstaltung_pflichtvorlesung' );
		
		/* sprint 4 Anfang
		 * neue Variable fürs Fachsemester angelegt
		 */
		$fachsemester = Request::post('veranstaltung_fachsemester');
		/* sprint 4 Ende
		 */
// print "<br>vID:: " . $this->erstelleVID($stg_ID) . "<br>";		
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
	/*
	 * ===============================================
	 * Start Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Verwalter möchte ich angeben können, ob für eine Veranstaltung eine Scheinleistung zu erbringen ist.
	 * Note: Nur Scheinleistung hinzugefügt
	 * ===============================================
	 */
			$insertString = "INSERT INTO Veranstaltung (`veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, " . "`maxTeilnehmer`, `vArt_ID`, `scheinleistung`) " . "VALUES ('$bez', '$kurztext', '$credits', '$sws', '$maxNo', '$art', '$scheinleistung');";
	/*
	 * ===============================================
	 * Ende Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Verwalter möchte ich angeben können, ob für eine Veranstaltung eine Scheinleistung zu erbringen ist.
	 * ===============================================
	 */
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
	
	 // holt die Grunddaten einer Veranstaltung mit $vID
	 // (Bezeichnung, Kurztext, SWS, Credits, max. Anzahl Teilnehmer, VeranstaltungsartID) aus der Datenbank
	 public function getGrunddaten($vID) {
	
	 //Query-String
	 $q = "select veranst_ID, veranst_bezeichnung, veranst_kurztext, "
	 . "credits, SWS, maxTeilnehmer, vArt_ID "
	 . "from Veranstaltung"
	 . " where veranst_ID = $vID;";
	
	 //führt die Abfrage aus und speichert sie in $result
	 $result = $this->abfrage($q);
	
	 return $result;
	 }
	 
	 
	 public function updateVeranstaltung($data) {
	 	$valid = true;
	 	
	 	$grunddaten = $data['grunddaten'];
	 
// 	 	'vID' 			=> Request::post("vID"),
// 	 	'vBezeichnung' 	=> Request::post("vBezeichnung"),
// 	 	'vKurztext' 	=> Request::post("vKurztext"),
// 	 	'vSWS'		 	=> Request::post("vSWS"),
// 	 	'vCredits'	 	=> Request::post("vCredits"),
// 	 	'vMaxTeilnehmer'=> Request::post("vMaxTeilnehmer")
	 	
	 	$vID 			= $grunddaten['vID'];
	 	$vBezeichnung 	= $grunddaten['vBezeichnung'];
	 	$vKurztext 		= $grunddaten['vKurztext'];
	 	$vSWS			= $grunddaten['vSWS'];
	 	$vCredits 		= $grunddaten['vCredits'];
	 	$vMaxTeilnehmer	= $grunddaten['vMaxTeilnehmer'];
	 	
	 	
	 	$vArtID			= $data['vArtID'];
	 	
	 	$ausstattung 	= $data['ausstattung'];
	 	
	 	
	 	// Datenbankverbindung
	 	$database = new DatabaseFactoryMysql ();
	
	 	$updateString = "UPDATE Veranstaltung SET veranst_bezeichnung = '$vBezeichnung', "
	 			. "veranst_kurztext = '$vKurztext', credits = $vCredits, SWS = $vSWS, " 
				. "maxTeilnehmer = $vMaxTeilnehmer, vArt_ID = $vArtID "
				. "where veranst_ID = $vID;";
				
	 	$database->insert($updateString);
	 	
	 	// löscht Einträge in der Datenbank Veranstaltung_erfordert_Ausstattung
	 	$this->loescheAusstattung($vID);
	 	
	 	// trägt die neun Austattungsmerkmale ein
	 	$this->ausstattungEintragen($vID, $ausstattung);
	 	
 	}
 	
 	
 	/*
 	 * löscht Einträge in der Datenbank Veranstaltung_erfordert_Ausstattung 
 	 * */
 	public function loescheAusstattung($vID) {
 		
 		$delteString = "delete from Veranstaltung_erfordert_Ausstattung where veranst_ID = $vID;";
 		
 		// Datenbankverbindung
 		$database = new DatabaseFactoryMysql ();
 		
 		$database->insert($delteString);
 	
 	}
	 		
	 	
	 	
	 
	 
	
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* sprint 6 Anfang
	 * Task: Maske, um ein Fach einem Studiengang als Wahlfach zuordnen zu können.
	 */
	/*
	 * ruft alle Studiengänge aus der Datenbank ab, die dem Studiengang hinzugefügt werden können 
	 * 
	 */
	public function getStudiengaengeWahlfach($vID) {
	
		// query-string
		$q = "select stg_ID, stg_bezeichnung, stgTyp_kuerzel from Studiengang " 
			 . "join Studiengangtyp on Studiengang.stgTyp_ID = Studiengangtyp.stgTyp_ID;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		$result = $this->abfrage ( $q );
		
		return $result;
	}
	
	
	/*
	 * liefert Informationen zu einem Studiengang
	 * */
	public function getStudiengang($stg_ID) {
	
		// query-string
		$q = "select stg_ID, stg_bezeichnung, stgTyp_kuerzel from Studiengang "
				. "join Studiengangtyp on Studiengang.stgTyp_ID = Studiengangtyp.stgTyp_ID where stg_ID = $stg_ID;";
	
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
		$result = $this->abfrage ( $q );
	
		return $result;
	}
	
	
	/*
	 * trägt Wahlfach in Datenbank ein
	 * */
	public function setWahlfach($vID, $studiengang, $semester) {
		
		
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();
		
		$insertString = "INSERT INTO Studiengang_hat_Wahlfach (stg_ID, veranst_ID, ab_Semester) "
				        . " VALUES ($vID, $studiengang, $semester);";
		
		$database->insert ( $insertString );		
	}
	

	
	/* sprint 6 Ende */
	
	
	
	
	
	
	
	
	

	
	private function abfrage($q) {
		// Datenbankverbindung
		$database = new DatabaseFactoryMysql ();
		
		// erzeugt ein Resultset
		$result = $database->query ( $q );
		
		return $result;
	}
}
