<?php /**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: Als Mitarbeiter möcht ich einem Studiengang Wahlfächer zuordnen könnenn.
 * Task: 	Maske, um ein Fach einem Studiengang als Wahlfach zuordnen zu können. 
 * Nr:		630
 * Points:	8
 * Zeit:
 *
 */

?>



<article>

<h1>Wahlfach: Veranstaltung erfolgreich eingetragen</h1>


<?php




	/* Tabelle drucken mit alias & link
	 * generische Tabelle mit Linkauswahl von Kilian Kraus
	 * Tabelle mit "hidden input" ermöglicht die Übergabe der Veranstaltungs-ID
	 * */

	$table = new Table ();
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

	// key=name des links - value=action
	$table->table ( array (
			'table' => $this->veranstaltung,
			'alias' => array (
					$alias
			)
	) );
	
	
	
	
	
	
	
	$table = new Table ();
	$alias = array (
			"0" => "Studiengangnummer",
			"1" => "Bezeichnung",
			"2" => "Typ",
	);
	$alias = ( object ) $alias;
	
	// key=name des links - value=action
	$table->table ( array (
			'table' => $this->studiengang,
			'alias' => array (
					$alias
			)
	) );

	print "ab Semester : " . $this->semester;





?>

<br><br><a href="index.php?url=veranstaltung/wahlfachVeranstaltungSelect">zur&uuml;ck</a>
</article>

