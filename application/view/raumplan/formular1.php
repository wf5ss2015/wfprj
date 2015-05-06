<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				22.04.2015
	- Sprint: 				2
	
	--------------------------------------------------
	
	- User Story (Nr. 160): Als Mitarbeiter m�chte ich einer Veranstaltung einen Raum unter Ber�cksichtigung 
							der Ausstattung zuordnen k�nnen.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	//////////////////////////////////////////////////
	
	- User-Story (Nr. 20a): Als Mitarbeiter m�chte ich einer Veranstaltung einen Raum manuell zuordnen k�nnen.  
							(Ber�cksichtigung der Zeit)
	- User Story Punkte:	13
	- User Story Aufwand:	4h
-->						


<h1>Raumplan anzeigen</h1>

<h3 style='color: red'>Bitte Raum ausw&aumlhlen: </h3>

<form action="index.php?url=raumplan/raumplanAnzeigen" method="post" style='background-color: #eeeeff; width: 28em; margin: 20px; padding: 25px; border: 1px solid silver;'>
	
	<p>
		<select class='input' name='waehleRaum' size='9' style='width: 25em'>
			
			<?php
			
			// ---------- alle Vorlesungsr�ume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Vorlesungsr�ume')."'>";
		
			//erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vorlesungsraeume
			
			foreach ($this->vorlesungsraeume as $vorlesungsraum) 
			{
				$raum_bezeichnung = $vorlesungsraum['raum_bezeichnung'];
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			
			
			// ---------- alle Laborr�ume anzeigen: ----------
			
			echo "<optgroup label='".utf8_encode('Laborr�ume')."'>";
		
			//erzeugt die Liste mit "option"-HTML-Elementen aus dem Array laborraeume
			
			foreach ($this->laborraeume as $laborraum) 
			{
				$raum_bezeichnung = $laborraum['raum_bezeichnung'];
				$lArt_bezeichnung = $laborraum['lArt_bezeichnung'];
				
				echo "<option value='$raum_bezeichnung'>$raum_bezeichnung ($lArt_bezeichnung)</option>";
			}
			
			echo "</optgroup>";
			
			?>
			
		</select>
	</p>

	<input type="submit" name="send" value="zeige Raumplan"/>
	
</form>