<?php 
 
/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				24.06.2015
	
	- User Story (Nr. 590):	Als Mitarbeiter möchte ich einen Veranstaltungstermin ändern können.
	- User Story Punkte:	5
	- Task:					View für Zeit-Änderung eines Termins erstellen.
	- Zeitaufwand:			1.5h
*/
 
?> 				

<!-- Formular zur Auswahl von Veranstaltung, Wochentag und Stundenzeit: -->


<article>

<?php

$studiengang = utf8_encode($this->studiengang);

echo "<h1>Veranstaltungstermin &auml;ndern (Fachsemester $this->fachsemester, $studiengang):</h1>";
?>

<form class="formular" action="index.php?url=veranstaltungsterminUebersicht/verarbeiteAenderungen" method="post" style='width: 33em; height: 22em; margin-left: 20px; padding: 8px;'>
	
	<p style='margin-left: 20px;'> 
		<?php
		
		echo "<h3 style='color: #00436A;'>aktuelle Daten des Termins f&uuml;r $this->veranst_bezeichnung: </h3>";
		
		echo "	<ul>
					<li>Tag: $this->tag_bezeichnung</li>
					<li>Stundenzeit: $this->stundenzeit</li>
					<li>Raum: $this->raum_bezeichnung</li>
				</ul>";
		?>
	</p>
	
	<h3 style='color: #A9DFFF; text-align: center; background: #00436A;'>Zeit des Termins &auml;ndern:</h3>
	
	<p style='margin-left: 20px;'>
		<label for='wochentag' style='width:7em; display:block; float:left; '> Wochentag: </label>
		<select class='input' name='waehleWochentag' id='wochentag' style='width: 17em'>
			<?php
		
			//alle Wochentage in Option-List anzeigen:
			
			foreach ($this->wochentage as $tag) 
			{
				$tag_bezeichnung = $tag['tag_bezeichnung'];
				$tag_ID = $tag['tag_ID'];
				
				//aktueller Tag des zu ändernden Veranstaltungstermins soll selektiert werden:
				if(Session::get('tag_ID') == $tag_ID) 
					echo "<option value='$tag_ID' selected>$tag_bezeichnung</option>";
				else
					echo "<option value='$tag_ID'>$tag_bezeichnung</option>";
			}
			?>
		</select>
	</p>
	
	<p style='margin-left: 20px;'>
		<label for='stundenzeit' style='width:7em; display:block; float:left;'> Stundenzeit:</label>
		<select class='input' name='waehleZeit' id='stundenzeit' style='width: 17em'>
			<?php
		
			//alle Stundenzeiten in Option-List anzeigen:
			
			foreach ($this->stundenZeiten as $stundenzeit) 
			{
				$zeitVon = $stundenzeit['stdZeit_von'];
				$zeitBis = $stundenzeit['stdZeit_bis'];
				$id = $stundenzeit['stdZeit_ID'];	
				
				//aktuelle Stundenzeit des zu ändernden Veranstaltungstermins soll selektiert werden:
				if(Session::get('stdZeit_ID') == $id) 
					echo "<option value='$id' selected>$zeitVon - $zeitBis</option>";
				else
					echo "<option value='$id'>$zeitVon - $zeitBis</option>";
			}
			?>
		</select>
	</p>
	
	<p class="btn">
		<input class="button" type="submit" name="send" value="weiter"/> 
	</p> 
	
</form>