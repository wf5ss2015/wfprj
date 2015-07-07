<?php
 /* ===============================================
 * Sprint: 6
 * @author: Damian Wysocki
 * Datum: 12.06.2015
 * User Story (Nr.: 550) Als Mitarbeiter möchte ich div. Nutzer anlegen können (8).
 * Zeit insgesamt: 10
 * ===============================================*/

/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.5 
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
 * Task: model erweitern 
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 05.05.2015
 * Zeitaufwand (in Stunden): 1.0
 * User Story Nr.: 320
 * User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
 * Task: model erweitern
 * ===============================================
 */
/*
 * Erweiterung um function getUserData5($user_name)
 * sprint: 6
 * autor: Kris Klamser
 * zeitaufwand: 1
 * datum: 16.6.2015
 */
 /*
 * Erweiterung um function getStudentStudiengang($user_name)
 * sprint: 5
 * autor: Kris Klamser
 * zeitaufwand: 1
 * datum: 10.6.2015
 */
/*
 * Erweiterung um Nutzerdaten von allen usern zu bekommen. (zu User Story Nr. 280)
 * sprint: 4
 * autor: Kris Klamser
 * zeitaufwand:0.5
 * datum: 17.5.2015
 */
/*
 * ===============================================
 * Sprint: 2
 * @author: Kilian Kraus
 * Datum: 20.04.2015
 * Zeitaufwand (in Stunden): 4.5
 * User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 * Task: zusätzlich zu PDO verbindung noch MySQLi hinzufügen
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Model für den Nutzer. In diesem fall nur um Nutzerdaten anhand des Nutzernames zu bekommen.
 */
class UserModel {
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 *        	
	 * @return mixed Gibts false zurück, wenn Nutzer nicht besteht. Ansonsten Objekt mit den Nutzerdaten zurück.
	 */
	public function getUserData($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT nutzer_name, passwortHash, rolle_ID               
                 FROM Nutzer
                 WHERE (nutzer_name = :user_name)   
                 LIMIT 1";
		$query = $database->prepare ( $sql );
		
		$query->execute ( array (
				':user_name' => $user_name 
		) );
		
		return $query->fetch ();
	}
	
	/*
	 * ===============================================
	 * Start Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
	 * ===============================================
	 */
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Frägt alle Veranstaltungen/Kurse ab zu denen ein Nutzer angemeldet ist.
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 *        	
	 * @return mixed
	 */
	public function getMyClass($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT v.veranst_ID, veranst_bezeichnung, credits, SWS 
				FROM Student stud  
				JOIN student_AngemeldetAn_Veranstaltung ubav 
				ON stud.nutzer_name = ubav.student_nutzer_name 
				JOIN Veranstaltung v 
				ON ubav.veranst_ID = v.veranst_ID
				WHERE stud.nutzer_name = :user_name";
		$query = $database->prepare ( $sql );
		
		$query->execute ( array (
				':user_name' => $user_name 
		) );
		
		return $query->fetchAll ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Frägt alle Veranstaltungen/Kurse ab die für einen Studenten möglich sind.
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 *        	
	 * @return mixed
	 */
	public function getAllClass($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT v.veranst_ID, veranst_bezeichnung, credits, SWS
				FROM Veranstaltung v
				JOIN Studiengang_hat_Veranstaltung shv
				ON v.veranst_ID = shv.veranst_ID
                JOIN student stud
                ON stud.nutzer_name = :user_name 
				where shv.stg_ID = stud.stg_ID;";
		$query = $database->prepare ( $sql );
		
		$query->execute ( array (
				':user_name' => $user_name 
		) );
		
		return $query->fetchAll ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Macht den Insert wenn sich ein Student zu einer Veranstaltung anmeldet.
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 * @param $id string
	 *        	id
	 */
	public function saveClass($id, $user_name, $veranst_bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "INSERT INTO Student_angemeldetAn_Veranstaltung VALUES (:id, :user_name);";
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':id' => $id,
					':user_name' => $user_name 
			) );
			Session::add ( 'response_positive', 'Erfolgreich in ' . $veranst_bezeichnung . ' angemeldet.' );
		} catch ( PDOException $e ) {
			if ($e->errorInfo [1] == 1062) {
				Session::add ( 'response_warning', 'Sie sind bereits in ' . $veranst_bezeichnung . ' angemeldet.' );
			} else {
				Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.'.$e );
			}
		}
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Macht den Delete, wenn sich ein Student von einer Veranstaltung abmeldet.
	 * @param $user_name string
	 *        	Nutzername
	 * @param $id string
	 *        	id
	 *        	
	 */
	public function delistClass($id, $user_name, $veranst_bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "DELETE FROM student_AngemeldetAn_Veranstaltung WHERE veranst_ID=:id and student_nutzer_name=:user_name;";
		$query = $database->prepare ( $sql );
		echo $veranst_bezeichnung;
		try {
			$query->execute ( array (
					':id' => $id,
					':user_name' => $user_name 
			) );
			Session::add ( 'response_positive', 'Erfolgreich von ' . $veranst_bezeichnung . ' abgemeldet.' );
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $e );
		}
	}
	/*
	 * ===============================================
	 * Ende Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
	 * ===============================================
	 */
	/*
	 * ===============================================
	 * Start Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
	 * ===============================================
	 */
	 /* ===============================================
	 * Start Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
	 * ===============================================
	 */
	 /**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Holt alle Nutzername & Rolle aller Nutzer.
	 *        
	 */
	public function getUserDataAll() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT nutzer_name, rolle_bezeichnung FROM Nutzer 
		JOIN Rolle
		ON Nutzer.rolle_ID = Rolle.rolle_ID 
		ORDER BY nutzer_name";
		$query = $database->prepare ( $sql );
		$query->execute();
		return $query->fetchAll();
	}
	
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Holt alle Rollen aus der Datenbank.
	 *        
	 */
	public function getRoles(){
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT * FROM Rolle";
		$query = $database->prepare ( $sql );
		$query->execute();
		return $query->fetchAll();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Updated die Rolle eines Nutzers.
	 *        
	 * @param $nutzer_name string
	 *        	Nutzername
	 * @param $rolle_id string
	 *        	ID der Rolle
	 */
	public function saveRole($rolle_id, $nutzer_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "UPDATE nutzer SET rolle_id=:rolle_id WHERE nutzer_name = :nutzer_name";
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':rolle_id' => $rolle_id,
					':nutzer_name' => $nutzer_name 
			) );
			Session::add ( 'response_positive', 'Rechte erfolgreich für '.$nutzer_name.' geändert.' );
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	/* ===============================================
	 * Ende Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
	 * ===============================================
	 */
	/*
	 * ===============================================
	 * Ende Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
	 * ===============================================
	 */
	
	/*
	 * Erweiterung um Nutzerdaten von allen usern zu bekommen.
	   sprint: 4
	 * autor: Kris Klamser
	 * datum: 17.5.2015
	 * START
	 */
	public function getUserDataAll4() {
		$database = DatabaseFactory::getFactory()->getConnection ();
		$sql = "Select u.nachname, u.vorname, u.nutzer_name, rolle_bezeichnung, email_name, straßenname, hausnummer, plz, stadt, land 
				from Nutzer u 
				join Rolle r on r.rolle_ID = u.rolle_ID 
				join EMail e on e.nutzer_name = u.nutzer_name 
				join Adresse a on a.nutzer_name = u.nutzer_name
				order by nachname asc;";
		$query = $database->prepare ($sql);
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch(PDOException $e){
			Session::add ( 'response_warning', 'Es ist ein Fehler bei der Datenbankabfrage aufgetreten.' );
		}
	}
	/* ENDE Änderungen Klamser */
	/*
	 * Erweiterung Studiengang eines Studenten abzufragen.
	   sprint: 5
	 * autor: Kris Klamser
	 * datum: 10.06..2015
	 * START
	 */
	public function getStudentStudiengang($user_name) {
		$database = DatabaseFactory::getFactory()->getConnection ();
		$sql = "Select stg_bezeichnung
				from studiengang s 
				join student n on s.stg_ID = n.stg_ID where n.nutzer_name ='".$user_name."';";
		$query = $database->prepare ($sql);
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch(PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler bei der Datenbankabfrage aufgetreten.' );
		}
	}
	/* ENDE Änderungen Klamser */
	/*
	 * Erweiterung um Studenteninfo für den Notenspiegel abzufragen.
	   sprint: 6
	 * autor: Kris Klamser
	 * datum: 16.06..2015
	 * START
	 */
	public function getUserData5($user_name) {
		$database = DatabaseFactory::getFactory()->getConnection ();
		$sql = "Select u.nachname, u.vorname, straßenname, hausnummer, plz, stadt, land 
				from Nutzer u  
				join Adresse a on a.nutzer_name = u.nutzer_name
				where u.nutzer_name ='".$user_name."';";
		$query = $database->prepare ($sql);
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch(PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler bei der Datenbankabfrage aufgetreten.' );
		}
	}
	/* ENDE Änderungen Klamser */
	
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 06
	* @author: Damian Wysocki
	* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
	* Task: 550/01  Beschreibung: Maske zum Anlegen eines Studenten
	* Zeitaufwand (in Stunden): 2
	* START SPRINT 06	
	*/
	    
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Letzte Matrikelnummer herausfinden
	 **/     
	public function getMatrikel() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT MAX(matrikelnummer) as matrikelnummer FROM student";
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			//print_r($query->fetch());
			return $query->fetch();
		} catch(PDOException $e){
			Session::add ( 'response_negative', 'Maktrikelnummer kann nicht ausgelesen werden.', $e );
		}
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Alle Studiengaenge aus Datenbank auslesen
	 **/  	
	public function getStudiengaenge() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT stg_ID, stg_bezeichnung FROM studiengang";
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll();
		} catch(PDOException $e){
			Session::add ( 'response_negative', 'Studiengänge können nicht angezeigt werden.', $e );
		}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *       Nutzerkonto in Datenbank anlegen
	 *			
	 **/  
	public function saveUsername($nutzer, $vorname, $nachname, $passwort,
											$telefonnummer, $geschlecht, $rolle) {
		
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "INSERT INTO nutzer(nutzer_name, vorname, nachname, rolle_ID, 
					passwortHash, telefonnummer, geschlecht) VALUES('".$nutzer."', '".$vorname."', '".$nachname."', '".$rolle."',
				'".$passwort."', '".$telefonnummer."', '".$geschlecht."');";
		
		$query = $database->prepare ( $sql );
		
			try {
				$query->execute ();
				
			} catch ( PDOException $e ) {
				Session::add ( 'response_negative', 'Nutzerkonto konnte nicht angelegt werden.' );
			}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *       Prüfen ob Nutzername bereits existiert
	 *			
	 **/  
	public function getRightUsername($nutzer) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		// wenn Nutzer bereits vorhanden dann fortlaufende Nummer anhängen
		$sql = "SELECT CONCAT(nutzer_name, CASE WHEN COUNT(*) = 0 THEN '' ELSE COUNT(*) END) As nutzer
				FROM nutzer WHERE nutzer_name LIKE '".$nutzer."%';";
	
		$query= $database->prepare ($sql);
		
			try {
				$query->execute ();
				
			
			$result = $query->fetchColumn();
			
			if($result){
				$nutzer = $result;
			}
			
			//print_r($nutzer);
			
			return $nutzer;
			
			} catch ( PDOException $e ) {
				Session::add ( 'response_negative', 'Fehler: neuer Nutzername' );
			}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 * 			Adressdaten für das dazugehörige Nutzerkonto speichern
	 *			
	 **/  
	public function saveAddress($nutzer, $strasse, $hausnummer, $stadt,
											$land, $plz) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
				
		$sql = "INSERT INTO adresse(nutzer_name, straßenname, hausnummer, stadt, 
					land, plz)
				VALUES('".$nutzer."', '".$strasse."', '".$hausnummer."', '".$stadt."', '".$land."', '".$plz."' );";
			
		$query = $database->prepare ( $sql );
		//print_r($query);
		try {
			$query->execute ();
			
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Adressdaten konnten nicht angelegt werden.' );
		}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 * 			Email für das dazugehörige Nutzerkonto speichern
	 *			
	 **/  
	public function saveEmail($nutzer, $email) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
				
		$sql = "INSERT INTO email(email_name, nutzer_name)
				VALUES('".$email."', '".$nutzer."');";
			
		$query = $database->prepare ( $sql );
		//print_r($query);
		try {
			$query->execute ();
			
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Email konnte nicht angelegt werden.' );
		}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 * 			Studentendaten für das dazugehörige Nutzerkonto speichern
	 *			
	 **/  
	public function saveStudentData($nutzer, $stid, $matrikel, $fachs, $studs) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
				
		$sql = "INSERT INTO student(nutzer_name, stg_ID, matrikelnummer, fachsemester, studiensemester)
				VALUES('".$nutzer."', '".$stid."', '".$matrikel."', '".$fachs."', '".$studs."');";
			
		$query = $database->prepare ( $sql );
		//print_r($query);
		try {
			$query->execute ();
			Session::add ( 'response_positive', 'Nutzerkonto für <b>"'.$nutzer.'"</b> erfolgreich angelegt.' );
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Nutzerdaten konnten nicht angelegt werden.' );
		}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 * 			Mitarbeiterdaten für das dazugehörige Nutzerkonto speichern
	 *			
	 **/  
	public function saveMitarbeiterData($nutzer) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
				
		$sql = "INSERT INTO mitarbeiter(nutzer_name)
				VALUES('".$nutzer."');";
			
		$query = $database->prepare ( $sql );
		//print_r($query);
		try {
			$query->execute ();
			Session::add ( 'response_positive', 'Nutzerkonto für <b>"'.$nutzer.'"</b> erfolgreich angelegt.' );
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Nutzerdaten konnten nicht angelegt werden.' );
		}
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 * 			Dozentendaten für das dazugehörige Nutzerkonto speichern
	 *			
	 **/  
	public function saveDozentData($nutzer, $titel) {
		 
		$database = DatabaseFactory::getFactory ()->getConnection ();
				
		$sql = "INSERT INTO dozent(nutzer_name, titel)
				VALUES('".$nutzer."', '".$titel."');";
			
		$query = $database->prepare ( $sql );
		//print_r($query);
		try {
			$query->execute ();
			Session::add ( 'response_positive', 'Nutzerkonto für <b>"'.$nutzer.'"</b> erfolgreich angelegt.' );
		} catch ( PDOException $e ) {
			Session::add ( 'response_negative', 'Fehler: Anlage Nutzerkonto' );
		}
	}	 
		 
		 
		 /** ENDE SPRINT 06
		* @author: Damian Wysocki
		* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
		* Task: 550/01  Beschreibung: Maske zum Anlegen eines Studenten
		* Zeitaufwand (in Stunden): 2
		* ENDE SPRINT 06
	**-----------------------------------------------------------------------------------------*/	
}
