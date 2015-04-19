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
	 // ACHTUNG. BLEIBT AUF HS-SERVER HIER HÄNGEN WENN MAN SICH MIT EINEM BESTEHENDEN USERNAME EINLOGGEN MÖCHTE. 
	 // Es werden Funktionen aus php 5.5 verwendet. Auf dem HS-Server ist jedoch 5.4, worin die Funtkionen noch nicht enthalten sind.
    public function login()
    {
        $login_successful = LoginModel::login(Request::post('user_name'), Request::post('user_password')
        );

        // falls Login fehlgeschlagen, dann wird nochmal der login aufgerufen.
        if ($login_successful==1) {
			if(Session::get('user_role')=="employee"){
			Redirect::to('login/helloEmployee');
			}elseif (Session::get('user_role')=="student"){
			Redirect::to('login/helloStudent');
			}elseif (Session::get('user_role')=="docent"){
			Redirect::to('login/helloDocent');
			}elseif (Session::get('user_role')=="tutor"){
			Redirect::to('login/helloTutor');
			}else{
			Redirect::to('login/index'); 
			}
        } else {
            Redirect::to('login/index'); 
        }
    }
	
	 /**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem erfolgreichen Login
     */
    public function helloEmployee()
    {
		Auth::checkAuthenticationEmployee();
		$this->View->render('login/loggedinEmployee', array(
            'userlist' => UserModel::getUserDataAll())
		);
    }
	
	/**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem erfolgreichen Login
     */
    public function helloStudent()
    {
		Auth::checkAuthenticationStudent();
		$this->View->render('login/loggedinStudent', array(
            'userlist' => UserModel::getUserDataAll())
		);
    }
	
		 /**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem erfolgreichen Login
     */
    public function helloTutor()
    {
		Auth::checkAuthenticationTutor();
		$this->View->render('login/loggedinTutor', array(
            'userlist' => UserModel::getUserDataAll())
		);
    }
	
		 /**
     * @author Kilian Kraus
	 * Zeigt eine einfache Seite an nach dem erfolgreichen Login
     */
    public function helloDocent()
    {
		Auth::checkAuthenticationDocent();
		$this->View->render('login/loggedinDocent', array(
            'userlist' => UserModel::getUserDataAll())
		);
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
