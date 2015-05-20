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
		$mail = new PHPMailer();
 
	echo Config::get('smtp_host');
  //Absenderadresse der Email setzen
  $mail->From = Config::get('smtp_email');
  
  //Name des Abenders setzen
  $mail->FromName = Session::get('user_name');
  
  //Empfängeradresse setzen
  $mail->AddAddress("kraus.kilian@googlemail.com");
  
  //Betreff der Email setzen
  $mail->Subject = "Test1234";
 
  //Text der EMail setzen
  $mail->Body = "Hallo! \n\n Dies ist die erste Email mit PHPMailer! Viele Grüße".Session::get('user_name');
  
  $mail->IsSMTP(); //Versand über SMTP festlegen
  $mail->Host = Config::get('smtp_host'); //SMTP-Server setzen
  
  $mail->SMTPAuth = true;     //Authentifizierung aktivieren
  $mail->Username = Config::get('smtp_user');  // SMTP Benutzername
  $mail->Password = Config::get('smtp_pass'); // SMTP Passwort 
  
  //EMail senden und überprüfen ob sie versandt wurde
  if(!$mail->Send())
  {
      Session::add('response_negative', 'Email wurde nicht versandt. Es ist ein Fehler aufgetreten: '.$mail->ErrorInfo);
  }
  else
  {
     Session::add('response_positive', 'Email wurde versandt.');
}
Redirect::to('dozent/emailDozent');
}

public function writeMailAll(){
		$this->View->render ( 'dozent/emailAll', array ('profil' => DozentModel::getDozentProfil(Session::get('user_name')),
				'id' => Request::post ( 'id' )
		) );
		
		print_r(array ('profil' => DozentModel::getDozentProfil(Session::get('user_name')),
				'id' => Request::post ( 'id' )));
	
}
public function sendMailAll(){
		$mail = new PHPMailer();
 
	echo Config::get('smtp_host');
  //Absenderadresse der Email setzen
  $mail->From = Config::get('smtp_email');
  
 //Name des Abenders setzen
  $mail->FromName = Request::post('nachname');
  
  echo "aöjsfdlkj: ".Request::post ( 'id' );
  $userlist = array('userlist' => DozentModel::getTeilnehmer(Request::post ( 'id')));
  
 
  print_r($userlist);
  //Empfängeradresse setzen
  foreach ( $userlist as $key => $value ) {
					$this->{$key} = $value;
				}
  foreach ( $this->userlist as $key => $value ) {
				$mail->AddAddress($value->Email);
				}

  $mail->AddBCC('kraus.kilian@googlemail.com');
  
  //Betreff der Email setzen
  $mail->Subject = Request::post('betreff');
 
  //Text der EMail setzen
  $mail->Body = Request::post('nachricht').Request::post('nachname');
  
  $mail->IsSMTP(); //Versand über SMTP festlegen
  $mail->Host = Config::get('smtp_host'); //SMTP-Server setzen
  
  $mail->SMTPAuth = true;     //Authentifizierung aktivieren
  $mail->Username = Config::get('smtp_user');  // SMTP Benutzername
  $mail->Password = Config::get('smtp_pass'); // SMTP Passwort 
  
  //EMail senden und überprüfen ob sie versandt wurde
  if(!$mail->Send())
  {
      Session::add('response_negative', 'Email wurde nicht versandt. Es ist ein Fehler aufgetreten: '.$mail->ErrorInfo);
  }
  else
  {
     Session::add('response_positive', 'Email wurde versandt.');
}
//Redirect::to('dozent/emailDozent');
}}
?>
		
	

