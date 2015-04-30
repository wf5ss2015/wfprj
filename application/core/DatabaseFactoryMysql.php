<?php
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 4.5
 User Story: Als Entwickler möchte ich eine einheitliche Datenbankverbindung in PHP haben
 Task: zusätzlich zu PDO verbindung noch MySQLi hinzufügen 
 ===============================================*/

/**
 * @author Kilian Kraus
 * Diese Klasse erstellt eine Datenbankverbindung mit Mysqli
 * 
 */

class DatabaseFactoryMysql extends MySQLi
{
	public function __construct() {
    parent::__construct(
	Config::get('DB_HOST'),
	Config::get('DB_USER'),
	Config::get('DB_PASS'),
	Config::get('DB_NAME'),
	Config::get('DB_PORT')		
    );
 
    if (mysqli_connect_error()) {
	Redirect::to('error/error');//sprint3
	Session::add('response_negative', 'Error: '. mysqli_connect_error());
	Session::add('response_negative', 'Errno: '. mysqli_connect_errno());
    }
  }
 
	/**
	* @author Kilian Kraus
	* macht die query
	* @param $query string sql
    * @return array mit results
	*/
	public function query($query) {
    $result = parent::query($query);
 
    if ($this->error) {
		Redirect::to('error/error');//sprint3
		Session::add('response_negative', 'Error: '. mysqli_connect_error());
		Session::add('response_negative', 'Errno: '. mysqli_connect_errno());
    }
	
	// baut einen array mit objekten. genau so wie in PDO, nur hab ich dazu keine methode in mysqli gefunden bisher
	$array = array();
		$i =0;
		while ($obj = $result->fetch_object()) {
		$array[$i] = $obj;
		$i++;
		}
	$this->close();
	// gibt array mit objekten zurück
	return $array;
  }
}
