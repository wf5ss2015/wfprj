<?php
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
	class Table {
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
					echo utf8_encode ( $value );
					echo "</td>";
				}
				echo "</tr>";
				echo "</thead>";
			} else {
				// falls keine alias übergeben, dann spaltenname
				echo "<tr>";
				foreach ( $this->table [0] as $key => $value ) {
					echo "<td>";
					echo utf8_encode ( $key );
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
					//echo utf8_encode ( $value );
					echo utf8_encode($value);
					echo "</td>";
				}
				// falls link
				if (isset ( $this->link )) {
					foreach ( $this->link [0] as $key => $value ) {
						$submitName = $key;
						echo "<td align=center>";
						echo "<form action=\"";
						echo utf8_encode ( $value );
						echo "\" method=\"post\">";
						foreach ( $this->table [$i] as $key => $value ) {
							echo "<input type=\"hidden\" name=\"";
							echo utf8_encode ( $key );
							echo "\" value=\"";
							echo utf8_encode ( $value );
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
									echo utf8_encode ( $key );
									echo "\" value=\"";
									echo utf8_encode ( $value );
									echo "\">";
								}
							}
	/*
	 * ===============================================
	 * Ende Sprint: 4
	 * @author: Kilian Kraus
	 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
	 * ===============================================
	 */
						echo "<input class=\"button\" type=\"submit\" value=\"";
						echo utf8_encode ( $submitName );
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

              
				


                
                
                

             
            
			


