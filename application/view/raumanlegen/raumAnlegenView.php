<?php
/*
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
	
	Startpage, in der man die Raumkategorie auswählt, die man anlegen möchte.
*/
?>

<article>
	<h1>Raumkategorie auswählen</h1>

	<!-- raumSelected-function des Controllers wird ausgeführt nach der Bestätigung -->
	<form action="index.php?url=raumAnlegen/raumSelected" method="post" />
	<input type="radio" name="typ" id="vorlesungsraum"
		value="vorlesungsraum">Vorlesungsraum<br> <input type="radio"
		name="typ" id="buero" value="buero">B&uuml;ro<br> <input type="radio"
		name="typ" id="labor" value="labor">Labor<br> <input type="radio"
		name="typ" id="bibliothek" value="bibliothek">Bibliothek<br>
	<p>
		<input type="submit" id="b1" value="weiter"></a>
	</p>
	</form>
	<?php 
		//Error Handling
		$this->renderResponse(); 
	?>
</article>
