<?php
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 05.05.2015
 * Zeitaufwand (in Stunden): 1.0
 * User Story Nr.: 320
 * User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
 * Task: view erstellen
 * ===============================================
 */
?>
<article>
	<h1>Meine Kurse</h1>
</article>

<article>
	<a>Hier sehen Sie ihre Kurse und können sich von diesen abmelden.</a>
</article>
<article>
	<?php
	if ($this->listClass) {
		$table = new Table ();
		$alias = array (
				"0" => "ID",
				"1" => "Veranstaltung",
				"2" => "Credits",
				"3" => "SWS",
				"4" => "Abmelden" 
		);
		$alias = ( object ) $alias;
		
		$link = array (
				"Abmelden" => "index.php?url=student/verifyDelist" 
		);
		$link = ( object ) $link;
		$table->table ( array (
				'table' => $this->listClass,
				'alias' => array (
						$alias 
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



