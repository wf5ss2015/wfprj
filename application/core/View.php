<?php
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 5.0
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 Task: core/view.php anpassen
 ===============================================*/
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.1
*/


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
		if(Session::userIsLoggedIn()&&Session::get('user_role')=="student"){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerStudent.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls mitarbeiter
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')=="employee"){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerEmployee.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls dozent
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')=="docent"){
			// lädt den header
			require Config::get('PATH_VIEW') . '_templates/headerDocent.php';
			// lädt den content
			require Config::get('PATH_VIEW') . $filename . '.php';
			// lädt den footer
			require Config::get('PATH_VIEW') . '_templates/footer.php';
			
		}
		//falls tutor
		elseif(Session::userIsLoggedIn()&&Session::get('user_role')=="tutor"){
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
	
	/**
     * SPRINT3
     */
    public function renderResponse()
    {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require Config::get('PATH_VIEW') . '_templates/response.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('response_positive', null);
        Session::set('response_negative', null);
		Session::set('response_warning', null);
    }
	

	
	
 
}
