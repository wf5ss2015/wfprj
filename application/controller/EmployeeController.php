<?php
/* ===============================================
 * Sprint: 6
 * @author: Damian Wysocki
 * Datum: 12.06.2015
 * User Story (Nr.: 550) Als Mitarbeiter möchte ich div. Nutzer anlegen können (8).
 * Zeit insgesamt: 10
 * ===============================================*/

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
	
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 06
	* @author: Damian Wysocki
	* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
	* Task: 550/01  Beschreibung: Maske zum Anlegen eines Studenten
	* Zeitaufwand (in Stunden): 2
	* START SPRINT 06	
	*/
	    
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Maske zum Anlegen eines Studenten
	 **/     
	public function zeigeStudentAnlage() {
		$model = new UserModel();
		$model1 = new UserModel();
		$this->View->render ( 'employee/AnlegenStudent', array (
				'matrikel' => $model->getMatrikel (), 'studiengaenge' => $model->getStudiengaenge () 
		) );
	}
		 
	public function anlageStudent() {
		
		$model = new UserModel();
		$model1 = new UserModel();
		$model2 = new UserModel();
		$model3 = new UserModel();
		
		// Passwort hashen
		 $options = array();
		$hashedPassword = password_hash(Request::post('passwort'),1, $options);
		
		// Test
		//echo $hashedPassword;
		//print_r($_POST);
		
		// Nutzerkonto
		$model->saveStudentUsername(
						Request::post('nutzername'), Request::post('vorname'), 
						Request::post('nachname'), $hashedPassword,
						Request::post('telefonnummer'), Request::post('geschlecht'));
		
		// Adressdaten
		$model1->saveAddress(
						Request::post('nutzername'), Request::post('strasse'), 
						Request::post('hausnummer'), Request::post('stadt'),
						Request::post('land'), Request::post('plz'));
		
		$model2->saveEmail(Request::post('nutzername'), Request::post('email'));
		
		// Studentendaten
		$model3->saveStudentData(
						Request::post('nutzername'), Request::post('studiengang'), 
						Request::post('matrikel'), Request::post('fachsemester'), 
						Request::post('studiensemester'));
		// View erneut rendern
		Redirect::to ( 'employee/zeigeStudentAnlage' );		

	}	 
		 
		 /** ENDE SPRINT 06
		* @author: Damian Wysocki
		* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
		* Task: 550/01  Beschreibung: Maske zum Anlegen eines Studenten
		* Zeitaufwand (in Stunden): 2
		* ENDE SPRINT 06
	**-----------------------------------------------------------------------------------------*/	
}
