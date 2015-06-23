<?php
/**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: 
 * Task: 	 
 * Nr:		
 * Points:	
 * Zeit: 	
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
