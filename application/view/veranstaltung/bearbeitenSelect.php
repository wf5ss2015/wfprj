<?php
/**
* SPRINT 02
*
* @author: Roland Schmid
* @Matrikel:
* Datum: 19.04.2015
*
* User­Story (Nr. xx ):  .... (n Points)
* Zeit: m
*/


/**
 * @author Roland Schmid
 * Das ist der Veranstaltung Controller. Steuert den Login Prozess.
 */
?><!--TODO HTML5 umsetzen-->

        <p>
            Veranstaltung zum bearbeiten auswählen
        </p>
        <?php if ($this->veranstaltung) { ?>
			<form method="post" action="index.php?url=veranstaltung/bearbeiten"> <!--Hier eben den Controller/Funktion eintragen damit was macht, wenn auswählen geklickt wird-->

                <select name="VeranstaltungID" size="10">
				<?php foreach($this->veranstaltung as $key => $value) { ?>
				<option value="<?=htmlentities($value->VeranstaltungID)?>"> <?= htmlentities($value->Bezeichnung)?></option>
				<?php }?>
				</select>	
                <input type="submit" value='auswählen' />
			</form>
		<?php } else { ?>
            <p>Blub</p>
        <?php } ?>

