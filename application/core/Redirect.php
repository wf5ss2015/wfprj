<?php
 /*===============================================
 Sprint: 1
 @author: Kilian Kraus
 Datum: 08.04.2015
 Zeitaufwand (in Stunden): 0.1
 User Story Nr.: 140
 User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 Task: xxx
 ===============================================*/


/**
* @author Kilian Kraus
* Diese Klasse ermöglicht es vorzugsweise über den Controller("Redirect::to('VerzeichnisDesView/NameDesView');") zu einer anderen Seite (View) zu leiten.
 */
class Redirect
{

	/**
	 * @author Kilian Kraus
	 * Holt sich die URL und den Pfad und leitet dorthin
	 * @see http://php.net/manual/de/function.header.php
	 * @param $path
	 */
	public static function to($path)
	{
		header("location: " . "index.php?url=" . $path);
	}
}
