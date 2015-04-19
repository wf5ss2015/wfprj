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
 * Überprüft ob ein Nutzer eingeloggt ist, ansonsten wird er zur Login-Seite verlinkt.
 * Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
 */
class Auth
{
    public static function checkAuthenticationStudent()
    {
        // Initialisiert eine Session, falls noch keine Vorhanden ist.
        Session::init();

        // Falls Nutzer nicht eingeloggt ist.
        if (Session::userIsLoggedIn()&&Session::get('user_role')=="student") {
			return true;
        }
		else{
			Session::destroy();
            header('location: ' . "index.php?url=". 'login');
            exit();
		}
    }
	
	public static function checkAuthenticationDocent()
    {
        // Initialisiert eine Session, falls noch keine Vorhanden ist.
        Session::init();

        // Falls Nutzer nicht eingeloggt ist.
        if (Session::userIsLoggedIn()&&Session::get('user_role')=="docent") {
		return true;
        }
		else{
			Session::destroy();
            header('location: ' . "index.php?url=". 'login');
            exit();
		}
    }
	
	public static function checkAuthenticationTutor()
    {
        // Initialisiert eine Session, falls noch keine Vorhanden ist.
        Session::init();

        // Falls Nutzer nicht eingeloggt ist.
        if (Session::userIsLoggedIn()&&Session::get('user_role')=="tutor") {
		return true;
        }
		else{
			Session::destroy();
            header('location: ' . "index.php?url=". 'login');
            exit();
		}
		
    }
	
	public static function checkAuthenticationEmployee()
    {
        // Initialisiert eine Session, falls noch keine Vorhanden ist.
        Session::init();

        // Falls Nutzer nicht eingeloggt ist.
        if (Session::userIsLoggedIn()&&Session::get('user_role')=="employee") {
		return true;
        }
		else{
			Session::destroy();
            header('location: ' . "index.php?url=". 'login');
            exit();
		}
    }
	
}
