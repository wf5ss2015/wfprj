<?php
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
	public static function getUserData($user_name) {
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
	public static function getMyClass($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT v.veranst_ID, veranst_bezeichnung, credits, SWS 
				FROM nutzer n  
				JOIN user_beteiligtan_Veranstaltung ubav 
				ON n.nutzer_name = ubav.nutzer_name 
				JOIN veranstaltung v 
				ON ubav.veranst_ID = v.veranst_ID
				WHERE n.nutzer_name = :user_name;";
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
	public static function getAllClass($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT v.veranst_ID, veranst_bezeichnung, credits, SWS 
				FROM veranstaltung v
				JOIN studiengang_hat_veranstaltung shv
				ON v.veranst_ID = shv.veranst_ID,
				(SELECT inhalt 
				FROM  wert 
				WHERE eigenschaft_ID='10' AND nutzer_name = :user_name)inline
				WHERE stg_ID = inline.inhalt;";
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
	public static function saveClass($id, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "INSERT INTO user_beteiligtan_veranstaltung VALUES (:id, :user_name);";
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':id' => $id,
					':user_name' => $user_name 
			) );
			Session::add ( 'response_positive', 'Erfolgreich angemeldet.' );
		} catch ( PDOException $e ) {
			if ($e->errorInfo [1] == 1062) {
				Session::add ( 'response_warning', 'Sie sind bereits in diesem Kurs angemeldet.' );
			} else {
				Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
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
	public static function delistClass($id, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "DELETE FROM user_beteiligtan_veranstaltung WHERE veranst_ID=:id and nutzer_name=:user_name;";
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute ( array (
					':id' => $id,
					':user_name' => $user_name 
			) );
			Session::add ( 'response_positive', 'Erfolgreich abgemeldet.' );
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
	
	// dummy für bsp tabelle
	public static function getUserDataAll() {
		$database = new DatabaseFactoryMysql ();
		
		$sql = "SELECT * FROM nutzer";
		
		$result = $database->query ( $sql );
		return $result;
	}
	
	// dummy für bsp tabelle
	public static function getUserDataAll2() {
		$database = new DatabaseFactoryMysql ();
		
		$sql = "SELECT nutzer_name FROM nutzer";
		
		$result = $database->query ( $sql );
		return $result;
	}
	
	// dummy für bsp tabelle
	public static function getUserDataAll3() {
		$database = new DatabaseFactoryMysql ();
		
		$sql = "SELECT nutzer_name, passwortHash  FROM nutzer";
		
		$result = $database->query ( $sql );
		return $result;
	}
	/*
	 * ===============================================
	 * Ende Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
	 * ===============================================
	 */
	
	/*
	 * Erweiterung um Nutzerdaten von allen usern zu bekommen.
	 * autor: Kris Klamser
	 * datum: 4.5.2015
	 * START
	 */
	public static function getUserDataAll4() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "Select u.nutzer_name, rolle_bezeichnung, email_name, straßenname, hausnummer, plz, stadt, land 
				from nutzer u 
				join rolle r on r.rolle_ID = u.rolle_ID 
				join email e on e.nutzer_name = u.nutzer_name 
				join adresse a on a.nutzer_name = u.nutzer_name;";
		
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	/* ENDE Änderungen Klamser */
}
