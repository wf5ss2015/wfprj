<?php
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
		// lädt den header
        require Config::get('PATH_VIEW') . '_templates/header.php';
		// lädt den content
        require Config::get('PATH_VIEW') . $filename . '.php';
		// lädt den footer
        require Config::get('PATH_VIEW') . '_templates/footer.php';
    }
 
}
