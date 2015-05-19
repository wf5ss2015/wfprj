<?php
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
		$sql = 'Select nutzer_name, rolle_bezeichnung from Nutzer u join Rolle r on r.rolle_ID = u.rolle_ID';
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			return $query->fetchAll ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
		}
	}
	
	// insertet die Erweiterung einer Veranstaltung mit einer Person
	public function setErweiterung($veranst_ID, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "Insert into Nutzer_beteiligtAn_Veranstaltung (veranst_ID, nutzer_name) Values ('$veranst_ID', '$user_name')";
		$query = $database->prepare ( $sql );
		try{
			$query->execute ();
			Session::add ( 'response_positive', 'Person wurde erfolgreich hinzugefügt.' );
		} catch ( PDOException $e ){
			if ($e->errorInfo [1] == 1062) {
				Session::add ( 'response_warning', 'Sie sind bereits an Veranstaltung beteiligt.' );
			} else {
				Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
			}
		}
	}
}
?>