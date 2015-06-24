<?php
/*
    autor: Kris Klamser
    datum: 22.6.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 6
	zeitaufwand: 0.5
	user story (Nr. 560): Als Mitarbeiter möchte ich einer Veranstaltung einen Dozenten zuordnen können. (8 Pkt.)
	-> Darstellung als Tabelle 
*/
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
	<h1>Student oder Dozent zu Veranstaltung hinzufügen</h1>
	<!-- Sobald der "Veranstaltung erweitern"-Button geclickt wird, wird die selected-function ausgeführt-->
	<form action="index.php?url=veranstaltungErweitern/selected" method="post" />
	<!-- Infotext -->
	<p style="font-size: 14px; line-height: 1.5;">
		Im folgenden können Sie einen Studenten oder einen Dozenten zu einer Veranstaltung hinzufügen.
		Wählen Sie dazu die Veranstaltung, die erweitert werden soll, und den User, der hinzugefügt werden soll.
	</p><br>
	
	<table style="font-size: 14px; text-align: left;"><tr>
	<!-- Zur Auswahl der Veranstaltung eine Liste mit allen Veranstaltung und deren ID -->
		<th>Veranstaltung  </th><th><select name="veranstaltung">
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
					Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
				}
				?>
				</select></th>
	</tr>
	<tr><th></th><th></th></tr>
	<!-- Zur Auswahl des Users, der hinzugefügt werden soll, eine Liste mit allen Usern und deren Rolle -->
	<tr>
		<th>User </th><th><select name="user">
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
						Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten.' );
					}
					?>
				</select></th>
	</tr></table>
	<p><br>
			<?php
			echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" name="erweitern" value="Veranstaltung erweitern">
	</p>
	</form>
</article>
