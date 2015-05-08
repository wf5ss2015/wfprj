<?php

/**
 * SPRINT 03
 *
 * @author: Damian Wysocki
 * Datum: 29.04.2015
 *
 * User­Story (Nr. 150a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
 * Zeit: 1,5
 */

/**
 *
 * @author Damian Wysocki
 *        
 *         Beschreibung: View um Teilnehmer einer Vorlesung anzuzeigen
 *        
 */
?>
<article>

	<h2>Teilnehmerliste für Kurs "<?php echo $_POST['id']?>"</h2>
	<a>Hier sehen Sie ihre zugeordneten Kurse. Bitte auswählen um
		Teilnehmerlisten zu erzeugen</a>
				
<?php

if ($this->teilnehmer) {
	
	$table = new Table ();
	
	// Tabelle erzeugen
	$dozentTeilnehmer = array (
			"0" => "Nutzername",
			"1" => "Email",
			"2" => "Vorname",
			"3" => "Nachname",
			"4" => "Telefonnummer",
			"5" => "Studiengang",
			"6" => "Anzeigen" 
	);
	
	// Testzwecke
	// $alias = array_flip($alias);
	// $alias = array_reverse($alias);
	$dozentTeilnehmer = ( object ) $dozentTeilnehmer;
	
	// key=name des links - value=action
	$link = array (
			"Anzeigen" => "index.php?url=login/helloDocent" 
	);
	
	$link = ( object ) $link;
	$table->table ( array (
			'table' => $this->teilnehmer,
			'dozentTeilnehmer' => array (
					$dozentTeilnehmer 
			),
			'link' => array (
					$link 
			) 
	) );
} else {
?>
kein array übergeben
 <?php } ?>			
</article>

