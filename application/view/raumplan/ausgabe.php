<!-- ---------- Autor: Alexander Mayer ---------- 

	- Projekt: 				Lehrveranstaltungssoftware (WF5-WFPRJ)
	- Gruppe: 				01
	
	- Datum: 				06.05.2015
	- Sprint: 				3
	
	--------------------------------------------------
	
	- User Story (Nr. 290):	Als Mitarbeiter/Dozent/Student möchte ich mir Raumpläne anzeigen lassen können.
	- User Story Punkte:	13	
	- User Story Aufwand:	4h
	
	- Task: View erstellen
	
	//////////////////////////////////////////////////
-->

<!-- Tabelle, welche den Raumplan darstellt: -->

<?php
echo "<article><h1>Raumplan anzeigen</h1>
			
			<table border='1' width='80%' style='text-align: center'>
			<colgroup width='240' span='8'>
				<tr>
					<th style='background:yellow'>Stundenzeit</th>";

// Wochentage im Tabellenkopf eintragen:
foreach ( $this->wochentage as $tag ) {
	$tag_bezeichnung = $tag ['tag_bezeichnung'];
	
	echo "<th style='background:#FF00FF'>$tag_bezeichnung</th>";
}

echo "</tr>";
echo "</colgroup>";

// erster Veranstaltungstermin holen:
if ($veranstTermin = $this->veranstaltungstermine->fetch_assoc ())
	;

for($stunde = 1; $stunde <= 7; $stunde ++) {
	// neue Zeile:
	echo "<tr>";
	
	for($tag = 0; $tag <= 7; $tag ++) {
		if ($tag == 0 && ($stundenzeit = $this->stundenzeiten->fetch_assoc ())) {
			// Stundenzeit wird in der ersten Spalte der Zeile eingetragen:
			$zeit_von = $stundenzeit ['stdZeit_von'];
			$zeit_bis = $stundenzeit ['stdZeit_bis'];
			echo "<td style='background:yellow'> $zeit_von - $zeit_bis </td>";
		} else {
			/*
			 * überprüfe, ob der Veranstaltungstermin in dieser Stunde ($stunde entspricht Zeile)
			 * und an diesem Tag ($tag entspricht Spalte)
			 * stattfindet:
			 *
			 * -> JA: trage den Veranstaltungstermin in die Zelle ein und hole nächsten Veranstaltungstermin
			 * -> NEIN: leerer Eintrag (solange, bis an richtiger Stunde bzw. Zeile und an richtigem Tag bzw. Spalte
			 * angekommen)
			 *
			 */
			
			if ($veranstTermin ['stdZeit_ID'] == $stunde && $veranstTermin ['tag_ID'] == $tag) {
				// Veranstaltungstermin in die Zelle eintragen:
				$veranst_bezeichnung = $veranstTermin ['veranst_bezeichnung'];
				echo "<td> $veranst_bezeichnung </td>";
				
				// nächster Veranstaltungstermin holen:
				if ($veranstTermin = $this->veranstaltungstermine->fetch_assoc ())
					;
			} else {
				// leerer Eintrag:
				echo "<td> </td>";
			}
		}
	}
	
	echo "</tr>";
}

echo "</table></article>";

?>
