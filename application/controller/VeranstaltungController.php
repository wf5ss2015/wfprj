<?php
/**
 * SPRINT 04
 *
 * @author : Roland Schmid
 * Datum: 	19.5.2015
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können. (Nacharbeit)
 * Task: 	Controller erweitern
 * Nr:		210a
 * Points:	13
 * Zeit: 	
 *
 */

/**
 * SPRINT 03
 *
 * @author : Roland Schmid
 * Datum: 	6.5.2015         
 * User­ Story: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * Task: Eingabemaske für "Veranstaltung anlegen" anpassen.
 * Nr:		130b
 * Points:	5 Points
 * Zeit: 	2
 *
 *
 * User­ Story: Als Entwickler möchte ich im MVC-Pattern programmieren können
 * Task: Bisherigen Code in MVC einfügen und anpassen.
 * Nr:		340
 * Points:	40
 * Zeit: 	3
 *        
 *                 
 */

/**
 * SPRINT 02
 *
 * @author : Roland Schmid
 * Datum: 	19.4.2015
 *         
 * User­ Story: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * Nr:		130a
 * Points:	5 Points
 * Zeit: 	1
 *
 */




/**
 *
 * @author Roland Schmid
 *         Das ist der Veranstaltung Controller.
 *         Dieser steuert alles, was mit Veranstaltungen zu tun hat:
 *         anlegen, bearbeiten, anzeigen, etc
 */
class VeranstaltungController extends Controller {
	/**
	 *
	 * @author Roland Schmid
	 *         Erstellt ein Objekt des Controllers
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 *
	 * @author Roland Schmid
	 *         Rendert "veranstaltung/index.php"
	 */
	public function index() {
		$this->View->render ( 'veranstaltung/index' );
	}
	
	/*
	 * Diese Methode sammelt die Daten, die für die Anzeige des Formular
	 * notwendig sind, mit dem eine neue Veranstaltung angelegt wird
	 *
	 */
	public function anlegenForm() {
		$vModel = new VeranstaltungModel ();
		
		// holt die Veranstaltungsarten aus der Datenbank
		$vArten = $vModel->getVeranstaltungsarten ();
		
		// holt die Ausstattung aus der Datenbank
		$ausstattung = $vModel->getAusstattung ();
		
		// holt die Studiengänge aus der Datenbank
		$studiengaenge = $vModel->getStudiengaenge ();
		
		/*
		 * rendert die Seite
		 * bekommt ein Array mit drei Subarrays übergeben, jeweils eins
		 * für die Veranstaltungsarten, für die Ausstattung und die Studiengänge
		 */
		$this->View->render ( 'veranstaltung/anlegenForm', array (
				'vArten' => $vArten,
				'ausstattung' => $ausstattung,
				'studiengaenge' => $studiengaenge 
		) );
	}
	
	/*
	 * steuert den Anlegen-Vorgang für neue Veranstaltung
	 *
	 */
	public function anlegen() {
		// neues Veranstaltungmodel anlegen
		$vModel = new VeranstaltungModel ();
		
		// legt die neue Veranstaltung an und speichert die ID, unter
		// der sie gespeichert wurde
		
		$vID = $vModel->veranstaltungAnlegen ();
		
		if ($vID > 1) {
			
			// zusätzlich noch Ausstattung eintragen
			// TODO
			
			// hole Daten der eben eingetragenen Veranstaltung als ein Array aus Objekten
			$veranstaltung = $vModel->getVeranstaltung ($vID);
			$this->View->render ( 'veranstaltung/angelegt', array (
					'veranstaltung' => $veranstaltung 
			) );
		} else {
			
			// TODO errer ausgeben
		}
	}
	

	/* sprint 4 Anfang 
	 * Task: Controller erweitern 
	 */
	/*
	 * ruft alle vorhandenen Veranstaltungen aus der Datenbank ab und übergibt sie 
	 * der view bearbeitenSelect, wo eine Veranstaltung zur Bearbeitung ausgewählt werden kann
	 */
	public function bearbeitenSelect() {
		
		// neues Veranstaltungmodel anlegen
		$vModel = new VeranstaltungModel ();
		
		// holt alle angelegten Veranstaltungen aus der Datenbank und speichert sie in einem Array
		$veranstaltungen = $vModel->getAlleVeranstaltungen();
		
		// übergibt die Veranstaltungen der View, in der die zu bearbeitende Veranstaltung 
		// ausgewählt werden kann
		$this->View->render ( 'veranstaltung/bearbeitenSelect', array (
			  'veranstaltungen' => $veranstaltungen 
		) );
		
		
	}
	
	// holt alle Grunddaten der Veranstaltung aus der Datenbank und übergibt sie der view "bearbeiten"
	public function bearbeiten() {
		// neues Veranstaltungmodel anlegen
		$vModel = new VeranstaltungModel ();
		
		//POST-Daten lesen
		$vID = Request::post("veranst_ID");
		
		if(isset($vID)) {
			
		// holt die Veranstaltung mit vID aus der Datenbank und speichert sie in $veranstaltung
		//$veranstaltung = $vModel->getVeranstaltung($vID);
		$veranstaltung = $vModel->getGrunddaten($vID);
		$this->View->render('veranstaltung/bearbeiten', array ('veranstaltung' => $veranstaltung 
		) );
		
		}
	}
	
	
	/*
	 * wird von "bearbeiten" aufgerufen, bekommt die Grunddaten (Bezeichnung, Kurztext, SWS, 
	 * Credits, Maximale Anzahl Teilnehmer) übergeben, die am Ende in der Datenbank geupdatet werden sollen.
	 * 
	 * Holt die Veranstaltungsarten aus der Datenbank und zeigt diese im nächsten Fenster des
	 * Bearbeitungs-Prozesses an.
	 * 
	 */
	public function bearbeitenVeranstaltungsart() {

	//nächster aufruf nach dem hier: array grunddaten, 
    //								 array veranstaltungsart
    //								 array ausstattung
    //								 array studiengang + fachsemester
    // dann eintragen

		
		// Array mit "Grunddaten"
		$grunddaten = array (
				'vID' 			=> Request::post("veranst_ID"), 
				'vBezeichnung' 	=> Request::post("veranstaltung_bezeichnung"),
				'vKurztext' 	=> Request::post("veranstaltung_kurztext"),
				'vSWS'		 	=> Request::post("veranstaltung_sws"),
				'vCredits'	 	=> Request::post("veranstaltung_credits"),
				'vMaxTeilnehmer'=> Request::post("veranstaltung_max_Teilnehmer"),
				//'Veranstaltungsart' => Request::post("Veranstaltungsart")
				'vArt_ID' 		=> Request::post("vArt_ID")
		);

		// neues Veranstaltungmodel anlegen
		$vModel = new VeranstaltungModel ();

		//POST-Daten lesen
		
		//Veranstaltungs-ID
		$vID = $grunddaten['vID'];
		
				
		if(isset($vID)) {

			// holt die Veranstaltung mit vID aus der Datenbank und speichert sie in $veranstaltung
 			$vArten = $vModel->getVeranstaltungsarten();
	
			$this->View->render('veranstaltung/bearbeitenVeranstaltungsart', array ('grunddaten' => $grunddaten,
					'vArten' => $vArten
			) );
	
		}
	}
	
	
	/*
	 * wird von "bearbeitenVeranstaltungsart" aufgerufen, bekommt die Grunddaten (Bezeichnung, Kurztext, SWS,
	 * Credits, Maximale Anzahl Teilnehmer) sowie die Veranstaltungsart übergeben, die am Ende in der 
	 * Datenbank geupdatet werden sollen.
	 *
	 * Holt die bisher eingetragene Ausstattung aus der Datenbank und zeigt diese im nächsten Fenster des
	 * Bearbeitungs-Prozesses an.
	 *
	 */
	public function bearbeitenAusstattung() { 
		
		//POST-Daten lesen
		// Array mit "Grunddaten", ohne Veranstaltungsart
		$grunddaten = array (
				'vID' 			=> Request::post("vID"),
				'vBezeichnung' 	=> Request::post("vBezeichnung"),
				'vKurztext' 	=> Request::post("vKurztext"),
				'vSWS'		 	=> Request::post("vSWS"),
				'vCredits'	 	=> Request::post("vCredits"),
				'vMaxTeilnehmer'=> Request::post("vMaxTeilnehmer")
				//'Veranstaltungsart' => Request::post("Veranstaltungsart")
		);

		
		//(neu gewählte) Veranstaltungsart als ID
		$vArtID = Request::post("veranstaltung_veranstaltungsart");
		
		// neues Veranstaltungmodel anlegen
		$vModel = new VeranstaltungModel ();
		
		$ausstattung = $vModel->getAusstattung();
		
		
		$this->View->render('veranstaltung/bearbeitenAusstattung', array ('grunddaten' => $grunddaten,
				'vArtID' => $vArtID,
				'ausstattung' => $ausstattung
		) );
	}
	
	/*
	 * wird von "bearbeitenAusstattung" aufgerufen, bekommt die Grunddaten (Bezeichnung, Kurztext, SWS,
	 * Credits, Maximale Anzahl Teilnehmer), die Veranstaltungsart und die Ausstattung übergeben, die am Ende in der
	 * Datenbank geupdatet werden sollen.
	 * Trägt die Eingabedaten in die Datenbank ein.
	 */
	public function bearbeitenEintragen() {
	
		//POST-Daten lesen
		// Array mit "Grunddaten", ohne Veranstaltungsart
		
		print_r($_POST);
// 		$grunddaten = array (
// 				'vID' 			=> Request::post("vID"),
// 				'vBezeichnung' 	=> Request::post("vBezeichnung"),
// 				'vKurztext' 	=> Request::post("vKurztext"),
// 				'vSWS'		 	=> Request::post("vSWS"),
// 				'vCredits'	 	=> Request::post("vCredits"),
// 				'vMaxTeilnehmer'=> Request::post("vMaxTeilnehmer")
// 				//'Veranstaltungsart' => Request::post("Veranstaltungsart")
// 		);
	
	
// 		//(neu gewählte) Veranstaltungsart als ID
// 		$vArtID = Request::post("veranstaltung_veranstaltungsart");
	
// 		// neues Veranstaltungmodel anlegen
// 		$vModel = new VeranstaltungModel ();
	
// 		$ausstattung = $vModel->getAusstattung();
	
	
// 		$this->View->render('veranstaltung/bearbeitenAusstattung', array ('grunddaten' => $grunddaten,
// 				'vArtID' => $vArtID,
// 				'ausstattung' => $ausstattung
// 		) );
	}
	
	
	
	
	
	/* sprint 4 Ende */
}
