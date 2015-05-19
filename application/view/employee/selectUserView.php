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
<h1>Rechte ändern</h1>


	
		<p>Hier können Sie für Nutzer neue Rechte vergeben.</p>
	
	
<?php
if ($this->userList) {
	$table = new Table ();
	$alias = array (
			"0" => "Nutzer",
			"1" => "Rolle",
	);
	$alias = ( object ) $alias;
	
	$link = array (
			"Rechte ändern" => "index.php?url=employee/changeRole" 
	);
	$link = ( object ) $link;
	

	$table->table ( array (
			'table' => $this->userList,
			'alias' => array (
					$alias 
			),
			'link' => array (
					$link 
			),

	) );
} else {
	?>
	kein array übergeben
<?php } ?>				
</article>