
<?php
 /* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 23.05.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/


/**-----------------------------------------------------------------------------------------
	* START SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/04  Beschreibung: SQL Statements
	* Zeitaufwand (in Stunden): 6
	* START SPRINT 05	
	*/
	    
/**
 *
 * @author Damian Wysocki
 *        
 *         Klasse Model um Anfragen vom Controller zu bearbeiten
 **/     
 
class NotenModel {

	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Alle  Vorlesungen aus der Datenbank holen
	 **/     
	public function getVorlesungAll(){
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "SELECT veranst_ID,veranst_bezeichnung
				FROM Veranstaltung;";
		
		$query = $database->prepare ( $sql );
		
		try {
			$query->execute();
			
			
		} catch ( PDOException $fehler ) {
			Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' . $fehler );
		}
		
		//print_r($query->fetch());
		
		return $query->fetchAll ();
	}
	

	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Alle Teilnehmer einer Veranstaltung aus der Datenbank holen
	 **/     
	  public function getVorlesungAllParticipants($id)
	  {
		 $database = DatabaseFactory::getFactory()->getConnection();
		 
		  $sql = "SELECT n.veranst_ID AS Veranstaltungsnummer, v.veranst_bezeichnung AS Bezeichnung, n.nutzer_name AS Nutzer,
					n.note AS Note
				FROM notenliste n
				JOIN veranstaltung v
				ON v.veranst_ID = n.veranst_ID
				WHERE n.veranst_ID = :id ";
		 
		  $query = $database->prepare($sql);
		 
		  try{
		  $query->execute(array(':id' => $id));
		 
		  }catch (PDOException $fehler)
		  {
		  Session::add('response_negative', 'Es ist ein Fehler aufgetreten.'.$fehler);
		  }
		  //print_r($query->fetch());
		  return $query->fetchAll();
	  }
	  
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Die geänderte Note in die Datenbank speichern
	 **/     
	  public function saveNote($id, $nutzer, $note)
	  {
		 $database = DatabaseFactory::getFactory()->getConnection();
		 
		  $sql = "UPDATE `notenliste` SET `note`= :note
				  WHERE `nutzer_name`= :nutzer AND `veranst_ID`= :id;";
		 
		  $query = $database->prepare($sql);
		 
		  try{
		  $query->execute(array(
					':id' => $id,
					':nutzer' => $nutzer,
					':note' => $note,
		  ));
			Session::add ( 'response_positive', 'Note erfolgreich geändert.');
		  }catch (PDOException $fehler)
		  {
		  Session::add('response_negative', 'Es ist ein Fehler aufgetreten.'.$fehler);
		  }
		  //print_r($query->fetch());
		  //return $query->fetchAll();
	  }
	
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Alle Studenten in Dropdown-Menü anzeigen
	 **/ 
	public function getAllStudents()
	  {
		 $database = DatabaseFactory::getFactory()->getConnection();
		 
		 // GROUP BY AUF HS_SERVER NOTWENDIG!!!
		  $sql = "SELECT n.veranst_ID AS Veranstaltungsnummer, v.veranst_bezeichnung AS Bezeichnung,
					n.nutzer_name AS Nutzer, n.note AS Note, 
					coalesce(MAX(case when w.eigenschaft_ID = 2 then w.inhalt end), 0) as Matrikel, 
					coalesce(MAX(case when w.eigenschaft_ID = 3 then w.inhalt end), 0) as Vorname, 
					coalesce(MAX(case when w.eigenschaft_ID = 4 then w.inhalt end), 0) as Nachname, 
					coalesce(MAX(case when w.eigenschaft_ID = 10 then w.inhalt end), 0) as Studiengang 
				FROM notenliste n JOIN veranstaltung v ON v.veranst_ID = n.veranst_ID 
				JOIN wert w ON w.nutzer_name = n.nutzer_name 
				GROUP BY n.nutzer_name; ";
		 
		  $query = $database->prepare($sql);
		 
		  try{
		  $query->execute();
		 
		  }catch (PDOException $fehler)
		  {
		  Session::add('response_negative', 'Es ist ein Fehler aufgetreten.'.$fehler);
		  }
		  //print_r($query->fetch());
		  return $query->fetchAll();
	  }
	  
	/**
	 *
	 * @author Damian Wysocki
	 *        
	 *         Die Notenliste eines bestimmten Studenten zum Bearbeiten aus der Datenbank holen
	 **/ 
	  public function getSpecificStudents($id)
	  {
		 $database = DatabaseFactory::getFactory()->getConnection();
		 
		  $sql = "SELECT n.veranst_ID AS Veranstaltungsnummer, v.veranst_bezeichnung AS Bezeichnung,
					n.nutzer_name AS Nutzer, n.note AS Note 
				  FROM notenliste n 
				  JOIN veranstaltung v ON v.veranst_ID = n.veranst_ID 
				  WHERE nutzer_name = :id ;";
		 
		  $query = $database->prepare($sql);
		 
		  try{
		  $query->execute(array(
					':id' => $id
		  ));
		 
		  }catch (PDOException $fehler)
		  {
		  Session::add('response_negative', 'Es ist ein Fehler aufgetreten.'.$fehler);
		  }
		  //print_r($query->fetch());
		  return $query->fetchAll();
	  }
	/**
	 * ENDE SPRINT 05
	 * @author: Damian Wysocki
	 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	 * Task: 430a/04  Beschreibung: SQL Statements
	 * Zeitaufwand (in Stunden): 6
	 * ENDE SPRINT 05	
	*---------------------------------------------------------------------------------------------------------------------*/
	
}
