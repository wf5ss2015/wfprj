<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 290):	Als Mitarbeiter/Dozent/Student m�chte ich mir Raumpl�ne anzeigen lassen k�nnen.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	- Task: View erstellen
	
	//////////////////////////////////////////////////
-->

<!-- Formular zur Auswahl eines Raumes, von welchem der Raumplan angezeigt werden soll: -->

<article>
	<h1>Raumplan anzeigen</h1>
	<h3 style='color: red'>Bitte Raum ausw&aumlhlen:</h3>
	<form action="index.php?url=raumplan/raumplanAnzeigen" method="post"
		style='background-color: #eeeeff; width: 28em; margin: 20px; padding: 25px; border: 1px solid silver;'>
		<p>
			<select class='input' name='waehleRaum' size='9' style='width: 25em'>			
			<?php
			// ---------- alle Vorlesungsr�ume anzeigen: ----------
			echo "<optgroup label='" . utf8_encode ( 'Vorlesungsr�ume' ) . "'>";
			
			// alle Vorlesungsr�ume in Option-List anzeigen:
			
			foreach ( $this->vorlesungsraeume as $vorlesungsraum ) {
				$raum_bezeichnung = $vorlesungsraum ['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			// ---------- alle Laborr�ume anzeigen: ----------
			
			echo "<optgroup label='" . utf8_encode ( 'Laborr�ume' ) . "'>";
			
			// alle Laborr�ume in Option-List anzeigen:
			
			foreach ( $this->laborraeume as $laborraum ) {
				$raum_bezeichnung = $laborraum ['raum_bezeichnung'];
				$lArt_bezeichnung = $laborraum ['lArt_bezeichnung'];
				
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung ($lArt_bezeichnung)</option>";
			}
			
			echo "</optgroup>";
			
			?>			
		</select>
		</p>
		<input type="submit" name="send" value="zeige Raumplan" />
	</form>
</article>