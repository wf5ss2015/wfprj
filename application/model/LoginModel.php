<?php
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 1.5
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Das LoginModel stellt Funktionen für den Loginvorgang bereit.
 */
class LoginModel {
	/**
	 *
	 * @author Kilian Kraus
	 *         Model für den Login
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 * @param $user_password string
	 *        	Passwort
	 *        	
	 * @return bool Status des Login
	 */
	public function login($user_name, $user_password) {
		// falls Nutzername oder Passwort leer sind
		if (empty ( $user_name ) or empty ( $user_password )) {
			return false;
		}
		
		// falls Benutzer nicht in der DB besteht bzw. Passwort nicht stimmt.
		$result = self::validateAndGetUser ( $user_name, $user_password );
		
		if (! $result) {
			return false;
		}
		
		// setzt Timestamp des letzten Login
		//self::saveTimestamp ( $result->nutzer_name );
		
		// falls Nutzer erfolgreich eingeloggt ist, dann werden notwendige Parameter in die Session Variablen geschrieben
		// Loggt Nutzer final ein
		self::doLogin ( $result->nutzer_name, $result->rolle_ID );
		// gibt letztendlich true zurück für erfolgreichen login
		return true;
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Überpüft ob der Login erfolgreich war.
	 *        
	 * @param
	 *        	$user_name
	 * @param
	 *        	$user_password
	 *        	
	 * @return bool mixed
	 */
	public function validateAndGetUser($user_name, $user_password) {
		// holt sich die Daten des Nutzers
		$result = UserModel::getUserData ( $user_name );
		
		// Überprüft ob der Nutzer besteht.
		if (! $result) {
			return false;
		}
		
		// überprüft ob passwort mit hash übereinstimmt.
		$match = password_verify ( $user_password, $result->passwortHash );
		// falls der in der Datenbank gespeicherte Hash nicht mit dem Hash des Passworts übereinstimmt.
		if ($match == null) {
			return false;
		}
		
		return $result;
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Löscht Session
	 */
	public function logout() {
		Session::destroy ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Diese Funktion macht den richtigen Login. Initialisiert die Session und schreibt Werte in die Session.
	 *        
	 * @param
	 *        	$user_id
	 * @param
	 *        	$user_name
	 * @param
	 *        	$user_role
	 */
	public function doLogin($user_name, $user_role) {
		Session::init ();
		Session::set ( 'user_name', $user_name );
		Session::set ( 'user_role', $user_role );
		Session::set ( 'user_logged_in', true );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Schreibt einen Timestamp des Login in die Datenbank.
	 *        
	 * @param
	 *        	$user_name
	 */
	public function saveTimestamp($user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "UPDATE Nutzer SET letzterLogin = :user_last_login_timestamp
                WHERE nutzer_name = :user_name LIMIT 1";
		$query = $database->prepare ( $sql );
		$query->execute ( array (
				':user_name' => $user_name,
				':user_last_login_timestamp' => time () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         gibt true zurück, falls Nutzer eingeloggt ist
	 *        
	 * @return bool Status des Login
	 */
	public function isUserLoggedIn() {
		return Session::userIsLoggedIn ();
	}
}
