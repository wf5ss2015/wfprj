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
<?php $this->renderResponse(); ?>
	<header>
				<h1>Teilnehmerliste</h1>
				<p>(Angemeldet als Nutzer:"<?php echo Session::get('user_name')?>")</p>
			</header>
		
		<!--  -->
		
         <section>
				<article>   
					<article>
						<p>Hier sehen Sie ihre zugeordneten Kurse. Bitte auswählen um Teilnehmerlisten zu erzeugen</p>
					</article>
					<!-- Prüfen ob Array leer (Wichtig, Namen für Select Tag vergeben ;=)-->
					<?php if ($this->vorlesung) { ?>
				
					<form action="index.php?url=Dozent/teilnehmerListe" method="post"/>
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
						kein Array übergeben
					<?php } ?>				
				</article>
		</section>
		
<!--
/*
* 		Diese Codezeile muss noch in den Standardheader eingefügt werden um Link herzustellen 
*		<li>
*			<a href="index.php?url=Dozent/auswahlVorlesung">Teilnehmerliste</a>
*       </li>
*/ -->