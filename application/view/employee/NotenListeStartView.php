<?php
 /* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 23.05.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/


/**-----------------------------------------------------------------------------------------
	* START SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/03  Beschreibung: Maske zum Eintragen
	* Zeitaufwand (in Stunden): 5
	* START SPRINT 05	
	*/
	    
		/**
		 *
		 * @author Damian Wysocki
		 *        
		 *         Kurs- oder Studentenauswahl zur Eingabe von Noten
		 **/     
?>
<article>
	<h1>Notenlisten verwalten</h1>
	</br>			
	</br>
	<a>Bitte <b>Kurs</b> auswählen um Noten zu bearbeiten</a>
	</br>			
	</br>
	<!-- Prüfen ob Array leer (Wichtig, Namen für Select Tag vergeben ;=)-->
	<?php if ($this->vorlesung) { ?>

	<form action="index.php?url=Employee/showEvents" method="post" />
		<select name="id">
		<!--Veranstaltung in dropdownmenü anzeigen -->
							<?php foreach($this->vorlesung as $key => $value) { ?>
							<option value="<?php echo htmlentities($value->veranst_ID);?>">
							
							<?php echo htmlentities($value->veranst_bezeichnung); ?></option>
							<?php } ?>
		</select>
		<input type="submit" class="button" value="weiter">			
	</form>

	<!-- sonst Fehlermeldung -->
	<?php }else { ?>
	Kein Array vorhanden
	<?php } ?>
	
	</br>			
	</br>
	<a>Bitte <b>Studenten</b> auswählen um Noten zu bearbeiten</a>
	</br>			
	</br>
	<?php if ($this->students) { ?>

	<form action="index.php?url=employee/showStudents" method="post" />
		<select name="id2">
		<!--Veranstaltung in dropdownmenü anzeigen -->
							<?php foreach($this->students as $key => $value) { ?>
							<option value="<?php echo htmlentities($value->Nutzer);?>">
							<?php echo htmlentities($value->Matrikel); ?>
							<?php echo ", "; ?>
							<?php echo htmlentities($value->Nutzer); ?>
							<?php echo ", "; ?>
							<?php echo htmlentities($value->Nachname); ?>
							</option>
							<?php } ?>
							
		</select> 
		<input type="submit" class="button" value="weiter">
	</form>

	<!-- sonst Fehlermeldung -->
<?php echo '<pre>'; print_r($_POST); echo '<pre>'; }else { ?>
	Kein Array vorhanden
<?php } ?>
</article>

<?php 
	/** ENDE SPRINT 05
		* @author: Damian Wysocki
		* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
		* Task: 430a/03  Beschreibung: Maske zum Eintragen
		* Zeitaufwand (in Stunden): 5
		* ENDE SPRINT 05
	**-----------------------------------------------------------------------------------------*/	?>
