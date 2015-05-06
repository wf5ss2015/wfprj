<?php
/*===============================================
 Sprint: 3
 @author: Kilian Kraus
 Datum: 25.04.2015
 Zeitaufwand (in Stunden): 0.5
 User Story Nr.: 
 User Story: Als Entwickler m�chte ich einheitliche Fehlermeldungen haben.
 Task:  response template erstellen 
 ===============================================*/
 
// holt sich die R�ckmeldung aus Session
$response_positive = Session::get('response_positive');
$response_negative = Session::get('response_negative');
$response_warning = Session::get('response_warning');

echo "<div class=\"response\">";
// output positive R�ckmeldung
if (isset($response_positive)) {
    foreach ($response_positive as $response) {
        echo '<div style="background:green">'.$response.'</div>';
    }
}

// output negative R�ckmeldung
if (isset($response_negative)) {
    foreach ($response_negative as $response) {
        echo '<div style="background:red">'.$response.'</div>';
    }
}

// output Warnung
if (isset($response_warning)) {
    foreach ($response_warning as $response) {
        echo '<div style="background:orange">'.$response.'</div>';
    }
}
echo "</div>";
