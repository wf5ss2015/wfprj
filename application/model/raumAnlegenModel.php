<?php
/*
    autor: Kris Klamser
    datum: 14.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04	
	zeitaufwand: 0.5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.) 
	-> Überarbeitung nach Review ("static" entfernt, Fehlerbearbeitung verbessert)
*/
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 2
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
	
	Dieses Model dient allen Arbeiten auf der Datenbank bezüglich dem Anlegen von Räumen.
*/

class raumAnlegenModel {
	
	// Alle Informationen von Gebäuden abfragen.
	public function getGebäude() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select g.geb_bezeichnung, a.straßenname, a.hausnummer from Gebaeude g join Adresse a on g.geb_bezeichnung = a.geb_bezeichnung';
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// Alle Informationen von Tabelle Ausstattung abfragen.
	public function getAusstattung() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select ausstattung_ID, ausstattung_bezeichnung from Ausstattung';
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// Alle Laborarten abfragen.
	public function getLaborart() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select lArt_ID, lArt_bezeichnung from Laborart';
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// Alle Buchkategorien abfragen.
	public function getBuchkategorie() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$sql = 'Select buchKat_ID, buchKat_bezeichnung from Buchkategorie';
		$query = $database->prepare ( $sql );
		$query->execute ();
		return $query->fetchAll ();
	}
	
	// Bibliothek in Datenbank eintragen
	public function bibliothekAnlegen($bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql2 = "INSERT INTO bibliothek (raum_bezeichnung) 
							VALUES ('$bezeichnung')";
		$query2 = $database->prepare ( $insert_sql2 );
		try{
			$query2->execute ();
			Session::add ( 'response_positive', 'Die Bibliothek wurde erfolgreich angelegt.' );
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Die Bibliothek konnte nicht angelegt werden.' );
		}
	}
	
	// Büro in Datenbank in Datenbank eintragen
	public function bueroAnlegen($bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql2 = "INSERT INTO buero (raum_bezeichnung)
							VALUES ('$bezeichnung')";
		$query2 = $database->prepare ( $insert_sql2 );
		try{
			$query2->execute ();
			Session::add ( 'response_positive', 'Das Büro wurde erfolgreich angelegt.' );
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Das Büro konnte nicht angelegt werden.' );
		}
	}
	
	// Laborraum in Datenbank eintragen
	public function laborAnlegen($bezeichnung, $laborart_ID) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql2 = "INSERT INTO laborraum(raum_bezeichnung, lArt_ID) 
							VALUES ('$bezeichnung', '$laborart_ID')";
		$query2 = $database->prepare ( $insert_sql2 );
		try{
			$query2->execute ();
			Session::add ( 'response_positive', 'Das Labor wurde erfolgreich angelegt.' );
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Das Labor konnte nicht angelegt werden.' );
		}
	}
	
	// Vorlesungsraum in Datenbank eintragen
	public function vorlesungsraumAnlegen($bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql2 = "INSERT INTO vorlesungsraum (raum_bezeichnung) 
							VALUES ('$bezeichnung')";
		$query2 = $database->prepare ( $insert_sql2 );
		try{
			$query2->execute ();
			Session::add ( 'response_positive', 'Der Vorlesungsraum wurde erfolgreich angelegt.' );
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Der Vorlesungsraum konnte nicht angelegt werden.' );
		}
	}
	/*
		Stammdaten eines Raumes in Datenbank eintragen. Stammdaten sind Raumbezeichnung und das zugehörige Gebäude.
		Wenn ein Fehler auftritt wird der Rest abgebrochen und eine Fehlermeldung angezeigt.
	*/
	public function raumStammdaten($bezeichnung, $gebäude_char) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql1 = "INSERT INTO raum(raum_bezeichnung, geb_bezeichnung) 
							VALUES ('$bezeichnung', '$gebäude_char')";
		$query1 = $database->prepare ( $insert_sql1 );
		try{
			$query1->execute ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Der Raum konnte nicht angelegt werden.' );
			$this->View->render ( 'raumanlegen/raumAngelegt' );
			exit;
		}
	}
	
	// Trägt die raumspezifische Ausstattung eines Vorlesungsraums in die Datenbank ein.
	public function ausstattungVorlesungsraum($id, $bezeichnung, $stückzahl) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql = "INSERT INTO vorlesungsraum_hat_ausstattung (ausstattung_ID, raum_bezeichnung, anzahl) 
							VALUES ('$id','$bezeichnung', '$stückzahl')";
		$query = $database->prepare ( $insert_sql );
		try{
			$query->execute ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler beim Eintragen der Ausstattung aufgetreten.' );
		}
	}
	
	// Trägt die raumspezifische Ausstattung eines Laborraums in die Datenbank ein.
	public function ausstattungLaborraum($id, $bezeichnung, $stückzahl) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql = "INSERT INTO laborraum_hat_ausstattung (ausstattung_ID, raum_bezeichnung, anzahl) 
							VALUES ('$id','$bezeichnung', '$stückzahl')";
		$query = $database->prepare ( $insert_sql );
		try{
			$query->execute ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler beim Eintragen der Ausstattung aufgetreten.' );
		}
	}
	
	// Trägt die bibliotheksspezifischen Buchkategorien einer Bibliothek in die Datenbank ein.
	public function buchKatBibliothek($id, $bezeichnung) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		$insert_sql = "INSERT INTO bibliothek_hat_buchkategorie (buchKat_ID, raum_bezeichnung) 
							VALUES ('$id','$bezeichnung')";
		$query = $database->prepare ( $insert_sql );
		try{
			$query->execute ();
		} catch (PDOException $e){
			Session::add ( 'response_negative', 'Es ist ein Fehler beim Eintragen der Buchkategorien aufgetreten.' );
		}
	}
}
?>