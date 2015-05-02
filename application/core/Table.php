<?php
/*===============================================
 Sprint: 3
 @author: Kilian Kraus
 Datum: 25.04.2015
 Zeitaufwand (in Stunden): 2.5
 User Story Nr.: 
 User Story: generische Tabellen
 Task:  template erstellen
 ===============================================*/
 ?>
 
 <?php 

class Table 
{
	public function __construct() {
	
	}
	
	// funktion um tabelle zu erstellen
	public function table($data = null)
    {
		if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
		
	// baut tabelle zusammen
	echo "<table>";   
	echo "<thead style=background:#FF00FF>";
		// falls alias übergeben wurde
		if (isset($this->alias)) {
			echo "<tr>";
			foreach($this->alias[0] as $key => $value) { 
				echo "<td>";
				echo htmlentities($value);
				echo "</td>";
			}
			echo "</tr>";
			echo "</thead>";
		}else { 
		// falls keine alias übergeben, dann spaltenname
            echo "<tr>";
			foreach($this->table[0] as $key => $value) { 
				echo "<td>";
				echo htmlentities($key);
				echo "</td>";
			}	
			echo "</tr>";
			echo "</thead>";
		} 	
			// befüllt tabelle mit daten
			echo "<tbody>";
				echo "<tr>";
					$i = 0;
					while ($i < count($this->table)) {					
						echo "<tr>";
						foreach($this->table[$i] as $key => $value) { 
							if ($i%2 != 0){
								echo "<td style=background:gray>";
							}else{
								echo "<td =>";
							}							
							echo htmlentities($value);
							echo "</td>";
						} 	
						echo "</tr>"; 
						$i++;
					}	
				echo "</tr>";
			echo "</tbody>";
		echo "</table>";
	}
}?>	   			

              
				


                
                
                

             
            
			


