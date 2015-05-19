<?php
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.5 (alle views)
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
 * Task: views erstellen
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