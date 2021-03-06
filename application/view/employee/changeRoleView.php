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


	<p>Rechte ändern für "<?php echo $this->nutzer_name?>" (<?php echo $this->rolle_bezeichnung?>).</p>

	<?php
	if ($this->roleList) {
	$table = new Table ();
	$alias = array (
			"0" => "ID",
			"1" => "Rolle",
	);
	$alias = ( object ) $alias;
	
	$link = array (
			"auswählen" => "index.php?url=employee/verifychangeRole" 
	);
	$link = ( object ) $link;
	
	$hidden = array (
			"nutzer_name" => $this->nutzer_name,
	);
	$hidden = ( object ) $hidden;
	
	$table->table ( array (
			'table' => $this->roleList,
			'alias' => array (
					$alias 
			),
			'link' => array (
					$link 
			), 
			'hidden' => array (
					$hidden
			)
	) );
} else {
	?>
	kein array übergeben
<?php } ?>			
</article>
