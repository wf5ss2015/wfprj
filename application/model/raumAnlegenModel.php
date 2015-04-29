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
			$sql = 'Select lArt_ID, lArt_bezeichnung from Laborart';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function getBuchkategorie(){
			$database = DatabaseFactory::getFactory()->getConnection();
			$sql = 'Select buchKat_bezeichnung from Buchkategorie';
			$query = $database->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
		
		public static function bibliothekAnlegen ($bezeichnung, $gebäude_char){
			$database = DatabaseFactory::getFactory()->getConnection();
			$insert_sql1 = "INSERT INTO raum (raum_bezeichnung, geb_bezeichnung) 
							VALUES ('$bezeichnung', '$gebäude_char')";
			$insert_sql2 = "INSERT INTO bibliothek (raum_bezeichnung) 
							VALUES ('$bezeichnung')";
			$query1 = $database->prepare($insert_sql1);
			$query2 = $database->prepare($insert_sql2);
			$query1->execute();
			$query2->execute();
		}
		
		public static function bueroAnlegen ($bezeichnung, $gebäude_char){
			$database = DatabaseFactory::getFactory()->getConnection();
			$insert_sql1 = "INSERT INTO raum(raum_bezeichnung, geb_bezeichnung)
							VALUES ('$bezeichnung', '$gebäude_char')";
			$insert_sql2 = "INSERT INTO buero (raum_bezeichnung)
							VALUES ('$bezeichnung')";
			$query1 = $database->prepare($insert_sql1);
			$query2 = $database->prepare($insert_sql2);
			$query1->execute();
			$query2->execute();
		}
		
		public static function laborAnlegen ($bezeichnung, $gebäude_char){
			$database = DatabaseFactory::getFactory()->getConnection();
			$insert_sql1 = "INSERT INTO raum(raum_bezeichnung, geb_bezeichnung) 
							VALUES ('$bezeichnung', '$gebäude_char')";
			$insert_sql2 = "INSERT INTO laborraum(raum_bezeichnung, lArt_ID) 
							VALUES ('$bezeichnung', '$laborart_ID')";
			$query1 = $database->prepare($insert_sql1);
			$query2 = $database->prepare($insert_sql2);
			$query1->execute();
			$query2->execute();
		}
		
		public static function vorlesungsraumAnlegen ($bezeichnung, $gebäude_char){
			$database = DatabaseFactory::getFactory()->getConnection();
			$insert_sql1 = "INSERT INTO raum (raum_bezeichnung, geb_bezeichnung) 
							VALUES ('$bezeichnung', '$gebäude_char')";
			$insert_sql2 = "INSERT INTO vorlesungsraum (raum_bezeichnung) 
							VALUES ('$bezeichnung')";
			$query1 = $database->prepare($insert_sql1);
			$query2 = $database->prepare($insert_sql2);
			$query1->execute();
			$query2->execute();
		}
	}
?>