<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student möchte ich mir meinen Stundenplan anzeigen können.
	- User Story Punkte:	13
	- Task:					stundenplanIndividuellView anlegen
	- Zeitaufwand:			2h
*/
?>	

<article>

<?php
	
	//Tabelle, welche den Stundenplan darstellt:

	echo 	"<h1>Stundenplan f&uumlr <strong style='color:red;'>$this->name</strong>:</h1>
			
			<table class='stundenplan' border='1'>
				<tr class='head'>
					<th style='width: 110px'>Stundenzeit</th>";

	//Wochentage im Tabellenkopf eintragen:
	foreach ($this->wochentage as $tag) 
	{
		$tag_bezeichnung = $tag['tag_bezeichnung'];
		
		echo "<th style='width: 113px'>$tag_bezeichnung</th>";
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
								(while-Schleife, da Überschneidungen möglich sind!)
					-> NEIN: 	leerer Eintrag (solange, bis an richtiger Stunde bzw. Zeile und an richtigem Tag bzw. Spalte 
								angekommen)
				
				*/
				
				if($veranstTermin['stdZeit_ID'] == $stunde && $veranstTermin['tag_ID'] == $tag)
				{
					while($veranstTermin['stdZeit_ID'] == $stunde && $veranstTermin['tag_ID'] == $tag)
					{
						//Veranstaltungstermin in die Zelle eintragen:
						$veranst_kurztext = $veranstTermin['veranst_kurztext'];
						$raum_bezeichnung = $veranstTermin['raum_bezeichnung'];
						$studiengang = $veranstTermin['stg_kurztext'];
						$semester = $veranstTermin['pflicht_im_Semester'];
						
						if(Session::get('user_role') == 1) //Student
						{
							$dozent = $veranstTermin['nachname'];
							
							echo "<td class='content' style='padding-left: 13px;'> 
									</br>
									<strong>$veranst_kurztext</strong> <br />
									&#8227; $studiengang$semester <br /> 
									&#8227; $raum_bezeichnung <br />";
									if($dozent)
										echo "&#8227; $dozent";  
							
						}
						else if(Session::get('user_role') == 2) //Dozent
						{
							echo "<td class='content' style='padding-left: 13px;'> 
									</br>
									<strong>$veranst_kurztext</strong> <br />
									&#8227; $studiengang$semester <br /> 
									&#8227; $raum_bezeichnung";
						}
					
						//nächster Veranstaltungstermin holen:
						if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());
					}
					
					echo "</td>";
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



