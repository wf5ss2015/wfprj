<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 1.5
*/

/**
 * @author Kilian Kraus
 * Das LoginModel stellt Funktionen für den Loginvorgang bereit.
 */

class LoginModel
{
    /**
     * @author Kilian Kraus
	 * Model für den Login
	 *
     * @param $user_name string Nutzername
     * @param $user_password string Passwort
     *
     * @return bool Status des Login
     */
    public static function login($user_name, $user_password)
    {
        // falls Nutzername oder Passwort leer sind
        if (empty($user_name) OR empty($user_password)) {
            return false;
        }

	    // falls Benutzer nicht in der DB besteht bzw. Passwort nicht stimmt.
	    $result = self::validateAndGetUser($user_name, $user_password);

	    if (!$result) {
		    return false;
	    }

        // setzt Timestamp des letzten Login 
        self::saveTimestamp($result->user_name);

        // falls Nutzer erfolgreich eingeloggt ist, dann werden notwendige Parameter in die Session Variablen geschrieben
		// Loggt Nutzer final ein
        self::doLogin(
            $result->user_id, $result->user_name, $result->user_role
        );

		// gibt letztendlich true zurück für erfolgreichen login
        return true;
    }

	/**
	 * @author Kilian Kraus
	 * Überpüft ob der Login erfolgreich war.
	 *
	 * @param $user_name
	 * @param $user_password
	 *
	 * @return bool mixed
	 */
	private static function validateAndGetUser($user_name, $user_password)
	{
		// holt sich die Daten des Nutzers
		$result = UserModel::getUserData($user_name);

		// Überprüft ob der Nutzer besteht.
		if (!$result) {
			return false;
		}

		// sprint02 start
		$match = password_verify($user_password, $result->user_password_hash);
		// sprint02 ende
		// falls der in der Datenbank gespeicherte Hash nicht mit dem Hash des Passworts übereinstimmt.
		if ($match==null) { 
			return false;
		}

		return $result;
	}

    

    /**
     * @author Kilian Kraus
	 * Löscht Session
     */
    public static function logout()
    {
        Session::destroy();
    }

    /**
     * @author Kilian Kraus
	 * Diese Funktion macht den richtigen Login. Initialisiert die Session und schreibt Werte in die Session.
     *
     * @param $user_id
     * @param $user_name 
     * @param $user_role
     */
    public static function doLogin($user_id, $user_name, $user_role)
    {
        Session::init();
        Session::set('user_id', $user_id);
        Session::set('user_name', $user_name);
		Session::set('user_role', $user_role);
        Session::set('user_logged_in', true);
    }

    /**
     * @author Kilian Kraus
	 * Schreibt einen Timestamp des Login in die Datenbank.
     *
     * @param $user_name 
     */
    public static function saveTimestamp($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE user SET user_last_login_timestamp = :user_last_login_timestamp
                WHERE user_name = :user_name LIMIT 1";
        $sth = $database->prepare($sql);
        $sth->execute(array(':user_name' => $user_name, ':user_last_login_timestamp' => time()));
    }


    /**
     * @author Kilian Kraus
	 * gibt true zurück, falls Nutzer eingeloggt ist
     *
     * @return bool Status des Login
     */
    public static function isUserLoggedIn()
    {
        return Session::userIsLoggedIn();
    }
	
}
