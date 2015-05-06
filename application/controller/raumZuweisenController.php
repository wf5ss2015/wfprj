<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 340): Als Entwickler m�chte ich im MVC-Pattern programmieren k�nnen.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: Controller erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden	
	
	//////////////////////////////////////////////////
-->		

<?php

session_start(); //Aufruf notwendig, um Session-Variablen registrieren zu k�nnen


class raumZuweisenController extends Controller
{
    //Controller zur Ablaufsteuerung, um einen Raum einer Veranstaltung zuweisen zu k�nnen
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	
	//erzeugt Formular zur Auswahl von Veranstaltung, Wochentag und Stundenzeit:
	public function erzeugeFormular1() 
	{
		//neues Model-Objekt f�r Datenfluss erstellen:
        $rzModel = new raumZuweisenModel();

        //Daten aus DB holen:
        $veranstaltungen = $rzModel->getVeranstaltungen();
		$wochentage = $rzModel->getWochentage();
		$stundenZeiten = $rzModel->getStundenzeiten();
		
		/* 	rendert die Seite und gibt die geholten Daten mit 3 Subarrays an den View weiter,
			um dort dem Nutzer die Auswahl f�r Veranstaltung, Wochentag und Stundenzeit zu
			erm�glichen
		*/
        $this->View->render('raumZuweisung/formular1', array('veranstaltungen' => $veranstaltungen,
                                                               'wochentage' => $wochentage, 
                                                               'stundenZeiten' => $stundenZeiten));
    }
	
	
	//erzeugt Formular zur Auswahl eines verf�gbaren Raumes:
	public function erzeugeFormular2() 
	{
		if(isset($_POST['send']) && $_POST['send'] == utf8_encode('zeige R�ume')) 
		{
			//Formularverarbeitung:
			$veranst_ID = $_POST['waehleVeranstaltung'];
			$tag_ID = $_POST['waehleWochentag'];
			$stdZeit_ID = $_POST['waehleZeit'];
			
			//Eingabe-Werte f�r Veranstaltung, Tag und Zeit werden in Session-Variablen gespeichert:
			$_SESSION['veranst_ID'] = $veranst_ID;
			$_SESSION['tag_ID'] = $tag_ID;
			$_SESSION['stdZeit_ID'] = $stdZeit_ID;
			
			//neues Model-Objekt f�r Datenfluss erstellen:
			$rzModel = new raumZuweisenModel();

			//Daten aus DB holen:
			$verfuegbareVorlesungsraeume = $rzModel->getVerfuegbareVorlesungsraeume($veranst_ID, $tag_ID, $stdZeit_ID);
			$verfuegbareLaborraeume = $rzModel->getVerfuegbareLaborraeume($veranst_ID, $tag_ID, $stdZeit_ID);
			
		
			/* 	rendert die Seite und gibt die geholten Daten mit 2 Subarrays an den View weiter,
				um dort dem Nutzer die Auswahl eines verf�gbaren Raumes zu erm�glichen
			*/
			$this->View->render('raumZuweisung/formular2', array('verfuegbareVorlesungsraeume' => $verfuegbareVorlesungsraeume,
																	'verfuegbareLaborraeume' => $verfuegbareLaborraeume));
		}
	}
	
	/*	legt entsprechend der eingelesenen Daten einen neuen Veranstaltungstermin in der Tabelle
		Veranstaltungstermin an
	*/
	public function anlegen_veranstaltungstermin()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'Raum zuweisen')
		{
			//alle aus den 2 Formularen eingelesenen Daten:
			$raum_bezeichnung = $_POST['waehleRaum'];
			$veranst_ID = $_SESSION['veranst_ID'];
			$tag_ID = $_SESSION['tag_ID'];
			$stdZeit_ID = $_SESSION['stdZeit_ID'];
			
			//neues Model-Objekt f�r Datenfluss erstellen:
			$rzModel = new raumZuweisenModel();
			
			//Veranstaltungstermin anlegen:
			$rzModel->veranstaltungsterminAnlegen($raum_bezeichnung, $veranst_ID, $tag_ID, $stdZeit_ID);
			
			/* 	rendert die Seite und gibt im View ausgabe.php ggf eine Best�tigung der Erstellung eines 
				neuen Veranstaltungstermin aus
			*/
			$this->View->render('raumZuweisung/ausgabe');
		}
	}
}