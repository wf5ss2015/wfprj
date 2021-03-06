<?php 

/**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern. (erneut)
 * Task: 	Link zurück zum Start (Veranstaltung bearbeiten)
 * Nr:		370b
 * Points:	8
 * Zeit: 	1
 *
 */

/**
 * SPRINT 04
 *
 * @author : Roland Schmid
 * Datum: 	19.5.2015
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können. (Nacharbeit)
 * Task: 	Tabelle zur Auswahl einer Veranstaltung erzeugen
 * Nr:		210a
 * Points:	13
 * Zeit: 	1
 *
 */



//diese Seite wird angezeigt, wenn der Bearbeiten-Vorgang abgeschlossen und 
//die neuen Werte in der Datenbank eingetragen sind.


?>
<article>
	<?php 
	//<h1>Veranstaltung erfolgreich ge&auml;ndert</h1> 
	?>

	<table>

<?php
	//alte und neue Veranstaltung
	$alteVeranstaltung = $data['alteVeranstaltung'];
	$neueVeranstaltung = $data['neueVeranstaltung'];
	$ausstattungNeu  =$data['ausstattung'];
	
	//Table-Objekt für die Ausgabe
	$table = new Table ();

echo "<H2>voher: </H2>";
	// Tabele drucken mit alias
	$alias = array (
			"0" => "Veranstaltungsnummer",
			"1" => "Bezeichnung",
			"2" => "Kurztext",
			"3" => "Credits",
			"4" => "SWS",
			"5" => "maximale Anzahl Teilnehmer",
			"6" => "Veranstaltungsart" 
	);
	$alias = ( object ) $alias;
	$table->table ( array (
			'table' => $this->alteVeranstaltung,
			'alias' => array (
					$alias
			)
	) );
	

	echo "<H2><br>nachher:</H2>";
	$table->table ( array (
			'table' => $this->neueVeranstaltung,
			'alias' => array (
					$alias
			)
	) );
	

	//print_r($ausstattungNeu);
	echo "<h3>Ausstattung:</h3><table>";
	$size = count($ausstattungNeu);
	//foreach($this->$ausstattungNeu as $key => $value) {
	for($i = 0; $i < $size; $i++) {
		echo "\n<tr>";
	
		echo "\n\t<td><input type=\"text\"  name=\"veranstaltung_ausstattung[]\" " . "value=\"" . $ausstattungNeu[$i]->anzahl;
		echo "\" size=\"1\" readonly /> </td>";
	
		echo "\n\t<td> " . utf8_encode($ausstattungNeu[$i]->ausstattung_bezeichnung);
	
	
		//              echo " <input type=\"hidden\" name=\"veranstaltung_ausstattungid[]\" value=\"" . $value->ausstattung_ID . "\" />";
	
		echo "</td>";
	
	
	
		echo " \n</tr>";
	}
	echo "</table>";
	
	
?>
	</table>
	<?php 
	/* sprint 6 Anfang
	 * Task: Link zurück zum Start (Veranstaltung bearbeiten)
	 */
	?>
	<br><br><br><br>
	<a href="index.php?url=veranstaltung/bearbeitenSelect">weitere Veranstaltung bearbeiten</a>
	<br><br>
	
	<?php 
	/* sprint 6 Ende
	 */
	?>
	
</article>




