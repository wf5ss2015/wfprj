<?php

/*
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 02
	zeitaufwand: 0,5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
*/
?>
<article>
	<h1>Bibliothek anlegen</h1>

	<!-- saveRaum-function wird ausgeführt nach der Bestätigung -->
	<form action="index.php?url=raumAnlegen/saveRaum" method="post" />

	<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
			include 'raumStammdatenView.php';
			?>
			<!-- 
				dynamisch aus Tabelle Buchkategorie abfragen welche Kategorien es gibt
				um per Checkbox anzugeben welche Kategorien in der Bibliothek verfügbar sind.	
			-->
	<p>
		Folgende Buchkategorien liegen in der Bibliothek vor: <br>
				<?php
				if ($this->buchKat_list) {
					echo "<table>";
					foreach ( $this->buchKat_list as $key => $value ) {
						echo '<tr><th>';
						echo htmlentities ( $value->buchKat_bezeichnung );
						echo '</th><th><input type="checkbox" name="';
						echo htmlentities ( $value->buchKat_bezeichnung );
						echo '" value="1"></th>';
						echo '</tr>';
					}
					echo "</table>";
				} else {
					echo "Es sind keine Buchkategorien in der Datenbank.";
				}
				?>	
			</p>
	<input type="hidden" name="raumtyp" value="bibliothek" />
	<p>
			<?php
			echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" name="bibAnlegen" value="Bibliothek anlegen"></a>
	</p>
	</form>
</article>