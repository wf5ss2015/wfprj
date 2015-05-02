<!--
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand:
	user story: Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<!--
	dynamisch aus Tabelle Ausstattung. Die im Raum vorhandene Ausstattung kann in Checkboxen und 
	Textfeldern für die Anzahl angegeben.
-->
<?php
	echo"<p>";
	if ($this->ausstattung_list){
		foreach($this->ausstattung_list as $key => $value){
			echo htmlentities($value->ausstattung_bezeichnung); 
			echo '<input type="checkbox" name="" value="1"> Anzahl:<input class="tf" type = "text" name = "1"/><br>'; 
		}
	} else{
		echo "Es ist ein Fehler aufgetretten.";
	}		
	echo"</p>";
?>