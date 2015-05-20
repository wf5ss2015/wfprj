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
 * Zeit: 	1.5
 *
 */

?>

<article>
<h1>Veranstaltung bearbeiten: Ausstattung</h1>
<?php 

// die View bekommt im array $data die Sub-Arrays $grunddaten und $vArten übergeben

//für leichteren Zugriff, kopiere Arrays
$grunddaten = $data['grunddaten'];

$vArtID = $data['vArtID'];
// echo "FART FART FART $vArtID";

$ausstattung = $data['ausstattung'];

// echo "<pre>";
// echo "DATA:\n";
// print_r($data);
// print_r($grunddaten);
// print_r($vArtID);
// print_r($ausstattung);
// echo "</pre>";

?>
	<h2>"<?php echo $grunddaten['vBezeichnung']?>"</h2>
	<form action="index.php?url=veranstaltung/bearbeitenEintragen" method="post">
	
	
	<?php 
	//die bereits übergenen Werte aus vorigen Fenstern werden hier als hidden values eingetragen, damit diese 
	//weitergegebenwerden können

	foreach($grunddaten as $key => $value) {
		echo "<input name=\"" . $key . "\" value=\"" . $value . "\" type=\"hidden\">\n\t";		
	}
	
	echo "<input name=\"vArtID\" value=\"" . $vArtID . "\" type=\"hidden\">\n";
	
	?>
	
	
    <table id="veranstaltungausstattung-bearbeiten">
   
    
    <table>
	
	<?php
	
	// erzeugt eine Tabelle mit allen Ausstatungsmerkmalen
            foreach($this->ausstattung as $key => $value) {                 
                echo "\n<tr>";

                //ausstattung[] gruppiert die so benannten Eingabefelder; 
                //in PHP wird dies zu einem Sub-Array zusammengefasst
                // TODO hidden value für id? 
                echo "\n\t<td><input type=\"text\"  name=\"veranstaltung_ausstattung[]\"";
                echo " size=\"1\" /> </td>";

                echo "\n\t<td> " . $value->ausstattung_bezeichnung;
                                
//              echo " <input type=\"hidden\" name=\"veranstaltung_ausstattungid[]\" value=\"" . $value->ausstattung_ID . "\" />";
                
                echo "</td>";
        
                
                
                echo " \n</tr>";
            }	
	

	?>
	</table>
    	</td></tr>
    	
      <tr><td><input type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
</article>