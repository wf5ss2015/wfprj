<?php
/*
 * ===============================================
 * Sprint: 2
 * @author: Kilian Kraus
 * Datum: 20.04.2015
 * Zeitaufwand (in Stunden): 1.0
 * User Story Nr.: 270
 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 * Task: loginController anpassen
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 1.0
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Das ist der Login Controller. Steuert den Login Prozess.
 */
class LoginController extends Controller {
	/**
	 *
	 * @author Kilian Kraus
	 *         Erstellt ein Objekt des Controllers
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Rendert "login/index.php"
	 */
	public function index() {
		$this->View->render ( 'login/index' );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Funktion die den Login ausführt.
	 */
	public function login() {
		$model = new LoginModel();
		$login_successful = $model->login ( Request::post ( 'user_name' ), Request::post ( 'user_password' ) );
		
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
	
	/*
	 * ===============================================
	 * Start Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
	 * ===============================================
	 */
	/**
	 *
	 * @author Kilian Kraus
	 *         Zeigt eine einfache Seite an nach dem erfolgreichen Login
	 */
	public function helloEmployee() {
		$model = new UserModel();
		$auth = new Auth(3);
		$this->View->render ( 'login/loggedinEmployee', array (
				'userlist' => $model->getUserDataAll () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Zeigt eine einfache Seite an nach dem erfolgreichen Login
	 */
	public function helloStudent() {
		$model = new UserModel();
		$auth = new Auth(1);
		$this->View->render ( 'login/loggedinStudent', array (
				'userlist' => $model->getUserDataAll () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Zeigt eine einfache Seite an nach dem erfolgreichen Login
	 */
	public function helloTutor() {
		$model = new UserModel();
		$auth = new Auth(4);
		$this->View->render ( 'login/loggedinTutor', array (
				'userlist' => $model->getUserDataAll () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Zeigt eine einfache Seite an nach dem erfolgreichen Login
	 */
	public function helloDocent() {
		$model = new UserModel();
		$auth = new Auth(2);
		$this->View->render ( 'login/loggedinDocent', array (
				'userlist' => $model->getUserDataAll () 
		) );
	}
	/*
	 * ===============================================
	 * Ende Sprint: 2
	 * @author: Kilian Kraus
	 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
	 * ===============================================
	 */
	/**
	 *
	 * @author Kilian Kraus
	 *         Zeigt eine einfache Seite an nach dem Logout
	 */
	public function logout() {
		$model = new LoginModel();
		$model->logout ();
		Redirect::to ( 'index/index' );
	}
}
