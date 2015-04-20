<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.5
*/

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

       $sql = "SELECT user_name, user_email, user_password_hash, user_role               
                 FROM user
                 WHERE (user_name = :user_name)   
                 LIMIT 1";
        $query = $database->prepare($sql);

        $query->execute(array(':user_name' => $user_name));

        return $query->fetch();
    }
	

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
	
	// Beispiel für Mysqli
	public static function getUserDataAll()
    {
        $database = new DatabaseFactoryMysql();
		
		$sql = "SELECT * FROM user";
		
		$array = $database->query($sql);
		
		return $array;
		
    }
	

}
