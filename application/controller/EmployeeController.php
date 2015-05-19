<?php
/*
 * ===============================================
 * Sprint: 4
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
class EmployeeController extends Controller {
	/**
	 *
	 * @author Kilian Kraus
	 *         Erstellt ein Objekt des Controllers
	 */
	public function __construct() {
		$auth = new Auth(3);//3=Mitarbeiter
		parent::__construct ();
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um einen User auszuwählen dessen Rechte/Rolle geändert werden soll.
	 */
	public function selectUser() {
		$this->View->render ( 'employee/selectUser', array (
				'userList' => UserModel::getUserDataAll () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um eine neue Rolle auszuwählen
	 */
	public function changeRole() {
		$this->View->render ( 'employee/changeRole', array (
				'roleList' => UserModel::getRoles(), 'nutzer_name' => Request::post('nutzer_name'), 'rolle_bezeichnung' => Request::post('rolle_bezeichnung')
		) );
	}
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um änderung der Rolle zu bestätigen.
	 */
	public function verifyChangeRole() {
		$this->View->render ( 'employee/verifyChangeRole', array('rolle_bezeichnung' => Request::post('rolle_bezeichnung'), 'nutzer_name' => Request::post('nutzer_name'), 'rolle_ID' => Request::post('rolle_ID')
		));
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Neue Rolle in DB speichern.
	 */
	public function saveChangeRole() {
		UserModel::saveRole (Request::post('rolle_ID'), Request::post('nutzer_name'));
		Redirect::to ( 'employee/selectUser' );
	}
	
	
}
