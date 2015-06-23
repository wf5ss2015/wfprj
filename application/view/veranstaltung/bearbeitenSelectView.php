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

/**
 * SPRINT 02
 *
 * @author : Roland Schmid
 * Datum: 19.4.2015
 *         
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können.
 * Task: 	Seite mit Anzeige einer Veranstaltung und Feldern, um diese zu ändern. 
 * Nr:		210
 * Points:	13
 * Zeit: 	1
 * UNVOLLSTÄNDIG
 *
 */


?>
<article>
<h1>Veranstaltung auswählen</h1>
	<p>Wählen Sie die Veranstaltung aus, die Sie bearbeiten m&ouml;chten: </p>
    
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
			"bearbeiten" => "index.php?url=veranstaltung/bearbeiten"
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
