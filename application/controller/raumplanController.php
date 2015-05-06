<?php

class raumplanController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();	
    }
	
	
     //Formular f�r Parameter
	 public function erzeugeFormular1() 
	 {
		//Daten �bers Model holen, dann im View eine Methode mit �P zum Anzeigen
        $rpModel = new raumplanModel();

        //Daten aus DB holen:
		$vorlesungsraeume = $rpModel->getVorlesungsraeume();
		$laborraeume = $rpModel->getLaborraeume();
		
		/* 	rendert die Seite
			bekommt ein Array mit zwei Subarrays �bergeben, jeweils eins 
			f�r die Vorlesungsr�ume und Laborr�ume
		*/
        $this->View->render('raumplan/formular1', array('vorlesungsraeume' => $vorlesungsraeume, 'laborraeume' => $laborraeume));
	 }
	 
	 public function raumplanAnzeigen()
	 {
		if(isset($_POST['send']) && $_POST['send'] == 'zeige Raumplan') 
		{
			$raum_bezeichnung = $_POST['waehleRaum'];
			
			$rpModel = new raumplanModel();
			$rzModel = new raumZuweisenModel();
			
			//Daten aus DB holen:
			$veranstaltungstermine = $rpModel->getVeranstaltungstermine($raum_bezeichnung);
			$wochentage = $rzModel->getWochentage();
			$stundenZeiten = $rzModel->getStundenzeiten();
			
			$this->View->render('raumplan/ausgabe', array('veranstaltungstermine' => $veranstaltungstermine,
																	'wochentage' => $wochentage,
																	'stundenzeiten' => $stundenZeiten));
		}
	 } 
}
?>