<!--
    autor: Kris Klamser
    datum: 5.4.2015
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
			print_r($query);
			return $query->fetchAll();
			
		}
		
		
		
		public static function bibliothekAnlegen (){
			
		}
		public static function bueroAnlegen (){
			
		}
		public static function laborAnlegen (){
			
		}
		public static function vorlesungsraumAnlegen (){
			
		}
	}
?>