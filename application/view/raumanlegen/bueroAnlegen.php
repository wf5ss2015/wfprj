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
    <form action="index.php?url=raumAnlegen/saveRaum" method="post"/>
		<div>
			<!-- included das Textfeld für die Bezeichnungseingabe und die Wahl des Gebäudes -->
			<?php
				include 'raumStammdaten.php';
			?>
			<input type="hidden" name="raumtyp" value="buero"/>
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