<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5
	zeitaufwand: 
	user story 
*/

class informationController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	public function information() {
		$current_user = Session::get('user_name');
		$this->View->render ('information/information',	array (
				'studiengang' => UserModel::getStudentStudiengang($current_user)
		) );
	}
}
?>