<?php
/**
 * SPRINT 03
 *
 * @author : Roland Schmid
 * Datum: 6.5.2015
 *         
 * User­ Story: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * Task: Eingabemaske für "Veranstaltung anlegen" anpassen.
 * Nr:		130b
 * Points:	5 Points
 * Zeit: 	1
 *
 *
 * User­ Story: Als Entwickler möchte ich im MVC-Pattern programmieren können
 * Task: Bisherigen Code in MVC einfügen und anpassen.
 * Nr:		340
 * Points:	40
 * Zeit: 	3
 *
 */


/**
 * SPRINT 01
 *
 * @author: Roland Schmid
 * Datum: 8.4.2015
 *
 * User­ Story: Als Verwalter möchte ich Veranstaltungen anlegen können.
 * Nr:		120
 * Task: Angelegte Veranstaltung darstellen
 * Points:	13 
 * Zeit: 	0.5
 *
 */


?>
<article>
	<h1>Veranstaltung erfolgreich angelegt</h1>

	<table>

<?php

/* sprint 3 Anfang 
 * Generische Tabelle zur Ausgabe der Daten eingefügt
 */
	$table = new Table ();

	// Tabelle drucken ohne Alias
	$table->table ( array (
			'table' => $this->veranstaltung 
	) );

/* sprint 3 Ende
 */

//alter Code aus Sprint 01:

// erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten
// foreach($this->veranstaltung as $key => $value) {
// // echo "\n\t<option value=\"" . $value->vArt_ID . "\">";
// // echo $value->vArt_bezeichnung . "</option>";
// echo "<tr><td>";
// // echo $value . "</td>";
// echo "ID" . "</td>";
// echo "<td>$value->veranst_ID" . "</td>";
// echo "</tr>";


?>
	</table>
</article>
