<?php
/**
 * SPRINT 04
 *
 * @author : Roland Schmid
 * Datum: 	19.5.2015
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können. (Nacharbeit)
 * Task: 	Maske zur Änderung erstellen 
 * Nr:		210a
 * Points:	13
 * Zeit: 	
 *
 */

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
	<p>Veranstaltung bearbeiten</p>
        <?php if ($this->veranstaltung) { ?>
		<form method="post" action="index.php?url=veranstaltung/index">
		<table>
			<tr>
				<td><label>Bezeichnung: </label></td>
				<td><input type="text" name="Bezeichnung"
					value="<?php echo htmlentities($this->veranstaltung->Bezeichnung); ?>" />
				</td>
				<td><input type="submit" value='speichern' />
		
		</table>
	</form>
		<?php } else { ?>
            <p>Blub</p>
        <?php } ?>
</article>
