<?php
/* ===============================================
 * Sprint: 5
 * @author: Damian Wysocki
 * Datum: 23.05.2015
 * User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
 * Zeit insgesamt: 15
 * ===============================================*/
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.5 
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
 * Task: core/table.php erweitert 
 * ===============================================
 */
/*
 * ===============================================
 * Sprint: 3
 * @author: Kilian Kraus
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): 2.5
 * User Story Nr.: 350
 * User Story: generische Tabellen
 * Task: template erstellen
 * ===============================================
 */
?>
 
 <?php
	class Table2 {
		public function __construct() {
		}
		
		// funktion um tabelle zu erstellen
		public function table($data = null) {
			if ($data) {
				foreach ( $data as $key => $value ) {
					$this->{$key} = $value;
				}
			}
			
			// baut tabelle zusammen
			echo "<table>";
			echo "<thead>";
			// falls alias übergeben wurde
			if (isset ( $this->alias )) {
				echo "<tr>";
				foreach ( $this->alias [0] as $key => $value ) {
					echo "<td>";
					echo htmlentities ( $value );
					echo "</td>";
				}
				echo "</tr>";
				echo "</thead>";
			} else {
				// falls keine alias übergeben, dann spaltenname
				echo "<tr>";
				foreach ( $this->table [0] as $key => $value ) {
					echo "<td>";
					echo htmlentities ( $key );
					echo "</td>";
				}
				echo "</tr>";
				echo "</thead>";
			}
			// befüllt tabelle mit daten
			echo "<tbody>";
			echo "<tr>";
			$i = 0;
			while ( $i < count ( $this->table ) ) {
				echo "<tr>";
				foreach ( $this->table [$i] as $key => $value ) {
					if ($i % 2 != 0) {
						echo "<td style=background:#A9DFFF; >";
					} else {
						echo "<td>";
					}
					echo htmlentities ( $value );
					echo "</td>";
				}
				// falls link
				if (isset ( $this->link )) {
					foreach ( $this->link [0] as $key => $value ) {
						$submitName = $key;
						echo "<td align=center>";
						echo "<form action=\"";
						echo htmlentities ( $value );
						echo "\" method=\"post\">";
						foreach ( $this->table [$i] as $key => $value ) {
							echo "<input type=\"hidden\" name=\"";
							echo htmlentities ( $key );
							echo "\" value=\"";
							echo htmlentities ( $value );
							echo "\">";
						}
	/*
	 * ===============================================
	 * Start Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
	 * ===============================================
	 */							
							// zusätzliche hidden values
							if(isset($this->hidden)){
								foreach ( $this->hidden[0] as $key => $value ) {
									echo "<input type=\"hidden\" name=\"";
									echo htmlentities ( $key );
									echo "\" value=\"";
									echo htmlentities ( $value );
									echo "\">";
								}
							}
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
		 *         Nur Zahlen mit Schritten von 0,3 als Noteneintrag erlaubt
		 **/     

					echo "<input type=\"number\" min=\"1\" max=\"5\" step=\"0.35\" name=\"";
					echo htmlentities ( $key );
					echo "\" value=\"";
					echo htmlentities ( $value );
					echo "\">";
					
						echo "<input class=\"button\" type=\"submit\" onClick=\"return confirm('Wollen Sie die Note wirklich ändern?')\" value=\"";
						/**
	* ENDE SPRINT 05
	* @author: Damian Wysocki
	* User Story (Nr.: 430a)  Als Mitarbeiter möchte ich Noten von Veranstaltungen für die Teilnehmer eintragen können. (erneut)
	* Task: 430a/03  Beschreibung: Maske zum Eintragen
	* Zeitaufwand (in Stunden): 5
	* ENDE SPRINT 05
	**-----------------------------------------------------------------------------------------*/	
						
						echo htmlentities ( $submitName );
						echo "\">";
						echo "</form>";
						echo "</td>";
					}
				}				
				echo "</tr>";
				$i ++;
			}
			echo "</tr>";
			echo "</tbody>";
			echo "</table>";
		}
	}
	?>	   			

              
				


                
                
                

             
            
			


