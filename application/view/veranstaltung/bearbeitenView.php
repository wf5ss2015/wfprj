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
<h1>Veranstaltung bearbeiten: Grunddaten</h1>
<?php 

/* sprint 4 Anfang
 * Maske zur Änderung erstellen 
 */

	// speichert das einzige Element aus dem objekt/array $veranstaltung in $veranst, für leichteren Zugriff
	$veranst = $this->veranstaltung[0]; 	
	//print_r($this->veranstaltung);
// 	echo "<pre>";
// 	print_r($veranst);
// 	echo "</pre>";
// 	echo "\n";
// 	echo $this->veranstaltung[0]->veranst_ID;
	
	/*
	        [veranst_ID] => 8
            [veranst_bezeichnung] => Strahlentechnik
            [veranst_kurztext] => STechnik
            [credits] => 5
            [SWS] => 4
            [maxTeilnehmer] => 30
            //[Veranstaltungsart] => Vorlesung/Labor
            [vArt_ID] => 3
	*/
	?>
	
	
	
	
	
	<form action="index.php?url=veranstaltung/bearbeitenVeranstaltungsart" method="post">
	
		<?php 
			//wichtig, hier die ID per hidden input mitzuübergeben
		?>
		<input name="veranst_ID" value=<?php echo "\"$veranst->veranst_ID\""?> type="hidden">
		<?php //<input name="Veranstaltungsart" value=<?php echo "\"$veranst->Veranstaltungsart\"" type="hidden">?>
		
		<input name="vArt_ID" value=<?php echo "\"$veranst->vArt_ID\""?> type="hidden">
		
	
	
    <table id="veranstaltung-bearbeiten">
	<tr><td>Bezeichnung: </td> <td><input type="text"  name="veranstaltung_bezeichnung" 
		value=<?php echo "\"$veranst->veranst_bezeichnung\""?> size="36" maxlength="100" required/></td></tr>
	<tr><td>Kurztext: </td> <td><input type="text"  name="veranstaltung_kurztext" 
		value=<?php echo "\"$veranst->veranst_kurztext\""?> required /></td></tr>
	<tr><td>SWS: </td> <td>
	
            <select name="veranstaltung_sws" style="; width: 3em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 10
            //wählt den in der DABA stehenden Wert aus ("selected");
                    for ($i=1; $i<=10; $i++) {
                        echo "\n\t<option value=\"" . $i . "\"";
 						
 						if($i == $veranst->SWS) {
 							echo " selected";
 						}
 		
						echo ">" . $i . "</option>";
                    }
			
            ?>

            </select> 
	
	</td></tr>
	
	
	<tr><td>Credits (ECTS-Punkte): </td><td>
	
            <select name="veranstaltung_credits" style="; width: 3em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 12
            //wählt den in der DABA stehenden Wert aus ("selected");
                    for ($i=1; $i<=20; $i++) {
						//echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
                           
                    	echo "\n\t<option value=\"" . $i . "\"";
                    		
                    	if($i == $veranst->credits) {
                    		echo " selected";
                    	}
                    		
                    	echo ">" . $i . "</option>";
                    }
            ?>

            </select> 
	</td></tr>
	
		
	<tr><td>maximale Anzahl Teilnehmer: </td><td>
		<input type="number" min="0" max="500" name="veranstaltung_max_Teilnehmer" 
		value=<?php echo "\"$veranst->maxTeilnehmer\""?> size="1" maxlength="3" required/>
	</td></tr>
		


	
	
	<tr><td><input class="button" type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
	
	
	
	
	
	
</article>
