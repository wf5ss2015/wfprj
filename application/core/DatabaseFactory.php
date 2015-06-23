<?php
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 1.5
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Diese Klasse erstellt eine Datenbankverbindung mit PDO.
 *        
 */
class DatabaseFactory {
	public static $factory;
	public $database;
	public static function getFactory() {
		if (! self::$factory) {
			self::$factory = new DatabaseFactory ();
		}
		return self::$factory;
	}
	
	/**
	 *
	 * @author Kilian Kraus
	 *         Diese Funktion baut eine Verbindung zur Datenbank auf
	 * @see http://php.net/manual/de/book.pdo.php
	 */
	public function getConnection() {
		if (! $this->database) {
			$options = array (
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			);
			$this->database = new PDO ( Config::get ( 'DB_TYPE' ) . ':host=' . Config::get ( 'DB_HOST' ) . ';dbname=' . Config::get ( 'DB_NAME' ) . ';port=' . Config::get ( 'DB_PORT' ) . ';charset=' . Config::get ( 'DB_CHARSET' ), Config::get ( 'DB_USER' ), Config::get ( 'DB_PASS' ), $options );
		}
		return $this->database;
	}
}
