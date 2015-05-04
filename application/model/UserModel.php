<?php
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 4.5
 User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 Task: zusätzlich zu PDO verbindung noch MySQLi hinzufügen 
 ===============================================*/
 /*===============================================
 Sprint: 1
 @author: Kilian Kraus
 Datum: 08.04.2015
 Zeitaufwand (in Stunden): 0.5
 User Story Nr.: 140
 User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 Task: xxx
 ===============================================*/

/**
 * @author Kilian Kraus
 * Model für den Nutzer. In diesem fall nur um Nutzerdaten anhand des Nutzernames zu bekommen.
 */
class UserModel
{
    /**
     * @author Kilian Kraus
     *
     * @param $user_name string Nutzername
     *
     * @return mixed Gibts false zurück, wenn Nutzer nicht besteht. Ansonsten Objekt mit den Nutzerdaten zurück.
     */
    public static function getUserData($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

       $sql = "SELECT nutzer_name, passwortHash, rolle_ID               
                 FROM nutzer
                 WHERE (nutzer_name = :user_name)   
                 LIMIT 1";
        $query = $database->prepare($sql);

        $query->execute(array(':user_name' => $user_name));

        return $query->fetch();
    }
	
/*===============================================
 Start Sprint: 2
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 ===============================================*/
	/* //Beispiel für PDO
	public static function getUserDataAll()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM user";
        $query = $database->prepare($sql);

        $query->execute();
		
        return $query->fetchAll();
    }
	*/
	
	/* Erweiterung um Nutzerdaten von allen usern zu bekommen.
	   autor: Kris Klamser 
	   datum: 4.5.2015
	   START
	*/
	public static function getUserDataAll(){
       $database = new DatabaseFactoryMysql();
		
		$sql = "SELECT * FROM nutzer";
		
		$result = $database->query($sql);
		return $result;
    }
	/* ENDE Änderungen Klamser */
	
	// dummy
	public static function getUserDataAll2()
    {
        $database = new DatabaseFactoryMysql();
		
		$sql = "SELECT nutzer_name FROM nutzer";
		
		$result = $database->query($sql);
		return $result;
		
    }
	
	// dummy
	public static function getUserDataAll3()
    {
        $database = new DatabaseFactoryMysql();
		
		$sql = "SELECT nutzer_name, passwortHash  FROM nutzer";
		
		$result = $database->query($sql);
		return $result;
		
    }
/*===============================================
 Ende Sprint: 2
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 ===============================================*/

}
