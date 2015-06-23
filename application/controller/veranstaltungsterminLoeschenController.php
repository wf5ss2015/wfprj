<?php
/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				09.06.2015
	
	- User Story (Nr. 530):	Als Mitarbeiter m�chte ich einen Veranstaltungstermin l�schen k�nnen.
	- User Story Punkte:	5
	- Task:					
	- Zeitaufwand:			
	
	//////////
*/
?>	

<?php

class veranstaltungsterminLoeschenController extends Controller
{
	//Controller zur Ablaufsteuerung zum L�schen von Veranstaltungsterminen
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	//erzeugt Tabelle mit Veranstaltungsterminen als Zeileneintr�ge
	public function erzeugeTabelle()
	{
		//neues Model-Objekt f�r Datenfluss erstellen:
        $vTerminLoeschenModel = new veranstaltungsterminLoeschenModel();

        //Daten aus DB holen:
		$veranstaltungstermine = $vTerminLoeschenModel->getAlleVeranstaltungstermine();
		
		/* 	rendert die Seite und gibt die geholten Daten an den View weiter,
			um dort dem Nutzer die Auswahl der zu l�schenden Veranstaltungstermine zu erm�glichen
		*/
        $this->View->render('veranstaltungsterminLoeschen/tabelle', array('veranstaltungstermine' => $veranstaltungstermine));
	}
	
	
	public function loescheVeranstaltungstermin()
	{
		//Formularverarbeitung (hidden values):
		$veranst_bezeichnung = $_POST['Veranstaltung'];
		$tag_bezeichnung = $_POST['Tag'];
		$stdZeit = $_POST['Zeit'];
		
		$split = split("-", $stdZeit);
		$stdZeit_von = $split[0];
		$stdZeit_bis = $split[1];
		
		
		//neue Model-Objekte f�r Datenfluss erstellen:
		$vTerminLoeschenModel = new veranstaltungsterminLoeschenModel();
		
		$veranst_ID = $vTerminLoeschenModel->getVeranstID($veranst_bezeichnung);
		$tag_ID = $vTerminLoeschenModel->getTagID($tag_bezeichnung);
		$stdZeit_ID = $vTerminLoeschenModel->getStundenzeitID($stdZeit_von, $stdZeit_bis);
		
		$vTerminLoeschenModel->loescheVeranstaltungstermin($veranst_ID, $tag_ID, $stdZeit_ID);

		$this->erzeugeTabelle();
	}
}