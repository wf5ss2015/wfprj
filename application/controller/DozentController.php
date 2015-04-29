<?php

class DozentController extends Controller
{

    public function __construct()
    {
        Auth::checkAuthenticationDocent();
		parent::__construct();	
		
    }

    public function auswahlVorlesung()
    {
		$this->View->render('dozent/auswahlVorlesung', array(
            'vorlesung' => DozentModel::getVorlesung())
		);
    }
	

    public function teilnehmerListe()
    {
		$this->View->render('dozent/teilnehmerListe', array(
            'teilnehmer' => DozentModel::getTeilnehmer(Request::post('id')))
		);
    }  
}
