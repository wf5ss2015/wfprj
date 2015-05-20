<?php
/* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 12.05.2015
 * User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
 * Zeit insgesamt: 8
 * ===============================================*/

/**
 * @author Damian Wysocki
 *        
 *         Beschreibung: Helper Klasse zur Speicherung der globalen Variablen
 */
?>

<?php 
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 380/02  Beschreibung: Attribute zum Versenden einer Email setzen
	* Zeitaufwand (in Stunden): 2,5
	* START SPRINT 04
	*/

if (!function_exists('sendEmail'))
{
  function sendEmail($to, $subject, $message)
  {
 
 require_once(APPPATH . 'helper/PHPMailer/class.phpmailer.php');
 
 $ci =& get_instance();
    $ci->config->load('email');
 
    $mail = new PHPMailer();
 
    $mail->CharSet = 'utf-8';
    $mail->IsSMTP();
    $mail->Host = $ci->config->item('smtp_host');
    //$mail->SMTPAuth = true;
    //$mail->SMTPSecure = 'ssl';
    $mail->Username = $ci->config->item('smtp_user');
    $mail->Password = $ci->config->item('smtp_pass');
    $mail->Port = $ci->config->item('smtp_port');
 
    $mail->From = $ci->config->item('smtp_user');
    $mail->FromName = $ci->config->item('from_name');
    $mail->AddAddress($to);
    $mail->AddReplyTo($ci->config->item('reply_to'), $ci->config->item('from_name'));
 
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = str_replace('<br/>', '', $message);
 
    if (!$mail->Send())
    {
      log_message('error', $mail->ErrorInfo);
    //throw new Exception($mail->ErrorInfo);
      return FALSE;
    }
 
    return TRUE;
  }
  /**
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 380/02  Beschreibung: Attribute zum Versenden einer Email setzen
	* Zeitaufwand (in Stunden): 1,5
	* ENDE SPRINT 04
	**-----------------------------------------------------------------------------------------*/
}