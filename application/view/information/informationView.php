<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5
	zeitaufwand: 0.5
	user story 
*/
?>
	<article>
		<h1>Studiengang-Information</h1>
		<?php	
			if ($this->studiengang) {
				foreach ( $this->studiengang as $key => $value ) {
						echo '<h3>';
						echo htmlentities ( $value->stg_bezeichnung );
						echo '</h3>';
						$stg_bezeichnung = htmlentities ( $value->stg_bezeichnung );
						echo '<img src="Content/'.$stg_bezeichnung.'.jpg" alt="Studenganginformation '.$stg_bezeichnung.'" align ="center">';
					}
			}
			echo '<br><input class="button" type="button" value="Zurück" onClick="history.back();">';
		?>
	</article>
