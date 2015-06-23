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

class veranstaltungsterminUebersichtController extends Controller
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
        $this->View->render('veranstaltungsterminUebersicht/formular', array('studiengaenge' => $studiengaenge));
	}
	
	//erzeugt eine Tabelle, welche den Stundenplan nach Fachsemester anzeigt:
	public function stundenplan_fachsemester()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'zeige Termine') 
		{
			if(empty($_POST['waehleStudiengang']) || empty($_POST['waehleFachsemester']))
			{
				Session::add('response_negative', utf8_encode('Für ein/mehrere Felder wurde keine Auswahl getroffen!'));
				$this->erzeugeFormular();
			}
			else
			{
				//Formularverarbeitung: Studiengang-ID und Fachsemester in Session-Variable schreiben
				$stg_ID = $_POST['waehleStudiengang'];
				$fachsemester = $_POST['waehleFachsemester'];
				
				$_SESSION['stg_ID'] = $stg_ID;
				$_SESSION['fachsemester'] = $fachsemester;
			
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
				$this->View->render('veranstaltungsterminUebersicht/veranstaltungsterminUebersicht', 
															array('studiengang' => (String)$stg_bezeichnung,
																  'fachsemester' => $fachsemester,
																  'veranstaltungstermine' => $veranstaltungstermine,
																  'wochentage' => $wochentage,
																  'stundenzeiten' => $stundenZeiten));
			}
		}
	}
	
	public function bearbeiteVeranstaltungstermin()
	{
		if(isset($_POST['send']) && $_POST['send'] == utf8_encode("ändern")) //Veranstaltungstermin ändern
		{
			//neue Model-Objekte für Datenfluss erstellen:
			$spModel = new stundenplanModel();
			$rzModel = new raumZuweisenModel();
			
			//Formularverarbeitung (hidden values):
			$veranst_ID = $_POST['veranst_ID'];
			$veranst_bezeichnung = $_POST['veranst_bezeichnung'];
			$raum_bezeichnung = $_POST['raum_bezeichnung'];
			$tag_ID = $_POST['tag_ID'];
			$tag_bezeichnung = $rzModel->getTag($tag_ID);
			$stdZeit_ID = $_POST['stdZeit_ID'];
			$stundenzeit = $rzModel->getStundenzeit($stdZeit_ID);
			
			/*	Veranstaltungs-ID, Raum-Bezeichnung, Tag-ID und Stundenzeit-ID des zu ändernden 
				Veranstaltungstermins werden in Session-Variablen geschrieben:
			*/
			$_SESSION['veranst_ID'] = $veranst_ID;
			$_SESSION['raum_bezeichnung'] = $raum_bezeichnung;
			$_SESSION['tag_ID'] = $tag_ID;
			$_SESSION['stdZeit_ID'] = $stdZeit_ID;
			
		
			/*	mit renderMulti() Formular zum Ändern der Zeit (Tag und Stundenzeit) des Veranstaltungstermins
				und Veranstaltungstermin-Übersicht erneut aufrufen:
			*/
			$this->View->renderMulti(array('veranstaltungsterminUebersicht/aendereZeit', 'veranstaltungsterminUebersicht/veranstaltungsterminUebersicht'), 
										array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
												'fachsemester' => $_SESSION['fachsemester'],
												'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
												'wochentage' => $rzModel->getWochentage(),
												'stundenzeiten' => $rzModel->getStundenzeiten(),
												
												//Daten des zu ändernden Veranstaltungstermins:
												'veranst_bezeichnung' => $veranst_bezeichnung,
												'raum_bezeichnung' => $raum_bezeichnung,
												'tag_ID' => $tag_ID,
												'tag_bezeichnung' => $tag_bezeichnung,
												'stdZeit_ID' => $stdZeit_ID,
												'stundenzeit' => $stundenzeit,
												'stundenZeiten' => $rzModel->getStundenzeiten()
											)
									);
		}
		else if(isset($_POST['send']) && $_POST['send'] == utf8_encode("löschen")) //Veranstaltungstermin löschen
		{
			//Formularverarbeitung (hidden values): 
			$veranst_ID = $_POST['veranst_ID'];
			$veranst_bezeichnung = $_POST['veranst_bezeichnung'];
			$raum_bezeichnung = $_POST['raum_bezeichnung'];
			$tag_ID = $_POST['tag_ID'];
			$stdZeit_ID = $_POST['stdZeit_ID'];
			
			//neue Model-Objekte für Datenfluss erstellen:
			$vTerminBearbeitenModel = new veranstaltungsterminBearbeitenModel();
			$spModel = new stundenplanModel();
			$rzModel = new raumZuweisenModel();
		
			//Veranstaltungstermin löschen:
			$vTerminBearbeitenModel->loescheVeranstaltungstermin($raum_bezeichnung, $veranst_ID, $tag_ID, $stdZeit_ID);
			
			//Veranstaltungstermin-Übersicht erneut anzeigen:
			$this->View->render('veranstaltungsterminUebersicht/veranstaltungsterminUebersicht', 
									array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
											'fachsemester' => $_SESSION['fachsemester'],
											'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
											'wochentage' => $rzModel->getWochentage(),
											'stundenzeiten' => $rzModel->getStundenzeiten()));
		}
	}
	
	public function verarbeiteAenderungen()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'weiter') 
		{
			//Formularverarbeitung:
			$tag_ID = $_POST['waehleWochentag'];
			$stdZeit_ID = $_POST['waehleZeit'];
				
			//zu ändernde Tag-ID und Stundenzeit-ID in Session-Variablen schreiben:
			$_SESSION['tagID_aenderung'] = $tag_ID;
			$_SESSION['stdZeitID_aenderung'] = $stdZeit_ID;
				
			//neue Model-Objekte für Datenfluss erstellen:
			$spModel = new stundenplanModel();
			$rzModel = new raumZuweisenModel();
			
			/*	wenn die Zeit des Termins geändert werden soll, muss überprüft werden, ob zu der "neuen" Zeit 
				bereits eine Veranstaltung aus demselben Fachsemester stattfindet (in diesem Fall wäre die 
				Zeit-Änderung nicht möglich und es müsste eine andere Zeit ausgewählt werden)
			*/
			if(($tag_ID != $_SESSION['tag_ID'] || $stdZeit_ID != $_SESSION['stdZeit_ID']) && $rzModel->veranstaltungZeitgleich($_SESSION['veranst_ID'], $tag_ID, $stdZeit_ID)) 
			{
				Session::add('response_negative', utf8_encode('Zeit-Änderung nicht möglich: eine Veranstaltung aus demselben Fachsemester findet bereits zur ausgewählten Zeit statt!'));
				
				/*	mit renderMulti() erneut Formular zum Ändern der Zeit (Tag und Stundenzeit) des Veranstaltungstermins
					und Veranstaltungstermin-Übersicht aufrufen:
				*/
				
				$this->View->renderMulti(array('veranstaltungsterminUebersicht/aendereZeit', 'veranstaltungsterminUebersicht/veranstaltungsterminUebersicht'), 
										array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
												'fachsemester' => $_SESSION['fachsemester'],
												'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
												'wochentage' => $rzModel->getWochentage(),
												'stundenzeiten' => $rzModel->getStundenzeiten(),
												
												//Daten des zu ändernden Veranstaltungstermins:
												'veranst_bezeichnung' => $rzModel->getVeranstaltung($_SESSION['veranst_ID']),
												'raum_bezeichnung' => $_SESSION['raum_bezeichnung'],
												'tag_ID' => $_SESSION['tag_ID'],
												'tag_bezeichnung' => $rzModel->getTag($_SESSION['tag_ID']),
												'stdZeit_ID' => $_SESSION['stdZeit_ID'],
												'stundenzeit' => $rzModel->getStundenzeit($_SESSION['stdZeit_ID']),
												'stundenZeiten' => $rzModel->getStundenzeiten()
											)
										);
			}
			else //Zeit-Änderung möglich (keine Überschneidung)
			{
				//Daten aus DB holen:
				$verfuegbareVorlesungsraeume = $rzModel->getVerfuegbareVorlesungsraeume($_SESSION['veranst_ID'], $tag_ID, $stdZeit_ID);
				$verfuegbareLaborraeume = $rzModel->getVerfuegbareLaborraeume($_SESSION['veranst_ID'], $tag_ID, $stdZeit_ID);
		
				/*	mit renderMulti() Formular zum Ändern des Raumes des Veranstaltungstermins
					und Veranstaltungstermin-Übersicht erneut aufrufen:
				*/
				$this->View->renderMulti(array('veranstaltungsterminUebersicht/aendereRaum', 'veranstaltungsterminUebersicht/veranstaltungsterminUebersicht'), 
										array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
												'fachsemester' => $_SESSION['fachsemester'],
												'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
												'wochentage' => $rzModel->getWochentage(),
												'stundenzeiten' => $rzModel->getStundenzeiten(),
												
												//Daten des zu ändernden Veranstaltungstermins:
												'veranst_bezeichnung' => $rzModel->getVeranstaltung($_SESSION['veranst_ID']),
												'raum_bezeichnung' => $_SESSION['raum_bezeichnung'],
												'tag_bezeichnung' => $rzModel->getTag($_SESSION['tag_ID']),
												'tagBez_aenderung' => $rzModel->getTag($tag_ID),
												'stundenzeit' => $rzModel->getStundenzeit($_SESSION['stdZeit_ID']),
												'stundenzeit_aenderung' => $rzModel->getStundenzeit($stdZeit_ID),
												'verfuegbareVorlesungsraeume' => $verfuegbareVorlesungsraeume,
												'verfuegbareLaborraeume' => $verfuegbareLaborraeume)	
										);
			}
		}
	}
	
	public function aendereVeranstaltungstermin()
	{
		if(isset($_POST['send']) && $_POST['send'] == utf8_encode("Änderungen speichern"))
		{
			//neue Model-Objekte für Datenfluss erstellen:
			$vTerminBearbeitenModel = new veranstaltungsterminBearbeitenModel();
			$spModel = new stundenplanModel();
			$rzModel = new raumZuweisenModel();
			
			if(empty($_POST['waehleRaum'])) //kein Raum wurde ausgewählt
			{
				Session::add('response_negative', utf8_encode('Es wurde kein Raum ausgewählt!'));
				
				/*	erneut mit renderMulti() Formular zum Ändern des Raumes des Veranstaltungstermins
					und Veranstaltungstermin-Übersicht aufrufen:
				*/
				$this->View->renderMulti(array('veranstaltungsterminUebersicht/aendereRaum', 'veranstaltungsterminUebersicht/veranstaltungsterminUebersicht'), 
										array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
												'fachsemester' => $_SESSION['fachsemester'],
												'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
												'wochentage' => $rzModel->getWochentage(),
												'stundenzeiten' => $rzModel->getStundenzeiten(),
												
												//Daten des zu ändernden Veranstaltungstermins:
												'veranst_bezeichnung' => $rzModel->getVeranstaltung($_SESSION['veranst_ID']),
												'raum_bezeichnung' => $_SESSION['raum_bezeichnung'],
												'tag_bezeichnung' => $rzModel->getTag($_SESSION['tag_ID']),
												'tagBez_aenderung' => $rzModel->getTag($_SESSION['tagID_aenderung']),
												'stundenzeit' => $rzModel->getStundenzeit($_SESSION['stdZeit_ID']),
												'stundenzeit_aenderung' => $rzModel->getStundenzeit($_SESSION['stdZeitID_aenderung']),
												'verfuegbareVorlesungsraeume' => $rzModel->getVerfuegbareVorlesungsraeume($_SESSION['veranst_ID'], $_SESSION['tagID_aenderung'], $_SESSION['stdZeitID_aenderung']),
												'verfuegbareLaborraeume' => $rzModel->getVerfuegbareLaborraeume($_SESSION['veranst_ID'], $_SESSION['tagID_aenderung'], $_SESSION['stdZeitID_aenderung']))	
										);
			}
			else //Raum wurde ausgewählt und Änderungen können abgespeichert werden
			{
				//Formularverarbeitung: ausgewählter Raum in Session-Variable abspeichern
				$_SESSION['raumBez_aenderung'] = $_POST['waehleRaum'];
				
				//Änderungen des Veranstaltungstermins abspeichern:
				$vTerminBearbeitenModel->aendereVeranstaltungstermin();
			
				//Veranstaltungstermin-Übersicht wird angezeigt mit vorgenommenen Änderungen:
				$this->View->render('veranstaltungsterminUebersicht/veranstaltungsterminUebersicht', 
										array('studiengang' => (String)$spModel->getStudiengang($_SESSION['stg_ID']),
												'fachsemester' => $_SESSION['fachsemester'],
												'veranstaltungstermine' => $spModel->getVeranstaltungstermine_fachsemester($_SESSION['stg_ID'], $_SESSION['fachsemester']),
												'wochentage' => $rzModel->getWochentage(),
												'stundenzeiten' => $rzModel->getStundenzeiten())
									);
			}
		}
	}
}