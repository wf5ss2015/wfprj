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
    <form action="bibliothekAnlegen.php" method="post"/>
		<div>
			<!-- Bezeichnung im Textfeld eingeben. -->
			Bezeichnung <input class="tf" type = "text" name = "bezeichnung" /><br>
			<!-- Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift. -->
			<p> Geb&auml;ude 
				<select name="gebäude">
				  <?php
					$sql = 'Select g.geb_bezeichnung, a.straßenname, a.hausnummer from gebaeude g join adresse a on g.geb_bezeichnung = a.geb_bezeichnung';
					$result = mysqli_query($con, $sql);
					while($row = mysqli_fetch_array($result)){
						echo "<option>"; echo $row['geb_bezeichnung']; echo " , "; 
						echo $row['straßenname']; echo " , "; 
						echo $row['hausnummer']; echo "</option>";
					}
				  ?>
				</select>
			</p>
			<!-- 
				dynamisch aus Tabelle Buchkategorie abfragen welche Kategorien es gibt
				um per Checkbox anzugeben welche Kategorien in der Bibliothek verfügbar sind.	
			-->
			<p>
				<?php
					$sql = 'Select buchKat_bezeichnung from Buchkategorie';
					$result = mysqli_query($con, $sql);
					while($row = mysqli_fetch_array($result)){
						echo $row['buchKat_bezeichnung']; 
						$BKAT_bez = $row['buchKat_bezeichnung']; 
						echo '<input type="checkbox" name="$BKAT_bez" value="1"><br>';
					}
				?>
			</p>
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