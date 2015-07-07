<?php

/**
 * SPRINT 03
 *
 * @author: Damian Wysocki
 * Datum: 29.04.2015
 *
 * User­Story (Nr. 150a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können. (13 Points)
 * Zeit: 1,5
 */

/**
 *
 * @author Damian Wysocki
 *        
 *         Beschreibung: View um Teilnehmer einer Vorlesung anzuzeigen
 *        
 */
?>
<article>

<?php if ($this->teilnehmer) { 
	
	 foreach($this->teilnehmer as $key => $value){
		$this->{$key} = $value;
		}
	
	 } //print_r($_POST);?>

	<h1>Teilnehmerliste für Kurs "<?php echo htmlentities($value->Bezeichnung); ?>" </h1>
	</br>			
	</br>
			<?php //echo '<pre>'; print_r($_POST); echo '<pre>';  ?>	
<?php

if ($this->teilnehmer) {
	
	$table = new Table ();
	
	// Tabelle erzeugen
	$dozentTeilnehmer = array (
			"0" => "Studiengang",
			"1" => "Nachname",
			"2" => "Vorname",
			"3" => "Email",
			"4" => "Telefonnummer",
			"5" => "Matrikel",
			"6" => "Anzeigen" 

	);
	
	// Testzwecke
	// $alias = array_flip($alias);
	// $alias = array_reverse($alias);
	$dozentTeilnehmer = ( object ) $dozentTeilnehmer;
	
	// key=name des links - value=action
	$link = array (
			"Email verschicken" => "index.php?url=Dozent/emailDozent" 
	);
	
	$link = ( object ) $link;
	
	$kid = $_POST['id'];
	
	$hidden =array(
			"kurs" => "$kid"
			);
	
	$hidden = ( object ) $hidden;
	
	$table->table ( array (
			'table' => $this->teilnehmer,
			'dozentTeilnehmer' => array (
					$dozentTeilnehmer 
			),
			'link' => array (
					$link 
			),
			'hidden' => array (
					$hidden 
			) 
	) );
	?>
	
	<form method="post" action="index.php?url=email/writeMailAll">
		<input type="hidden" name="id"
			value="<?php echo htmlentities($_POST['id']); ?>" /> <input class="button"
			type="submit" value='Email an Alle'/>
			</br>
			</br>
			</br>
	</form>
			
	<form> <input class="button" type="submit" name="laden" value="Zurück Auswahl"
				formaction="index.php?url=Dozent/auswahlVorlesung" formmethod="post">
	</form>
				
	<?php
} else {
?>
kein array übergeben
 <?php } ?>			
</article>

