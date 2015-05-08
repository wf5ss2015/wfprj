<?php
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
 *         Das ist der Basis Controller.
 */
class Controller {
	/**
	 * @var View Variable für ein Objekt der View
	 */
	public $View;
	
	/**
	 * Erstellt den Basis Controller (Konstruktor)
	 */
	function __construct() {
		// Session erstellen
		Session::init ();
		
		// Erstellt ein View Objekt
		$this->View = new View ();
	}
}
