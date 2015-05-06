<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 290):	Als Mitarbeiter/Dozent/Student möchte ich mir Raumpläne anzeigen lassen können.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	- Task: Controller erstellen
	
	//////////////////////////////////////////////////
-->		


<?php

class raumplanController extends Controller
{
	//Controller zur Ablaufsteuerung, um Räume anzeigen lassen zu können
    
    public function __construct()
    {
        parent::__construct();	
    }
	
	
     //erzeugt Formular zur Auswahl eines Raumes, von welchem der Raumplan angezeigt werden soll:
	 public function erzeugeFormular1() 
	 {
		//neues Model-Objekt für Datenfluss erstellen:
        $rpModel = new raumplanModel();

        //Daten aus DB holen:
		$vorlesungsraeume = $rpModel->getVorlesungsraeume();
		$laborraeume = $rpModel->getLaborraeume();
		
		/* 	rendert die Seite und gibt die geholten Daten mit 2 Subarrays an den View weiter,
			um dort dem Nutzer die Auswahl eines Raumes zu ermöglichen
		*/
        $this->View->render('raumplan/formular1', array('vorlesungsraeume' => $vorlesungsraeume, 'laborraeume' => $laborraeume));
	 }
	 
	 
	 //erzeugt eine Tabelle, welche den Raumplan darstellt:
	 public function raumplanAnzeigen()
	 {
		if(isset($_POST['send']) && $_POST['send'] == 'zeige Raumplan') 
		{
			//Formularverarbeitung:
			$raum_bezeichnung = $_POST['waehleRaum'];
			
			//neue Model-Objekte für Datenfluss erstellen:
			$rpModel = new raumplanModel();
			$rzModel = new raumZuweisenModel();
			
			//Daten aus DB holen:
			$veranstaltungstermine = $rpModel->getVeranstaltungstermine($raum_bezeichnung);
			$wochentage = $rzModel->getWochentage();
			$stundenZeiten = $rzModel->getStundenzeiten();
			
			/* 	rendert die Seite und gibt die geholten Daten mit 3 Subarrays an den View weiter,
				um dort den Raumplan als Tabelle aufzeichnen zu können
			*/
			$this->View->render('raumplan/ausgabe', array('veranstaltungstermine' => $veranstaltungstermine,
																	'wochentage' => $wochentage,
																	'stundenzeiten' => $stundenZeiten));
		}
	 } 
}
?>