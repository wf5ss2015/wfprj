<?php
/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				09.06.2015
	
	- User Story (Nr. 530):	Als Mitarbeiter möchte ich einen Veranstaltungstermin löschen können.
	- User Story Punkte:	5
	- Task:					
	- Zeitaufwand:			
	
	//////////
*/
?>	

<?php

class veranstaltungsterminLoeschenModel
{
	//liefert die ID einer Veranstaltung:
	public function getVeranstID($veranst_bezeichnung)
	{
		$query = "SELECT veranst_ID FROM Veranstaltung WHERE veranst_bezeichnung = '$veranst_bezeichnung';";
		
		//holt die Veranstaltungs-ID:
        $veranst_ID = $this->abfrage($query)->fetch_assoc();
		
		return $veranst_ID['veranst_ID'];
	}
	
	//liefert die ID einer Stundenzeit:
	public function getStundenzeitID($stdZeit_von, $stdZeit_bis)
	{
		$query = "SELECT stdZeit_ID FROM Stundenzeit WHERE stdZeit_von = '$stdZeit_von' AND stdZeit_bis = '$stdZeit_bis';";
		
		//holt die Stundenzeit-ID:
        $stdZeit_ID = $this->abfrage($query)->fetch_assoc();
		
		return $stdZeit_ID['stdZeit_ID'];
	}
	
	//liefert die ID eines Tages:
	public function getTagID($tag_bezeichnung)
	{
		$query = "SELECT tag_ID FROM Wochentag WHERE tag_bezeichnung = '$tag_bezeichnung';";
		
		//holt die Tag-ID:
        $tag_ID = $this->abfrage($query)->fetch_assoc();
		
		return $tag_ID['tag_ID'];
	}
	
	//gibt ein array zurück mit allen Veranstaltungsterminen:
	public function getAlleVeranstaltungstermine()
	{
		/*	ORDER BY: 
		*/
		$query = "SELECT wt.tag_bezeichnung, sz.stdZeit_von, sz.stdZeit_bis, vt.raum_bezeichnung, v.veranst_bezeichnung, shv.pflicht_im_Semester, stg.stg_bezeichnung
							FROM Veranstaltungstermin vt JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Stundenzeit sz ON (vt.stdZeit_ID = sz.stdZeit_ID)
								JOIN Wochentag wt ON (vt.tag_ID = wt.tag_ID)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
								JOIN Studiengang stg ON (shv.stg_ID = stg.stg_ID)
							ORDER BY stg.stg_bezeichnung, shv.pflicht_im_Semester, vt.tag_ID, vt.stdZeit_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		$array = array();
		
		foreach($veranstaltungstermine as $vt)
		{
			$result = array (
			"Studiengang" => $vt['stg_bezeichnung']." ".$vt['pflicht_im_Semester'],
			"Tag" => $vt['tag_bezeichnung'],
			"Zeit" => $vt['stdZeit_von']." - ".$vt['stdZeit_bis'],
			"Veranstaltung" => $vt['veranst_bezeichnung'],
			"Raum" => $vt['raum_bezeichnung']
			);
			
			$array[] = $result;
		}
		
		return $array;
	}
	
	public function loescheVeranstaltungstermin($veranst_ID, $tag_ID, $stdZeit_ID)
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
			Session::add('response_positive', utf8_encode('Veranstaltungstermin wurde gelöscht!'));
		}
		catch (PDOException $e)
		{
			Session::add('response_negative', 'Es ist ein Fehler aufgetreten!'.$e);
			$db -> rollback();
		}
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