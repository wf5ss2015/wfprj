<?php
 /*===============================================
 Sprint: 1
 @author: Kilian Kraus
 Datum: 08.04.2015
 Zeitaufwand (in Stunden): 0.5
 User Story Nr.: 140
 User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 Task: xxx
 ===============================================*/

/**
 * Gibt die Konfiguration zurück.
 */
return array(
	/**
	 * @author Kilian Kraus
	 * Baut die richtige URL zusammen. 
	 *
	 * $_SERVER['HTTP_HOST'] 
	 * ==> gibt die IP/URL des servers
	 *
	 * str_replace('public', '', dirname($_SERVER['SCRIPT_NAME']))
	 * @see http://php.net/manual/de/function.str-replace.php
	 */
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
	
	/**
	 * Pfade für den Controller & View
	 */
	'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
	'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',

	/**
	 * @author Kilian Kraus
	 * Setzt die Default Controller
	 */
	'DEFAULT_CONTROLLER' => 'index',
	'DEFAULT_ACTION' => 'index',
	
	/**
	 * @author Kilian Kraus
	 * Einstellungen der Datenbank
	 * 
	 * DB_TYPE 
	 * ==> Datenbank-Typ
	 * DB_HOST 
	 * ==> Hostname (lokal ==> "localhost"; vpn/hochschule ==> "i-intra-03.informatik.hs-ulm.de") 
	 * DB_NAME 
	 * ==> Name der Datenbank (lokal ==> "wasAuchImmer"; hochschule ==> "wfprj_wf5_0X")
	 * DB_USER 
	 * ==> Nutzername (lokal ==> "'root' wenn nicht geändert"; hochschule ==> "wfprj_wf5_0X")
	 * DB_PASS 
	 * ==> Passwort (lokal ==> "Kein Passwort, falls nicht geändert"; hochschule ==> "euer DB Passwort")
	 * DB_PORT 
	 * ==> Port (sollte "3306" sein)
	 * DB_CHARSET 
	 * ==> Charset 
	 * @see http://www.w3schools.com/charsets/ref_html_utf8.asp
	 */
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '',
	'DB_NAME' => '',
	'DB_USER' => '',
	'DB_PASS' => '',
	'DB_PORT' => '3306',
	'DB_CHARSET' => 'utf8',
);
