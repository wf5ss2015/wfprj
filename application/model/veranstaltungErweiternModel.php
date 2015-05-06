<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 1.5
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
-->
<?php
	class veranstaltungErweiternModel {
		
		//fragt nach allen Veranstaltungen in der Datenbanktabelle Veranstaltung
		public static function getVeranstaltung(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select veranst_ID, veranst_bezeichnung from veranstaltung';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		//selected alle User
		public static function getUser(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select nutzer_name, rolle_bezeichnung from nutzer u join rolle r on r.rolle_ID = u.rolle_ID';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		//insertet die Erweiterung einer Veranstaltung mit einer Person
		public static function setErweiterung($veranst_ID, $user_name){			
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = "Insert into User_beteiligtAn_Veranstaltung (veranst_ID, nutzer_name) Values ('$veranst_ID', '$user_name')";
			$query = $database->prepare($sql);
			$query->execute();
		}
	}
?>