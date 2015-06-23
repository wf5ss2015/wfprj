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

<!-- Formular zur Änderung von Wochentag und Stundenzeit: -->


<article>

<?php
echo "<h1>Veranstaltungstermin &auml;ndern (Fachsemester $this->fachsemester, $this->studiengang):</h1>";
?>

<form action="index.php?url=veranstaltungsterminUebersicht/aendereVeranstaltungstermin" method="post" style='background: #A9DFFF; width: 32em; height: 20em; margin-left: 20px; padding: 8px; border: 1px solid silver;'>
	
	<p style='margin-left: 20px;'> 
		<?php
		
		$tagGeaendert = "unver&auml;ndert";
		$stundenzeitGeaendert = "unver&auml;ndert";
		
		if($this->tag_bezeichnung == $this->tagBez_aenderung)
		{}
		else
			$tagGeaendert = "&Auml;nderung";
			
		if($this->stundenzeit == $this->stundenzeit_aenderung)
		{}
		else
			$stundenzeitGeaendert = "&Auml;nderung";
			
		echo "<b>aktuelle Daten des Termins f&uuml;r $this->veranst_bezeichnung: </b>";
		
		echo "	<ul>
					<li>Tag: $this->tagBez_aenderung (<em style='color:red;'>$tagGeaendert</em>)</li>
					<li>Stundenzeit: $this->stundenzeit_aenderung (<em style='color:red;'>$stundenzeitGeaendert</em>)</li>
					<li>Raum: $this->raum_bezeichnung</li>
				</ul>";
		?>
	</p>
	
	<h4 style='color: #A9DFFF; text-align: center; background: #00436A;'>Raum &auml;ndern:</h4>
		
	<p style="text-align:center;">

		<select class='input' name='waehleRaum' size='7' style='width: 20em'>
			
			<?php
			
			// ---------- alle Vorlesungsräume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Vorlesungsräume')."'>";
		
			//alle verfügbare Vorlesungsräume in Option-List anzeigen:
			
			foreach ($this->verfuegbareVorlesungsraeume as $vorlesungsraum) 
			{
				$raum_bezeichnung = $vorlesungsraum['raum_bezeichnung'];
				
				//aktueller Raum des zu ändernden Veranstaltungstermins soll selektiert werden:
				if(Session::get('raum_bezeichnung') == $raum_bezeichnung) 
					echo "<option value='$raum_bezeichnung' selected>$raum_bezeichnung</option>";
				else
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
				
				//aktueller Raum des zu ändernden Veranstaltungstermins soll selektiert werden:
				if(Session::get('raum_bezeichnung') == $raum_bezeichnung) 
					echo "<option value='$raum_bezeichnung' selected>$raum_bezeichnung ($lArt_bezeichnung)</option>";
				else
					"<option value='$raum_bezeichnung'>$raum_bezeichnung ($lArt_bezeichnung)</option>";
			}
			
			echo "</optgroup>";
			
			?>
			
		</select>
	</p>
	
	<p class="btn">
		<input class="button" type="submit" name="send" value="&Auml;nderungen speichern"/> 
	</p> 
	
</form>