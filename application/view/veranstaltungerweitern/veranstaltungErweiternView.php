<?php
/*
    autor: Kris Klamser
    datum: 22.6.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 6
	zeitaufwand: 0.5
	user story (Nr. 560): Als Mitarbeiter möchte ich einer Veranstaltung einen Dozenten zuordnen können. (8 Pkt.)
	-> Erst muss Typ der Person ausgewählt werden: Dozent oder Student als Radiobutton
*/
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 0.5
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
*/
?>
<article>
	<h1>Person zu Veranstaltung hinzufügen</h1>
	<form action="index.php?url=veranstaltungErweitern/typSelected" method="post" />
	<input type="radio" name="typ" id="student" value="student">Student<br> 
	<input type="radio"	name="typ" id="dozent" value="dozent">Dozent<br><br> 
	<p>
		<input class="button" type="submit" id="b1" value="weiter"></a>
	</p>
	</form>
</article>
