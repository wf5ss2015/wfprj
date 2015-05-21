<?php
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 0.1
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Das ist der Index Controller. Steuert die Startseite.
 */
class IndexController extends Controller {
	/**
	 *
	 * @author Kilian Kraus
	 *         Erstellt ein Objekt der "Controller"-Klasse.
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Diese Funktion steuert was passiert, wennn jemand zu index/index aufruft
	 */
	public function index() {
		$model = new UserModel();
		$this->View->render ( 'index/index', array (
				'userList' => $model->getUserDataAll ()  ));
	}
	
	// für entwicklung
	public function login() {
		$model = new LoginModel();
		$login_successful = $model->login ( Request::post ( 'nutzer_name' ), Request::post ( 'nutzer_name' ) );
		
		/*
		 * ===============================================
		 * Start Sprint: 2
		 * @author: Kilian Kraus
		 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
		 * ===============================================
		 */
		// falls Login fehlgeschlagen, dann wird nochmal der login aufgerufen.
		if ($login_successful == 1) {
			if (Session::get ( 'user_role' ) == 3) {
				Session::add ( 'response_positive', 'Erfolgreich eingeloggt' );
				Redirect::to ( 'login/helloEmployee' );
			} elseif (Session::get ( 'user_role' ) == 1) {
				Session::add ( 'response_positive', 'Erfolgreich eingeloggt' );
				Redirect::to ( 'login/helloStudent' );
			} elseif (Session::get ( 'user_role' ) == 2) {
				Session::add ( 'response_positive', 'Erfolgreich eingeloggt' );
				Redirect::to ( 'login/helloDocent' );
			} elseif (Session::get ( 'user_role' ) == 4) {
				Session::add ( 'response_positive', 'Erfolgreich eingeloggt' );
				Redirect::to ( 'login/helloTutor' );
				/*
				 * ===============================================
				 * Ende Sprint: 2
				 * @author: Kilian Kraus
				 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
				 * ===============================================
				 */
			} else {
				Redirect::to ( 'login/index' );
				Session::add ( 'response_warning', 'Keine Berechtigung Sich mit diesem Account einzuloggen.' );
			}
		} else {
			Redirect::to ( 'login/index' );
			Session::add ( 'response_negative', 'Nutzer existiert nicht oder falsches Kennwort.' );
		}
	}
}
