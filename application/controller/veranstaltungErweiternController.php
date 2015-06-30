<?php
/*
    autor: Kris Klamser
    datum: 22.6.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 6
	zeitaufwand: 3
	user story (Nr. 560): Als Mitarbeiter möchte ich einer Veranstaltung einen Dozenten zuordnen können. (8 Pkt.)
	-> Erweiterung um typSelected-function und Änderung in selected-function
*/
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 2
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
*/

class veranstaltungErweiternController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	// rendert die View veranstaltungErweitern 
	public function veranstaltungErweitern() {
		$this->View->render ( 'veranstaltungerweitern/veranstaltungErweitern');
	}
	
	//START Änderungen Klamser Sprint 6
	//Wird ausgeführt wenn Personentyp ausgewählt wurde.
	public function typSelected() {
		if (isset ( $_POST['typ'])){
			$typ = $_POST ['typ'];
			switch ($typ) {
				case "dozent" :
					//umDozentErweitern-View wird gezeigt und die arrays veranstaltung_list und user_list übergeben
					$this->View->render ( 'veranstaltungerweitern/umPersonErweitern', array (
							'veranstaltung_list' => veranstaltungErweiternModel::getVeranstaltung (),
							'user_list' => veranstaltungErweiternModel::getDozent () 
					) );
					break;
				case "student":
					//umStudentErweitern-View wird gezeigt und die arrays veranstaltung_list und user_list übergeben
					$this->View->render ( 'veranstaltungerweitern/umPersonErweitern', array (
							'veranstaltung_list' => veranstaltungErweiternModel::getVeranstaltung (),
							'user_list' => veranstaltungErweiternModel::getStudent () 
					) );
					break;
				default:
					default :
					Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
			} 
		} else {
				Session::add ( 'response_warning', 'Es ist kein	Personentyp ausgewählt.' );
				$this->View->render( 'veranstaltungerweitern/veranstaltungErweitert' );
		}
	}
	//ENDE Änderungen Klamser Sprint 
	
	// wird ausgeführt, wenn auf der umStudent-/umDonzentErweitern-View der Button geklickt wird.
	public function selected() {
		// Prüfung ob sowohl Veranstaltung als auch User selected sind.
		if (isset ( $_POST ['veranstaltung'] ) and isset ( $_POST ['user'] )) {
			// $_POST['veranstaltung'] übergibt einen String mit der veranst_ID und der veranst_bezeichnung
			// durch explode wird dieser String getrennt, damit man mit der ID weiter arbeiten kann
			$veranst_string = $_POST ['veranstaltung'];
			$veranst_array = explode ( ",", $veranst_string );
			$veranst_ID = $veranst_array [0];
			
			// $_POST['user'] übergibt einen String mit dem user_name und der rolle_bezeichnung
			// durch explode wird dieser String getrennt, damit man mit dem user_name weiter arbeiten kann
			$user_string = $_POST ['user'];
			$user_array = explode ( ",", $user_string );
			$user_name = $user_array [0];
			$user_rolle = $_POST['personentyp'];
			//START Änderungen Klamser Sprint 6: Veranstaltungen können auch mit Dozenten erweitert werden.
			if(stristr($user_rolle, 'Student') !== false){
				// inserten der Erweiterung
				veranstaltungErweiternModel::setErweiterungStudent ( $veranst_ID, $user_name );
				$this->View->render('veranstaltungerweitern/veranstaltungErweitert');
			} else if (stristr($user_rolle, 'Dozent') !== false){
				// inserten der Erweiterung
				veranstaltungErweiternModel::setErweiterungDozent( $veranst_ID, $user_name );
				$this->View->render('veranstaltungerweitern/veranstaltungErweitert');
			} else {
				Session::add ( 'response_warning', 'Die Veranstaltung konnte nicht erweitert werden.' );
				$this->View->render('veranstaltungerweitern/veranstaltungErweitert');
			}
			//ENDE Änderungen Klamser Sprint 6
		} else {
			// Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man eine Fehlermeldung.
			if(empty( $_POST ['veranstaltung'] )){
				Session::add ( 'response_negative', 'Es ist keine Veranstaltung ausgewählt.' );
			} 
			if(empty( $_POST ['user'] )){
				Session::add ( 'response_negative', 'Es ist kein User ausgewählt.' );
			}
			$this->View->render('veranstaltungerweitern/veranstaltungErweitert');
		}
	}
}
?>