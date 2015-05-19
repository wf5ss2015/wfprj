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
// Bezeichnung im Textfeld eingeben.
echo "<p>Bezeichnung";
echo '<input class="tf" type = "text" name = "bezeichnung"><br></p>';
// Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift.
echo "<p> Geb&auml;ude";
echo '<select name="gebäude">';
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
	echo "Es ist ein Fehler aufgetretten.";
}
echo '</select></p>';

?>