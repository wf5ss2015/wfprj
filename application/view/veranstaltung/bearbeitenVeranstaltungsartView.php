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
<h1>Veranstaltung bearbeiten: Veranstaltungsart</h1>
<?php 

// die View bekommt im array $data die Sub-Arrays $grunddaten und $vArten übergeben

//für leichteren Zugriff, kopiere Arrays
$grunddaten = $data['grunddaten'];

$vArten = $data['vArten'];

?>
	<h2>"<?php echo $grunddaten['vBezeichnung']?>"</h2>
	<form action="index.php?url=veranstaltung/bearbeitenAusstattung" method="post">
	
	
	<?php 
	// die bereits übergenen Werte aus vorigen Fenstern werden hier als hidden values eingetragen,
	// damit diese weitergegebenwerden können

	foreach($grunddaten as $key => $value) {
		echo "<input name=\"" . $key . "\" value=\"" . $value . "\" type=\"hidden\">\n";		
	}

	?>
		
    <table id="veranstaltungsart-bearbeiten">
    <tr><td>Veranstaltungsart: </td><td>
    <select class="input " name="veranstaltung_veranstaltungsart" style="; width: 32em">
    
    <?php
    // erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten
    
    foreach($this->vArten as $key => $value) {
    	echo "\n\t<option value=\"" . $value->vArt_ID . "\"";

    	// wählt die aktuelle Veranstaltungsart vor
    	//if($value->vArt_bezeichnung == $grunddaten['Veranstaltungsart']) {    		
    	if($value->vArt_ID == $grunddaten['vArt_ID']) {
    		echo " selected";    		
    	} 		
    	echo ">";
    	echo utf8_encode($value->vArt_bezeichnung) . "</option>";        
    }
    ?>
    	</select>
    	</td></tr>
    	
      <tr><td><input class="button" type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
</article>