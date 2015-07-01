<?php
/*
    autor: Kris Klamser
    datum: 22.6.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 6	
	zeitaufwand: 1.5
	user story (Nr. 560): Als Mitarbeiter möchte ich einer Veranstaltung einen Dozenten zuordnen können. (8 pkt.)
	-> Erweiterung: getStudent, getDozent, setErweiterungDozent($veranst_ID, $user_name)
*/
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04	
	zeitaufwand: 1.0
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
	-> Überarbeitung nach Review ("static" entfernt, Fehlerbearbeitung verbessert)
*/
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
*/
class veranstaltungErweiternModel {
	
	// fragt nach allen Veranstaltungen in der Datenbanktabelle Veranstaltung
	public function getVeranstaltung() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select veranst_ID, veranst_bezeichnung from Veranstaltung';
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	
	// selected alle User
	public function getUser() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select n.nutzer_name, r.rolle_bezeichnung from Nutzer n join Rolle r on n.rolle_ID = r.rolle_ID';
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	
	//START Änderungen Klamser Sprint 6
	// selected alle Studenten
	public function getStudent() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select nutzer_name, "Student" AS rolle_bezeichnung from Student;';
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	
	// selected alle Dozenten
	public function getDozent() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select nutzer_name, "Dozent" AS rolle_bezeichnung from Dozent;';
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	//ENDE Änderungen Klamser Sprint 6
	
	// insertet die Erweiterung einer Veranstaltung mit einem Student
	public function setErweiterungStudent($veranst_ID, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "Insert into Student_angemeldetAn_Veranstaltung (veranst_ID, student_nutzer_name) Values ('$veranst_ID', '$user_name')";
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			Session::add ( 'response_positive', 'Person wurde erfolgreich hinzugefügt.' );
		} catch ( PDOException $e ){
			if ($e->errorInfo [1] == 1062) {
				Session::add ( 'response_warning', 'Der Student ist bereits an Veranstaltung beteiligt.' );
			} else {
				Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
			}
		}
	}
	/*
		Kris Klamser
		Sprint 6
		22.6.2015
		Erweiterung um Veranstaltung mit Dozenten zu erweitern.
	*/
	// insertet die Erweiterung einer Veranstaltung mit eines Dozenten
	public function setErweiterungDozent($veranst_ID, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "UPDATE Veranstaltung SET dozent_nutzer_name = '$user_name' WHERE veranst_ID = '$veranst_ID';";
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			Session::add ( 'response_positive', 'Dozent wurde erfolgreich hinzugefügt.');
		} catch ( PDOException $e ){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	
	public function pruefenDozent($veranst_ID, $user_name){
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "SELECT count(dozent_nutzer_name) AS zahl FROM Dozent_berechtigtFuer_Veranstaltung WHERE dozent_nutzer_name = '$user_name' AND veranst_ID = '$veranst_ID';";
		$query = $database->prepare($sql);
		try {
			$query->execute ();
			return $query->fetchAll ();
		} catch ( PDOException $e ){
			Session::add( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
}
?>