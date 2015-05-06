
<!--
    autor: Kris Klamser
    datum: 29.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03
	zeitaufwand: 0,5
	user story (Nr. 110b): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<html>
<head>
    <title>Labor anlegen</title>
</head>
<body> 
    <header>
        <h1>Labor/Werkstatt anlegen</h1>
    </header>
	<!-- saveRaum-function wird ausgeführt nach der Bestätigung -->
    <form action="index.php?url=raumAnlegen/saveRaum" method="post"/>
		<div>
			<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
				include 'raumStammdaten.php';
			?>
			<!-- Laborart als Dropdown Menü zum auswählen -->
			<p>	Laborart 
				<select name = "laborart">
					<?php
						if ($this->labArt_list){
							foreach($this->labArt_list as $key => $value){
								echo "<option>"; echo htmlentities($value->lArt_ID); echo " , "; 
								echo htmlentities($value->lArt_bezeichnung); echo "</option>";
							}
						} else{
							echo "Es ist ein Fehler aufgetretten.";
						}
					?>
				</select>	
			</p>
			<!-- includet die Ausstattungsabfrage raumAusstattung.php -->
			<p>
				<?php
					include 'raumAusstattung.php';
				?>
			</p>
			<input type="hidden" name="raumtyp" value="labor"/>
		</div>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="anlegen" value="Labor anlegen">
		</p>
    </form>
</body>
</html>