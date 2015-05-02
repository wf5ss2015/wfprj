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

	/*um table.php zu benutzen im Controller folgendes machen
	*	
		// alias für die erste tabelle
		$alias0 = array(
			"0" => "Nutzer",
			"1" => "Passwort",
			"2" => "Letzter Login",
			"3" => "Rolle",);
		$alias0 = (object) $alias0;
		
		// die zweite tabelle hat keine alias
		
		// alias für die dritte tabelle
		$alias2 = array(
			"0" => "Nutzer",
			"1" => "Passwort",);
		$alias2 = (object) $alias2;
		
		// View->renderMulti verwenden.
		// Zuerst zur normalen View '_templates/table' aufnehmen. --> Es sind auch mehr als zwei Views möglich
		// Tabellen müssen 'table*' heißen, gefolgt von einem optionalen 'alias*' --> siehe unten.
		// Die Reihenfolge der Tabellen ist egal. Ein Alias muss jedoch der dazugehörigen Tabelle (noch) direkt folgen.
		$this->View->renderMulti(array('login/loggedinDocent', '_templates/table'), array(
            'table0' => UserModel::getUserDataAll(),'alias0' => array($alias0),
			'table2' => UserModel::getUserDataAll3(),'alias2' => array($alias2),
			'table1' => UserModel::getUserDataAll2(),)
		);
	*/
	
	// um den index hochzuzählen
	$countTable =0;
	// werden die tables/alias erst mal gespeichert
	$tableArr = array();
	$aliasArr = array();
	
	// sucht sich alles mit "table" und "alias" raus
	foreach($this as $key => $value) { 
	if(preg_match("/table/",$key)){
		$tableArr[$countTable] = $key;
		$countTable++;
	}elseif(preg_match("/alias/",$key)){
		$idArray = substr($key, 5);
		//print_r($idArray);
		$aliasArr[$idArray] = $key;
	}else{
	}
	}
	//print_r($tableArr);
	//print_r($aliasArr);
	sort($tableArr);
	//print_r($tableArr);
	//print_r($aliasArr);
	
	
	$k = 0;
	
	// damit mehrere tabellen auf einmal angezeigt werden können
	while($k <= count($tableArr)-1){
		if(preg_match("/table".$k."/",$tableArr[$k])&&preg_grep ("/alias".$k."/",$aliasArr)){
		//print_r($k);
		$this->table = $this->$tableArr[$k];
		$this->alias = $this->$aliasArr[$k];
		$k++;
		//print_r($k);
	}elseif(preg_match("/table".$k."/",$tableArr[$k])){
		$this->table = $this->$tableArr[$k];
		$k++;
	}else{
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
		// auf null setzen
		$this->table = null;
		$this->alias = null;
}?>	   			

              
				


                
                
                

             
            
			


