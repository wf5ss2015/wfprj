
<?php
 /* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 12.05.2015
 * User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können (Points 13)
 * Zeit insgesamt: 7
 * ===============================================*/

/** ===============================================
 * SPRINT 03
 *
 * @author: Damian Wysocki
 * Datum: 29.04.2015
 *
 * User­Story (Nr. 150a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
 * Zeit: 8
 *===============================================*/

/**
 * @author Damian Wysocki      
 *         Beschreibung: Model Klasse, um Datenbankabfragen für Funktionen eines Dozenten auszuführen       
 */
 
class DozentModel {

	/**-----------------------------------------------------------------------------------------
	* START SPRINT 03
	* @author: Damian Wysocki
	* User­Story (Nr. 150a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
	* START SPRINT 03
	*/
	// Funktion die anhand der veranst_ID alle Teilnehmer ausliest
	public static function getTeilnehmer($id) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// Jeder angelegte User sollte eine hinterlegte Email Adresse haben, da sonst nicht angezeigt
		// Pivot-Funktion in MySQL nicht verfügbar
		$sql = "SELECT  ubv.nutzer_name AS Nutzername, e.email_name AS Email,
				coalesce(MAX(case when w.eigenschaft_ID = 2 then w.inhalt end), 0) as Matrikel,
				coalesce(MAX(case when w.eigenschaft_ID = 3 then w.inhalt end), 0) as Vorname,
				coalesce(MAX(case when w.eigenschaft_ID = 4 then w.inhalt end), 0) as Nachname,
				coalesce(MAX(case when w.eigenschaft_ID = 7 then w.inhalt end), 0) as Telefonnummer,
				coalesce(MAX(case when w.eigenschaft_ID = 10 then w.inhalt end), 0) as Studiengang
				FROM wert w
				JOIN nutzer u
				ON u.nutzer_name = w.nutzer_name
				JOIN email e
				ON e.nutzer_name = w.nutzer_name
				JOIN nutzer_beteiligtAn_veranstaltung ubv
				ON ubv.nutzer_name = w.nutzer_name
				JOIN veranstaltung v
				ON ubv.veranst_ID = v.veranst_ID
				WHERE ubv.veranst_ID = :id
				GROUP BY w.nutzer_name ASC;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':id' => $id 
			) );
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
		//print_r($query->fetch());
		
		return $query->fetchAll ();
		
		/*
		 * Tabellenstruktur
		 * ---- |Nutzername|Email|Matrikel|Vorname|Nachname|Telefonnummer|Studiengang|
		 */
	}
	
	
	  // Funktion um die aktuell ausgewählte Veranstaltung anzuzeigen
	  public static function getNameVorlesung($id)
	  {
	 $database = DatabaseFactory::getFactory()->getConnection();
	 
	  $sql = "SELECT veranst_bezeichnung
			  FROM veranstaltung
			  WHERE veranst_ID=:id;";
	 
	  $query = $database->prepare($sql);
	 
	  try{
	  $query->execute(array(':id' => $id));
	 
	  }catch (PDOException $fehler)
	  {
	  Session::add('response_negative', 'Es ist ein Fehler aufgetreten.'.$fehler);
	  }
	  //print_r($query->fetch());
	  return $query->fetch();
	  }
	
	
	// Funktion, die anhand des Nutzernamens des Dozenten die zugehörigen Vorlesungen ausliest
	public static function getVorlesung() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$user_name = Session::get ( 'user_name' );
		
		$sql = "SELECT nutzer_name, User_beteiligtAn_Veranstaltung.veranst_ID as veranst_ID, veranst_bezeichnung 
				FROM  nutzer_beteiligtAn_Veranstaltung 
				JOIN Veranstaltung 
				ON User_beteiligtAn_Veranstaltung.veranst_ID = Veranstaltung.veranst_ID 
				WHERE nutzer_name = :user_name ORDER BY veranst_bezeichnung ASC";
		
		$result = $database->prepare ( $sql );
		
		try{
		
			$result->execute ( array (
					':user_name' => $user_name 
			) );
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
		//TESt
		//print_r($result->fetchAll());
		
		return $result->fetchAll ();
	}
	/**
	* ENDE SPRINT 03
	* User­Story (Nr. 150a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
	* ENDE SPRINT 03
	*-------------------------------------------------------------------------------------------*/
	
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/01  Beschreibung: SQL Queries erstellen
	* Zeitaufwand (in Stunden): 3
	* START SPRINT 04
	*/
	public static function getDozentProfil($user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// 
		$sql = "SELECT  ad.straßenname AS Straße, ad.hausnummer as Hausnummer, ad.plz AS PLZ, ad.stadt AS Stadt, 
					ad.land AS Land, e.email_name AS Email, w.nutzer_name As Nutzername,
				coalesce(MAX(case when w.eigenschaft_ID = 3 then w.inhalt end), 0) as Vorname,
				coalesce(MAX(case when w.eigenschaft_ID = 4 then w.inhalt end), 0) as Nachname,
				coalesce(MAX(case when w.eigenschaft_ID = 7 then w.inhalt end), 0) as Telefonnummer
				FROM  wert w, email e, adresse ad
				WHERE w.nutzer_name = :user
				AND ad.nutzer_name = :user
				AND e.nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user 
			) );
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
		// Test
		 //print_r($query->fetchAll());
		
		return $query->fetch();
		}
		
	/* 
	* Funktion um Profildaten zu aktualisieren
	*/
	// Nachname, id 4 in wert tabelle
	public static function updateDataDozentNN($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE wert
				SET inhalt= :wert
				WHERE eigenschaft_id = 4 
				AND nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Nachnamen erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		//print_r($query);
	}
	
	// Straße
	public static function updateDataDozentSTR($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE adresse
				SET straßenname= :wert
				WHERE nutzer_name= :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Straßennamen erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		//print_r($query);
	}
	
	// Telefonnummer, id 7 in wert tabelle
	public static function updateDataDozentTE($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE wert
				SET inhalt= :wert
				WHERE eigenschaft_id = 7 
				AND nutzer_name= :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Telefonnummer erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	// Hausnummer
	public static function updateDataDozentHN($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE adresse
				SET hausnummer= :wert
				WHERE nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Hausnummer erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	// PLZ
	public static function updateDataDozentPL($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE adresse
				SET plz= :wert
				WHERE nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Postleitzahl erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	// Stadt
	public static function updateDataDozentSTA($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		 //print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE adresse
				SET stadt= :wert
				WHERE nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Stadtnamen erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	// Land
	public static function updateDataDozentLA($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE adresse
				SET land= :wert
				WHERE nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Land erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	// Email
	public static function updateDataDozentEM($wert, $user) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// print_r($wert, $user);
		
		// Daten in Datenbank updaten
		$sql = "UPDATE email
				SET email_name = :wert
				WHERE nutzer_name = :user;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':user' => $user,
					':wert' => $wert
			) );
			Session::add ( 'response_positive', 'Emailnamen erfolgreich geändert.');
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
	}
	
	/*
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/01  Beschreibung: SQL Queries erstellen
	* Zeitaufwand (in Stunden): 3
	* ENDE SPRINT 04
	**-----------------------------------------------------------------------------------------*/
	
}
