<?php
/**
 * SPRINT 02
 *
 * @author : Roland Schmid
 * Datum: 19.4.2015
 *         
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können.
 * Task: 	Seite mit Anzeige einer Veranstaltung und Feldern, um diese zu ändern. 
 * Nr:		210
 * Points:	13
 * Zeit: 	1
 * UNVOLLSTÄNDIG
 *
 */


?>
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
