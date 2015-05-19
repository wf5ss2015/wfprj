<?php
/*
    autor: Kris Klamser
    datum: 28.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 0.5
	user story (Nr. 30b): Als Mitarbeiter möchte ich Lehrverantwortlicher / Dozent / Tutor zu Veranstaltung hinzufügen können. (20 Pkt.)
*/
?>
<article>
	<h1>Person zu Veranstaltung hinzufügen</h1>
	<!-- Sobald der "Veranstaltung erweitern"-Button geclickt wird, wird die selected-function ausgeführt-->
	<form action="index.php?url=veranstaltungErweitern/selected"
		method="post" />
	<!-- Zur Auswahl der Veranstaltung eine Liste mit allen Veranstaltung und deren ID -->
	<p>
		Veranstaltung <select name="veranstaltung">
				<?php
				if ($this->veranstaltung_list) {
					foreach ( $this->veranstaltung_list as $key => $value ) {
						echo '<option>';
						echo htmlentities ( $value->veranst_ID );
						echo ",";
						echo htmlentities ( $value->veranst_bezeichnung );
						echo '</option>';
					}
				} else {
					echo "Es ist ein Fehler aufgetretten.";
				}
				?>
				</select>
	</p>
	<!-- Zur Auswahl des Users, der hinzugefügt werden soll, eine Liste mit allen Usern und deren Rolle -->
	<p>
		User <select name="user">
				 <?php
					if ($this->user_list) {
						foreach ( $this->user_list as $key => $value ) {
							echo '<option>';
							echo htmlentities ( $value->nutzer_name );
							echo ", ";
							echo htmlentities ( $value->rolle_bezeichnung );
							echo '</option>';
						}
					} else {
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
</article>
