<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 0.5
 * User Story Nr.:
 * User Story: Als Entwickler möchte ich einheitliche Fehlermeldungen haben.
 * Task: response template erstellen
 * ===============================================
 */

// holt sich die Rückmeldung aus Session
$response_positive = Session::get ( 'response_positive' );
$response_negative = Session::get ( 'response_negative' );
$response_warning = Session::get ( 'response_warning' );

echo "<article class=\"response\">";
// output positive Rückmeldung
if (isset ( $response_positive )) {
	foreach ( $response_positive as $response ) {
		echo '<article style="background:green">' . $response . '</article>';
	}
}

// output negative Rückmeldung
if (isset ( $response_negative )) {
	foreach ( $response_negative as $response ) {
		echo '<article style="background:red">' . $response . '</article>';
	}
}

// output Warnung
if (isset ( $response_warning )) {
	foreach ( $response_warning as $response ) {
		echo '<article style="background:orange">' . $response . '</article>';
	}
}
echo "</article>";