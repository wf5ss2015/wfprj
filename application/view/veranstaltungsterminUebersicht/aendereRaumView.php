<?php 
 
/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				24.06.2015
	
	- User Story (Nr. 590):	Als Mitarbeiter möchte ich einen Veranstaltungstermin ändern können.
	- User Story Punkte:	5
	- Task:					View für Raum-Änderung eines Termins erstellen.
	- Zeitaufwand:			1.5h
*/
 
?> 				

<!-- Formular zur Änderung von Wochentag und Stundenzeit: -->


<article>

<?php
echo "<h1>Veranstaltungstermin &auml;ndern (Fachsemester $this->fachsemester, $this->studiengang):</h1>";
?>

<form class="formular" action="index.php?url=veranstaltungsterminUebersicht/aendereVeranstaltungstermin" method="post" style='width: 33em; height: 24em; margin-left: 20px; padding: 8px;'>
	
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
			
		echo "<h3 style='color: #00436A;'>aktuelle Daten des Termins f&uuml;r $this->veranst_bezeichnung: </h3>";
		
		echo "	<ul>
					<li>Tag: $this->tagBez_aenderung (<em style='color:red;'>$tagGeaendert</em>)</li>
					<li>Stundenzeit: $this->stundenzeit_aenderung (<em style='color:red;'>$stundenzeitGeaendert</em>)</li>
					<li>Raum: $this->raum_bezeichnung</li>
				</ul>";
		?>
	</p>
	
	<h3 style='color: #A9DFFF; text-align: center; background: #00436A;'>Raum &auml;ndern:</h3>
		
	<p style="text-align:center;">

		<select class='input' name='waehleRaum' size='6' style='width: 20em'>
			
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