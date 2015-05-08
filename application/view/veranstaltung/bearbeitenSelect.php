<?php
/**
 * SPRINT 03
 *
 * @author: Roland Schmid
 * @Matrikel:
 * Datum: 6.5.2015
 *
 * User­ Story 130b: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * 5 Points
 * Zeit: 2
 *
 * User Story 340: Als Entwickler möchte ich im MVC-Pattern programmieren können
 * 40
 *
 */

/**
 *
 * @author Roland Schmid
 *         Das ist der Veranstaltung Controller. Steuert den Login Prozess.
 */
?>
<!--TODO HTML5 umsetzen-->
<article>
	<p>Veranstaltung zum bearbeiten auswählen</p>
        <?php if ($this->veranstaltung) { ?>
			<form method="post" action="index.php?url=veranstaltung/bearbeiten">
		<!--Hier eben den Controller/Funktion eintragen damit was macht, wenn auswählen geklickt wird-->

		<select name="VeranstaltungID" size="10">
				<?php foreach($this->veranstaltung as $key => $value) { ?>
				<option value="<?=htmlentities($value->VeranstaltungID)?>"> <?= htmlentities($value->Bezeichnung)?></option>
				<?php }?>
				</select> <input type="submit" value='auswählen' />
	</form>
		<?php } else { ?>
            <p>Blub</p>
        <?php } ?>
</article>
