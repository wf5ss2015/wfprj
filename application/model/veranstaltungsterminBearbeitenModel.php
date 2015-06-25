<?php

/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				24.06.2015
	
	- User Story (Nr. 590):	Als Mitarbeiter möchte ich einen Veranstaltungstermin ändern können.
	- User Story Punkte:	5
	- Task:					im Model Funktion loescheVeranstaltungstermin() erstellen.
	- Zeitaufwand:			1h
	
	//////////
	
	- User Story (Nr. 590):	Als Mitarbeiter möchte ich einen Veranstaltungstermin ändern können.
	- User Story Punkte:	5
	- Task:					im Model Funktion aendereVeranstaltungstermin() erstellen.
	- Zeitaufwand:			1.5h
*/

?>	

<?php

class veranstaltungsterminBearbeitenModel
{
	
	public function loescheVeranstaltungstermin($raum_bezeichnung, $veranst_ID, $tag_ID, $stdZeit_ID)
	{
		//Datenbankverbindung
		$db = new DatabaseFactoryMysql();
		$db -> autocommit(false);
		$db -> begin_transaction();
			
		$drop  = 'DELETE FROM Veranstaltungstermin WHERE veranst_ID = ? AND stdZeit_ID = ? AND tag_ID = ?;';
		$stmt  = $db -> prepare ($drop);
		$stmt -> bind_param('iii', $veranst_ID, $stdZeit_ID, $tag_ID);
		
		try
		{
			$stmt -> execute();
			$db -> commit();
			
			$meldung = "Veranstaltungstermin mit folgenden Parametern wurde erfolgreich gel&ouml;scht: 
						<ul>
							<li>Veranstaltung: ".$this->getVeranstaltung($veranst_ID)."</li>
							<li>Tag: ".$this->getTag($tag_ID)."</li>
							<li>Stundenzeit: ".$this->getStundenzeit($stdZeit_ID)."</li>
							<li>Raum: ".$raum_bezeichnung."</li>
						</ul>";
			
			Session::add('response_positive', $meldung);
		}
		catch (PDOException $e)
		{
			Session::add('response_negative', 'Es ist ein Fehler aufgetreten!'.$e);
			$db -> rollback();
		}
	}
	
	public function aendereVeranstaltungstermin()
	{
		//Datenbankverbindung
		$db = new DatabaseFactoryMysql();
		$db -> autocommit(false);
		$db -> begin_transaction();
			
		$update =  	'UPDATE Veranstaltungstermin
					SET tag_ID = ?, stdZeit_ID = ?, raum_bezeichnung = ?
					WHERE veranst_ID = ? AND tag_ID = ? AND stdZeit_ID = ?;';
					
		$stmt  = $db -> prepare ($update);
		
		$stmt -> bind_param('iisiii', 	$_SESSION['tagID_aenderung'], $_SESSION['stdZeitID_aenderung'], $_SESSION['raumBez_aenderung'],
										$_SESSION['veranst_ID'], $_SESSION['tag_ID'], $_SESSION['stdZeit_ID']);
		
		try
		{
			$stmt -> execute();
			$db -> commit();
			
			$meldung = "Veranstaltungstermin wurde erfolgreich ge&auml;ndert: 
						<ul>
							<li>Veranstaltung: ".$this->getVeranstaltung($_SESSION['veranst_ID'])."</li>
							<li>Tag: ".$this->getTag($_SESSION['tagID_aenderung'])."</li>
							<li>Stundenzeit: ".$this->getStundenzeit($_SESSION['stdZeitID_aenderung'])."</li>
							<li>Raum: ".$_SESSION['raumBez_aenderung']."</li>
						</ul>";
			
			Session::add('response_positive', $meldung);
		}
		catch (PDOException $e)
		{
			Session::add('response_negative', 'Es ist ein Fehler aufgetreten!'.$e);
			$db -> rollback();
		}
	}
	
	//liefert die Bezeichnung eines Studiengangs:
	private function getVeranstaltung($veranst_ID)
	{
		$query = "SELECT veranst_bezeichnung FROM Veranstaltung WHERE veranst_ID = $veranst_ID";
		
		//holt die Veranstaltungs-Bezeichnung:
        $veranst_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $veranst_bezeichnung['veranst_bezeichnung'];
	}
	
	//liefert den Tag:
	private function getTag($tag_ID)
	{
		$query = "SELECT tag_bezeichnung FROM Wochentag WHERE tag_ID = $tag_ID";
		
		//holt die Tag-Bezeichnung:
        $tag_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $tag_bezeichnung['tag_bezeichnung'];
	}
	
	//liefert die Stundenzeit:
	private function getStundenzeit($stdZeit_ID)
	{
		$query = "SELECT stdZeit_von, stdZeit_bis FROM Stundenzeit WHERE stdZeit_ID = $stdZeit_ID";
		
		//holt stdZeit_von und stdZeit_bis:
        $stundenzeit = $this->abfrage($query)->fetch_assoc();
		
		return $stundenzeit['stdZeit_von']." - ".$stundenzeit['stdZeit_bis'];
	}
	
	//gibt ein Resultset zurück:
	private function abfrage($query) 
	{
        //Datenbankverbindung
        $db = new DatabaseFactoryMysql();
		
		$stmt   = $db->prepare($query); 
		$stmt -> execute(); 
			
		$resultSet = $stmt -> get_result();
        return $resultSet;
    }
}

?>