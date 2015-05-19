<?php
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04	
	zeitaufwand: 0.1
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
	-> Überarbeitung nach Review ("static" entfernt)
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
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// selected alle User
	public function getUser() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select nutzer_name, rolle_bezeichnung from Nutzer u join Rolle r on r.rolle_ID = u.rolle_ID';
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// insertet die Erweiterung einer Veranstaltung mit einer Person
	public function setErweiterung($veranst_ID, $user_name) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = "Insert into Nutzer_beteiligtAn_Veranstaltung (veranst_ID, nutzer_name) Values ('$veranst_ID', '$user_name')";
		$query = $database->prepare ( $sql );
		$query->execute ();
	}
}
?>