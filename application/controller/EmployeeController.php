<?php
/* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 21.05.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
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
		$model = new UserModel();
		$this->View->render ( 'employee/selectUser', array (
				'userList' => $model->getUserDataAll () 
		) );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um eine neue Rolle auszuwählen
	 */
	public function changeRole() {
		$model = new UserModel();
		$this->View->render ( 'employee/changeRole', array (
				'roleList' => $model->getRoles(), 'nutzer_name' => Request::post('nutzer_name'), 'rolle_bezeichnung' => Request::post('rolle_bezeichnung')
		) );
	}
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         -> View um Änderung der Rolle zu bestätigen.
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
		$model = new UserModel();
		$model->saveRole (Request::post('rolle_ID'), Request::post('nutzer_name'));
		Redirect::to ( 'employee/selectUser' );
	}
	
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/02  Beschreibung: Controller zur Steuerung der Views
	* Zeitaufwand (in Stunden): 3
	* START SPRINT 05
	*/
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Startmenü Notenliste.
	 */
	public function startNotenListe() {
		
		$model = new NotenModel();
		$model2 = new NotenModel();
		$this->View->render ( 'employee/NotenListeStart', array (
				'vorlesung' => $model->getVorlesungAll(), 'students' => $model2->getAllStudents()
				
		) );
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Alle Teilnehmer einer Veranstaltung
	 */
	public function showEvents() {
		
		$model = new NotenModel();
		$this->View->render ( 'employee/NotenListeAuswahlGesamt', array (
				'notenliste' => $model->getVorlesungAllParticipants(Request::post('id'))
		) );
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Action-Handling wenn Note geändert wird
	 */
	public function aendernNote(){
		$model = new NotenModel();
		//print_r($_POST);
		$model->saveNote (Request::post('Veranstaltungsnummer'), Request::post('Nutzer'), Request::post('Note'));
		$this->startNotenListe();
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *        Action-Handling wenn ein bestimmter Student ausgewählt worden ist
	 */
	public function showStudents(){
		$model = new NotenModel();
		$this->View->render ( 'employee/NotenListeAuswahlEinzeln', array (
				'notenlisteStudent' => $model->getSpecificStudents(Request::post('id2'))
		) );
	}
		
	
	/*
	* ENDE SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)   Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/02  Beschreibung: Controller zur Steuerung der Views
	* Zeitaufwand (in Stunden): 3
	* ENDE SPRINT 05
	**-----------------------------------------------------------------------------------------*/
}
