<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<?php
	class raumAnlegenModel{
		
		public static function getGebäude(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select g.geb_bezeichnung, a.straßenname, a.hausnummer from gebaeude g join adresse a on g.geb_bezeichnung = a.geb_bezeichnung';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function getAusstattung(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select ausstattung_bezeichnung from Ausstattung';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function getLaborart(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = '';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function bibliothekAnlegen (){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = '';
			$query = $database->prepare($sql);
			$query->execute();
		}
		
		public static function bueroAnlegen (){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = '';
			$query = $database->prepare($sql);
			$query->execute();
		}
		
		public static function laborAnlegen (){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = '';
			$query = $database->prepare($sql);
			$query->execute();
		}
		
		public static function vorlesungsraumAnlegen (){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = '';
			$query = $database->prepare($sql);
			$query->execute();
		}
	}
?>