<?php

/*
 * HS-Ulm, WF5, SS2015, Wirtschaftsinformatik-Projekt
 * Projekt: Lehrveranstaltungssoftware
 * Name: Roland Schmid
 * Gruppe: 01
 * Sprint: 3
 * Version: 1
 * Datum: 2015-04-28
 * ----------------------------------------------------------------------------
 *
 * User-Story: (alte User Story, die jetzt in MVC überführt wurde)
 *              ....
 *
 */


?>

<h1>Neue Veranstaltung anlegen</h1>

<form action=index.php?url=veranstaltung/anlegen method="post">
	
    <table id="veranst-anlegen">
	<tr><td>Bezeichnung: </td> <td><input type="text"  name="veranstaltung_bezeichnung" size="36" maxlength="100" /></td></tr>
	<tr><td>Kurztext: </td> <td><input type="text"  name="veranstaltung_kurztext" /></td></tr>
	<tr><td>SWS: </td> <td>
	
            <select name="veranstaltung_sws" style="; width: 15em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 10
                    for ($i=1; $i<=10; $i++) {
                            echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
                    }
            ?>

            </select> 
	
	</td></tr>
	
	
	<tr><td>Credits (ECTS-Punkte): </td><td>
	
            <select name="veranstaltung_credits" style="; width: 15em">
            <?php
            //befüllt den selection-Abschnitt mit den Werten von 1 bis 12
                    for ($i=1; $i<=20; $i++) {
                            echo "\n\t<option value=\"" . $i . "\">" . $i . "</option>";
                    }
            ?>

            </select> 
	</td></tr>
	
		
	<tr><td>maximale Anzahl Teilnehmer: </td><td>
		<input type="text" name="veranstaltung_max_Teilnehmer" size="3" maxlength="3"/>
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
                echo "\n\t<td><input type=\"text\"  name=\"veranstaltung_ausstattung[]\"";
                echo " size=\"1\" /> </td>";

                echo "\n\t<td> " . $value->ausstattung_bezeichnung . "</td>";
                echo " \n</tr>";
            }	
	

	?>
	</table>
	
	</td></tr>
	
		
	
<?php
/* sprint 3 Anfang*/
?>

  <tr>
    <td> Pflichtvorlesung im Studiengang: </td>
    <td>
  
        <select class="input " name="veranstaltung_pflichtvorlesung" style="; width: 32em">	


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
    </td>



  </tr>
<?php
/* sprint 3 Ende */
?>
	
	
	
	<tr><td><input type="submit" value="anlegen" /></td><td>&nbsp;</td></tr>		
    </table>
</form>