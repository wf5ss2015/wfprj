<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				22.04.2015
	- Sprint: 				2
	
	--------------------------------------------------
	
	- User Story (Nr. 160): Als Mitarbeiter möchte ich einer Veranstaltung einen Raum unter Berücksichtigung 
							der Ausstattung zuordnen können.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	//////////////////////////////////////////////////
	
	- User-Story (Nr. 20a): Als Mitarbeiter möchte ich einer Veranstaltung einen Raum manuell zuordnen können.  
							(Berücksichtigung der Zeit)
	- User Story Punkte:	13
	- User Story Aufwand:	4h
-->						


<h1>Raum einer Veranstaltung zuweisen</h1>

<h3 style='color: red'>Folgende R&aumlume sind zu dieser Zeit mit der erforderlichen Ausstattung verf&uumlgbar: </h3>

<form action="index.php?url=raumZuweisen/anlegen_veranstaltungstermin" method="post" style='background-color: #eeeeff; width: 25em; margin: 20px; padding: 25px; border: 1px solid silver;'>
	
	<p>
		<select class='input' name='waehleRaum' size='5' style='width: 20em'>
			
			<?php
			
			// ---------- alle Vorlesungsräume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Vorlesungsräume')."'>";
		
			//erzeugt die Liste mit "option"-HTML-Elementen aus dem Array verfuegbareVorlesungsraeume
			
			foreach ($this->verfuegbareVorlesungsraeume as $vorlesungsraum) 
			{
				$raum_bezeichnung = $vorlesungsraum['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			
			// ---------- alle Laborräume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Laborräume')."'>";
		
			//erzeugt die Liste mit "option"-HTML-Elementen aus dem Array verfuegbareLaborraeume
			
			foreach ($this->verfuegbareLaborraeume as $laborraum) 
			{
				$raum_bezeichnung = $laborraum['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			?>
			
		</select>
	</p>
	
	<input type="submit" name="send" value="Raum zuweisen"/>
	
</form>