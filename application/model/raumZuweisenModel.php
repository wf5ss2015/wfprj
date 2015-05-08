<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 340): Als Entwickler möchte ich im MVC-Pattern programmieren können.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: Model erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden	
	
	//////////////////////////////////////////////////
-->


<?php
class raumZuweisenModel {
	
	// gibt ein array zurück mit allen vorhandenen Veranstaltungen:
	public function getVeranstaltungen() {
		$query = "SELECT veranst_ID, veranst_bezeichnung FROM Veranstaltung";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
		$veranstaltungen = $this->abfrage ( $query );
		
		return $veranstaltungen;
	}
	
	// gibt ein array zurück mit allen Wochentagen
	public function getWochentage() {
		$query = "SELECT tag_ID, tag_bezeichnung FROM Wochentag;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
		$tage = $this->abfrage ( $query );
		
		return $tage;
	}
	
	// gibt ein array zurück mit allen Stundenzeiten
	public function getStundenzeiten() {
		$query = "SELECT stdZeit_ID, stdZeit_von, stdZeit_bis FROM Stundenzeit;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
		$stdZeiten = $this->abfrage ( $query );
		
		return $stdZeiten;
	}
	
	// gibt ein array zurück mit allen verfügbaren Vorlesungsräumen:
	public function getVerfuegbareVorlesungsraeume($veranst_ID, $wochentag_ID, $stdZeit_ID) {
		// alle Vorlesungsräume selektieren, welche zur ausgewählten Zeit noch nicht belegt sind:
		$query = "SELECT raum_bezeichnung FROM Vorlesungsraum WHERE raum_bezeichnung NOT IN 
					(SELECT raum_bezeichnung FROM Veranstaltungstermin 
					WHERE stdZeit_ID = '$stdZeit_ID' AND tag_ID = '$wochentag_ID');";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
		$result_raeume = $this->abfrage ( $query );
		
		$verfuegbareRaeume = array ();
		$index = 0;
		
		/*
		 * im array $verfuegbareRaeume werden nur die Räume aus dem Reusultset $result_raeume abgespeichert,
		 * wenn sie die erforderliche Ausstattung erfüllen, es muss also für jeden Vorlesungsraum in der
		 * while-Schleife die Ausstattung überprüft werden:
		 */
		while ( $row = $result_raeume->fetch_assoc () ) {
			$raum_bezeichnung = $row ['raum_bezeichnung'];
			
			if ($this->pruefeAusstattung_vorlesungsraum ( $raum_bezeichnung, $veranst_ID )) {
				// Raum erfüllt Ausstattung, welche von der Veranstaltung erfordert wird:
				$verfuegbareRaeume [$index] = $row;
				$index ++;
			}
		}
		
		return $verfuegbareRaeume;
	}
	
	// gibt ein array zurück mit allen verfügbaren Laborräumen:
	public function getVerfuegbareLaborraeume($veranst_ID, $wochentag_ID, $stdZeit_ID) {
		// alle Laborräume selektieren, welche zur ausgewählten Zeit noch nicht belegt sind:
		$query = "SELECT lr.raum_bezeichnung, la.lArt_bezeichnung 
					   FROM Laborraum lr JOIN Laborart la ON (lr.lArt_ID = la.lArt_ID)
					   WHERE lr.raum_bezeichnung NOT IN 
							(SELECT raum_bezeichnung FROM Veranstaltungstermin 
							WHERE stdZeit_ID = '$stdZeit_ID' AND tag_ID = '$wochentag_ID');";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
		$result_raeume = $this->abfrage ( $query );
		
		$verfuegbareRaeume = array ();
		$index = 0;
		
		/*
		 * im array $verfuegbareRaeume werden nur die Räume aus dem Reusultset $result_raeume abgespeichert,
		 * wenn sie die erforderliche Ausstattung erfüllen, es muss also für jeden Vorlesungsraum in der
		 * while-Schleife die Ausstattung überprüft werden:
		 */
		while ( $row = $result_raeume->fetch_assoc () ) {
			$raum_bezeichnung = $row ['raum_bezeichnung'];
			
			if ($this->pruefeAusstattung_laborraum ( $raum_bezeichnung, $veranst_ID )) {
				// Raum erfüllt Ausstattung, welche von der Veranstaltung erfordert wird:
				$verfuegbareRaeume [$index] = $row;
				$index ++;
			}
		}
		
		return $verfuegbareRaeume;
	}
	
	// legt einen neuen Veranstaltungstermin in der Tabelle Veranstaltungstermin an:
	public function veranstaltungsterminAnlegen($raum_bezeichnung, $veranst_ID, $wochentag_ID, $stdZeit_ID) {
		// ausgewählter Raum der ausgewählten Veranstaltung zur ausgewählten Zeit zuweisen:
		
		// Datenbankverbindung
		$db = new DatabaseFactoryMysql ();
		$db->autocommit ( false );
		$db->begin_transaction ();
		
		$insert = 'INSERT INTO Veranstaltungstermin (veranst_ID, stdZeit_ID, tag_ID, raum_bezeichnung) VALUES (?, ?, ?, ?);';
		
		if ($stmt = $db->prepare ( $insert )) {
			$stmt->bind_param ( 'iiis', $veranst_ID, $stdZeit_ID, $wochentag_ID, $raum_bezeichnung );
			$stmt->execute ();
			$db->commit ();
		} else {
			echo $db->error;
			$db->rollback ();
		}
	}
	
	/*
	 * wird in der Funktion getVerfuegbareVorlesungsraeume() aufgerufen und überprüft, ob
	 * der Vorlesungsraum die Ausstattung erfüllt, welche von der Veranstaltung erfordert wird
	 * (boolean wird zurückgegeben)
	 */
	private function pruefeAusstattung_vorlesungsraum($raum_bezeichnung, $veranst_ID) {
		$query = "SELECT v.anzahl AS anzahl_erforderlich, vr.anzahl AS anzahl_inRaum, v.ausstattung_ID AS a_ID
							FROM  Veranstaltung_erfordert_Ausstattung v JOIN Vorlesungsraum_hat_Ausstattung vr 
								ON (v.ausstattung_ID = vr.ausstattung_ID)
							WHERE v.veranst_ID = '$veranst_ID' AND vr.raum_bezeichnung = '$raum_bezeichnung';";
		
		$result_ausstattung = $this->abfrage ( $query );
		
		$ausstattungOk = 1;
		
		// für jedes Ausstattungsmerkmal wird überprüft, ob es in erforderlicher Anzahl im Raum vorhanden ist
		while ( $row = $result_ausstattung->fetch_assoc () ) {
			$a_ID = $row ['a_ID'];
			$anzahl_erforderlich = $row ['anzahl_erforderlich'];
			$anzahl_inRaum = $row ['anzahl_inRaum'];
			
			if ($a_ID == 1) // Ausstattungsmerkmal Stuhl hat ausstattung_ID 1
{
				if ((($anzahl_inRaum - $anzahl_erforderlich)) > 20 or ($anzahl_inRaum < $anzahl_erforderlich)) {
					$ausstattungOk = 0;
					break;
				}
			} else if ($a_ID == 2) // Ausstattungsmerkmal PC hat ausstattung_ID 2
{
				if (($anzahl_erforderlich == 0 and $anzahl_inRaum > 0) or ($anzahl_inRaum < $anzahl_erforderlich)) {
					$ausstattungOk = 0;
					break;
				}
			} else // gilt für restliche Ausstattungsmerkmale
{
				if ($anzahl_inRaum < $anzahl_erforderlich) {
					$ausstattungOk = 0;
					break;
				}
			}
		}
		
		return $ausstattungOk;
	}
	
	/*
	 * wird in der Funktion getVerfuegbareLaborraeume() aufgerufen und überprüft, ob
	 * der Vorlesungsraum die Ausstattung erfüllt, welche von der Veranstaltung erfordert wird
	 * (boolean wird zurückgegeben)
	 */
	private function pruefeAusstattung_laborraum($raum_bezeichnung, $veranst_ID) {
		$query = "SELECT v.anzahl AS anzahl_erforderlich, lr.anzahl AS anzahl_inRaum, v.ausstattung_ID AS a_ID
							FROM  Veranstaltung_erfordert_Ausstattung v JOIN Laborraum_hat_Ausstattung lr 
								ON (v.ausstattung_ID = lr.ausstattung_ID)
							WHERE v.veranst_ID = '$veranst_ID' AND lr.raum_bezeichnung = '$raum_bezeichnung';";
		
		$result_ausstattung = $this->abfrage ( $query );
		
		$ausstattungOk = 1;
		
		// für jedes Ausstattungsmerkmal wird überprüft, ob es in erforderlicher Anzahl im Raum vorhanden ist
		while ( $row = $result_ausstattung->fetch_assoc () ) {
			$a_ID = $row ['a_ID'];
			$anzahl_erforderlich = $row ['anzahl_erforderlich'];
			$anzahl_inRaum = $row ['anzahl_inRaum'];
			
			if ($a_ID == 1) // Ausstattungsmerkmal Stuhl hat ausstattung_ID 1
{
				if ((($anzahl_inRaum - $anzahl_erforderlich)) > 20 or ($anzahl_inRaum < $anzahl_erforderlich)) {
					$ausstattungOk = 0;
					break;
				}
			} else if ($a_ID == 2) // Ausstattungsmerkmal PC hat ausstattung_ID 2
{
				if (($anzahl_erforderlich == 0 and $anzahl_inRaum > 0) or ($anzahl_inRaum < $anzahl_erforderlich)) {
					$ausstattungOk = 0;
					break;
				}
			} else // gilt für restliche Ausstattungsmerkmale
{
				if ($anzahl_inRaum < $anzahl_erforderlich) {
					$ausstattungOk = 0;
					break;
				}
			}
		}
		
		return $ausstattungOk;
	}
	
	// Funktion zur Datenabfrage, sodass nur an dieser Stelle die Verbindung zur DB hergestellt wird
	private function abfrage($query) {
		// Datenbankverbindung
		$db = new DatabaseFactoryMysql ();
		
		$stmt = $db->prepare ( $query );
		$stmt->execute ();
		
		$resultSet = $stmt->get_result ();
		return $resultSet;
	}
}
