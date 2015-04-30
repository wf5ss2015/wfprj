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
 * Das ist der Basis Controller. 
 */
class Controller
{
    /** @var View Variable für ein Objekt der View */
    public $View;

    /**
	 * Erstellt den Basis Controller (Konstruktor)
     */
    function __construct()
    {
        // Session erstellen
        Session::init();

        // Erstellt ein View Objekt
        $this->View = new View();
    }
}
