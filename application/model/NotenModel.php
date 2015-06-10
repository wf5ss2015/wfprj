
<?php
 /* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 23.05.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/
 /*
  * Erweiterung um function getSpecificStudents2($user_name)
  * Sprint: 5
  * autor: Kris Klamser
  * User Story (Nr. 440): Als Student möchte ich mir ein Zeugnis/Notenspiegel mit allen bisher erbrachten Leistungen erstellen lassen können.
  * datum: 8.6.2015
  */

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
		 
		  $sql = "SELECT n.veranst_ID AS Veranstaltungsnummer, v.veranst_bezeichnung AS Bezeichnung, 
					s.matrikelnummer AS Matrikel, nu.vorname as Vorname, nu.nachname as Nachname,
					n.student_nutzer_name as Nutzer, n.note AS Note
				  FROM Notenliste n
					  JOIN Nutzer nu
					  ON nu.nutzer_name = n.student_nutzer_name
					  JOIN Student s
					  ON s.nutzer_name = n.student_nutzer_name
					  JOIN Veranstaltung v
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
		 
		  $sql = "UPDATE `Notenliste` SET `note`= :note
				  WHERE `student_nutzer_name`= :nutzer AND `veranst_ID`= :id;";
		 
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
		 
		  $sql = "SELECT n.veranst_ID AS Veranstaltungsnummer, v.veranst_bezeichnung AS Bezeichnung,
					n.student_nutzer_name AS Nutzer, n.note AS Note, 
					s.matrikelnummer as Matrikel, nu.vorname as Vorname, nu.nachname as Nachname, 
					st.stg_bezeichnung as Studiengang 
				 FROM notenliste n 
					JOIN veranstaltung v 
					ON v.veranst_ID = n.veranst_ID 
					JOIN Student s 
					ON s.nutzer_name = n.student_nutzer_name
					JOIN Nutzer nu 
					ON nu.nutzer_name = n.student_nutzer_name
					JOIN Studiengang st 
					ON st.stg_ID = s.stg_ID 
				 GROUP BY n.student_nutzer_name; ";
		 
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
					s.matrikelnummer AS Matrikel, nu.vorname as Vorname, nu.nachname as Nachname,
					n.student_nutzer_name as Nutzer, n.note AS Note
				  FROM Notenliste n
					  JOIN Nutzer nu
					  ON nu.nutzer_name = n.student_nutzer_name
					  JOIN Student s
					  ON s.nutzer_name = n.student_nutzer_name
					  JOIN Veranstaltung v
					  ON v.veranst_ID = n.veranst_ID
				  WHERE n.student_nutzer_name = :id ;";
		 
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
	 
	/* 
		START
		autor: Kris Klamser
		Sprint: 5
		Zeitaufwand: 0.5
		datum: 8.6.2015
		Frägt alle nötigen Informationen für den Notenspiegel/Zeugnis ab
	*/
	 public function getSpecificStudents2($user_name)
	  {
		 $database = DatabaseFactory::getFactory()->getConnection();
		 
		  $sql = 'SELECT n.veranst_ID, v.veranst_bezeichnung, n.note
				  FROM Notenliste n 
				  JOIN veranstaltung v ON v.veranst_ID = n.veranst_ID 
				  WHERE n.student_nutzer_name ="'.$user_name.'";';
		 
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
	  /*
		ENDE Klamser Sprint 5
	  */
}
