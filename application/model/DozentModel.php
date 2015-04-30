<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 90 ): Als Dozent möchte ich Teilnehmerlisten erzeugen können (Nacharbeit). (13 Points)
* Zeit: 1
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

        $sql = "SELECT user_name, veranst_bezeichnung
                FROM User_beteiligtAn_Veranstaltung 
				JOIN Veranstaltung
				ON User_beteiligtAn_Veranstaltung.veranst_ID = Veranstaltung.veranst_ID
                WHERE (User_beteiligtAn_Veranstaltung.veranst_ID = :id)";
        
		$query = $database->prepare($sql);

        $query->execute(array(':id' => $id));

        return $query->fetchAll();
    }
	
	
	// Funktion, die anhand des user names des Dozenten die zugehörigen Vorlesungen ausliest
	public static function getVorlesung()
    {
        $database = DatabaseFactory::getFactory()->getConnection();
		
		$user_name = Session::get('user_name');
		
		$sql = "SELECT user_name, User_beteiligtAn_Veranstaltung.veranst_ID as veranst_ID, veranst_bezeichnung 
				FROM  User_beteiligtAn_Veranstaltung 
				JOIN Veranstaltung 
				ON User_beteiligtAn_Veranstaltung.veranst_ID = Veranstaltung.veranst_ID 
				WHERE user_name = :user_name ORDER BY veranst_bezeichnung ASC";
		
		$result = $database->prepare($sql);
        
		$result->execute(array(':user_name' => $user_name));
		
		return $result->fetchAll();
		
    }
}
