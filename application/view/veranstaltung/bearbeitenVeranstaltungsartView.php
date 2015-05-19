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
 * Zeit: 	0.6 + x
 *
 */

?>

<article>
<h1>Veranstaltung bearbeiten: Veranstaltungsart</h1>
<?php 


echo "DATA: ";
print_r($data);


$grunddaten = $data['grunddaten'];
echo "grunddaten";
print_r($grunddaten);

$vArten = $data['vArten'];
echo "vARten";
print_r($vArten);
echo"\n\n\n";
echo $vArten[0]->vArt_ID . "\t" . $vArten[0]->vArt_bezeichnung;
//bekommt im array $data die Sub-Arrays $grunddaten und $vArten übergeben

// $veranst = $data->$grunddaten;
// echo "veranst: \n";
// print_r($veranst);
?>
	<h2>Veranstaltungsbezeichnung</h2>
	<form action="index.php?url=veranstaltung/bearbeitenAusstattung" method="post">
	
    <table id="veranstaltungsart-bearbeiten">
    <tr><td>Veranstaltungsart: </td><td>
    
    <?php 
//         foreach($this->vArten as $key => $value) {
//         	echo $key;
//         	echo "<br>";
//         	echo $value;
     
//         }
    
    ?>
    <select class="input " name="veranstaltung_veranstaltungsart" style="; width: 32em">
    
    
    <?php
    // erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten

    
    foreach($this->vArten as $key => $value) {
    	echo "\n\t<option value=\"" . $value->vArt_ID . "\">";
    	echo $value->vArt_bezeichnung . "</option>";
    	
    	/*
    	 * echo "\n\t<option value=\"" . $i . "\"";
                    		
                    	if($i == $veranst->credits) {
                    		echo " selected";
                    	}
                    		
                    	echo ">" . $i . "</option>";
    	 * */
    	//                echo htmlentities($value->vArt_bezeichnung) . "</option>";
    
    }
    ?>
    
    
    	</select>
    	</td></tr>
    	
      <tr><td><input type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
	
	
	
	
	
	
</article>