<?php
 /* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 09.05.2015
 * User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können (Points 13)
 * Zeit insgesamt: 7
 * ===============================================*/

/**===============================================
 * SPRINT 03
 *
 * @author: Damian Wysocki
 * Datum: 29.04.2015
 *
 * User­Story (Nr. 150a): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
 * Zeit: 1
 *===============================================*/

/**
 *
 * @author Damian Wysocki
 *        
 *         Beschreibung: Controller um die Daten aus dem Model in den Views für Dozenten zu steuern
 *        
 */
?>
 
<?php
class DozentController extends Controller {
	
	public function __construct() {
		
		parent::__construct ();
	}
	
	
	/*  // ausgewählt Vorlesung anzeigen
	 public function anzeigenVorlesung()
	  {
	  $this->View->render('dozent/teilnehmerListe', array(
	  'zeigeVorlesung' => DozentModel::getNameVorlesung(Request::post('id'))
	  ));
	  }
	 */
	
	// Funktion zur Auswahl der hinterlegten Vorlesungen eines Dozenten
	public function auswahlVorlesung() {
		
		$auth = new Auth(2);
		$this->View->render ( 'dozent/auswahlVorlesung', array (
				'vorlesung' => DozentModel::getVorlesung () 
		) );
	}
	
	// Funktion zum Aufruf der DozentModel-Klasse um Teilnehmer einer Vorlesung anzuzeigen
	public function teilnehmerListe() {
		$auth = new Auth(2);
		$this->View->render ( 'dozent/teilnehmerListe', array (
				'teilnehmer' => DozentModel::getTeilnehmer(Request::post ( 'id' ) ) 
		) );
	}
	
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/02  Beschreibung: Controller zur Steuerung der Views
	* Zeitaufwand (in Stunden): 3
	* START SPRINT 04
	*/
	
	// Funktion um das Profil anzuzeigen
	public function meinProfil() {
		$this->View->render ( 'dozent/meinProfil', array (
				'profil' => DozentModel::getDozentProfil(Session::get('user_name')) 
		) );
	}
	
	/**
	* @author: Damian Wysocki
	* User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/04  Beschreibung: Controller erstellen
	*/
	public function emailDozent() {
		$auth = new Auth(2);
		$this->View->render ( 'dozent/email', array (
				'profil' => DozentModel::getDozentProfil(Session::get('user_name')) 
		)  );
	}
	
	public function emailStEm() {
		//$auth = new Auth(2);
		$this->View->render ( 'user/emailStudentEmployee', array (	
				'profil' => DozentModel::getDozentProfil(Session::get('user_name')) 
		)  );
	}
	
	
	public function updateDozent() {
	
			// Nachname
			if (isset($_POST ['nn'])){
			
			$wert = $_POST['Nachname'];
			
			DozentModel::updateDataDozentNN($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['nn']);
			
			//print_r($_POST['Nachname']);
			}
				
			// Straße
			if (isset($_POST ['str'])){
			
			$wert = $_POST['Straße'];
			
			DozentModel::updateDataDozentSTR($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['str']);
			
			//print_r($_POST['Straße']);
			}	
				
			// Hausnummer
			if (isset($_POST ['hn'])){
			
			$wert = $_POST['Hausnummer'];
			
			DozentModel::updateDataDozentHN($wert, Session::get('user_name'));
				
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['hn']);
				
			//print_r($_POST['Hausnummer']);
			}
			
			// PLZ
			if (isset($_POST ['pl'])){
			
			$wert = $_POST['PLZ'];
			
			DozentModel::updateDataDozentPL($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['pl']);
			
			//print_r($_POST['PLZ']);
			}
			
			// Stadt
			if (isset($_POST ['sta'])){
			
			$wert = $_POST['Stadt'];
			
			DozentModel::updateDataDozentSTA($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['sta']);
			
			//print_r($_POST['Stadt']);
			}
			
			// Land
			if (isset($_POST ['la'])){
			
			$wert = $_POST['Land'];
			
			DozentModel::updateDataDozentLA($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['la']);
			
			//print_r($_POST['Land']);
			}
			
			// Telefonnummer
			if (isset($_POST ['te'])){
			
			$wert = $_POST['Telefonnummer'];
			
			DozentModel::updateDataDozentTE($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['te']);
			
			//print_r($_POST['Telefonnummer']);
			}
			
			// Email
			if (isset($_POST ['em'])){
			
			$wert = $_POST['Email'];
			
			DozentModel::updateDataDozentEM($wert, Session::get('user_name'));
			
			// Variable wieder als nicht gesetzt deklarieren
			unset($_POST['em']);
			
			//print_r($_POST['Email']);
			}
	
		// Seite wird nochmal gerendert, um aktualisierte Daten anzuzeigen
		$this->meinProfil();
	}
	
	/*
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/02  Beschreibung: Controller zur Steuerung der Views
	* Zeitaufwand (in Stunden): 3
	* ENDE SPRINT 04
	**-----------------------------------------------------------------------------------------*/
	
}
