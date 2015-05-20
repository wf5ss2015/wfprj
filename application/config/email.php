<?php
/* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 15.05.2015
 * User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
 * Zeit insgesamt: 1
 * ===============================================*/

/**
 * @author Damian Wysocki
 *        
 *         Beschreibung: Konfigurationsdaten erstellen und setzten
 */
?>

<?php 
class email {
	public static $config;
	public function __construct(){
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/03  Beschreibung: Konfigurationsdaten erstellen und setzten
	* Zeitaufwand (in Stunden): 1,5
	* START SPRINT 04
	*/
	
	$config['protocol']  = 'smtp';
	$config['smtp_email']= 'versender@kilian-kraus.net';
	$config['smtp_host'] = 'w012e8ee.kasserver.com';
	$config['smtp_user'] = 'm03399f9';
	$config['smtp_pass'] = 'DF6yQq8aKowGQft8';
	$config['smtp_port'] = '25';
	}

	

	public function get($key) {		
			if (! $this->$config) {
			
			$config_file = new email();
			
			if (! file_exists ( $config_file )) {
				return false;
			}
			
			$this->$config = require $config_file;
		}
		
		return $this->$config [$key];
	}
	}
	/*
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 380/03  Beschreibung: Konfigurationsdaten erstellen und setzten
	* Zeitaufwand (in Stunden): 1,5
	* ENDE SPRINT 04
	*-----------------------------------------------------------------------------------------*/