<?php
/*
    autor: Kris Klamser
    datum: 12.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04
	zeitaufwand: 0.5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.) -> Überarbeitung
	
	Endpage, wenn raum angelegt wurde.
*/
?>
<article>	
	<!-- Wenn Raum angelegt wurde gibt es zwei Optionen: zur Startseite zurück oder nächsten Raum anlegen -->
	<form action="index.php?url=raumAnlegen/raumAnlegen" method="post" />
		<input class="button" type="submit" id="b1" value="nächster Raum"></a>
	</form>
	<form action="index.php?url=index/index" method="post" />
		<input class="button" type="submit" id="b2" value="Startseite"></a>
	</form>
</article>
