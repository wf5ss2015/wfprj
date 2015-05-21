<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student m�chte ich mir meinen Stundenplan anzeigen k�nnen.
	- User Story Punkte:	13
	- Task:					stundenplanIndividuellView anlegen
	- Zeitaufwand:			2h
*/
?>	

<article>

<?php
	
	//Tabelle, welche den Stundenplan darstellt:
	
	echo 	"<h1>Stundenplan f&uumlr User $this->nutzerName:</h1>
			
			<table border='1' width='80%' style='text-align: center'>
			<colgroup width='240' span='8'>
				<tr>
					<th style='background:yellow'>Stundenzeit</th>";

	//Wochentage im Tabellenkopf eintragen:
	foreach ($this->wochentage as $tag) 
	{
		$tag_bezeichnung = $tag['tag_bezeichnung'];
		
		echo "<th style='background:#FF00FF'>$tag_bezeichnung</th>";
	}
	
	echo "</tr>";
	echo "</colgroup>";
	
	
	//erster Veranstaltungstermin holen:
	if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());

	for ($stunde = 1; $stunde <= 7; $stunde++) 
	{
		//neue Zeile:
		echo "<tr>";
		
		for ($tag = 0; $tag <= 7; $tag++) 
		{
			if($tag == 0 && ($stundenzeit = $this->stundenzeiten->fetch_assoc()))
			{
				//Stundenzeit wird in der ersten Spalte der Zeile eingetragen:
				$zeit_von = $stundenzeit['stdZeit_von'];
				$zeit_bis = $stundenzeit['stdZeit_bis'];
				echo "<td style='background:yellow'> $zeit_von - $zeit_bis </td>";
			}
			else
			{
				/*	�berpr�fe, ob der Veranstaltungstermin in dieser Stunde ($stunde entspricht Zeile) 
					und an diesem Tag ($tag entspricht Spalte)
					stattfindet:
					
					-> JA: 		trage den Veranstaltungstermin in die Zelle ein und hole n�chsten Veranstaltungstermin
					-> NEIN: 	leerer Eintrag (solange, bis an richtiger Stunde bzw. Zeile und an richtigem Tag bzw. Spalte 
								angekommen)
				
				*/
				
				if($veranstTermin['stdZeit_ID'] == $stunde && $veranstTermin['tag_ID'] == $tag)
				{
					//Veranstaltungstermin in die Zelle eintragen:
					$veranst_bezeichnung = $veranstTermin['veranst_bezeichnung'];
					$raum_bezeichnung = $veranstTermin['raum_bezeichnung'];
					echo "<td> $veranst_bezeichnung ($raum_bezeichnung) </td>";
					
					//n�chster Veranstaltungstermin holen:
					if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());
				}
				else
				{
					//leerer Eintrag:
					echo "<td> </td>";
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo "</table>";
	?>
	
</article>



