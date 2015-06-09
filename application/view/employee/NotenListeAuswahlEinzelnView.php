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
		 *         Anzeige aller Noten eines bestimmten Studenten
		 **/     
?>

<article>
	<h1>Noten ändern</h1>
	
	<?php if ($this->notenlisteStudent) { 
	
	 foreach($this->notenlisteStudent as $key => $value){
		$this->{$key} = $value;
	
	 } ?>
	 
	<h3>Notenliste für Nutzer <b>"<?php echo htmlentities($_POST['id2']);?>"</b> </h3>
	</br>			
	</br>
	
	<?php //echo '<pre>'; print_r($_POST); echo '<pre>';  ?>
<?php 	
	 
	$table = new Table2 ();
	
	// Tabelle erzeugen
	$noten = array (
			"0" => "Kurs-ID",
			"1" => "Kurs",
			"2" => "Nutzer",
			"3" => "Matrikel",
			"4" => "Nachname",
			"5" => "Vorname",
			"6" => "Note" 
	);
	
	// Testzwecke
	// $alias = array_flip($alias);
	// $alias = array_reverse($alias);
	$noten = ( object ) $noten;
	
	// key=name des links - value=action
	$link = array (
			"Note eintragen" => "index.php?url=employee/aendernNote" 
	);
	
	$link = ( object ) $link;
	
	$table->table ( array (
			'table' => $this->notenlisteStudent,
			'noten' => array (
					$noten 
			),
			'link' => array (
					$link 
			)
	) );
	
} else {
?>
kein array übergeben
 <?php } ?>		
	<form> <input class="button" type="submit" name="laden" value="Zurück zur Auswahl"
				formaction="index.php?url=employee/startNotenListe" formmethod="post"></form>
</article>

<?php 
	/** ENDE SPRINT 05
		* @author: Damian Wysocki
		* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
		* Task: 430a/03  Beschreibung: Maske zum Eintragen
		* Zeitaufwand (in Stunden): 5
		* ENDE SPRINT 05
	**-----------------------------------------------------------------------------------------*/	?>