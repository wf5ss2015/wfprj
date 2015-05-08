<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.25
 * User Story Nr.: 330
 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 * Task: errorController erstellen.
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Dieses Controller startet eine Simple fehlerseite.
 */
class ErrorController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 404
	 */
	public function index() {
		header ( 'HTTP/1.0 404 Not Found' );
		$this->View->render ( 'error/index' );
	}
	
	// TODO
	/**
	 * 404
	 */
	public function error() {
		header ( 'HTTP/1.0 404 Not Found' );
		$this->View->render ( 'error/error' );
	}
}
