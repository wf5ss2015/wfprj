<?php
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
	<p>Wählen Sie die Veranstaltung aus, die Sie bearbeiten m&ouml;chten: </p>
        <?php if ($this->veranstaltung) { 
			
echo "Tabelle mit Alias & Link bzw Action übergabe";
	// Tabelle drucken mit alias & link
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
			"bearbeiten" => "index.php?url=veranstaltung/bearbeiten",
			//"Index" => "index.php?url=index" 
	);
	$link = ( object ) $link;
	$table->table ( array (
			'table' => $this->veranstaltung,
			'alias' => array (
					$alias 
			),
			'link' => array (
					$link 
			) 
	) );

	
	
        }
		?>	
			
			

</article>
