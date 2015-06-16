<?php
/*
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand: 1
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
*/
/*
	dynamisch aus Tabelle Ausstattung. Die im Raum vorhandene Ausstattung kann in Checkboxen und 
	Textfeldern für die Anzahl angegeben.
*/
/*
echo '<script type=text/javascript>function textfeldErzeugen() {if('; echo htmlentities( $value->ausstattung_bezeichnung ); echo '.checked){<th>Anzahl:<input class="tf" type = "text" name = "';
echo htmlentities ( $value->ausstattung_bezeichnung );
echo 'Anzahl"/></th>}}</script>';
*/
echo "<p>";
$data_ausstattung = array ();
echo '<table style="border: 0px; text-align: left; font-weight: lighter;">';
if ($this->ausstattung_list) {
	foreach ( $this->ausstattung_list as $key => $value ) {
		echo '<tr><th>';
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo '</th><th><input type="checkbox" name="';
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo '" value="';
		echo htmlentities ( $value->ausstattung_ID );
		echo '"></th><th>Anzahl: <input class="tf" type = "text" name = "';
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo 'Anzahl"/></th></tr>';
		array_push ( $data_ausstattung, htmlentities ( $value->ausstattung_bezeichnung ) );
	}
echo '</table>';
} else {
	Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
}
echo "</p>";

?>