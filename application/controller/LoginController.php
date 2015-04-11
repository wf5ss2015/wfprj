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
?>

<?php

/**
 * @author Kilian Kraus
 * Das ist der Login Controller. Steuert den Login Prozess.
 */
class LoginController extends Controller
{
    /**
     * @author Kilian Kraus
	 * Erstellt ein Objekt des Controllers
     */
    public function __construct()
    {
        parent::__construct();	
    }

    /**
     * @author Kilian Kraus
	 * Rendert "login/index.php"
     */
    public function index()
    {
        $this->View->render('login/index');
    }

    /**
	 * @author Kilian Kraus
     * Funktion die den Login ausführt.
     */
    public function login()
    {
        $login_successful = LoginModel::login(Request::post('user_name'), Request::post('user_password')
        );

        // falls Login fehlgeschlagen, dann wird nochmal der login aufgerufen.
        if ($login_successful) {
            Redirect::to('login/hello');
        } else {
            Redirect::to('login/index');
        }
    }
	
	 /**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem erfolgreichen Login
     */
    public function hello()
    {
	    Auth::checkAuthentication();
		$this->View->render('login/loggedin');
    }

    /**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem Logout
     */
    public function logout()
    {
        LoginModel::logout();
		Redirect::to('login/index');
	}
  
}
