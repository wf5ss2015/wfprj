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
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/03  Beschreibung: Konfigurationsdaten erstellen und setzten
	* Zeitaufwand (in Stunden): 1,5
	* START SPRINT 04
	*/
	$config['protocol']  = 'smtp';
	$config['smtp_host'] = 'w012e8ee.kasserver.com';
	$config['smtp_user'] = 'projekt1@kilian-kraus.net ';
	$config['smtp_pass'] = 'GBAoChBqoz8VYCzP';
	$config['smtp_port'] = '25';
	$config['reply_to']  = 'wysdam@googlemail.com';
	$config['from_name'] = 'Test';

	/* TESTDATEN
	adresse:        projekt1@kilian-kraus.net
	konto:           m03390cc
	server:          w012e8ee.kasserver.com
	PW:               GBAoChBqoz8VYCzP
	Kopie:           wysdam@googlemail.com

	adresse:        projekt2@kilian-kraus.net
	PW:               HVRwL7L94RQ4QcRA
	konto:           m03390cf
	server:          w012e8ee.kasserver.com
	Kopie:           wysdam@googlemail.com

	adresse:        projekt3@kilian-kraus.net
	PW:               8vYrtesNcaEEeogq
	konto:           m03390d2
	server:          w012e8ee.kasserver.com
	Kopie:           wysdam@googlemail.com


	ports sind die üblichen.

	smtp 25 bzw 587
	pop3 110
	imap 143 
	*/
	/*
	* ENDE SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 380/03  Beschreibung: Konfigurationsdaten erstellen und setzten
	* Zeitaufwand (in Stunden): 1,5
	* ENDE SPRINT 04
	*-----------------------------------------------------------------------------------------*/