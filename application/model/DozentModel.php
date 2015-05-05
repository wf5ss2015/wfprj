<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 90a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
* Zeit: 6
*/

/**
 * @author Damian Wysocki
 *
 * Beschreibung: Model Klasse um die Datenbankabfrage auszuführen
 *
 */

class DozentModel
{
	// Funktion die anhand der veranst_ID alle Teilnehmer ausliest
    public static function getTeilnehmer($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
		
		// Jeder angelegte User sollte eine hinterlegte Email Adresse haben, da sonst nicht angezeigt
		// Pivot-Funktion in MySQL nicht verfügbar
        $sql = "SELECT  ubv.nutzer_name AS Nutzername, e.email_name AS Email,
				coalesce(MAX(case when w.eigenschaft_ID = 2 then w.inhalt end), 0) as Matrikel,
				coalesce(MAX(case when w.eigenschaft_ID = 3 then w.inhalt end), 0) as Vorname,
				coalesce(MAX(case when w.eigenschaft_ID = 4 then w.inhalt end), 0) as Nachname,
				coalesce(MAX(case when w.eigenschaft_ID = 7 then w.inhalt end), 0) as Telefonnummer,
				coalesce(MAX(case when w.eigenschaft_ID = 10 then w.inhalt end), 0) as Studiengang
				FROM wert w
				JOIN nutzer u
				ON u.nutzer_name = w.nutzer_name
				JOIN email e
				ON e.nutzer_name = w.nutzer_name
				JOIN user_beteiligtAn_veranstaltung ubv
				ON ubv.nutzer_name = w.nutzer_name
				JOIN veranstaltung v
				ON ubv.veranst_ID = v.veranst_ID
				WHERE ubv.veranst_ID = :id
				GROUP BY w.nutzer_name ASC;";
        
		/* Tabellenstruktur
		---- |Nutzername|Email|Matrikel|Vorname|Nachname|Telefonnummer|Studiengang|
		*/
		
		$query = $database->prepare($sql);

        $query->execute(array(':id' => $id));

        return $query->fetchAll();
    }
			
	// Funktion um die aktuell ausgewählte Veranstaltung anzuzeigen
    /*public static function getSelectedVorlesung($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
		
		
		
		
		$query = $database->prepare($sql);

        $query->execute(array(':id' => $id));

        return $query->fetchAll();
    }		
			*/
	// Funktion, die anhand des Nutzernamens des Dozenten die zugehörigen Vorlesungen ausliest
	public static function getVorlesung()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
		
		$user_name = Session::get('user_name');
		
		$sql = "SELECT nutzer_name, User_beteiligtAn_Veranstaltung.veranst_ID as veranst_ID, veranst_bezeichnung 
				FROM  User_beteiligtAn_Veranstaltung 
				JOIN Veranstaltung 
				ON User_beteiligtAn_Veranstaltung.veranst_ID = Veranstaltung.veranst_ID 
				WHERE nutzer_name = :user_name ORDER BY veranst_bezeichnung ASC";
		
		$result = $database->prepare($sql);
        
		$result->execute(array(':user_name' => $user_name));
		
		return $result->fetchAll();
		
    }
}
