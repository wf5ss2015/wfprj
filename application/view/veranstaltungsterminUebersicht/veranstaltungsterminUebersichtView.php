<?php
/*	---------- SPRINT 6 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				24.06.2015
	
	- User Story (Nr. 590):	Als Mitarbeiter möchte ich einen Veranstaltungstermin ändern können.
	- User Story Punkte:	5
	- Task:					View erstellen zum Anzeigen aller Veranstaltungstermine eines Fachsemesters 
							mit Optionen ändern und löschen.
	- Zeitaufwand:			3h
*/
?>	


<?php

	if(! property_exists($this, 'veranst_bezeichnung')) 
	{
		echo "<article>";
		echo "<h1>Veranstaltungstermine von Fachsemester $this->fachsemester, $this->studiengang:</h1>";
	}
	else
	{
		echo "	<br />
				<br /> ";
	}

	//Tabelle, welche den Stundenplan darstellt:
			
	echo 	"<table class='stundenplan' border='1'>
				<tr class='head'>
					<th style='width: 110px;'>Stundenzeit</th>";

	//Wochentage im Tabellenkopf eintragen:
	foreach ($this->wochentage as $tag) 
	{
		$tag_bezeichnung = $tag['tag_bezeichnung'];
		
		echo "<th style='width: 130px;'>$tag_bezeichnung</th>";
	}
	
	echo "</tr>";
	
	
	//erster Veranstaltungstermin holen:
	if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());

	for ($stunde = 1; $stunde <= 7; $stunde++) 
	{
		//neue Zeile:
		echo "<tr>";
		
		for ($tag = 0; $tag <= 6; $tag++) 
		{
			if($tag == 0 && ($stundenzeit = $this->stundenzeiten->fetch_assoc()))
			{
				//Stundenzeit wird in der ersten Spalte der Zeile eingetragen:
				$zeit_von = $stundenzeit['stdZeit_von'];
				$zeit_bis = $stundenzeit['stdZeit_bis'];
				echo "<td class='content' style='text-align:center;'><p> $zeit_von - $zeit_bis </p></td>";
			}
			else
			{
				/*	überprüfe, ob der Veranstaltungstermin in dieser Stunde ($stunde entspricht Zeile) 
					und an diesem Tag ($tag entspricht Spalte)
					stattfindet:
					
					-> JA: 		trage den Veranstaltungstermin in die Zelle ein und hole nächsten Veranstaltungstermin
					-> NEIN: 	leerer Eintrag (solange, bis an richtiger Stunde bzw. Zeile und an richtigem Tag bzw. Spalte 
								angekommen)
				
				*/
				
				if($veranstTermin['stdZeit_ID'] == $stunde && $veranstTermin['tag_ID'] == $tag)
				{
					//Veranstaltungstermin in die Zelle eintragen:
					$veranst_ID = $veranstTermin['veranst_ID'];
					$veranst_bezeichnung = $veranstTermin['veranst_bezeichnung'];
					$veranst_kurztext = $veranstTermin['veranst_kurztext'];
					$dozent = utf8_encode($veranstTermin['nachname']);
					$tag_ID = $veranstTermin['tag_ID'];
					$stdZeit_ID = $veranstTermin['stdZeit_ID'];
					$raum_bezeichnung = $veranstTermin['raum_bezeichnung'];
					
					echo "<td class='content' style='padding-left: 13px;'> 
							</br>
							<strong>$veranst_kurztext</strong> <br />
							&#8227; $raum_bezeichnung <br />";
							if($dozent)
								echo "&#8227; $dozent"; 
					
					//Formular mit Button zum Löschen und Bearbeiten platzieren (mit hidden values):
					echo "<form class='formular' style='width: 95px;' action='index.php?url=veranstaltungsterminUebersicht/bearbeiteVeranstaltungstermin' method='post'>";
						
						//hidden values:
						echo "<input type='hidden' name='veranst_ID' value='$veranst_ID'>";
						echo "<input type='hidden' name='veranst_bezeichnung' value='$veranst_bezeichnung'>";
						echo "<input type='hidden' name='tag_ID' value='$tag_ID'>";
						echo "<input type='hidden' name='tag_bezeichnung' value='$tag_bezeichnung'>";
						echo "<input type='hidden' name='stdZeit_ID' value='$stdZeit_ID'>";
						echo "<input type='hidden' name='raum_bezeichnung' value='$raum_bezeichnung'>";
							
						echo "<input class='btnLink' type='submit' name='send' value='".utf8_encode("ändern")."'> / ";
						echo "<input class='btnLink' type='submit' name='send' value='".utf8_encode("löschen")."'>";
						
					echo "</form>";
					echo "</td>";
					
					//nächster Veranstaltungstermin holen:
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
	
	<br/>
	
	<div style="margin-left:20px;">
	<form>
		<input class="button" type="button" value=<?php echo utf8_encode("zurück")?> onclick="window.location.href='index.php?url=veranstaltungsterminUebersicht/erzeugeFormular'" />
	</form>
	</div>
	
	<br/>
	
</article>



