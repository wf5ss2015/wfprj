<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.5
*/


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
