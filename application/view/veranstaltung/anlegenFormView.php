<?php

/**
 * SPRINT 04
 *
 * @author : Roland Schmid
 * Datum: 16.5.2015
 * User­ Story: Als Mitarbeiter möchte ich einer Veranstaltung ein Fachsemester zuordnen können. (Nacharbeit)
 * Task: 	Eingabemaske für Veranstaltung erweitern
 * Nr:		310a
 * Points:	5
 * Zeit: 	0.25	
 *
 */

/**
 * SPRINT 03
 *
 * @author : Roland Schmid
 * Datum: 6.5.2015
 *         
 * User­ Story: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
 * Task: 	Eingabemaske für "Veranstaltung anlegen" anpassen.
 * Nr:		130b
 * Points:	5
 * Zeit: 	2
*
*/

/**
 * SPRINT 02
 *
 * @author : Roland Schmid
 * Datum: 22.4.2015
 *         
 * User­ Story: Als Benutzer möchte ich die für eine Veranstaltung die benötigte Ausstattung festlegen können.
 * Task: 	Maske bei "Veranstaltung anlegen" erweitern. 
 * Nr:		240
 * Points:	3
 * Zeit: 	1.5
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
 * Task: 	Maske zum Anlegen einer Veranstaltung erstellen
 * Points:	13 
 * Zeit: 	2
 *
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ECTS vergeben können.
 * Nr:		121
 * Task:	Maske zur Angabe von ECTS erweitern
 * Points:	5 
 * Zeit: 	0.5
 *
 */


?>
<article>
<h1>Neue Veranstaltung anlegen</h1>

<form action=index.php?url=veranstaltung/anlegen method="post">
	
    <table id="veranst-anlegen">
	<tr><td>Bezeichnung: </td> <td><input type="text"  name="veranstaltung_bezeichnung" size="36" maxlength="100" /></td></tr>
	<tr><td>Kurztext: </td> <td><input type="text"  name="veranstaltung_kurztext" /></td></tr>
	<tr><td>SWS: </td> <td>
	
            <select name="veranstaltung_sws" style="; width: 3em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 10
                    for ($i=1; $i<=10; $i++) {
                            echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
                    }
            ?>

            </select> 
	
	</td></tr>
	
	
	<tr><td>Credits (ECTS-Punkte): </td><td>
	
            <select name="veranstaltung_credits" style="; width: 3em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 12
                    for ($i=1; $i<=20; $i++) {
                            echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
                    }
            ?>

            </select> 
	</td></tr>
	
		
	<tr><td>maximale Anzahl Teilnehmer: </td><td>
		<input type="text" name="veranstaltung_max_Teilnehmer" size="1" maxlength="3"/>
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
	

<?php
/* Sprint 2 Anfang 
 * Auswahl Ausstattung hinzugefügt
 */
?>
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
	
		
	
<?php
/* Sprint 2 Ende
 */

/* Sprint 3 Anfang 
 * Auswahl Studiengang für Pflichtfach hinzugefügt
 */

?>

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
		<?php
		/* Sprint 4 Anfang
		 * Auswahl Fachsemester für "Pflichtvorlesung im Studiengang" hinzugefügt
		 */ 
		?>
         in Fachsemester: 
        <select class="input " name="veranstaltung_fachsemester" style="; width: 3em">
        <?php 
 			for ($i=1; $i<=7; $i++) {
				echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
            }
		?>
        </select>	
		<?php
		/* Sprint 4 Ende
		 */ 
		?>
        
    </td>



  </tr>
<?php
/* Sprint 3 Ende
 */
?>
	
	
	
	<tr><td><input type="submit" value="anlegen" /></td><td>&nbsp;</td></tr>		
    </table>
</form>
</article>
