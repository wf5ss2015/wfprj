<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 2
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
-->
<?php
class veranstaltungErweiternController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	// rendert die View veranstaltungErweitern und übergibt das array mit den veranstaltungen und usern
	public function veranstaltungErweitern() {
		$this->View->render ( 'veranstaltungerweitern/veranstaltungErweitern', array (
				'veranstaltung_list' => veranstaltungErweiternModel::getVeranstaltung (),
				'user_list' => veranstaltungErweiternModel::getUser () 
		) );
	}
	
	// wird ausgeführt, wenn in der veranstaltungErweitern-View der Button geklickt wird.
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
			
			// inserten der Erweiterung
			veranstaltungErweiternModel::setErweiterung ( $veranst_ID, $user_name );
			echo "Die Veranstaltung ";
			echo $veranst_string;
			echo "wurde erfolgreich um ";
			echo $user_name;
			echo " erweitert.";
			echo '<input type="button" value="Zurück" onClick="history.back();">';
		} else {
			// Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
			echo "Bitte wählen Sie Veranstaltung UND User aus!<br><br>";
			echo '<input type="button" value="Zurück" onClick="history.back();">';
		}
	}
}
?>