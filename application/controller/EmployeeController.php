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
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Erstellt einen gültigen Stundenplan
	 */
	public function createSchedule() {
		$model = new ScheduleModel();
		
		// speichert die benötigten daten in array
		$room = $model->getRoom();
		$docent = $model->getDocent();
		$lecture = $model->getLecture();
		$semester = $model->getSemester();

		// umwandeln array $Vorlesung
		$lectureNew=array();
		foreach($lecture as $key => $value) {
			//echo "key: ". $key. " value: " . $value->veranst_ID . " ". $value->dozent_nutzer_name . " <br>";
			$SWS=$value->SWS;
			while($SWS>1){
			array_push($lectureNew, $value->veranst_id);
			$SWS=$SWS-2;
			}
		}	
		
		
		// umwandeln array $semester
		$semesterNew;
		foreach($semester as $key => $value) {
			//echo "key: ". $key. " value: " . $value->veranst_ID . " ". $value->dozent_nutzer_name . " <br>";
			$semesterNew[$value->stg_kurztext . $value->pflicht_im_Semester]=array();
		}
				

		foreach($semester as $key => $value) {
			//echo "key1: ". $key. " value1: " . $value->veranst_ID . " ". $value->dozent_nutzer_name . " <br>";
			
			
				array_push($semesterNew[$value->stg_kurztext . $value->pflicht_im_Semester], $value->veranst_id);
				
			
		}

		// umwandeln array $dozent
		$docentNew;
		foreach($docent as $key => $value) {
			//echo "key: ". $key. " value: " . $value->veranst_ID . " ". $value->dozent_nutzer_name . " <br>";
			$docentNew[$value->dozent_nutzer_name]=array();
		}
		
		foreach($docent as $key => $value) {
			//echo "key1: ". $key. " value1: " . $value->veranst_ID . " ". $value->dozent_nutzer_name . " <br>";
			array_push($docentNew[$value->dozent_nutzer_name], $value->veranst_ID);
		}
		
		// umwandeln array $raum
		$roomNew=array();
		foreach($room as $key => $value){
			array_push($roomNew, $value->raum_bezeichnung);
		}
		
		//erstellt einen gültigen stundenplan
		$generate = new schedule($lectureNew, $roomNew, $docentNew, $semesterNew);
		$schedule=$generate->match($generate);
		
		//zeigt den gültigen stundenplan an
		$this->View->render ('employee/createSchedule', array('schedule' => $schedule, 'lecture' =>$lecture));
		//Redirect::to ( 'employee/selectUser' );
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 *         Den erstellten Stundenplan speichern.
	 */
	public function saveSchedule() {
		$schedule=unserialize(Request::post('schedule'));

		$model = new ScheduleModel();
		$model->saveSchedule($schedule);
		Session::add ( 'response_positive', 'Stundenplan erfolgreich gespeichert.' );
		Redirect::to('Employee/createSchedule');
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
	* Task: 550/01  Beschreibung: Maske zum Anlegen eines Nutzers
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
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Maske zum Anlegen eines Mitarbeiters
	 **/     
	public function zeigeMitarbeiterAnlage() {

		$this->View->render ( 'employee/AnlegenMitarbeiter');
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Maske zum Anlegen eines Dozenten
	 **/     
	public function zeigeDozentAnlage() {

		$this->View->render ( 'employee/AnlegenDozent');
	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Student: Passwort hashen, daten holen und Aufruf Model
	 **/	
	public function anlageStudent() {
		
		$model = new UserModel();
		$model1 = new UserModel();
		$model2 = new UserModel();
		$model3 = new UserModel();
		
		// Richtigen User aus DatenBank extrahieren
		$modelUser = new UserModel();
		$strUser = $modelUser->getRightUsername(Request::post('nutzername'));
		
		// Passwort hashen
		 $options = array();
		$hashedPassword = password_hash(Request::post('passwort'),1, $options);
		
		// Test
		//echo $hashedPassword;
		//print_r($_POST);
		
		// Nutzerkonto
		$model->saveUsername(
						$strUser, Request::post('vorname'), 
						Request::post('nachname'), $hashedPassword,
						Request::post('telefonnummer'), Request::post('geschlecht'),
						Request::post('rolle'));
		
		// Adressdaten
		$model1->saveAddress(
						$strUser, Request::post('strasse'), 
						Request::post('hausnummer'), Request::post('stadt'),
						Request::post('land'), Request::post('plz'));
		
		$model2->saveEmail(Request::post('nutzername'), Request::post('email'));
		
		// Studentendaten
		$model3->saveStudentData(
						$strUser, Request::post('studiengang'), 
						Request::post('matrikel'), Request::post('fachsemester'), 
						Request::post('studiensemester'));
		// View erneut rendern
		Redirect::to ( 'employee/zeigeStudentAnlage' );		
	}	 
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Mitarbeiter: Passwort hashen, daten holen und Aufruf Model
	 **/
	public function anlageMitarbeiter() {
		
		$model = new UserModel();
		$model1 = new UserModel();
		$model2 = new UserModel();
		$model3 = new UserModel();
		
		// Richtigen User aus DatenBank extrahieren
		$modelUser = new UserModel();
		$strUser = $modelUser->getRightUsername(Request::post('nutzername'));
		
		//print_r($strUser);
		
		// Passwort hashen
		 $options = array();
		$hashedPassword = password_hash(Request::post('passwort'),1, $options);
		
		// Test
		//echo $hashedPassword;
		//print_r($_POST);
		
		// Nutzerkonto
		$model->saveUsername(
						$strUser, Request::post('vorname'), 
						Request::post('nachname'), $hashedPassword,
						Request::post('telefonnummer'), Request::post('geschlecht'),
						Request::post('rolle'));
		
		// Adressdaten
		$model1->saveAddress(
						$strUser, Request::post('strasse'), 
						Request::post('hausnummer'), Request::post('stadt'),
						Request::post('land'), Request::post('plz'));
		
		$model2->saveEmail($strUser, Request::post('email'));
		
		// Mitarbeiterdaten
		$model3->saveMitarbeiterData(
						$strUser);
						
		// View erneut rendern
		Redirect::to ( 'employee/zeigeMitarbeiterAnlage' );		

	}
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Dozent: Passwort hashen, daten holen und Aufruf Model
	 **/
	public function anlageDozent() {
		
		$model = new UserModel();
		$model1 = new UserModel();
		$model2 = new UserModel();
		$model3 = new UserModel();
		
		// Richtigen User aus DatenBank extrahieren
		$modelUser = new UserModel();
		$strUser = $modelUser->getRightUsername(Request::post('nutzername'));
		
		// Passwort hashen
		 $options = array();
		$hashedPassword = password_hash(Request::post('passwort'),1, $options);
		
		// Test
		//echo $hashedPassword;
		//print_r($_POST);
		
		// Nutzerkonto
		$model->saveUsername(
						$strUser, Request::post('vorname'), 
						Request::post('nachname'), $hashedPassword,
						Request::post('telefonnummer'), Request::post('geschlecht'),
						Request::post('rolle'));
		
		// Adressdaten
		$model1->saveAddress(
						$strUser, Request::post('strasse'), 
						Request::post('hausnummer'), Request::post('stadt'),
						Request::post('land'), Request::post('plz'));
		
		$model2->saveEmail($strUser, Request::post('email'));
		
		// Mitarbeiterdaten
		$model3->saveDozentData(
						$strUser, Request::post('titel'));
						
		// View erneut rendern
		Redirect::to ( 'employee/zeigeDozentAnlage' );		

	}	 
		 
		 /** ENDE SPRINT 06
		* @author: Damian Wysocki
		* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
		* Task: 550/01  Beschreibung: Maske zum Anlegen eines Studenten
		* Zeitaufwand (in Stunden): 2
		* ENDE SPRINT 06
	**-----------------------------------------------------------------------------------------*/	
}
