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
    <title>Vorlesungsraum anlegen</title>
</head>
<body> 
    <header>
        <h1>Vorlesungsraum anlegen</h1>
    </header>
	<!-- vorlesungsraumAnlegen.php wird ausgeführt nach der Bestätigung -->
    <form action="vorlesungsraumAnlegen.php" method="post"/>
		<div>
			Bezeichnung <input class="tf" type = "text" name = "bezeichnung" /><br>
			<!-- Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift. -->
			<p> Geb&auml;ude 
				<select name="gebäude">
				  <?php
					if ($this->geblist){
						foreach($this->geblist as $key => $value){
							echo "<option>"; echo htmlentities($value->geb_bezeichnung); echo " , "; 
							echo htmlentities($value->straßenname); echo " , "; 
							echo htmlentities($value->hausnummer); echo "</option>";
						}
					} else{
						
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
			<input type="submit" name="anlegen" value="Vorlesungsraum anlegen">
		</p>
    </form>
</body>
</html>