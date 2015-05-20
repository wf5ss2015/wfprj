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
	<h1>Abmeldung bestätigen</h1>
	<p>(Angemeldet:"<?php echo Session::get('user_name')?>")</p>
	<p>Möchten Sie sich wirklich von <?php echo $this->veranst_bezeichnung?> abmelden?</p>

	<table>
	<td>
	<form method="post" action="index.php?url=student/saveDelist">
		<input type="hidden" name="id"
			value="<?php echo htmlentities($this->id); ?>" /> <input class="button"
			type="submit" value='ja' />
	</form>
	</td>
	<td>
	<form method="post" action="index.php?url=student/delistClass">
		<input class="button" type="submit" value='nein' />
	</form>
	</td>
	</table>
</article>
