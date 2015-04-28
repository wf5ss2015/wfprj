
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
    <title>Labor anlegen</title>
</head>
<body> 
    <header>
        <h1>Labor/Werkstatt anlegen</h1>
    </header>
	<!-- laborAnlegen.php wird ausgeführt nach der Bestätigung -->
    <form action="laborAnlegen.php" method="post"/>
		<div>
			Bezeichnung <input class="tf" type = "text" name = "bezeichnung" /><br>
			<!-- Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift. -->
			<p> Geb&auml;ude 
				<select name="gebäude">
				  <?php
					$sql = 'Select g.geb_bezeichnung, a.straßenname, a.hausnummer from gebaeude g join adresse a on g.geb_bezeichnung = a.geb_bezeichnung';
					$result = mysqli_query($database, $sql);
					while($row = mysqli_fetch_array($result)){
						echo "<option>"; echo $row['geb_bezeichnung']; echo " , "; 
						echo $row['straßenname']; echo " , "; 
						echo $row['hausnummer']; echo "</option>";
					}
				  ?>
				</select>
			</p>
			<!--
				dynamisch aus Tabelle Laborart nach der zutreffenden Laborart abfragen
			-->
			<p>	Laborart 
				<select name = "laborart">
					<?php
						$sql = 'Select lArt_ID, lArt_bezeichnung from Laborart';
						$result = mysqli_query($database, $sql);
						while($row = mysqli_fetch_array($result)){
							echo "<option>"; echo $row['lArt_ID']; echo " , "; 
							echo $row['lArt_bezeichnung']; echo "</option>";
						}
					?>
				</select>	
			</p>
			<!--
				dynamisch aus Tabelle Ausstattung. Die im Raum vorhandene Ausstattung kann in Checkboxen und 
				Textfeldern für die Anzahl angegeben.
			-->
			<p>
				<?php
					$sql = 'Select ausstattung_bezeichnung from Ausstattung';
					$result = mysqli_query($database, $sql);
					while($row = mysqli_fetch_array($result)){
						echo $row['ausstattung_bezeichnung']; 
						$bez = $row['ausstattung_bezeichnung']; 
						echo ' <input type="checkbox" name="$bez" value="1"> Anzahl:<input class="tf" type = "text" name = "$bez +1"/><br>';
					}
				?>
			</p>
		</div>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="labAnlegen"  value="Labor/Werkstatt anlegen">
		</p>
    </form>
</body>
</html>