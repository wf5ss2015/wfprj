<?php
/*===============================================
 Sprint: 3
 @author: Kilian Kraus
 Datum: 25.04.2015
 Zeitaufwand (in Stunden): 0.25
 User Story Nr.: 320
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 Task: Application.php anpassen, damit errorController geladen wird. 
 ===============================================*/
 /*===============================================
 Sprint: 1
 @author: Kilian Kraus
 Datum: 08.04.2015
 Zeitaufwand (in Stunden): 1.0
 User Story Nr.: 140
 User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 Task: xxx
 ===============================================*/


/**
 * @author Kilian Kraus
 * Dieses Ding startet die ganze Anwendung.
 */
 
 // Die ganzen require ließen sich mit dem Composer schöner handeln.
 // vorsicht. Casesensitive kann hier bei richtigen Servern Probleme machen.
 require '../application/core/Request.php';
 require '../application/core/Config.php';
 require '../application/core/Controller.php';
 require '../application/core/Session.php';
 require '../application/core/View.php';
 require '../application/core/Table.php';
 require '../application/model/LoginModel.php';
 require '../application/core/Redirect.php';
 require '../application/model/UserModel.php';
 require '../application/core/DatabaseFactory.php';
 require '../application/core/Auth.php';
 require '../application/lib/phppasswordlib/passwordLib.php';
 require '../application/core/DatabaseFactoryMysql.php';
 require '../application/model/raumAnlegenModel.php';
 require '../application/model/veranstaltungErweiternModel.php';
 require '../application/model/DozentModel.php';

//Roland Schmid
require '../application/model/VeranstaltungModel.php';

 
class Application
{
    /** @var mixed Instanzen des Controllers*/
    private $controller;

    /** @var string Controller Name, falls man in der View eine Abfrage machen möchte wo man ist. */
    private $controller_name;

    /** @var string Controller Methode, falls man in der View eine Abfrage machen möchte wo man ist. */
    private $action_name;

    /**
	 * @author Kilian Kraus
	 * Startet die Anwendung. 
     */
    public function __construct()
    {
        $this->split();

	    $this->createController();

        // überprüft ob controller besteht.
        if (file_exists(Config::get('PATH_CONTROLLER') . $this->controller_name . '.php')) {

            // lädt den pfad des Controller aus der Config und erstellt den Controller
            require Config::get('PATH_CONTROLLER') . $this->controller_name . '.php';
            $this->controller = new $this->controller_name();

            // überprüft, ob die Methode im entsprechenden Controller vorhanden ist.
            if (method_exists($this->controller, $this->action_name)) {
				$this->controller->{$this->action_name}();  
            } else {    
/*===============================================
 Start Sprint: 3
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 ===============================================*/		
				header('location:index.php?url=error');
            }
        } else {
			header('location:index.php?url=error');
		}
/*===============================================
 Ende Sprint: 3
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 ===============================================*/		      
    }

    /**
     * @author Kilian Kraus
	 * Macht Bananasplit aus URL
     */
    private function split()
    {
        if (Request::get('url')) {

            $url = trim(Request::get('url'), '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->controller_name = isset($url[0]) ? $url[0] : null;
            $this->action_name = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

        }
    }

	/**
	 * @author Kilian Kraus
	 * setzt den Controller auf den richtigen Namen. Default wenn nichts gefunden (index/index).
	 */
	private function createController()
	{
		// Default falls kein Controller
		if (!$this->controller_name) {
			$this->controller_name = Config::get('DEFAULT_CONTROLLER');
		}

		// Default falls keine Funktion/Ereignis gefunden
		if (!$this->action_name OR (strlen($this->action_name) == 0)) {
			$this->action_name = Config::get('DEFAULT_ACTION');
		}

		// Hängt and den Controllername "Controller" ran, da diese Files so heißen ("xxxController.php")
		$this->controller_name = ucwords($this->controller_name) . 'Controller';
	}
}
