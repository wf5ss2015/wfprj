<?php
/*
 * ===============================================
 * Sprint: 1
 * @author: Kilian Kraus
 * Datum: 08.04.2015
 * Zeitaufwand (in Stunden): 0.1
 * User Story Nr.: 140
 * User Story: Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können.
 * Task: xxx
 * ===============================================
 */

/**
 *
 * @author Kilian Kraus
 *         Klasse um get/post zu handeln.
 */
class Request {
	public static function post($key) {
		if (isset ( $_POST [$key] )) {
			return $_POST [$key];
		}
	}
	public static function get($key) {
		if (isset ( $_GET [$key] )) {
			return $_GET [$key];
		}
	}
}
