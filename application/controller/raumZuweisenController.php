<?php

session_start(); //Aufruf notwendig, um Session-Variablen registrieren zu können


class raumZuweisenController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();	
    }
	
	
     //Formular für Parameter
	 public function erzeugeFormular1() 
	 {
	
		//Daten übers Model holen, dann im View eine Methode mit ÜP zum Anzeigen
        $rzModel = new raumZuweisenModel();

        //Daten aus DB holen:
        $veranstaltungen = $rzModel->getVeranstaltungen();
		$wochentage = $rzModel->getWochentage();
		$stundenZeiten = $rzModel->getStundenzeiten();
		
		/* 	rendert die Seite
			bekommt ein Array mit drei Subarrays übergeben, jeweils eins 
			für die Veranstaltungen, für die Wochentage und die Stundenzeiten
		*/
        $this->View->render('raumZuweisung/formular1', array('veranstaltungen' => $veranstaltungen,
                                                               'wochentage' => $wochentage, 
                                                               'stundenZeiten' => $stundenZeiten));
    }
	
	
	//Formular für Raumauswahl
	public function erzeugeFormular2() 
	{
		if(isset($_POST['send']) && $_POST['send'] == utf8_encode('zeige Räume')) 
		{
			$veranst_ID = $_POST['waehleVeranstaltung'];
			$tag_ID = $_POST['waehleWochentag'];
			$stdZeit_ID = $_POST['waehleZeit'];
			
			//Eingabe-Werte für Veranstaltung, Tag und Zeit werden in Session-Variablen gespeichert:
			$_SESSION['veranst_ID'] = $veranst_ID;
			$_SESSION['tag_ID'] = $tag_ID;
			$_SESSION['stdZeit_ID'] = $stdZeit_ID;
			
			
			//Daten übers Model holen, dann im View eine Methode mit ÜP zum Anzeigen
			$rzModel = new raumZuweisenModel();

			//Daten aus DB holen:
			$verfuegbareVorlesungsraeume = $rzModel->getVerfuegbareVorlesungsraeume($veranst_ID, $tag_ID, $stdZeit_ID);
			$verfuegbareLaborraeume = $rzModel->getVerfuegbareLaborraeume($veranst_ID, $tag_ID, $stdZeit_ID);
			
		
			/* 	rendert die Seite,
				bekommt ein Array mit allen verfügbaren Räumen übergeben
			*/
			$this->View->render('raumZuweisung/formular2', array('verfuegbareVorlesungsraeume' => $verfuegbareVorlesungsraeume,
																	'verfuegbareLaborraeume' => $verfuegbareLaborraeume));
		
		}
	}
	
	public function anlegen_veranstaltungstermin()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'Raum zuweisen')
		{
			$raum_bezeichnung = $_POST['waehleRaum'];
			$veranst_ID = $_SESSION['veranst_ID'];
			$tag_ID = $_SESSION['tag_ID'];
			$stdZeit_ID = $_SESSION['stdZeit_ID'];
			
			//neues model anlegen:
			$rzModel = new raumZuweisenModel();
			
			//Veranstaltungstermin anlegen:
			$rzModel->veranstaltungsterminAnlegen($raum_bezeichnung, $veranst_ID, $tag_ID, $stdZeit_ID);
			
			$this->View->render('raumZuweisung/ausgabe');
		}
	}
}