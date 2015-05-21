<?php
/**
 * SPRINT 01
 *
 * @author: Kilian Kraus
 * @Matrikel:
 * Datum: 08.04.2015
 *
 * User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
 * Zeit: 
 */
?>
<article>
	<h1>Start</h1>
	
	<p>Hier sehen Sie alle Nutzer und können Sich mit diesen Testweise (Entwicklung) anmelden.</p>
	<?php
if ($this->userList) {
	$table = new Table ();
	$alias = array (
			"0" => "Nutzer",
			"1" => "Rolle",
	);
	$alias = ( object ) $alias;
	
	$link = array (
			"Login" => "index.php?url=index/Login" 
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

