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

require 'Environment.php';

	
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
