<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5
	zeitaufwand: 1
	user story (Nr. 470): Als Student möchte ich online Informationen zu meinem Studiengang einsehen können.
*/

class informationController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	//ruft die informationView auf und übergibt dazu die Information welche/n Studiengang/Studiengänge der Student studiert
	public function information() {
		$current_user = Session::get('user_name');
		$this->View->render ('information/information',	array (
				'studiengang' => UserModel::getStudentStudiengang($current_user)
		) );
	}
}
?>