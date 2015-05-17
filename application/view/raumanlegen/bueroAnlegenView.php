<!--
      autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	version: 02
	sprint: 02
	zeitaufwand: 0,5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<article>
	<h1>B&uuml;ro anlegen</h1>
	<!-- saveRaum-function im Controller wird ausgeführt nach der Bestätigung -->
	<form action="index.php?url=raumAnlegen/saveRaum" method="post" />
	<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
			include 'raumStammdaten.php';
			?>
			<input type="hidden" name="raumtyp" value="buero" />
	<p>
			<?php
			echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="bueroAnlegen" value="Büro anlegen"></a>
	</p>
	</form>
</article>