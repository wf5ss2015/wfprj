<?php
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.25
 * User Story Nr.: 350
 * User Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
 * Task: View.php abgeändert, damit ***View.php verarbeitet wird. 
 * Note: überall View rangehängt wo es nötig war. Wird nicht extra im Code Kommentiert, da mehr Kommentare als änderung
 * ==> Beispiel "require Config::get ( 'PATH_VIEW' ) . '_templates/headerView.php';"
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 350
 * User Story: generische Tabellen
 * Task: core/view.php erweitern
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.: 330
 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 * Task: response in core/view.php integrieren
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 2
 * @author: Kilian Kraus
 * Datum: 20.04.2015
 * Zeitaufwand (in Stunden): 1.5
 * User Story Nr.: 270
 * User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 * Task: core/view.php anpassen
 * ===============================================
 */
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
 *         Diese Klasse ist für den Output da.
 */
class View {
	/**
	 *
	 * @author Kilian Kraus
	 *         rendert eine Response Message
	 */
	public function render($filename, $data = null) {
		if ($data) {
			foreach ( $data as $key => $value ) {
				$this->{$key} = $value;
			}
		}
		// lädt den header
		require Config::get ( 'PATH_VIEW' ) . '_templates/headerView.php';
		// lädt das menue
		new menueView();
		// lädt Response message
		$this->renderResponse();
		// lädt den content
		require Config::get ( 'PATH_VIEW' ) . $filename . 'View.php';
		// lädt den footer
		require Config::get ( 'PATH_VIEW' ) . '_templates/footerView.php';
	}
	
	/*
	 * ===============================================
	 * Start Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
	 * ===============================================
	 */
	/**
	 *
	 * @author Kilian Kraus
	 *         rendert eine Response Message
	 */
	public function renderResponse() {
		require Config::get ( 'PATH_VIEW' ) . '_templates/responseView.php';
		// setzt die Response auf Null, damit sie nicht zweimal angezeigt wird.
		Session::set ( 'response_positive', null );
		Session::set ( 'response_negative', null );
		Session::set ( 'response_warning', null );
	}
	/*
	 * ===============================================
	 * Ende Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
	 * ===============================================
	 */
	
	/*
	 * ===============================================
	 * Start Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: generische Tabellen
	 * ===============================================
	 */
	/**
	 *
	 * @author Kilian Kraus
	 *         rendert mehrere Views
	 */
	public function renderMulti($filenames, $data = null) {
		if (! is_array ( $filenames )) {
			self::render ( $filenames, $data );
			return false;
		}
		
		if ($data) {
			// print_r($data);
			foreach ( $data as $key => $value ) {
				$this->{$key} = $value;
			}
		}
		
		// lädt den header
		require Config::get ( 'PATH_VIEW' ) . '_templates/headerView.php';
		// lädt das menue
		new menueView();
		// lädt Response message
		$this->renderResponse();
		// lädt die verschiedenen views
		foreach ( $filenames as $filename ) {
			require Config::get ( 'PATH_VIEW' ) . $filename . 'View.php';
		}
		// lädt den footer
		require Config::get ( 'PATH_VIEW' ) . '_templates/footerView.php';
	}
	/*
	 * ===============================================
	 * Ende Sprint: 3
	 * @author: Kilian Kraus
	 * User Story: generische Tabellen
	 * ===============================================
	 */
	
}
