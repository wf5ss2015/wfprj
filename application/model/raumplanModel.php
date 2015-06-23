<?php

/*	---------- SPRINT 3 ----------

	- Autor:				Alexander Mayer
	- Datum: 				06.05.2015
	
	- User Story (Nr. 290):	Als Mitarbeiter/Dozent/Student möchte ich mir Raumpläne anzeigen lassen können.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	- Task: Model erstellen
*/
?>

<?php	
class raumplanModel 
{

    //gibt ein array zurück mit allen vorhandenen Vorlesungsräumen
    public function getVorlesungsraeume() 
	{
		$query = "SELECT raum_bezeichnung 
					FROM Vorlesungsraum
					ORDER BY raum_bezeichnung;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $vorlesungsraeume = $this->abfrage($query);
		
		return $vorlesungsraeume;
	}
	
	
	//gibt ein array zurück mit allen vorhandenen Laborräumen
    public function getLaborraeume() 
	{
		$query = "SELECT lr.raum_bezeichnung, la.lArt_bezeichnung 
					   FROM Laborraum lr JOIN Laborart la ON (lr.lArt_ID = la.lArt_ID)
					   ORDER BY raum_bezeichnung;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $laborraeume = $this->abfrage($query);
		
		return $laborraeume;
	}
	
	
	//gibt ein array zurück mit allen Veranstaltungsterminen in einem bestimmten Raum:
	public function getVeranstaltungstermine($raum_bezeichnung)
	{
		/*	ORDER BY: die Datensätze werden sortiert nach Stundenzeit und Wochentag, sodass später beim
			Anlegen der Tabelle im View die Veranstaltungstermine Reihe für Reihe im Raumplan eingefügt werden
			können!
		*/
		$query = "SELECT vt.tag_ID, vt.stdZeit_ID, v.veranst_kurztext, n.nachname, stg.stg_kurztext, shv.pflicht_im_Semester
							FROM Veranstaltungstermin vt 
								JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
								JOIN Studiengang stg ON (shv.stg_ID = stg.stg_ID)
								LEFT JOIN Dozent doz ON (v.dozent_nutzer_name = doz.nutzer_name)
								LEFT JOIN Nutzer n ON (doz.nutzer_name = n.nutzer_name)
							WHERE vt.raum_bezeichnung = '$raum_bezeichnung' 
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		return $veranstaltungstermine;
	}
	
	
	//Funktion zur Datenabfrage, sodass nur an dieser Stelle die Verbindung zur DB hergestellt wird
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