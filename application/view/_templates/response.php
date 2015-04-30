<?php
// holt sich die Rückmeldung aus Session
$response_positive = Session::get('response_positive');
$response_negative = Session::get('response_negative');
$response_warning = Session::get('response_warning');


// output positive Rückmeldung
if (isset($response_positive)) {
    foreach ($response_positive as $response) {
        echo '<div style="background:green">'.$response.'</div>';
    }
}

// output negative Rückmeldung
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
