<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
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
    <form action="index.php?url=raumAnlegen/setStammdaten" method="post"/>
		<div>
			<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
				include 'raumStammdaten.php';
			?>
			<!--
				dynamisch aus Tabelle Ausstattung. Die im Raum vorhandene Ausstattung kann in Checkboxen und 
				Textfeldern für die Anzahl angegeben.
			-->
			<p>
				<?php
					if ($this->ausstattung_list){
						foreach($this->ausstattung_list as $key => $value){
							echo htmlentities($value->ausstattung_bezeichnung); 
							echo '<input type="checkbox" name="" value="1"> Anzahl:<input class="tf" type = "text" name = "1"/><br>'; 
						}
					} else{
						echo "Es ist ein Fehler aufgetretten.";
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