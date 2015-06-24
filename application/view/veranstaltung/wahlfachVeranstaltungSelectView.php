<?php
/**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: Als Mitarbeiter möcht ich einem Studiengang Wahlfächer zuordnen könnenn.
 * Task: 	Maske, um ein Fach einem Studiengang als Wahlfach zuordnen zu können. 
 * Nr:		630
 * Points:	8
 * Zeit:	5
 *
 */

/*
 * Auf dieser Seite wird die Veranstaltung ausgewählt, die ein Mitarbeiter einem Studiengang als Wahlfach
 * hinzufügen möchte
 * */
?>

<article>
<h1>Wahlfach: Veranstaltung auswählen</h1>
<p>Wählen Sie die Veranstaltung aus, die Sie einem Studiengang als Wahlfach hinzuf&uuml;gen m&ouml;chten: </p>
 
    
    <?php if ($this->veranstaltungen) { 

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
	$link = array (
			"bearbeiten" => "index.php?url=veranstaltung/bearbeitenWahlfach"
	);
	
	$link = (object)$link;
	
	$table->table ( array (
			'table' => $this->veranstaltungen,
			'alias' => array (
					$alias 
			),
			'link' => array (
					$link 
			) 
	) );

	
	
        } else {
        	echo "error";
        }
		?>	
			
</article>
