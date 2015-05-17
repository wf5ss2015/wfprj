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
	<p>(Angemeldet:"<?php echo Session::get('user_name')?>")</p>
</article>

<article>
	<p>Möchten Sie sich wirklich zu <?php echo $this->veranst_bezeichnung?> anmelden?</p>
</article>
<article>
	<form method="post" action="index.php?url=student/saveEnroll">
		<input type="hidden" name="id"
			value="<?php echo htmlentities($this->id); ?>" /> <input
			type="submit" value='ja' />
	</form>

	<form method="post" action="index.php?url=student/enrollClass">
		<input type="submit" value='nein' />
	</form>
</article>

