<?php
/*
    autor: Kris Klamser
    datum: 12.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04
	zeitaufwand: 0.5
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
	
	Endpage, wenn veranstaltung erweitert wurde.
*/
?>

<article>
	<h3>Raum erfolgreich angelegt!</h3>
	
	<!-- Wenn Veranstaltung erweitert wurde gibt es zwei Optionen: zur Startseite zurück oder nächste Erweiterung -->
	<form action="index.php?url=veranstaltungErweitern/veranstaltungErweitern" method="post" />
		<input type="submit" id="b1" value="nächster Raum"></a>
	</form>
	<form action="index.php?url=index/index" method="post" />
		<input type="submit" id="b2" value="Startseite"></a>
	</form>
</article>
