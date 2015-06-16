<?php
/*
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand: 0.5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
*/

// Für die Stammdaten, die jeder Raum hat
echo '<table style="border: 0px; text-align: left;"><tr>';
// Bezeichnung im Textfeld eingeben.
echo "<th>Bezeichnung</th>";
echo '<th><input class="tf" type = "text" name = "bezeichnung"></th></tr>';
// Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift.
echo "<tr> <th>Geb&auml;ude</th>";
echo '<th><select name="gebäude">';
if ($this->geb_list) {
	foreach ( $this->geb_list as $key => $value ) {
		echo "<option>";
		echo htmlentities ( $value->geb_bezeichnung );
		echo " , ";
		echo htmlentities ( $value->straßenname );
		echo " , ";
		echo htmlentities ( $value->hausnummer );
		echo "</option>";
	}	
} else {
	Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
}
echo '</select></th></tr></table>';

?>