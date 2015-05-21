
<?php

/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 370):	Als Entwickler m�chte ich die Teile aus den vorigen Sprints nachbessern.
	- User Story Punkte:	8
	- Task:					Bei Raumplan-Anzeige Error-Handling betreiben.
	- Zeitaufwand:			2h			
	
	---------- SPRINT 3 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				06.05.2015
	
	- User Story (Nr. 290):	Als Mitarbeiter/Dozent/Student m�chte ich mir Raumpl�ne anzeigen lassen k�nnen.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	- Task: Controller erstellen
	
*/
?>

<?php
class raumplanController extends Controller
{
	//Controller zur Ablaufsteuerung, um R�ume anzeigen lassen zu k�nnen
    
    public function __construct()
    {
        parent::__construct();	
    }
	
	
     //erzeugt Formular zur Auswahl eines Raumes, von welchem der Raumplan angezeigt werden soll:
	 public function erzeugeFormular() 
	 {
		//neues Model-Objekt f�r Datenfluss erstellen:
        $rpModel = new raumplanModel();

        //Daten aus DB holen:
		$vorlesungsraeume = $rpModel->getVorlesungsraeume();
		$laborraeume = $rpModel->getLaborraeume();
		
		/* 	rendert die Seite und gibt die geholten Daten mit 2 Subarrays an den View weiter,
			um dort dem Nutzer die Auswahl eines Raumes zu erm�glichen
		*/
        $this->View->render('raumplan/formular', array('vorlesungsraeume' => $vorlesungsraeume, 'laborraeume' => $laborraeume));
	 }
	 
	 
	 //erzeugt eine Tabelle, welche den Raumplan darstellt:
	 public function raumplanAnzeigen()
	 {
		if(isset($_POST['send']) && $_POST['send'] == 'zeige Raumplan') 
		{
			if(empty($_POST['waehleRaum']))
			{
				Session::add('response_negative', utf8_encode('Es wurde kein Raum ausgew�hlt!'));
				$this->erzeugeFormular();
			}
			else
			{
				//Formularverarbeitung:
				$raum_bezeichnung = $_POST['waehleRaum'];
			
				//neue Model-Objekte f�r Datenfluss erstellen:
				$rpModel = new raumplanModel();
				$rzModel = new raumZuweisenModel();
			
				//Daten aus DB holen:
				$veranstaltungstermine = $rpModel->getVeranstaltungstermine($raum_bezeichnung);
				$wochentage = $rzModel->getWochentage();
				$stundenZeiten = $rzModel->getStundenzeiten();
			
				/* 	rendert die Seiten ... und gibt die geholten Daten mit 4 Subarrays an den View weiter,
					um dort den Raumplan als Tabelle aufzeichnen zu k�nnen
				*/
				$this->View->render('raumplan/ausgabe', array('raum' => $raum_bezeichnung,
															  'veranstaltungstermine' => $veranstaltungstermine,
															  'wochentage' => $wochentage,
															  'stundenzeiten' => $stundenZeiten));
			}
		}
	 } 
}
?>