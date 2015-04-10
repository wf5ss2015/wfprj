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
* Zeit: 0.1
*/
?>


<?php

/**
 * @author Kilian Kraus
 * Klasse um die Umgebung zu steuern.
 * TODO ==> noch nicht fertig.
 */
class Environment
{
	public static function get()
	{
		return (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : "local");
	}
}
