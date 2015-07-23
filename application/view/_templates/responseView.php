<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.:
 * User Story: Als Entwickler m�chte ich einheitliche Fehlermeldungen haben.
 * Task: response template erstellen
 * ===============================================
 */

// holt sich die R�ckmeldung aus Session
$response_positiv = Session::get ( 'response_positive' );
$response_negative = Session::get ( 'response_negative' );
$response_warning = Session::get ( 'response_warning' );


// output positive R�ckmeldung
if (isset ( $response_positiv )) {
	foreach ( $response_positiv as $response ) {
		echo '<section class="response" id="positiv"><a style="text:bold">' . $response . '</a></section>';
	}
}

// output negative R�ckmeldung
if (isset ( $response_negative )) {
	foreach ( $response_negative as $response ) {
		echo '<section class="response" id="negative">' . $response . '</section>';
	}
}

// output Warnung
if (isset ( $response_warning )) {
	foreach ( $response_warning as $response ) {
		echo '<section class="response" id="warning">' . $response . '</section>';
	}
}
