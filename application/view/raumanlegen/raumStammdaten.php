<!--
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand:
	user story: Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<?php
			// Bezeichnung im Textfeld eingeben. 
			echo "Bezeichnung"; echo '<input class="tf" type = "text" name = "bezeichnung" /><br>';
			// Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift.
			echo "<p> Geb&auml;ude"; 
				echo '<select name="gebäude">';
					if ($this->geb_list){
						foreach($this->geb_list as $key => $value){
							echo "<option>"; echo htmlentities($value->geb_bezeichnung); echo " , "; 
							echo htmlentities($value->straßenname); echo " , "; 
							echo htmlentities($value->hausnummer); echo "</option>";
						}
					} else{
						echo "Es ist ein Fehler aufgetretten.";
					}
			echo '</select></p>';
			
?>