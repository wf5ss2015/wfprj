<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 90 ): Als Dozent möchte ich Teilnehmerlisten erzeugen können (Nacharbeit). (13 Points)
* Zeit: 0.25
*/

/**
 * @author Damian Wysocki
 *
 * Beschreibung: View um verfügbare Vorlesungen eines Dozenten anzuzeigen
 *
 */
?>
<div class="container">

        <div class="table-wrapper">
		
		<!--  -->
		<?php $this->renderResponse(); ?>
            
			<!-- Prüfen ob Array leer (Wichtig, Namen für Select Tag vergeben ;=)-->
			<?php if ($this->vorlesung) { ?>
			
			<form action="index.php?url=Dozent/teilnehmerListe" method="post"/>
			<select name="id">
			
			<!--Veranstaltung in dropdownmenü anzeigen -->
			<?php foreach($this->vorlesung as $key => $value) { ?>
			
			<option value="<?php echo htmlentities($value->veranst_ID);?>"><?php echo htmlentities($value->veranst_bezeichnung); ?></option>
			
			<?php } ?>
			</select>
	 		<input type="submit" value="weiter">
			</form>
			
			<!-- sonst Fehlermeldung -->
            <?php }else { ?>
                <div>kein array übergeben</div>
            <?php } ?>				
            </div>
        </div>

</div>
<!--
/*
* 		Diese Codezeile muss noch in den Standardheader eingefügt werden um Link herzustellen 
*		<li>
*			<a href="index.php?url=Dozent/auswahlVorlesung">Teilnehmerliste</a>
*       </li>
*/ -->