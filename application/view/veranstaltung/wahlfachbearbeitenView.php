<?php /**
 * SPRINT 06
 *
 * @author : Roland Schmid
 * Datum: 	23.6.2015
 * User­ Story: Als Mitarbeiter möcht ich einem Studiengang Wahlfächer zuordnen könnenn.
 * Task: 	Maske, um ein Fach einem Studiengang als Wahlfach zuordnen zu können. 
 * Nr:		630
 * Points:	8
 * Zeit:	5
 *
 */

?>



<article>
<h1>Wahlfach: Veranstaltung auswählen</h1>
<p>Wählen Sie den Studiengang aus, dem Sie die Veranstaltung als Wahlfach zuordnen m&ouml;chten: </p>
 
 
 
 
 <?php 
//  $grunddaten = $data['grunddaten'];
//  $grunddaten['vBezeichnung'];
 $veranstaltung = $this->veranstaltung[0];
 $studgaenge = $this->studiengaenge;
 ?>
 
 
 
 
 
 
 <form action="index.php?url=veranstaltung/wahlfachEintragen" method="post">
	
		<?php 
			//wichtig, hier die ID per hidden input mitzuübergeben
		?>
		<input name="veranst_ID" value=<?php echo "\"". $veranstaltung->veranst_ID ."\"";?> type="hidden">
		<?php //<input name="Veranstaltungsart" value=<?php echo "\"$veranst->Veranstaltungsart\"" type="hidden">?>
		
	
    <table id="wahlfach_waehlen">
	<tr><td>
	
	<?php if ($this->veranstaltung) { 

	/* Tabelle drucken mit alias & link
	 * generische Tabelle mit Linkauswahl von Kilian Kraus
	 * Tabelle mit "hidden input" ermöglicht die Übergabe der Veranstaltungs-ID
	 * */ 
	
	$table = new Table ();
	$alias = array (
			"0" => "Veranstaltungsnummer",
			"1" => "Bezeichnung",
			"2" => "Kurztext",
			"3" => "Credits",
			"4" => "SWS",
			"5" => "maximale Anzahl Teilnehmer",
			"6" => "Veranstaltungsart" 
	);
	$alias = ( object ) $alias;
	
	// key=name des links - value=action
	$table->table ( array (
			'table' => $this->veranstaltung,
			'alias' => array (
					$alias
					) 
	) );
        } else {
        	echo "error";
        }

        
        ?>	
	
	
	</td></tr>
	
	<tr><td><br><br>Studiengang: <br>
	
	
            <select name="studiengang" style="; width: 20em">
            <?php
 		foreach($studgaenge as $key => $value) {
	    	echo "\n\t<option value=\"" . $value->stg_ID . "\"";
	
	    	echo ">";
	    	echo $value->stg_ID . " - " . $value->stg_bezeichnung . " " . $value->stgTyp_kuerzel . "</option>";    
  	  }
            ?>

            </select> 
	ab Fachsemester: 
	
	
            <select name="semester" style="; width: 3em">
            <?php
 		for($i = 1; $i < 10; $i++) {
	    	echo "\n\t<option value=\"" . $i . "\"";
	
	    	echo ">";
	    	echo $i . "</option>";    
  	  	}
            ?>

            </select> 
	</td></tr>
	
	<tr><td><input class="button" type="submit" value="weiter" /></td><td>&nbsp;</td></tr>		
    </table>
</form>


</article>

