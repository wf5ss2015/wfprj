<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 410):	Als Dozent/Student möchte ich mir einen Stundenplan für Fachsemester anzeigen können.
	- User Story Punkte:	13
	- Task:					formularView anlegen
	- Zeitaufwand:			2h
*/
?>				

<?php $this->renderResponse(); ?>

<article>

<h1>Stundenplan nach Fachsemester anzeigen</h1>

<form action="index.php?url=stundenplan/stundenplan_fachsemester" method="post" style='background-color: #eeeeff; width: 28em; margin: 20px; padding: 25px; border: 1px solid silver;'>
	
	<h3 style='color: blue'>Studiengang und Fachsemester ausw&aumlhlen: </h3>
	
	<p>
		<label for='studiengang' style='width:8em; display:block; float:left'> Studiengang: </label>
		<select class='input' name='waehleStudiengang' id='studiengang' size='4' style='width: 22em'>
			<?php
		
			//alle Studiengänge in Option-List anzeigen:
			
			foreach ($this->studiengaenge as $studiengang) 
			{
				$stg_ID = $studiengang['stg_ID'];
				$stg_bezeichnung = $studiengang['stg_bezeichnung'];
				
				echo "<option value='$stg_ID'>$stg_bezeichnung</option>";
			}
			?>
		</select>
	</p>
	
	<p>
		<label for='fachsemester' style='width:8em; display:block; float:left'> Fachsemester: </label>
		<select class='input' name='waehleFachsemester' id='fachsemester' size='4' style='width: 22em'>
			<?php
		
			//alle Fachsemester in Option-List anzeigen:
			
			for($fachsemester=1; $fachsemester<=7; $fachsemester++) 
			{
				echo "<option value='$fachsemester'>$fachsemester</option>";
			}
			?>
		</select>
	</p>

	<input type="submit" name="send" value="zeige Stundenplan"/>
	
</form>

</article>