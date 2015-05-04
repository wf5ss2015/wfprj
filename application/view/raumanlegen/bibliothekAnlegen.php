<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	version: 02
	sprint: 02
	zeitaufwand: 0,5
	user story: Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<html>
<head>
    <title>Bibliothek anlegen</title>
</head>
<body> 
    <header>
        <h1>Bibliothek anlegen</h1>
    </header>
	<!-- bibliothekAnlegen.php wird ausgeführt nach der Bestätigung -->
    <form action="index.php?url=raumAnlegen/saveRaum" method="post"/>
		<div>
			<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
				include 'raumStammdaten.php';
			?>
			<!-- 
				dynamisch aus Tabelle Buchkategorie abfragen welche Kategorien es gibt
				um per Checkbox anzugeben welche Kategorien in der Bibliothek verfügbar sind.	
			-->
			<p>	Folgende Buchkategorien liegen in der Bibliothek vor: <br>
				<?php
					if ($this->buchKat_list){
						echo "<p>";
						foreach($this->buchKat_list as $key => $value){
							echo htmlentities($value->buchKat_bezeichnung); 
							echo '<input type="checkbox" name="" value="1"><br>'; 
						}
						echo "</p>";
					} else{
							echo "Es ist ein Fehler aufgetretten.";
					}
				?>	
			</p>
			<input type="hidden" name="raumtyp" value="bibliothek"/>
		</div>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="bibAnlegen" value="Bibliothek anlegen"></a>
		</p>
    </form>
</body>
</html>