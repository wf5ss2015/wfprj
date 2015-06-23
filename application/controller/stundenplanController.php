<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student m�chte ich mir meinen Stundenplan anzeigen k�nnen.
	- User Story Punkte:	13
	- Task:					Funktion stundenplan_individuell() im Controller erstellen.
	- Zeitaufwand:			1h
	
	//////////
	
	- User Story (Nr. 410):	Als Dozent/Student m�chte ich mir einen Stundenplan f�r Fachsemester anzeigen k�nnen.
	- User Story Punkte:	13
	- Task:					Funktionen erzeugeFormular() und stundenplan_fachsemester() im Controller erstellen.
	- Zeitaufwand:			1h
*/
?>	

<?php

class stundenplanController extends Controller
{
	//Controller zur Ablaufsteuerung, um Stundenplan nach Fachsemester oder individuell f�r Student/Dozent anzuzeigen
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	//erzeugt Formular zur Auswahl des Studiengangs und Fachsemesters:
	public function erzeugeFormular()
	{
		//neues Model-Objekt f�r Datenfluss erstellen:
        $spModel = new stundenplanModel();

        //Daten aus DB holen:
		$studiengaenge = $spModel->getStudiengaenge();
		
		/* 	rendert die Seite und gibt die geholten Daten an den View weiter,
			um dort dem Nutzer die Auswahl eines Studiengangs und Fachsemesters zu erm�glichen
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
				Session::add('response_negative', utf8_encode('F�r ein/mehrere Felder wurde keine Auswahl getroffen!'));
				$this->erzeugeFormular();
			}
			else
			{
				//Formularverarbeitung:
				$stg_ID = $_POST['waehleStudiengang'];
				$fachsemester = $_POST['waehleFachsemester'];
			
				//neue Model-Objekte f�r Datenfluss erstellen:
				$spModel = new stundenplanModel();
				$rzModel = new raumZuweisenModel();
			
				//Daten aus DB holen:
				$veranstaltungstermine = $spModel->getVeranstaltungstermine_fachsemester($stg_ID, $fachsemester);
				$stg_bezeichnung = $spModel->getStudiengang($stg_ID);
				$wochentage = $rzModel->getWochentage();
				$stundenZeiten = $rzModel->getStundenzeiten();
			
				/* 	rendert die Seiten ... und gibt die geholten Daten mit 5 Subarrays an den View weiter,
					um dort den Stundenplan als Tabelle aufzeichnen zu k�nnen
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
	
	//erzeugt eine Tabelle, welche einen individuellen Stundenplan gem�� des angemeldeten Students/Dozents anzeigt:
	public function stundenplan_individuell()
	{
		//neue Model-Objekte f�r Datenfluss erstellen:
		$spModel = new stundenplanModel();
		$rzModel = new raumZuweisenModel();
			
		//Daten aus DB holen:
		$veranstaltungstermine = $spModel->getVeranstaltungstermine_individuell(Session::get('user_name'), Session::get ( 'user_role' ));
		$wochentage = $rzModel->getWochentage();
		$stundenZeiten = $rzModel->getStundenzeiten();
			
		/* 	rendert die Seiten ... und gibt die geholten Daten mit 4 Subarrays an den View weiter,
			um dort den Stundenplan als Tabelle aufzeichnen zu k�nnen
		*/
		$this->View->render('stundenplan/stundenplanIndividuell', 
													array('nutzerName' => Session::get('user_name'),
														  'veranstaltungstermine' => $veranstaltungstermine,
														  'wochentage' => $wochentage,
														  'stundenzeiten' => $stundenZeiten));
	}
}