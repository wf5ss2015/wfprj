<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5	
	zeitaufwand: 1
	user story (Nr. 440): Als Student möchte ich mir ein Zeugnis/Notenspiegel mit allen bisher erbrachten Leistungen erstellen lassen können.
*/
?>
	<article>
		<h1>Zeugnis/Notenspiegel</h1>
		<!-- Sobald der Button geclickt wird, wird die printZeugnis-function ausgeführt-->
		<form action="index.php?url=zeugnis/printZeugnis" method="post" target="_blank" />
			<?php
			//das übergebene Array noten_list wird durch die Table-Klasse in eine Tabelle umgewandelt und angezeigt.
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
				Session::add ( 'response_negative', 'Es ist ein Fehler aufgetreten. Die Notenliste konnte nicht erstellt werden.' );
			}
			echo '<input class="button" type="button" value="Zurück" onClick="history.back();">';
			?>
			<input class="button" type="submit" id="b1" value="Zeugnis/Notenspiegel drucken" ></a>
		</form>
	</article>
