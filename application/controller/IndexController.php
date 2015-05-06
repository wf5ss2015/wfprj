<?php
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
 * Das ist der Index Controller. Steuert die Startseite.
 */
class IndexController extends Controller
{
    /**
     * @author Kilian Kraus
	 * Erstellt ein Objekt der "Controller"-Klasse.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @author Kilian Kraus
	 * Diese Funktion steuert was passiert, wennn jemand zu index/index aufruft
     */
    public function index()
    {
        $this->View->render('index/index');
    }
}
