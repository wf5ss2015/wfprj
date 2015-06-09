<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5	
	zeitaufwand: 
	user story 
*/
?>
	<article>
		<h1>Zeugnis/Notenspiegel</h1>
		<!-- Sobald der Button geclickt wird, wird die printZeugnis-function ausgeführt-->
		<form action="index.php?url=zeugnis/printZeugnis" method="post" />
			<?php
			if ($this->noten_list) {
				$table = new Table ();
				$tableInfo = array (
						"0" => "Veranstaltungsnummer",
						"1" => "Veranstaltungsbezeichnung",
						"2" => "Note"
				);
				$table->table ( array (
						'table' => $this->noten_list,
						'alias' => array (
								$tableInfo 
						) 
				) );
				
			} else {
				echo "Es ist ein Fehler aufgetretten. Die Notenliste konnte nicht erstellt werden.";
			}
			
			echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" id="b1" value="Zeugnis/Notenspiegel drucken" ></a>
		</form>
	</article>
