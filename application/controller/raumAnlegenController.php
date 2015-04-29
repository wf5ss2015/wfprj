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
			global $raumtyp;
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
		
		public function setVorlesungsraum(){
			if(isset($_POST['bezeichnung']) and isset($_POST['gebäude'])){
				$bezeichnung = $_POST['bezeichnung'];
				$gebäude_string = $_POST['gebäude'];
				$gebäude_array = explode(",", $gebäude_string);
				$gebäude_char = $gebäude_array[0];
				raumAnlegenModel::vorlesungsraumAnlegen($bezeichnung, $gebäude_char);
				echo "Raum erfolgreich angelegt.";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			} else{
				//Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
				echo "Ein Fehler ist aufgetretten!<br><br>";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			}
		}
		public function setLabor(){
			if(isset($_POST['bezeichnung']) and isset($_POST['gebäude'])){
				$bezeichnung = $_POST['bezeichnung'];
				$gebäude_string = $_POST['gebäude'];
				$gebäude_array = explode(",", $gebäude_string);
				$gebäude_char = $gebäude_array[0];
				//Laborart Info muss aufgespalten werden, weil nur lArt_ID eingetragen werden muss
				$labor_string = $_POST['laborart'];
				$labor_array = explode(",", $labor_string);
				$laborart_ID = $labor_array[0];
				raumAnlegenModel::laborAnlegen($bezeichnung, $gebäude_char, $laborart_ID);
				echo "Raum erfolgreich angelegt.";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			} else{
				//Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
				echo "Ein Fehler ist aufgetretten!<br><br>";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			}
		}
		public function setBibliothek(){
			if(isset($_POST['bezeichnung']) and isset($_POST['gebäude'])){
				$bezeichnung = $_POST['bezeichnung'];
				$gebäude_string = $_POST['gebäude'];
				$gebäude_array = explode(",", $gebäude_string);
				$gebäude_char = $gebäude_array[0];
				raumAnlegenModel::bibliothekAnlegen($bezeichnung, $gebäude_char);
				echo "Raum erfolgreich angelegt.";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			} else{
				//Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
				echo "Ein Fehler ist aufgetretten!<br><br>";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			}
		}
		public function setBuero(){
			if(isset($_POST['bezeichnung']) and isset($_POST['gebäude'])){
				$bezeichnung = $_POST['bezeichnung'];
				$gebäude_string = $_POST['gebäude'];
				$gebäude_array = explode(",", $gebäude_string);
				$gebäude_char = $gebäude_array[0];
				raumAnlegenModel::bueroAnlegen($bezeichnung, $gebäude_char);
				echo "Raum erfolgreich angelegt.";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			} else{
				//Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
				echo "Ein Fehler ist aufgetretten!<br><br>";
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			}
		}	
	}
?>