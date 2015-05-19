<?php
/*
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
*/

class raumAnlegenController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	// rendert die Startview 'raumAnlegen'
	public function raumAnlegen() {
		$this->View->render ( 'raumanlegen/raumAnlegen' );
	}
	// öffnet je nach Angegebener Raumkategorie die dazugehörige View
	public function raumSelected() {
		$raumtyp = $_POST ['typ'];
		if (isset ( $_POST )) {
			switch ($raumtyp) {
				case "vorlesungsraum" :
					$this->View->render ( 'raumanlegen/vorlesungsraumAnlegen', array (
							'geb_list' => raumAnlegenModel::getGebäude (),
							'ausstattung_list' => raumAnlegenModel::getAusstattung () 
					) );
					break;
				case "buero" :
					$this->View->render ( 'raumanlegen/bueroAnlegen', array (
							'geb_list' => raumAnlegenModel::getGebäude () 
					) );
					break;
				case "labor" :
					$this->View->render ( 'raumanlegen/laborAnlegen', array (
							'geb_list' => raumAnlegenModel::getGebäude (),
							'labArt_list' => raumAnlegenModel::getLaborart (),
							'ausstattung_list' => raumAnlegenModel::getAusstattung () 
					) );
					break;
				case "bibliothek" :
					$this->View->render ( 'raumanlegen/bibliothekAnlegen', array (
							'geb_list' => raumAnlegenModel::getGebäude (),
							'buchKat_list' => raumAnlegenModel::getBuchkategorie () 
					) );
					break;
				default :
					echo "Kein Raumtyp ausgewählt!";
			}
		} else {
			echo "Kein Raumtyp ausgewählt!";
		}
	}
	
	// Speichert den Raum mit den angegebenen Informationen in den jeweiligen Datenbanktabellen
	public function saveRaum() {
		if (isset ( $_POST ['bezeichnung'] ) and isset ( $_POST ['gebäude'] ) and isset ( $_POST ['raumtyp'] )) {
			// fragt die übergebenen Stammdaten ab
			$bezeichnung = $_POST ['bezeichnung'];
			$gebäude_string = $_POST ['gebäude'];
			$gebäude_array = explode ( ",", $gebäude_string );
			$gebäude_char = $gebäude_array [0];
			$raumtyp = $_POST ['raumtyp'];
			
			// legt den Raum (Stammdaten in Raum-Tabelle ) in der Datenbank an.
			raumAnlegenModel::raumStammdaten ( $bezeichnung, $gebäude_char );
			
			// Je nach raumtyp werden die spezifischen Informationen in der Datenbank gespeichert.
			switch ($raumtyp) {
				case "vorlesungsraum" :
					// Raum wird in die Tabelle der jeweiligen Raumkategorie eingetragen.
					raumAnlegenModel::vorlesungsraumAnlegen ( $bezeichnung );
					/*
					 * Um die angegebene Ausstattung für den Vorlesungsraum in die Datenbanktabelle einzutragen,
					 * werden alle Checkboxen und dazugehörigen Textfelder für die Anzahl abgefragt.
					 * Die Informationen werden dann mit der ausstattungVorlesungsraum-function im Model in die Datenbank eingetragen.
					 */
					$data = array (
							'ausstattung_list' => raumAnlegenModel::getAusstattung () 
					);
					// print_r($data);
					foreach ( $data as $key => $value ) {
						$this->{$key} = $value;
						// print_r($value);
					}
					foreach ( $this->ausstattung_list as $key => $value ) {
						// echo htmlentities($value[0]);
						// print_r($value->ausstattung_bezeichnung);
						if (isset ( $_POST [$value->ausstattung_bezeichnung] )) {
							$id = $value->ausstattung_ID;
							$anzahl = $_POST [$value->ausstattung_bezeichnung . "Anzahl"];
							raumAnlegenModel::ausstattungVorlesungsraum ( $id, $bezeichnung, $anzahl );
						}
					}
					break;
				case "buero" :
					// Raum wird in die Tabelle der jeweiligen Raumkategorie eingetragen.
					raumAnlegenModel::bueroAnlegen ( $bezeichnung );
					break;
				case "labor" :
					// übergebene Laborart auslesen
					$labor_string = $_POST ['laborart'];
					$labor_array = explode ( ",", $labor_string );
					$laborart_ID = $labor_array [0];
					// Raum wird in die Tabelle der jeweiligen Raumkategorie eingetragen.
					raumAnlegenModel::laborAnlegen ( $bezeichnung, $laborart_ID );
					/*
					 * Um die angegebene Ausstattung für das Labor in die Datenbanktabelle einzutragen,
					 * werden alle Checkboxen und dazugehörigen Textfelder für die Anzahl abgefragt.
					 * Die Informationen werden dann mit der ausstattungLaborraum-function im Model in die Datenbank eingetragen.
					 */
					$data = array (
							'ausstattung_list' => raumAnlegenModel::getAusstattung () 
					);
					// print_r($data);
					foreach ( $data as $key => $value ) {
						$this->{$key} = $value;
						// print_r($value);
					}
					foreach ( $this->ausstattung_list as $key => $value ) {
						// echo htmlentities($value[0]);
						// print_r($value->ausstattung_bezeichnung);
						if (isset ( $_POST [$value->ausstattung_bezeichnung] )) {
							$id = $value->ausstattung_ID;
							$anzahl = $_POST [$value->ausstattung_bezeichnung . "Anzahl"];
							raumAnlegenModel::ausstattungLaborraum ( $id, $bezeichnung, $anzahl );
						}
					}
					break;
				case "bibliothek" :
					// Raum wird in die Tabelle der jeweiligen Raumkategorie eingetragen.
					raumAnlegenModel::bibliothekAnlegen ( $bezeichnung );
					/*
					 * Um die angegebenen Buchkategorien in die Datenbanktabelle einzutragen,
					 * werden alle Checkboxen abgefragt.
					 * Die Informationen werden dann mit der buchKatBibliothek-function im Model in die Datenbank eingetragen.
					 */
					$data = array (
							'buchKat_list' => raumAnlegenModel::getBuchkategorie () 
					);
					// print_r($data);
					foreach ( $data as $key => $value ) {
						$this->{$key} = $value;
						// print_r($value);
					}
					foreach ( $this->buchKat_list as $key => $value ) {
						// echo htmlentities($value[0]);
						if (isset ( $_POST [$value->buchKat_bezeichnung] )) {
							$id = $value->buchKat_ID;
							raumAnlegenModel::buchKatBibliothek ( $id, $bezeichnung );
						}
					}
					break;
				default :
					echo "Fehler beim Raumtyp eintragen!";
					exit ();
			}
			// wenn Raum erfolgreich angelegt wurde, wird diese raumAngelegtView angezeigt.
			$this->View->render ( 'raumanlegen/raumAngelegt' );
		} else {
			// Wenn schon bei der Auswahl von Veranstaltung und User etwas nicht beachtet wurde, bekommt man dies gemeldet.
			echo "Ein Fehler ist aufgetretten!<br><br>";
			echo '<input type="button" value="Zurück" onClick="history.back();">';
		}
	}
}
?>