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

<!-- Formular zur Auswahl von Veranstaltung, Wochentag und Stundenzeit: -->


<article>

<?php
echo "<h1>Veranstaltungstermin &auml;ndern (Fachsemester $this->fachsemester, $this->studiengang):</h1>";
?>

<form action="index.php?url=veranstaltungsterminUebersicht/verarbeiteAenderungen" method="post" style='background: #A9DFFF; width: 32em; height: 16em; margin-left: 20px; padding: 8px; border: 1px solid silver;'>
	
	<p style='margin-left: 20px;'> 
		<?php
		echo "<b>aktuelle Daten des Termins f&uuml;r $this->veranst_bezeichnung: </b>";
		
		echo "	<ul>
					<li>Tag: $this->tag_bezeichnung</li>
					<li>Stundenzeit: $this->stundenzeit</li>
					<li>Raum: $this->raum_bezeichnung</li>
				</ul>";
		?>
	</p>
	
	<h4 style='color: #A9DFFF; text-align: center; background: #00436A;'>Zeit des Termins &auml;ndern:</h4>
	
	<p style='margin-left: 20px;'>
		<label for='wochentag' style='width:7em; display:block; float:left; '> Wochentag: </label>
		<select class='input' name='waehleWochentag' id='wochentag' style='width: 22em'>
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
		<select class='input' name='waehleZeit' id='stundenzeit' style='width: 22em'>
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