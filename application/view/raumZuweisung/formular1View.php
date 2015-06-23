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

<h1>Veranstaltungstermin erstellen</h1>

<?php
if(property_exists($this, 'verfuegbareVorlesungsraeume')) 
	echo "<div class='flexbox'>";
?>

<form class="formular" action="index.php?url=raumZuweisen/erzeugeFormular2" method="post" style='width: 28em; height: 21em; margin: 20px; padding: 25px;'>
	
	<h4 style='color: #00436A'>1) Veranstaltung und Zeit f&uuml;r Termin ausw&auml;hlen:</h4> <br/>
	
	<p>
		<label for='veranstaltung' style='width:8em; display:block; float:left'> Veranstaltung: </label>
		<select class='input' name='waehleVeranstaltung' id='veranstaltung' size='6' style='width: 22em'>
			<?php
		
			//alle Veranstaltungen in Option-List anzeigen:
			
			$studiengang = "";
			
			foreach ($this->veranstaltungen as $veranstaltung) 
			{
				$veranst_bezeichnung = $veranstaltung['veranst_bezeichnung'];
				$veranst_ID = $veranstaltung['veranst_ID'];
				$stg_bezeichnung = $veranstaltung['stg_bezeichnung'];
				$stg_kurztext = $veranstaltung['stg_kurztext'];
				$fachsemester = $veranstaltung['pflicht_im_Semester'];
				
				//verschachtelte Menüstruktur (mittels optgroup): z.B. Studiengang WF -> Veranstaltung WF1-Prog1
				
				if($studiengang == "")
				{
					$studiengang = $stg_bezeichnung;
					echo "<optgroup label='".utf8_encode($stg_bezeichnung)."'>";
				}
				else if($stg_bezeichnung != $studiengang)
				{
					$studiengang = $stg_bezeichnung;
					echo "</optgroup>";
					echo "<optgroup label='".utf8_encode($stg_bezeichnung)."'>";
				}
				else //immernoch derselbe Studiengang
				{
				}
				
				//wenn Auswahl bereits getroffen, soll ausgewählter Eintrag selektiert werden (selected):
				if(Session::get('veranst_ID') == $veranst_ID) 
					echo "<option value='$veranst_ID' selected>$stg_kurztext$fachsemester &nbsp; $veranst_bezeichnung</option>";
				else
					echo "<option value='$veranst_ID'>$stg_kurztext$fachsemester &nbsp; $veranst_bezeichnung</option>";
			}
			
			echo "</optgroup>";
			?>
		</select>
	</p>
	
	<p>
		<label for='wochentag' style='width:8em; display:block; float:left'> Wochentag: </label>
		<select class='input' name='waehleWochentag' id='wochentag' style='width: 22em'>
			<?php
		
			//alle Wochentage in Option-List anzeigen:
			
			foreach ($this->wochentage as $tag) 
			{
				$tag_bezeichnung = $tag['tag_bezeichnung'];
				$tag_ID = $tag['tag_ID'];
				
				//wenn Auswahl bereits getroffen, soll ausgewählter Eintrag selektiert werden (selected):
				if(Session::get('tag_ID') == $tag_ID) 
					echo "<option value='$tag_ID' selected>$tag_bezeichnung</option>";
				else
					echo "<option value='$tag_ID'>$tag_bezeichnung</option>";
			}
			?>
		</select>
	</p>
	
	<p>
		<label for='stundenzeit' style='width:8em; display:block; float:left'> Stundenzeit: </label>
		<select class='input' name='waehleZeit' id='stundenzeit' style='width: 22em'>
			<?php
		
			//alle Stundenzeiten in Option-List anzeigen:
			
			foreach ($this->stundenZeiten as $stundenzeit) 
			{
				$zeitVon = $stundenzeit['stdZeit_von'];
				$zeitBis = $stundenzeit['stdZeit_bis'];
				$id = $stundenzeit['stdZeit_ID'];	
				
				//wenn Auswahl bereits getroffen, soll ausgewählter Eintrag selektiert werden (selected):
				if(Session::get('stdZeit_ID') == $id) 
					echo "<option value='$id' selected>$zeitVon - $zeitBis</option>";
				else
					echo "<option value='$id'>$zeitVon - $zeitBis</option>";
			}
			?>
		</select>
	</p>
	
	<br />
	
	<p class="btn">
		<input class="button" type="submit" name="send" value="R&auml;ume anzeigen >>"/> 
	</p> 
	
</form>


