<?php 
 
 /*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 370):	Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	- User Story Punkte:	8
	- Task:					Bei Raum-Zuweisung beide Formulare auf einer Seite anzeigen, dazu die Funktion 
							renderMulti() nutzen.
	- Zeitaufwand:			2h
	
	//////////
	
	- User Story (Nr. 370):	Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	- User Story Punkte:	8
	- Task:					Bei Raum-Zuweisung Error-Handling betreiben und Response ausgeben.
	- Zeitaufwand:			2h
	
	---------- SPRINT 3 ----------
	
	- Autor:				Alexander Mayer
	- Datum: 				06.05.2015
	
	- User Story (Nr. 340): Als Entwickler möchte ich im MVC-Pattern programmieren können.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: Controller erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden	
*/
 
?> 	

<?php

session_start(); //Aufruf notwendig, um Session-Variablen registrieren zu können


class raumZuweisenController extends Controller
{
    //Controller zur Ablaufsteuerung, um einen Raum einer Veranstaltung zuweisen zu können
    
	public function __construct()
    {
        parent::__construct();	
    }
	
	
	//erzeugt Formular zur Auswahl von Veranstaltung, Wochentag und Stundenzeit:
	public function erzeugeFormular1() 
	{
		//neues Model-Objekt für Datenfluss erstellen:
        $rzModel = new raumZuweisenModel();

        //Daten aus DB holen:
        $veranstaltungen = $rzModel->getVeranstaltungen();
		$wochentage = $rzModel->getWochentage();
		$stundenZeiten = $rzModel->getStundenzeiten();
		
		/* 	rendert die Seite und gibt die geholten Daten mit 3 Subarrays an den View weiter,
			um dort dem Nutzer die Auswahl für Veranstaltung, Wochentag und Stundenzeit zu
			ermöglichen
		*/
        $this->View->render('raumZuweisung/formular1', array('veranstaltungen' => $veranstaltungen,
                                                               'wochentage' => $wochentage, 
                                                               'stundenZeiten' => $stundenZeiten));
    }
	
	
	//erzeugt Formular zur Auswahl eines verfügbaren Raumes:
	public function erzeugeFormular2() 
	{
		if(isset($_POST['send']) && $_POST['send'] == utf8_encode('zeige Räume')) 
		{
			if(empty($_POST['waehleVeranstaltung']) || empty($_POST['waehleWochentag']) || empty($_POST['waehleZeit']))
			{
				Session::add('response_negative', utf8_encode('Für ein/mehrere Felder wurde keine Auswahl getroffen!'));
				$this->erzeugeFormular1();
			}
			else //für alle Formular-Felder wurde ein Wert ausgewählt
			{
				//Formularverarbeitung:
				$veranst_ID = $_POST['waehleVeranstaltung'];
				$tag_ID = $_POST['waehleWochentag'];
				$stdZeit_ID = $_POST['waehleZeit'];
				
				//neues Model-Objekt für Datenfluss erstellen:
				$rzModel = new raumZuweisenModel();
				
				/*	prüfen, ob eine Veranstaltung aus dem Fachsemester bereits zur ausgewählten Zeit stattfindet 
					(in diesem Fall wieder zurück auf formular1, sonst verfügbare Räume zur Raum-Zuweisung anzeigen)
				*/
				if($rzModel->veranstaltungZeitgleich($veranst_ID, $tag_ID, $stdZeit_ID)) 
				{
					Session::add('response_negative', utf8_encode('Überschneidung: eine Veranstaltung aus demselben Fachsemester findet bereits zur ausgewählten Zeit statt!'));
					$this->erzeugeFormular1();
				}
				else
				{
					//Eingabe-Werte für Veranstaltung, Tag und Zeit werden in Session-Variablen gespeichert:
					$_SESSION['veranst_ID'] = $veranst_ID;
					$_SESSION['tag_ID'] = $tag_ID;
					$_SESSION['stdZeit_ID'] = $stdZeit_ID;

					//Daten aus DB holen:
					$veranstaltungen = $rzModel->getVeranstaltungen();
					$wochentage = $rzModel->getWochentage();
					$stundenZeiten = $rzModel->getStundenzeiten();
			
					$verfuegbareVorlesungsraeume = $rzModel->getVerfuegbareVorlesungsraeume($veranst_ID, $tag_ID, $stdZeit_ID);
					$verfuegbareLaborraeume = $rzModel->getVerfuegbareLaborraeume($veranst_ID, $tag_ID, $stdZeit_ID);
			
		
					/*	rendert die Seiten ... und gibt die geholten Daten an den View weiter,
						um dort dem Nutzer die Auswahl eines verfügbaren Raumes zu ermöglichen (weiterhin ...)
					*/
					$this->View->renderMulti(array('raumZuweisung/formular1', 'raumZuweisung/formular2'), 
												array('veranstaltungen' => $veranstaltungen,
													  'wochentage' => $wochentage, 
													  'stundenZeiten' => $stundenZeiten,
													  'verfuegbareVorlesungsraeume' => $verfuegbareVorlesungsraeume,
													  'verfuegbareLaborraeume' => $verfuegbareLaborraeume));
				}
			}
		}
	}
	
	/*	legt entsprechend der eingelesenen Daten einen neuen Veranstaltungstermin in der Tabelle
		Veranstaltungstermin an
	*/
	public function anlegen_veranstaltungstermin()
	{
		if(isset($_POST['send']) && $_POST['send'] == 'Raum zuweisen')
		{
			if(empty($_POST['waehleRaum']))
			{
				Session::add('response_negative', utf8_encode('Es wurde kein Raum ausgewählt!'));
				$this->erzeugeFormular1();
			}
			else //Veranstaltungstermin kann angelegt werden 
			{
				//alle aus den 2 Formularen eingelesenen Daten:
				$raum_bezeichnung = $_POST['waehleRaum'];
				$veranst_ID = $_SESSION['veranst_ID'];
				$tag_ID = $_SESSION['tag_ID'];
				$stdZeit_ID = $_SESSION['stdZeit_ID'];
			
				//neues Model-Objekt für Datenfluss erstellen:
				$rzModel = new raumZuweisenModel();
			
				//Veranstaltungstermin anlegen:
				$rzModel->veranstaltungsterminAnlegen($raum_bezeichnung, $veranst_ID, $tag_ID, $stdZeit_ID);
			
				//formular1 wird erneut angezeigt, um einen weiteren Veranstaltungstermin erstellen zu können!
				$this->erzeugeFormular1();
			}
		}
	}
}