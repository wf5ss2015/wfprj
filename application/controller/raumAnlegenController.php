<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<?php
	class raumAnlegenController extends Controller {
    
		public function __construct()
		{
			parent::__construct();
		}


		public function raumAnlegen()
		{
			$this->View->render('raumanlegen/raumAnlegen');
		}
		
		public function raumSelected()
		{
			$raumtyp = $_POST['typ'];
			if(isset($_POST)){
				switch ($raumtyp) {
					case "vorlesungsraum":
						$this->View->render('raumanlegen/vorlesungsraumAnlegen', array(
							'geblist' => raumAnlegenModel::getGebäude()));
						break;
					case "buero":
						$this->View->render('raumanlegen/bueroAnlegen');
						break;
					case "labor":
						$this->View->render('raumanlegen/laborAnlegen');
						break;
					case "bibliothek":
						$this->View->render('raumanlegen/bibliothekAnlegen');
						break;
					default:
						echo "Kein Raumtyp ausgewählt!";
				}
			}
			else {
				echo "Kein Raumtyp ausgewählt!";
			} 
		}
}

?>