<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 05.05.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 320
 * User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
 * Task: controller erstellen
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 */
class StudentController extends Controller {
	/**
	 *
	 * @author Kilian Kraus
	 *         Erstellt ein Objekt des Controllers
	 */
	public function __construct() {
		$auth = new Auth(1);
		parent::__construct ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um sich an Veranstaltungen anzumelden
	 */
	public function enrollClass() {
		$model = new UserModel();
		$this->View->render ( 'student/enrollClass', array (
				'listClass' => $model->getAllClass ( Session::get ( 'user_name' ) ) 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um Anmelden zu bestätigen
	 */
	public function verifyEnroll() {
		$this->View->render ( 'student/verifyEnrollClass', array (
				'veranst_bezeichnung' => Request::post ( 'veranst_bezeichnung' ),
				'id' => Request::post ( 'veranst_ID' ) 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Anmeldung in DB speichern
	 */
	public function saveEnroll() {
		$model = new UserModel();
		$model->saveClass ( Request::post ( 'id' ), Session::get ( 'user_name' ), Request::post('veranst_bezeichnung') );
		Redirect::to ( 'student/enrollClass' );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um sich von Veranstaltungen abzumelden
	 */
	public function delistClass() {
		$model = new UserModel();
		$this->View->render ( 'student/delistClass', array (
				'listClass' => $model->getMyClass ( Session::get ( 'user_name' ) ) 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um Abmelden zu bestätigen
	 */
	public function verifyDelist() {
		$this->View->render ( 'student/verifyDelistClass', array (
				'veranst_bezeichnung' => Request::post ( 'veranst_bezeichnung' ),
				'id' => Request::post ( 'veranst_ID' ) 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Abmeldung speichern in Datenbank
	 */
	public function saveDelist() {
		$model = new UserModel();
		$model->delistClass ( Request::post ( 'id' ), Session::get ( 'user_name' ), Request::post('veranst_bezeichnung') );
		Redirect::to ( 'student/delistClass' );
	}
}
