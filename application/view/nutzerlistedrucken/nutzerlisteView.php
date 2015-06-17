<?php
/*
    autor: Kris Klamser
    datum: 19.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04	
	zeitaufwand: 0.5
	user story (Nr. 280a): Als Admin möchte ich alle Nutzer in einer Liste speichern können. (20 Pkt.) 
	-> Erweiterung um Vorname und Nachname
*/
/*
    autor: Kris Klamser
    datum: 4.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. 280): Als Admin möchte ich alle Nutzer in einer Liste speichern können. (20 Pkt.)
*/
?>

<article>
	<h1>Nutzerliste</h1>
	<form action="index.php?url=nutzerlisteDrucken/printUser" method="post" target="_blank" />
	<p>Im Folgenden sehen Sie eine Liste von allen Nutzern:</p>
		
<?php
if ($this->user_list) {
	$table = new Table ();
	$userInfo = array (
			"0" => "Nachname",
			"1" => "Vorname",
			"2" => "Nutzername",
			"3" => "Rolle",
			"4" => "E-Mail",
			"5" => "Straßenname",
			"6" => "Hausnummer",
			"7" => "PLZ",
			"8" => "Stadt",
			"9" => "Land" 
	);
	$table->table ( array (
			'table' => $this->user_list,
			'alias' => array (
					$userInfo 
			) 
	) );
	/*
	 * Alternativ ohne Table-Class:
	 *
	 * <table><tr>
	 * <th>Username</th> <th>Rolle</th> <th>E-Mail</th> <th>Strassenname</th> <th>Hausnummer</th> <th>PLZ</th> <th>Stadt</th> <th>Land</th>
	 * </tr>
	 * foreach($this->user_list as $key => $value){
	 * echo "<tr>";
	 * echo "<td>"; echo htmlentities($value->nutzer_name); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->rolle_bezeichnung); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->email_name); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->straßenname); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->hausnummer); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->plz); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->stadt); echo "</td>";
	 * echo "<td>"; echo htmlentities($value->land); echo "</td>";
	 * echo "</tr>";
	 * }
	 * </table>
	 */
} else {
	Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten. Die Nutzerliste konnte nicht erstellt werden.' );
}
?>
   
<p>
<?php
echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
?>
<input class="button" type="submit" id="b1" value="Nutzerliste drucken" ></a>
	</p>
	</form>
</article>