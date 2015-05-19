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
	echo "<pre>";
	print_r($veranst);
	echo "</pre>";
	echo "\n";
	echo $this->veranstaltung[0]->veranst_ID;
	
	/*
	        [veranst_ID] => 8
            [veranst_bezeichnung] => Strahlentechnik
            [veranst_kurztext] => STechnik
            [credits] => 5
            [SWS] => 4
            [maxTeilnehmer] => 30
            [Veranstaltungsart] => Vorlesung/Labor
	*/
	?>
	
	
	
	
	
	<form action="index.php?url=veranstaltung/bearbeitenAusstattung" method="post">
	
    <table id="veranstaltung-bearbeiten">
	<tr><td>Bezeichnung: </td> <td><input type="text"  name="veranstaltung_bezeichnung" 
		value=<?php echo "\"$veranst->veranst_bezeichnung\""?> size="36" maxlength="100" /></td></tr>
	<tr><td>Kurztext: </td> <td><input type="text"  name="veranstaltung_kurztext" 
		value=<?php echo "\"$veranst->veranst_kurztext\""?> /></td></tr>
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
		<input type="text" name="veranstaltung_max_Teilnehmer" 
		value=<?php echo "\"$veranst->maxTeilnehmer\""?> size="1" maxlength="3"/>
	</td></tr>
		
	
	<tr><td>Veranstaltungsart: </td><td>
	

	<select class="input " name="veranstaltung_veranstaltungsart" style="; width: 32em">	
	
	
        <?php
            // erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten
            foreach($this->vArten as $key => $value) {                 
                echo "\n\t<option value=\"" . $value->vArt_ID . "\">";                
                echo $value->vArt_bezeichnung . "</option>";                
//                echo htmlentities($value->vArt_bezeichnung) . "</option>";                
                
            }	
        ?>


	</select>
	</td></tr>
	

	<tr><td>Ausstattung: </td>
	<td>
		
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
	


  <tr>
    <td> Pflichtvorlesung im Studiengang: </td>
    <td>
  
        <select class="input " name="veranstaltung_pflichtvorlesung" style="; width: 24em">	

		<?php /*value 0 für kein Pflichtfach*/ ?>        
         <option value="0"> </option>;

            <?php
            //Studiengänge aus DABA lesen und in einer Tabelle darstellen

           // $q = "select stg_ID, stg_bezeichnung, stgTyp_kuerzel from Studiengang join Studiengangtyp on Studiengang.stgTyp_ID = Studiengangtyp.stgTyp_ID;";
            // erzeugt die Liste mit "option"-HTML-Elementen aus dem Array studiengaenge
            foreach($this->studiengaenge as $key => $value) {                 
                echo "\n\t<option value=\"" . $value->stg_ID . "\">";
                echo $value->stg_bezeichnung;
                echo ", " . $value->stgTyp_kuerzel; 
                echo "</option>";
            }	
            ?>

        </select>

         in Fachsemester: 
        <select class="input " name="veranstaltung_fachsemester" style="; width: 3em">
        <?php 
 			for ($i=1; $i<=7; $i++) {
				echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
            }
		?>
        </select>	

        
    </td>



  </tr>

	
	
	<tr><td><input type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
	
	
	
	
	
	
</article>
