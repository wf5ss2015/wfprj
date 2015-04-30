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
 * Beschreibung: View um Teilnehmer einer Vorlesung anzuzeigen
 *
 */
?>
<div class="container">

        <div class="table-wrapper">
		
		<!-- Schleife um die Einträge in der DB Tabelle auszulesen -->
		<?php $this->renderResponse(); ?>
            <div >
             
			<!--Prüfen ob array leer -->
			<?php if ($this->teilnehmer) { ?>
			
			<h2>Teilnehmerliste </h2>	
            <table style="width: 100%" >
                <thead>
                <tr>
					<td><h3>Nutzername</h3></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
				
					<!-- Schleife um die Einträge in der DB Tabelle auszulesen -->
                    <?php foreach($this->teilnehmer as $key => $value) { ?>
                        <tr>
							<td><?= htmlentities($value->user_name);?></td>
							<td><?= htmlentities($value->veranst_bezeichnung)?></td>
						</tr>
                    <?php } ?>
					
                </tbody>
            </table>
			
			<!-- Ansonsten Fehlermeldung -->
            <?php }else { ?>
                <div>Kkein array übergeben.</div>
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
*/-->