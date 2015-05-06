<?php



/**
 * @author Alexander Mayer
 * Model für Raumplan-Anzeige
 */
class raumplanModel 
{
    /**
     * @author Kilian Kraus
     *
     * @param $user_name string Nutzername
     *
     */

    //gibt ein array zurück mit allen vorhandenen Vorlesungsräumen
    public function getVorlesungsraeume() 
	{
		$query = "SELECT raum_bezeichnung FROM Vorlesungsraum";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $vorlesungsraeume = $this->abfrage($query);
		
		return $vorlesungsraeume;
	}
	
	//gibt ein array zurück mit allen vorhandenen Laborräumen
    public function getLaborraeume() 
	{
		$query = "SELECT lr.raum_bezeichnung, la.lArt_bezeichnung 
					   FROM Laborraum lr JOIN Laborart la ON (lr.lArt_ID = la.lArt_ID)";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $laborraeume = $this->abfrage($query);
		
		return $laborraeume;
	}
	
	public function getVeranstaltungstermine($raum_bezeichnung)
	{
		$query = "SELECT vt.tag_ID, vt.stdZeit_ID, v.veranst_bezeichnung 
							FROM Veranstaltungstermin vt JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
							WHERE vt.raum_bezeichnung = '$raum_bezeichnung' 
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		return $veranstaltungstermine;
	}
	
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