<?php
/*	---------- SPRINT 3 ----------
	
	- Autor:				Alexander Mayer
	- Datum: 				06.05.2015
	
	- User Story (Nr. 340): Als Entwickler möchte ich im MVC-Pattern programmieren können.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: View erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden
*/
?>			

<!-- Formular zur Auswahl eines verfügbaren Raumes: -->

<form class="formular" action="index.php?url=raumZuweisen/anlegen_veranstaltungstermin" method="post" style='width: 28em; height: 32em; margin: 20px; padding: 25px;'>
	
	<h3 style='color: #00436A'>2) Raum ausw&auml;hlen:</h3> <br/>
	
	<p style="text-align:center;">Folgende R&auml;ume sind zur ausgew&auml;hlten Zeit verf&uuml;gbar und erf&uuml;llen die erforderliche Ausstattung f&uuml;r die Veranstaltung: </p>
	
	<p style="text-align:center;">
		<select class='input' name='waehleRaum' size='7' style='width: 20em'>
			
			<?php
			
			// ---------- alle Vorlesungsräume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Vorlesungsräume')."'>";
		
			//alle verfügbare Vorlesungsräume in Option-List anzeigen:
			
			foreach ($this->verfuegbareVorlesungsraeume as $vorlesungsraum) 
			{
				$raum_bezeichnung = $vorlesungsraum['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			
			// ---------- alle Laborräume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Laborräume')."'>";
		
			//alle verfügbare Laborräume in Option-List anzeigen:
			
			foreach ($this->verfuegbareLaborraeume as $laborraum) 
			{
				$raum_bezeichnung = $laborraum['raum_bezeichnung'];
				$lArt_bezeichnung = $laborraum['lArt_bezeichnung'];
				
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung ($lArt_bezeichnung)</option>";
			}
			
			echo "</optgroup>";
			
			?>
			
		</select>
	</p>
	
	<br />
	
	<p class="btn">
		<input class="button" type="submit" name="send" value="Termin erstellen"/> <br /> 
	</p>
	
</form>

</div>

</article>