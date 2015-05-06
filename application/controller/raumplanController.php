<?php

class raumplanController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();	
    }
	
	
     //Formular für Parameter
	 public function erzeugeFormular1() 
	 {
		//Daten übers Model holen, dann im View eine Methode mit ÜP zum Anzeigen
        $rpModel = new raumplanModel();

        //Daten aus DB holen:
		$vorlesungsraeume = $rpModel->getVorlesungsraeume();
		$laborraeume = $rpModel->getLaborraeume();
		
		/* 	rendert die Seite
			bekommt ein Array mit zwei Subarrays übergeben, jeweils eins 
			für die Vorlesungsräume und Laborräume
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