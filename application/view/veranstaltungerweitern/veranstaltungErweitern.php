<!--
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
-->
<html>
<head>
    <title>Veranstaltung erweitern</title>
</head>
<body> 
    <header>
        <h1>Person zu Veranstaltung hinzufügen</h1>
    </header>
	<!-- Sobald der "Veranstaltung erweitern"-Button geclickt wird -->
    <form action="index.php?url=veranstaltungErweitern/selected" method="post"/>
		<!-- Zur Auswahl der Veranstaltung eine Liste mit allen Veranstaltung und deren ID -->
		<p> Veranstaltung 
				<select name="veranstaltung">
				<?php
					if ($this->veranstaltung_list){
						foreach($this->veranstaltung_list as $key => $value){
							echo '<option>';
							echo htmlentities($value->veranst_ID); echo ",";
							echo htmlentities($value->veranst_bezeichnung);
							echo '</option>'; 
						}
					} else{
						echo "Es ist ein Fehler aufgetretten.";
					}
				?>
				</select>
		</p>
		<!-- Zur Auswahl des Users, der hinzugefügt werden soll, eine Liste mit allen Usern und deren Rolle -->
		<p> User     
				<select name="user">
				 <?php
					if ($this->user_list){
						foreach($this->user_list as $key => $value){
							echo '<option>';
							echo htmlentities($value->user_name); echo ",";
							echo htmlentities($value->rolle_bezeichnung);
							echo '</option>'; 
						}
					} else{
						echo "Es ist ein Fehler aufgetretten.";
					}
				?>
				</select>
		</p>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" name="erweitern" value="Veranstaltung erweitern">
		</p>
    </form>
</body>
</html>
