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
	<h1>Anmeldung bestätigen</h1>
	<p>Möchten Sie sich wirklich zu <?php echo $this->veranst_bezeichnung?> anmelden?</p>

	<table>
	<td>
	<form method="post" action="index.php?url=student/saveEnroll">
		<input type="hidden" name="id"
			value="<?php echo htmlentities($this->id); ?>" /> 
		<input type="hidden" name="veranst_bezeichnung"
			value="<?php echo htmlentities($this->veranst_bezeichnung); ?>" />  	
		<input class="button"
			type="submit" value='ja' />
	</form>
	</td>
	<td>
	<form method="post" action="index.php?url=student/enrollClass">
		<input class="button" type="submit" value='nein' />
	</form>
	</td>
	</table>
</article>

