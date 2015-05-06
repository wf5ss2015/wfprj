<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 90 ): Als Dozent möchte ich Teilnehmerlisten erzeugen können (Nacharbeit). (13 Points)
* Zeit: 0.5
*/

/**
 * @author Damian Wysocki
 *
 * Beschreibung: Controller um die Daten aus dem Model in der View zu steuern
 *
 */
 
class DozentController extends Controller
{

    public function __construct()
    {
        Auth::checkAuthenticationDocent();
		parent::__construct();	
		
    }
	
	// Funktion zur Auswahl der hinterlegten Vorlesungen eines Dozenten
    public function auswahlVorlesung()
    {
		$this->View->render('dozent/auswahlVorlesung', array(
            'vorlesung' => DozentModel::getVorlesung())
		);
    }
	
	// Funktion zum Aufruf der DozentModel-Klasse um Teilnehmer einer Vorlesung anzuzeigen
    public function teilnehmerListe()
    {
		$this->View->render('dozent/teilnehmerListe', array(
            'teilnehmer' => DozentModel::getTeilnehmer(Request::post('id')))
		);
    }  
}
