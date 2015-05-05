<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<?php
	class nutzerlisteDruckenController extends Controller {
    
		public function __construct(){
			parent::__construct();
		}

		public function nutzerlisteDrucken(){
			$this->View->render('nutzerlistedrucken/nutzerliste', array('user_list' => UserModel::getUserDataAll4()));
		}
		
		public function printUser(){
			
		}
	}
?>