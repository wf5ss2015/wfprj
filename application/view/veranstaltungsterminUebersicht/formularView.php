<?php
/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				24.06.2015
	
	- User Story (Nr. 590):	Als Mitarbeiter m�chte ich einen Veranstaltungstermin �ndern k�nnen.
	- User Story Punkte:	5
	- Task:					View erstellen zur Auswahl von Studiengang und Fachsemester.
	- Zeitaufwand:			1h
*/
?>				

<article>

<h1>Veranstaltungstermine nach Fachsemester anzeigen</h1>

<form class="formular" action="index.php?url=veranstaltungsterminUebersicht/stundenplan_fachsemester" method="post" style='width: 35em; height: 24em; margin: 20px; padding: 25px;'>
	
	<h3 style="color: #00436A;">Studiengang und Fachsemester ausw&aumlhlen: </h3>
	
	<p>
		<label for='studiengang' style='width:8em; display:block; float:left;'> Studiengang: </label>
		<select class='input' name='waehleStudiengang' id='studiengang' size='4' style='width: 31em'>
			<?php
		
			//alle Studieng�nge in Option-List anzeigen:
			
			foreach ($this->studiengaenge as $studiengang) 
			{
				$stg_ID = $studiengang['stg_ID'];
				$stg_bezeichnung = utf8_encode($studiengang['stg_bezeichnung']);
				
				echo "<option value='$stg_ID'>$stg_bezeichnung</option>";
			}
			?>
		</select>
	</p>
	
	<p>
		<label for='fachsemester' style='width:8em; display:block; float:left'> Fachsemester: </label>
		<select class='input' name='waehleFachsemester' id='fachsemester' size='4' style='width: 31em'>
			<?php
		
			//alle Fachsemester in Option-List anzeigen:
			
			for($fachsemester=1; $fachsemester<=7; $fachsemester++) 
			{
				echo "<option value='$fachsemester'>$fachsemester</option>";
			}
			?>
		</select>
	</p>

	<p class="btn">
		<input class="button" type="submit" name="send" value="zeige Termine"/>
	</p>
	
</form>

</article>