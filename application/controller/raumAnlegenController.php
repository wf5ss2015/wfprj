<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<?php
	class raumAnlegenController extends Controller {
    
		public function __construct(){
			parent::__construct();
		}

		public function raumAnlegen(){
			$this->View->render('raumanlegen/raumAnlegen');
		}
		
		public function raumSelected(){
			$raumtyp = $_POST['typ'];
			if(isset($_POST)){
				switch ($raumtyp) {
					case "vorlesungsraum":
						$this->View->render('raumanlegen/vorlesungsraumAnlegen', 
							array('geb_list' => raumAnlegenModel::getGebäude(), 'ausstattung_list' => raumAnlegenModel::getAusstattung()));
						break;
					case "buero":
						$this->View->render('raumanlegen/bueroAnlegen', 
							array('geb_list' => raumAnlegenModel::getGebäude()));
						break;
					case "labor":
						$this->View->render('raumanlegen/laborAnlegen', 
							array('geb_list' => raumAnlegenModel::getGebäude(), 'labArt_list' => raumAnlegenModel::getLaborart(), 'ausstattung_list' => raumAnlegenModel::getAusstattung()));
						break;
					case "bibliothek":
						$this->View->render('raumanlegen/bibliothekAnlegen', 
							array('geb_list' => raumAnlegenModel::getGebäude(), 'buchKat_list' => raumAnlegenModel::getBuchkategorie()));
						break;
					default:
						echo "Kein Raumtyp ausgewählt!";
				}
			}
			else {
				echo "Kein Raumtyp ausgewählt!";
			} 
		}
		
		public function saveRaum(){
			if(isset($_POST['bezeichnung']) and isset($_POST['gebäude']) and isset($_POST['raumtyp'])){
				$bezeichnung = $_POST['bezeichnung'];
				$gebäude_string = $_POST['gebäude'];
				$gebäude_array = explode(",", $gebäude_string);
				$gebäude_char = $gebäude_array[0];
				$raumtyp = $_POST['raumtyp'];
				raumAnlegenModel::raumStammdaten($bezeichnung, $gebäude_char);
				switch ($raumtyp) {
					case "vorlesungsraum":
						raumAnlegenModel::vorlesungsraumAnlegen($bezeichnung);
						break;
					case "buero":
						raumAnlegenModel::bueroAnlegen($bezeichnung);
						break;
					case "labor":
						raumAnlegenModel::laborAnlegen($bezeichnung, $laborart_ID);
						break;
					case "bibliothek":
						raumAnlegenModel::bibliothekAnlegen($bezeichnung);
						break;
					default:
						echo "Fehler beim Raumtyp eintragen!";
						exit;
				}
				echo "Raum erfolgreich angelegt.";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			} else {
				//Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
				echo "Ein Fehler ist aufgetretten!<br><br>";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			}
		}
	}
?>