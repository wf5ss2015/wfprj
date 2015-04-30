<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.1
*/


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
