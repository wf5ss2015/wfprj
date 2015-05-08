<!--
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand: 1
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<!--
	dynamisch aus Tabelle Ausstattung. Die im Raum vorhandene Ausstattung kann in Checkboxen und 
	Textfeldern für die Anzahl angegeben.
-->
<?php
echo "<p>";
$data_ausstattung = array ();
if ($this->ausstattung_list) {
	foreach ( $this->ausstattung_list as $key => $value ) {
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo '<input type="checkbox" name="';
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo '" value="';
		echo htmlentities ( $value->ausstattung_ID );
		echo '"> Anzahl:<input class="tf" type = "text" name = "';
		echo htmlentities ( $value->ausstattung_bezeichnung );
		echo 'Anzahl"/><br>';
		array_push ( $data_ausstattung, htmlentities ( $value->ausstattung_bezeichnung ) );
	}
} else {
	echo "Es ist ein Fehler aufgetretten.";
}
echo "</p>";

?>