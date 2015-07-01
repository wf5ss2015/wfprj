<?php
/*
    autor: Kris Klamser
    datum: 22.6.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 6
	zeitaufwand: 1
	user story (Nr. 560): Als Mitarbeiter möchte ich einer Veranstaltung einen Dozenten zuordnen können. (8 Pkt.)
	-> Darstellung als Tabelle und Dozent/Student getrennt
*/
?>
<article>
	<h1>Veranstaltung - Dozent</h1>
	<p>Hier können Sie einen Dozenten einer Veranstaltung zuweisen.</p>
	<!-- Sobald der "Veranstaltung erweitern"-Button geclickt wird, wird die selected-function ausgeführt-->
	<form action="index.php?url=veranstaltungErweitern/selected" method="post" />
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
	<!-- Zur Auswahl des Users, der hinzugefügt werden soll, eine Liste mit allen Dozenten -->
	<tr>
		<th>Dozent </th><th><select name="user">
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
	<input type="hidden" name="personentyp" value="dozent">
	<p><br>
			<?php
			echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" name="erweitern" value="Veranstaltung erweitern">
	</p>
	</form>
</article>