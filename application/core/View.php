<?php
/*===============================================
 Sprint: 3
 @author: Kilian Kraus
 Datum: 25.04.2015
 Zeitaufwand (in Stunden): 0.5
 User Story Nr.: 
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 Task: response in core/view.php integrieren 
 ===============================================*/
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 1.5
 User Story Nr.: 270
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 Task: core/view.php anpassen
 ===============================================*/
 /*===============================================
 Sprint: 1
 @author: Kilian Kraus
 Datum: 08.04.2015
 Zeitaufwand (in Stunden): 0.1
 User Story Nr.: 140
 User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 Task: xxx
 ===============================================*/



/**
 * @author Kilian Kraus
 * Diese Klasse ist für den Output da.
 * view->render('Ordnername/Dateiname')
 */
class View
{
    public function render($filename, $data = null)
    {

		if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
/*===============================================
 Start Sprint: 2
 @author: Kilian Kraus
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 ===============================================*/		
		//falls student
		if(Session::userIsLoggedIn()&&Session::get('user_role')==1){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerStudent.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls mitarbeiter
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')==3){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerEmployee.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls dozent
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')==2){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerDocent.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls tutor
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')==4){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerTutor.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
		}else{
/*===============================================
 Ende Sprint: 2
 @author: Kilian Kraus
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 ===============================================*/
		// lädt den header
        require Config::get('PATH_VIEW') . '_templates/header.php';
		// lädt den content
        require Config::get('PATH_VIEW') . $filename . '.php';
		// lädt den footer
        require Config::get('PATH_VIEW') . '_templates/footer.php';
		}
    }
	
/*===============================================
 Start Sprint: 3
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 ===============================================*/	
 
	/**
	* @author Kilian Kraus
	* rendert eine Response Message
	*/
    public function renderResponse()
    {
        require Config::get('PATH_VIEW') . '_templates/response.php';
        // setzt die Response auf Null, damit sie nicht zweimal angezeigt wird.
        Session::set('response_positive', null);
        Session::set('response_negative', null);
		Session::set('response_warning', null);
    }
/*===============================================
 Ende Sprint: 3
 @author: Kilian Kraus
 User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 ===============================================*/	

	
	
 
}
