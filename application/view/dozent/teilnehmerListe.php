<?php

/**
* SPRINT 03
*
* @author: Damian Wysocki
* Datum: 29.04.2015
*
* User­Story (Nr. 90a ): Als Dozent möchte ich Teilnehmerlisten erzeugen können (Nacharbeit). (13 Points)
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
		
		<?php $this->renderResponse(); ?>
           <div >
                <h2>Teilnehmerliste für Kurs "<?php echo $_POST['id']; ?>"</h2>	
			<?php if ($this->teilnehmer) {
				
				$table = new Table();
				
				/*
				IN ARBEIT ;=)
				*/
				
				echo "Mit Alias & Link bzw Action übergabe";	
				// mit alias & link
				$dozentTeilnehmer = array(
				"0" => "Nutzername",
				"1" => "Email",
				"2" => "Vorname",
				"3" => "Nachname",
				"4" => "Telefonnummer",
				"5" => "Studiengang",
				"6" => "Selbst ausloggen",
				"7" => "Gehe index");
				
				#$alias = array_flip($alias);
				#$alias = array_reverse($alias);
				$dozentTeilnehmer = (object) $dozentTeilnehmer;
				
				
				// key=name des links - value=action
				$link = array(
				"Logout" => "index.php?url=login/logout",
				"Index" => "index.php?url=index");
				$link = (object) $link;
				$table->table(array('table' =>$this->teilnehmer, 'dozentTeilnehmer' => array($dozentTeilnehmer), 'link' => array($link)));
            }else { ?>
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
*/-->