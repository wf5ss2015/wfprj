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
            Veranstaltung bearbeiten
        </p>
        <?php if ($this->veranstaltung) { ?>
		<form method="post" action="index.php?url=veranstaltung/index">
			<table >				
				<tr>
                <td><label>Bezeichnung: </label>
				</td>
				<td><input type="text" name="Bezeichnung" value="<?php echo htmlentities($this->veranstaltung->Bezeichnung); ?>" />
				</td>
				<td>
                <input type="submit" value='speichern' />
				</table>
           </form>
		<?php } else { ?>
            <p>Blub</p>
        <?php } ?>

