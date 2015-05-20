<?php
/* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 15.05.2015
 * User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
 * Zeit insgesamt: 0,3
 * ===============================================*/

/**
 * @author Damian Wysocki
 *        
 *         Beschreibung: Controller zur Steuerung der View erstellen
 */
?>
 
<?php
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/04  Beschreibung: Controller erstellen
	* Zeitaufwand (in Stunden): 1
	* START SPRINT 04
	*/

class EmailController extends Controller {
	
	public function __construct() {
		$auth = new Auth(2);
		parent::__construct ();
	}
	
	public function sendMailDozent(){
		//TEST
		//property_exists('EmailController','');
		
		// BUG
		//Notice: Undefined property: EmailController::$load in C:\xampp\htdocs\wfprj\application\controller\EmailController.php on line 50
		//Fatal error: Call to a member function helper() on null in C:\xampp\htdocs\wfprj\application\controller\EmailController.php on line 50
		$this->load->helper('email');
		
		$sent = sendEmail('wysdam@googlemail.com', 'Hello subject!', 'My message');
		echo $sent ? 'sent.' : 'NOT sent!';
		

		//$this->view->render('dozent/email');

		}
	/*
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/04  Beschreibung: Controller erstellen
	* Zeitaufwand (in Stunden): 1
	* ENDE SPRINT 04
	**-----------------------------------------------------------------------------------------*/
	
}
