<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 150a): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
* Zeit: 1,5
*/

/**
 * @author Damian Wysocki
 *
 * Beschreibung: View um zugeordnete Vorlesungen eines Dozenten anzuzeigen
 *
 */
?>
	<header>
		<h2>Teilnehmerliste</h2>
		
	</header>
		
         <section>
				<article>   
					<article>
						<p>Hier sehen Sie ihre zugeordneten Kurse. Bitte auswählen um Teilnehmerlisten zu erzeugen</p><br>
					</article>
					
					<!-- Prüfen ob Array leer (Wichtig, Namen für Select Tag vergeben ;=)-->
					<?php if ($this->vorlesung) { ?>
				
					<form action="index.php?url=dozent/teilnehmerListe" method="post"/>
						<select name="id">
							
							<!--Veranstaltung in dropdownmenü anzeigen -->
							<?php foreach($this->vorlesung as $key => $value) { ?>
							<option value="<?php echo htmlentities($value->veranst_ID);?>">
							<?php echo htmlentities($value->veranst_bezeichnung); ?></option>
							<?php } ?>
							
						</select>
						<input type="submit" value="weiter">
					</form>
					
					<!-- sonst Fehlermeldung -->
					<?php }else { ?>
							Kein Array vorhanden
					<?php } ?>				
				</article>
		</section>
		