<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5
	zeitaufwand: 1
	user story (Nr. 440a): Als Student möchte ich Informationen zu meinem Studiengang einsehen können.
*/
?>
	<article>
		<h1>Studiengang-Information</h1>
		<?php	
			// übergebenes Array studiengang (studiengang des aktuell eingeloggten Studenten) wird genutzt um Studenganginformation anzuzeigen
			if ($this->studiengang) {
				foreach ( $this->studiengang as $key => $value ) {
						// Studiengang als Überschrift
						echo '<h3>';
						echo htmlentities ( $value->stg_bezeichnung );
						echo '</h3>';
						// Studenganginformationen in Form von Bild und Text anzeigen
						$stg_bezeichnung = htmlentities ( $value->stg_bezeichnung );
						echo '<p><img src="../application/view/information/Content/'.$stg_bezeichnung.'.jpg" alt="Studenganginformation '.$stg_bezeichnung.'"></p>';
						/* Optional kann auch ein Text (.txt-Datei) eingebunden werden
						 * echo '<p><object data="../application/view/information/Content/'.$stg_bezeichnung.'.txt" type="text/plain" width=100% height="500px" ></object></p><br>'; 
						 */
					}
			}
			echo '<br><input class="button" type="button" value="Zurück" onClick="history.back();">';
		?>
	</article>
