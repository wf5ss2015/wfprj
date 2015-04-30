<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 1
*/

/**
 * @author Kilian Kraus
 * Unsere Session Klasse. Damit kann eine Session erstellt bzw geschlossen werden, Session-Variablen gesetzt und ausgelesen werden. 
 */
class Session
{
    /**
     * Initialisiert eine Session.
     */
    public static function init()
    {
        if (session_id() == null) {
            session_start();
        }
    }

    /**
     * @author Kilian Kraus
     *
     * @param mixed $key Schlüssel
     * @param mixed $value Wert
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @author Kilian Kraus
     *
     * @param mixed $key Schlüssel
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

	 /**
     * @author Kilian Kraus
     * Fügt einem Schlüssel einen Wert hinzu
	 *
     * @param mixed $key Schlüssel
	 * @param mixed $value Wert
     */
    public static function add($key, $value)
    {
        $_SESSION[$key][] = $value;
    }

    /**
	 * @author Kilian Kraus
     * Schließt die Session
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * @author Kilian Kraus
	 * Überprüft ob der User eingeloggt ist
     *
     * @return bool true=eingeloggt false=nicht eingeloggt
     */
    public static function userIsLoggedIn()
    {
        if(Session::get('user_logged_in')){
        return true;
		}else{
		return false;
		}
    }
	
}
