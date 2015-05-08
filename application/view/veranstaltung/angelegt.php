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
?>
<article>
	<h1>Veranstaltung erfolgreich angelegt</h1>

	<table>
<?php
$table = new Table ();

echo "Standard";
// ohne alias
$table->table ( array (
		'table' => $this->veranstaltung 
) );

// erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten
// foreach($this->veranstaltung as $key => $value) {
// // echo "\n\t<option value=\"" . $value->vArt_ID . "\">";
// // echo $value->vArt_bezeichnung . "</option>";
// echo "<tr><td>";
// // echo $value . "</td>";
// echo "ID" . "</td>";
// echo "<td>$value->veranst_ID" . "</td>";
// echo "</tr>";

/*
 * $q = "select Veranstaltung.veranst_ID, Veranstaltung.veranst_bezeichnung, Veranstaltung.veranst_kurztext, Veranstaltung.credits, Veranstaltung.SWS, "
 * ."Veranstaltung.maxTeilnehmer, Veranstaltungsart.vArt_bezeichnung as Veranstaltungsart "
 * . "from Veranstaltung join Veranstaltungsart on Veranstaltung.vArt_ID = Veranstaltungsart.vArt_ID"
 * ." where Veranstaltung.veranst_ID = $vid;";
 */
// }

?>
	</table>
</article>
