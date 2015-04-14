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
 * Klasse um get/post zu handeln.
 */
class Request
{

    public static function post($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
    }

    public static function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        }
    }

}
