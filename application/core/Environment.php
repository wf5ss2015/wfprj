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
 * Klasse um die Umgebung zu steuern.
 */
class Environment
{
	/**
	* @author Kilian Kraus
	* gibt
	*/
	public static function get()
	{
	if(getenv('HTTP_HOST') == 'localhost'){
		return 'local';
	}
	if(getenv('HTTP_HOST') == 'kilian-kraus.de'){
		return 'kilian';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '01') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '02') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '03') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '04') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '05') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '06') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '07') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '08') {
		return 'private';
	}
	if(getenv('HTTP_HOST') == 'wfprj-wf5.informatik.hs-ulm.de' && substr($_SERVER['PHP_SELF'],1,2) == '09') {
		return 'group';
	}

	}
}
