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

<!-- Formular zur Auswahl eines verfügbaren Raumes: -->

<article>
	<h1>Raum einer Veranstaltung zuweisen</h1>

	<h3 style='color: red'>Folgende R&aumlume sind zu dieser Zeit mit der
		erforderlichen Ausstattung verf&uumlgbar:</h3>

	<form action="index.php?url=raumZuweisen/anlegen_veranstaltungstermin"
		method="post"
		style='background-color: #eeeeff; width: 25em; margin: 20px; padding: 25px; border: 1px solid silver;'>

		<p>
			<select class='input' name='waehleRaum' size='5' style='width: 20em'>
			
			<?php
			
			// ---------- alle Vorlesungsräume anzeigen: ----------
			echo "<optgroup label='" . utf8_encode ( 'Vorlesungsräume' ) . "'>";
			
			// alle verfügbare Vorlesungsräume in Option-List anzeigen:
			
			foreach ( $this->verfuegbareVorlesungsraeume as $vorlesungsraum ) {
				$raum_bezeichnung = $vorlesungsraum ['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			// ---------- alle Laborräume anzeigen: ----------
			
			echo "<optgroup label='" . utf8_encode ( 'Laborräume' ) . "'>";
			
			// alle verfügbare Laborräume in Option-List anzeigen:
			
			foreach ( $this->verfuegbareLaborraeume as $laborraum ) {
				$raum_bezeichnung = $laborraum ['raum_bezeichnung'];
				$lArt_bezeichnung = $laborraum ['lArt_bezeichnung'];
				
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung ($lArt_bezeichnung)</option>";
			}
			
			echo "</optgroup>";
			
			?>
			
		</select>
		</p>

		<input type="submit" name="send" value="Raum zuweisen" />

	</form>
</article>