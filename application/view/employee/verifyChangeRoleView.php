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
	<h1>Änderung bestätigen</h1>

	<p>Möchten Sie dem Nutzer "<?php echo $this->nutzer_name?>" wirklich die Neue Rolle "<?php echo $this->rolle_bezeichnung?>" geben?</p>

	<table>
	<form method="post" action="index.php?url=employee/saveChangeRole">
		<input type="hidden" name="nutzer_name"
			value="<?php echo htmlentities($this->nutzer_name); ?>" />
		<input type="hidden" name="rolle_ID"
			value="<?php echo htmlentities($this->rolle_ID); ?>" />			
		<td><input type="submit" value='ja' /></td>
	</form>

	<form method="post" action="index.php?url=employee/selectUser">
		<td><input type="submit" value='nein' /></td>
	</form>
	</table>
</article>
