<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 340): Als Entwickler möchte ich im MVC-Pattern programmieren können.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: View erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden
	
	//////////////////////////////////////////////////
-->

<!-- Formular zur Auswahl von Veranstaltung, Wochentag und Stundenzeit: -->

<article>
	<h1>Raum einer Veranstaltung zuweisen</h1>
	<h3 style='color: red'>Bitte Veranstaltung, Wochentag und Stundenzeit
		ausw&aumlhlen:</h3>
	<form action="index.php?url=raumZuweisen/erzeugeFormular2"
		method="post"
		style='background-color: #eeeeff; width: 32em; margin: 20px; padding: 25px; border: 1px solid silver;'>
		<p>
			<label for='veranstaltung'
				style='width: 8em; display: block; float: left'> Veranstaltung: </label>
			<select class='input' name='waehleVeranstaltung' id='veranstaltung'
				size='4' style='width: 22em'>
			<?php
			
			// alle Veranstaltungen in Option-List anzeigen:
			foreach ( $this->veranstaltungen as $veranstaltung ) {
				$veranst_bezeichnung = $veranstaltung ['veranst_bezeichnung'];
				$veranst_ID = $veranstaltung ['veranst_ID'];
				
				echo "<option value='$veranst_ID'>$veranst_bezeichnung</option>";
			}
			?>
		</select>
		</p>
		<p>
			<label for='wochentag'
				style='width: 8em; display: block; float: left'> Wochentag: </label>
			<select class='input' name='waehleWochentag' id='wochentag'
				style='width: 22em'>
			<?php
			
			// alle Wochentage in Option-List anzeigen:
			
			foreach ( $this->wochentage as $tag ) {
				$tag_bezeichnung = $tag ['tag_bezeichnung'];
				$tag_ID = $tag ['tag_ID'];
				
				echo "<option value='$tag_ID'>$tag_bezeichnung</option>";
			}
			?>
		</select>
		</p>
		<p>
			<label for='stundenzeit'
				style='width: 8em; display: block; float: left'> Stundenzeit: </label>
			<select class='input' name='waehleZeit' id='stundenzeit'
				style='width: 22em'>
			<?php
			
			// alle Stundenzeiten in Option-List anzeigen:
			
			foreach ( $this->stundenZeiten as $stundenzeit ) {
				$zeitVon = $stundenzeit ['stdZeit_von'];
				$zeitBis = $stundenzeit ['stdZeit_bis'];
				$id = $stundenzeit ['stdZeit_ID'];
				
				echo "<option value='$id'>$zeitVon - $zeitBis</option>";
			}
			?>
		</select>
		</p>
		<input type="submit" name="send" value="zeige Räume" />
	</form>
</article>