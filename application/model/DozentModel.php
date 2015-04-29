<?php

class DozentModel
{

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
