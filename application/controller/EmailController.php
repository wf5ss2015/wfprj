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
	
		$mail = new PHPMailer(true);

		$mail->IsSMTP(); //Versand über SMTP festlegen
		
		try{
			$mail->Host = Config::get('smtp_host'); //SMTP-Server setzen
			$mail->SMTPDebug  = 2; // Debug information
			
			// Testing
			$mail->SMTPAuth = true; //Authentifizierung aktivieren
			$mail->Port = Config::get('smtp_port');
			
			// Server
			$mail->Username = Config::get('smtp_user');  // SMTP Benutzername
			$mail->Password = Config::get('smtp_pass'); // SMTP Passwort
			$mail->AddAddress(Request::post('email'));
			$mail->SetFrom = Config::get('smtp_email', Session::get('user_name'));
			$mail->Subject = Request::post('betreff');
			$mail->Body = Request::post('nachricht')."\n\n Viele Grüße".Session::get('user_name');
			
			if(!$mail->Send())
			{
				Session::add('response_negative', 'Email wurde nicht versandt. Es ist ein Fehler aufgetreten: '.$mail->ErrorInfo);
				//print_r($mail);
			}
			else
			{
				Session::add('response_positive', 'Email wurde versandt.');
			}
			Redirect::to('dozent/emailDozent');
		
		}catch (phpmailerException $e){
				echo $e->getMessage();
		}
	}
public function writeMailAll(){
		$this->View->render ( 'dozent/emailAll', array ('profil' => DozentModel::getDozentProfil(Session::get('user_name')),
				'id' => Request::post ( 'id' )
		) );
	
}

public function sendMailAll(){
		
		$mail = new PHPMailer(true);

		$mail->IsSMTP(); //Versand über SMTP festlegen
		
		try{
			$mail->Host = Config::get('smtp_host'); //SMTP-Server setzen
			$mail->SMTPDebug  = 2; // Debug information
			echo Config::get('smtp_host');
	
			// Testing
			$mail->SMTPAuth = true; //Authentifizierung aktivieren
			$mail->Port = Config::get('smtp_port');
			
			// Server
			$mail->Username = Config::get('smtp_user');  // SMTP Benutzername
			$mail->Password = Config::get('smtp_pass'); // SMTP Passwort
			
			$userlist = array('userlist' => DozentModel::getTeilnehmer(Request::post ( 'id')));
 
			//print_r($userlist);
			//Empfängeradresse setzen
			foreach ( $userlist as $key => $value ) {
						$this->{$key} = $value;
					}
			foreach ( $this->userlist as $key => $value ) {
						$mail->AddAddress($value->Email);
					}
			
			// zu Testzwecken
			$mail->AddBCC('wysdam@googlemail.com');
			//Betreff der Email setzen
			$mail->Subject = Request::post('betreff');
			$mail->SetFrom = Config::get('smtp_email', Session::get('user_name'));
			$mail->Subject = Request::post('betreff');
			$mail->Body = Request::post('nachricht')."\n\n Viele Grüße".Session::get('user_name');
			
			if(!$mail->Send())
			{
				Session::add('response_negative', 'Email wurde nicht versandt. Es ist ein Fehler aufgetreten: '.$mail->ErrorInfo);
				//print_r($mail);
			}
			else
			{
				Session::add('response_positive', 'Email wurde versandt.');
			}
			$this->View->render ( 'dozent/teilnehmerListe', array (
				'teilnehmer' => DozentModel::getTeilnehmer(Request::post ( 'id' ) ) 
			) );
		
		}catch (phpmailerException $e){
				echo $e->getMessage();
		}
	}
}
?>
		
	

