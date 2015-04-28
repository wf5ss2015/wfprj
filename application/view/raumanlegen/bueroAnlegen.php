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
    <title>B&uuml;ro anlegen</title>
</head>
<body> 
    <header>
        <h1>B&uuml;ro anlegen</h1>
    </header>
	<!-- bueroAnlegen.php wird ausgeführt nach der Bestätigung -->
    <form action="bueroAnlegen.php" method="post"/>
		<div>
			<p>
				<!-- Bezeichnung im Textfeld eingeben. -->
				Bezeichnung <input class="tf" type = "text" name = "bezeichnung" /><br>
			</p>
			<!-- Alle Gebäude werden in einer Liste zur Auswahl angezeigt. Mit Bezeichnung und Anschrift. -->
			<p> Geb&auml;ude 
				<select name="gebäude">
				  <?php
					while($query = fetch()){
						echo "<option>"; echo $row['geb_bezeichnung']; echo " , "; 
						echo $row['straßenname']; echo " , "; 
						echo $row['hausnummer']; echo "</option>";
					}
				  ?>
				</select>
			</p>
		</div>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="bueroAnlegen" value="Büro anlegen"></a>
		</p>
    </form>
</body>
</html>