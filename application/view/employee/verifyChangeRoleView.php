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
