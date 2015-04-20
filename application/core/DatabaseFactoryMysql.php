<?php
/**
* SPRINT 02
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): einheitliche datenbankverbindung.
* Zeit: 2.0
*/

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
      throw new MySQLi_ConnectionException(
        mysqli_connect_error(),
        mysqli_connect_errno()
      );
    }
  }
 
	// macht die query.
	public function query($query) {
    $result = parent::query($query);
 
    if ($this->error) {
      throw new MySQLi_QueryException(
        $this->error,
        $this->errno
      );
    }
	
	// baut einen array mit objekten. genau so wie in PDO, nur hab ich dazu keine methode in mysqli gefunden bisher
	$array = array();
		$i =0;
		while ($obj = $result->fetch_object()) {
		$array[$i] = $obj;
		$i++;
		}
	// gibt mit objekten zurück
	return $array;
  }
}
