<?php
/*
* HS­Ulm, WF5, SS2015, Prof. Klippel, Wirtschaftsinformatik­Projekt
* Projekt: Lehrveranstaltungssoftware
* Name: Kilian Kraus
* Gruppe: 01
* Version: 1
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.5
*/
?>

<?php

require '/environment.php';

	
class Config
{
    public static $config;

    public static function get($key)
    {
        if (!self::$config) {

	        $config_file = '../application/config/config.' . Environment::get() . '.php';

			if (!file_exists($config_file)) {
				return false;
			}

	        self::$config = require $config_file;
        }

        return self::$config[$key];
    }
}
