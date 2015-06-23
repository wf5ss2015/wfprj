<?php
/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				09.06.2015
	
	- User Story (Nr. 530):	Als Mitarbeiter möchte ich einen Veranstaltungstermin löschen können.
	- User Story Punkte:	5
	- Task:					
	- Zeitaufwand:			
	
	//////////
*/
?>	

<?php

class veranstaltungsterminLoeschenController extends Controller
{
	//Controller zur Ablaufsteuerung zum Löschen von Veranstaltungsterminen
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	//erzeugt Tabelle mit Veranstaltungsterminen als Zeileneinträge
	public function erzeugeTabelle()
	{
		//neues Model-Objekt für Datenfluss erstellen:
        $vTerminLoeschenModel = new veranstaltungsterminLoeschenModel();

        //Daten aus DB holen:
		$veranstaltungstermine = $vTerminLoeschenModel->getAlleVeranstaltungstermine();
		
		/* 	rendert die Seite und gibt die geholten Daten an den View weiter,
			um dort dem Nutzer die Auswahl der zu löschenden Veranstaltungstermine zu ermöglichen
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
		
		
		//neue Model-Objekte für Datenfluss erstellen:
		$vTerminLoeschenModel = new veranstaltungsterminLoeschenModel();
		
		$veranst_ID = $vTerminLoeschenModel->getVeranstID($veranst_bezeichnung);
		$tag_ID = $vTerminLoeschenModel->getTagID($tag_bezeichnung);
		$stdZeit_ID = $vTerminLoeschenModel->getStundenzeitID($stdZeit_von, $stdZeit_bis);
		
		$vTerminLoeschenModel->loescheVeranstaltungstermin($veranst_ID, $tag_ID, $stdZeit_ID);

		$this->erzeugeTabelle();
	}
}