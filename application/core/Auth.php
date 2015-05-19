<?php
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 17.05.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 370
 * User Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
 * Task: static -> OOP
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 2
 * @author: Kilian Kraus
 * Datum: 20.04.2015
 * Zeitaufwand (in Stunden): 1.5
 * User Story Nr.: 270
 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 * Task: core/auth.php anpassen
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
 *         Überprüft ob ein Nutzer eingeloggt ist, ansonsten wird er zur Login-Seite verlinkt.
 *         Sollte am Anfang eines Controllers bzw Funktion im Controller verwendet werden, wenn diese nur für eingeloggte Nutzer sichtbar sein sollte.
 */
class Auth {
	/*
	 * ===============================================
	 * Start Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
	 * ===============================================
	 */
	 /*
	 * ===============================================
	 * Start Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	 * ===============================================
	 */	
	 /**
	 *
	 * @author Kilian Kraus
	 *         Überprüft ob ein Student eingeloggt ist und die entsprechnede Rolle besitzt, ansonsten wird er zur Login-Seite verlinkt und die Session zerstört.
	 *         Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
	 */
	 // übergabe int rolle
	public function __construct($role) {	
		// Initialisiert eine Session.
		Session::init ();
		
		// Falls Nutzer nicht eingeloggt ist.
		if (Session::userIsLoggedIn () && Session::get ( 'user_role' ) == $role) {
			return true;
		} else {
			Session::destroy ();
			header ( 'location: ' . "index.php?url=" . 'login' );
			exit ();
		}
	}
	/*
	 * ===============================================
	 * Ende Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	 * ===============================================
	 */
	/*
	 * ===============================================
	 * Ende Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
	 * ===============================================
	 */
}
