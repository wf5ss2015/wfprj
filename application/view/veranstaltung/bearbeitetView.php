<?php 
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
	<h1>Veranstaltung erfolgreich ge&auml;ndert</h1>

	<table>

<?php
	//alte und neue Veranstaltung
	$alteVeranstaltung = $data['alteVeranstaltung'];
	$neueVeranstaltung = $data['neueVeranstaltung'];
	
	//Table-Objekt für die Ausgabe
	$table = new Table ();

echo "voher: <br><br>";
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
	

	echo "<br><br>nachher: <br><br>";
	$table->table ( array (
			'table' => $this->neueVeranstaltung,
			'alias' => array (
					$alias
			)
	) );
	
	
?>
	</table>
	
	<br><br><br><br>
	<a href="index.php?url=veranstaltung/bearbeitenSelect">weitere Veranstaltung bearbeiten</a>
	<br><br>
	
</article>




