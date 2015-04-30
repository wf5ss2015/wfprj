<?php
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 5.0
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 Task: core/auth.php anpassen
 ===============================================*/
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
 * Sollte am Anfang eines Controllers bzw Funktion im Controller verwendet werden, wenn diese nur für eingeloggte Nutzer sichtbar sein sollte.
 */
class Auth
{
/*===============================================
 Start Sprint: 2
 @author: Kilian Kraus
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 ===============================================*/
	/**
	* @author Kilian Kraus
	* Überprüft ob ein Student eingeloggt ist und die entsprechnede Rolle besitzt, ansonsten wird er zur Login-Seite verlinkt und die Session zerstört.
	* Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
	*/
    public static function checkAuthenticationStudent()
    {
        // Initialisiert eine Session.
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
	/**
	* @author Kilian Kraus
	* Überprüft ob ein Dozent eingeloggt ist und die entsprechnede Rolle besitzt, ansonsten wird er zur Login-Seite verlinkt und die Session zerstört.
	* Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
	*/
	public static function checkAuthenticationDocent()
    {
        // Initialisiert eine Session.
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
	/**
	* @author Kilian Kraus
	* Überprüft ob ein Tutor eingeloggt ist und die entsprechnede Rolle besitzt, ansonsten wird er zur Login-Seite verlinkt und die Session zerstört.
	* Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
	*/
	public static function checkAuthenticationTutor()
    {
        // Initialisiert eine Session.
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
	/**
	* @author Kilian Kraus
	* Überprüft ob ein Mitarbeiter eingeloggt ist und die entsprechnede Rolle besitzt, ansonsten wird er zur Login-Seite verlinkt und die Session zerstört.
	* Sollte am Anfang eines Controllers verwendet werden, wenn dieser nur für eingeloggte Nutzer sichtbar sein sollte.
	*/
	public static function checkAuthenticationEmployee()
    {
        // Initialisiert eine Session
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
/*===============================================
 Ende Sprint: 2
 @author: Kilian Kraus
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 ===============================================*/	
}
