<?php

/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand: 0,5
	user story(Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
*/
?>
<article>
	<h1>Vorlesungsraum anlegen</h1>
	<!-- saveRaum-function wird ausgeführt nach der Bestätigung -->
	<form action="index.php?url=raumAnlegen/saveRaum" method="post">
		<!-- includet das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
			include 'raumStammdatenView.php';
			?>
			<!-- includet Ausstattungsabfrage -->
			<?php
			include 'raumAusstattungView.php';
			?>
			<input type="hidden" name="raumtyp" value="vorlesungsraum">
		<p>
			<?php
				echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" name="anlegen" value="Vorlesungsraum anlegen">
		</p>
	</form>
</article>