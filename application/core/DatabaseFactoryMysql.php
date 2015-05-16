<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.:
 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 * Task:
 *
 * ===============================================
 */

/**
 * SPRINT 03
 *
 * @author: Roland Schmid
 * Datum: 6.5.2015
 *
 * User Story: Als Entwickler möchte ich im MVC-Pattern programmieren können
 * Task: Bisherigen Code in MVC einfügen und anpassen.
 * Methode "insert($q)" eingeführt, um Insert-Statements ausführen zu können.
 * Die vorhandene Query-Methode liefert einen Fehler bei Inserts.
 * Nr:  	340
 * Points: 	40
 * Zeit: 	1
 *
 */

/*
 * ===============================================
 * Sprint: 2
 * @author: Kilian Kraus
 * Datum: 20.04.2015
 * Zeitaufwand (in Stunden): 2.0
 * User Story Nr.: 170
 * User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 * Task: zusätzlich zu PDO verbindung noch MySQLi hinzufügen
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Diese Klasse erstellt eine Datenbankverbindung mit Mysqli
 *        
 */
class DatabaseFactoryMysql extends MySQLi {
	public function __construct() {
		parent::__construct ( Config::get ( 'DB_HOST' ), Config::get ( 'DB_USER' ), Config::get ( 'DB_PASS' ), Config::get ( 'DB_NAME' ), Config::get ( 'DB_PORT' ) );
		
		if (mysqli_connect_error ()) {
			/*
			 * ===============================================
			 * Start Sprint: 3
			 * @author: Kilian Kraus
			 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
			 * ===============================================
			 */
			Redirect::to ( 'error/error' );
			Session::add ( 'response_negative', 'Error: ' . mysqli_connect_error () );
			Session::add ( 'response_negative', 'Errno: ' . mysqli_connect_errno () );
		}
		/*
		 * ===============================================
		 * Ende Sprint: 3
		 * @author: Kilian Kraus
		 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
		 * ===============================================
		 */
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         macht die query
	 * @param $query string
	 *        	sql
	 * @return array mit results
	 */
	public function query($query) {
		$result = parent::query ( $query );
		
		if ($this->error) {
			/*
			 * ===============================================
			 * Start Sprint: 3
			 * @author: Kilian Kraus
			 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
			 * ===============================================
			 */
			Redirect::to ( 'error/error' );
			Session::add ( 'response_negative', 'Error: ' . mysqli_connect_error () );
			Session::add ( 'response_negative', 'Errno: ' . mysqli_connect_errno () );
			/*
			 * ===============================================
			 * Ende Sprint: 3
			 * @author: Kilian Kraus
			 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
			 * ===============================================
			 */
		}
		
		// baut einen array mit objekten. genau so wie in PDO, nur hab ich dazu keine methode in mysqli gefunden bisher
		$array = array ();
		$i = 0;
		while ( $obj = $result->fetch_object () ) {
			$array [$i] = $obj;
			$i ++;
		}
		$this->close ();
		// gibt array mit objekten zurück
		return $array;
	}
	
/*
 * Sprint 3 Anfang
 * Änderung: Roland Schmid
*/
	
	/*
	 *
	 * @author Roland Schmid
	 *
	 * Führt eine Query mit einem INSERT INTO String aus.
	 * liefert 1 zurück, falls die Eintragung erfolgreich war.
	 * Diese Methode ist nötig, da die (überschriebene) Query-Methode versucht,
	 * ein Array aus Objekten zu bauen, was bei einer INSERT-Query fehlschlägt
	 * und zu einem Error führt.
	 *
	 */
	public function insert($insertString) {
		$success = parent::query ( $insertString );
		return $success;
	}
	
/*
 * Sprint 3 Ende
 * Änderung: Roland Schmid
*/
}
