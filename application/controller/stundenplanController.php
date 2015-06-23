<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student möchte ich mir meinen Stundenplan anzeigen können.
	- User Story Punkte:	13
	- Task:					Funktion stundenplan_individuell() im Controller erstellen.
	- Zeitaufwand:			1h
	
	//////////
	
	- User Story (Nr. 410):	Als Dozent/Student möchte ich mir einen Stundenplan für Fachsemester anzeigen können.
	- User Story Punkte:	13
	- Task:					Funktionen erzeugeFormular() und stundenplan_fachsemester() im Controller erstellen.
	- Zeitaufwand:			1h
*/
?>	

<?php

class stundenplanController extends Controller
{
	//Controller zur Ablaufsteuerung, um Stundenplan nach Fachsemester oder individuell für Student/Dozent anzuzeigen
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	//erzeugt Formular zur Auswahl des Studiengangs und Fachsemesters:
	public function erzeugeFormular()
	{
		//neues Model-Objekt für Datenfluss erstellen:
        $spModel = new stundenplanModel();

        //Daten aus DB holen:
		$studiengaenge = $spModel->getStudiengaenge();
		
		/* 	rendert die Seite und gibt die geholten Daten an den View weiter,
			um dort dem Nutzer die Auswahl eines Studiengangs und Fachsemesters zu ermöglichen
		*/
        $this->View->render('stundenplan/formular', array('studiengaenge' => $studiengaenge));
	}
	
	//erzeugt eine Tabelle, welche den Stundenplan nach Fachsemester anzeigt:
	public function stundenplan_fachsemester()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'zeige Stundenplan') 
		{
			if(empty($_POST['waehleStudiengang']) || empty($_POST['waehleFachsemester']))
			{
				Session::add('response_negative', utf8_encode('Für ein/mehrere Felder wurde keine Auswahl getroffen!'));
				$this->erzeugeFormular();
			}
			else
			{
				//Formularverarbeitung:
				$stg_ID = $_POST['waehleStudiengang'];
				$fachsemester = $_POST['waehleFachsemester'];
			
				//neue Model-Objekte für Datenfluss erstellen:
				$spModel = new stundenplanModel();
				$rzModel = new raumZuweisenModel();
			
				//Daten aus DB holen:
				$veranstaltungstermine = $spModel->getVeranstaltungstermine_fachsemester($stg_ID, $fachsemester);
				$stg_bezeichnung = $spModel->getStudiengang($stg_ID);
				$wochentage = $rzModel->getWochentage();
				$stundenZeiten = $rzModel->getStundenzeiten();
			
				/* 	rendert die Seiten ... und gibt die geholten Daten mit 5 Subarrays an den View weiter,
					um dort den Stundenplan als Tabelle aufzeichnen zu können
				*/
				$this->View->render('stundenplan/stundenplanFachsemester', 
															array('studiengang' => (String)$stg_bezeichnung,
																  'fachsemester' => $fachsemester,
																  'veranstaltungstermine' => $veranstaltungstermine,
																  'wochentage' => $wochentage,
																  'stundenzeiten' => $stundenZeiten));
			}
		}
	}
	
	//erzeugt eine Tabelle, welche einen individuellen Stundenplan gemäß des angemeldeten Students/Dozents anzeigt:
	public function stundenplan_individuell()
	{
		//neue Model-Objekte für Datenfluss erstellen:
		$spModel = new stundenplanModel();
		$rzModel = new raumZuweisenModel();
			
		//Daten aus DB holen:
		$veranstaltungstermine = $spModel->getVeranstaltungstermine_individuell(Session::get('user_name'), Session::get ( 'user_role' ));
		$wochentage = $rzModel->getWochentage();
		$stundenZeiten = $rzModel->getStundenzeiten();
			
		/* 	rendert die Seiten ... und gibt die geholten Daten mit 4 Subarrays an den View weiter,
			um dort den Stundenplan als Tabelle aufzeichnen zu können
		*/
		$this->View->render('stundenplan/stundenplanIndividuell', 
													array('nutzerName' => Session::get('user_name'),
														  'veranstaltungstermine' => $veranstaltungstermine,
														  'wochentage' => $wochentage,
														  'stundenzeiten' => $stundenZeiten));
	}
}