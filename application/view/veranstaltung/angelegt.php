<?php
/**
* SPRINT 03
*
* @author: Roland Schmid
* Datum: 02.05.2015
*
* User­Story (Nr. xx ):  .... (n Points)
* Zeit: m
*/


/**
 * @author Roland Schmid
 * Das ist der Veranstaltung Controller. Steuert den Login Prozess.
 */
?>

eben angelegte Veranstaltung anzeigen

<table>
        <?php
            // erzeugt die Liste mit "option"-HTML-Elementen aus dem Array vArten
            foreach($this->veranstaltung as $key => $value) {                 
//                echo "\n\t<option value=\"" . $value->vArt_ID . "\">";                
//                echo $value->vArt_bezeichnung . "</option>";        
                echo "<tr><td>";
                echo $value . "</td>"; 
                echo "<td>$value->veranst_ID" . "</td>";
                echo "</tr>";
                
                 /* $q = "select Veranstaltung.veranst_ID, Veranstaltung.veranst_bezeichnung, Veranstaltung.veranst_kurztext, Veranstaltung.credits, Veranstaltung.SWS, "
	  ."Veranstaltung.maxTeilnehmer, Veranstaltungsart.vArt_bezeichnung as Veranstaltungsart "
	  . "from Veranstaltung join Veranstaltungsart on Veranstaltung.vArt_ID = Veranstaltungsart.vArt_ID"
	  ." where Veranstaltung.veranst_ID = $vid;";*/
            }	
       
        
        ?>
</table> 