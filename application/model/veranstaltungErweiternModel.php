<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
-->
<?php
	class veranstaltungErweiternModel {
		
		public static function getVeranstaltung(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select veranst_ID, veranst_bezeichnung from veranstaltung';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function getUser(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select user_name, rolle_bezeichnung from user u join rolle r on r.rolle_ID = u.rolle_ID';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function setErweiterung($veranst_ID, $user_name){			
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = "Insert into User_beteiligtAn_Veranstaltung (veranst_ID, user_name) Values ('$veranst_ID', '$user_name')";
			$query = $database->prepare($sql);
			$query->execute();
		}
	}
?>