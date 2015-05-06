
<?php
	
	echo 	"<h1>Raumplan anzeigen</h1>
			
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
	
	
	if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());

	for ($zeile = 1; $zeile <= 7; $zeile++) 
	{
		echo "<tr>";
		
		for ($spalte = 0; $spalte <= 7; $spalte++) 
		{
			if($spalte == 0 && ($stundenzeit = $this->stundenzeiten->fetch_assoc()))
			{
				$zeit_von = $stundenzeit['stdZeit_von'];
				$zeit_bis = $stundenzeit['stdZeit_bis'];
				echo "<td style='background:yellow'> $zeit_von - $zeit_bis </td>";
			}
			else
			{
				if($veranstTermin['stdZeit_ID'] == $zeile && $veranstTermin['tag_ID'] == $spalte)
				{
					$veranst_bezeichnung = $veranstTermin['veranst_bezeichnung'];
					echo "<td> $veranst_bezeichnung </td>";
					if($veranstTermin = $this->veranstaltungstermine->fetch_assoc());
				}
				else
				{
					//leerer Spalteneintrag:
					echo "<td> </td>";
				}
			}
		}
		
		echo "</tr>";
	}
	
	echo "</table>";

?>
