<?php
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 0.5 (alle views)
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
 * Task: views erstellen
 * ===============================================
 */
?>

<article>
	<h1>Stundenplan generieren</h1>

	<?php
	$generate = new schedule();
	echo "<pre>";
	$schedule=$generate->match($generate);

	print_r($schedule);
		
	
?>	
	<table class='stundenplan' border='1'>
		<tr>
		<tr class='head'>
					<th style='width: 110px;'>Stundenzeit</th>
			<th>Montag</th>
			<th>Dienstag</th>
			<th>Mittwoch</th>
			<th>Donnerstag</th>
			<th>Freitag</th>
			<th>Samstag</th>
		</tr>
		<?php 
		$counter=0;
		$j=0;
			while ($j<7){
				$i=0;
				echo "<tr>";
				while($i<6){
					
	
					if($i==0){
						echo "<td>Slot ". $j." </td>";
					}
					echo "<td>";
					$first=0;
					for($k=0;$k<(count($schedule[$counter]));$k++){
						
						if(isset($schedule[$counter][$k])){

							
							for($n=0;$n<count($schedule[$counter][$k]);$n++){

							echo $schedule[$counter][$k][$n];
							echo "<br>";
							$first=1;
							}
							if($first==1){
								echo "<br>";
							}
							$first=0;
						}
						
					}

					
					echo "</td>";
					//echo $k<count($schedule[$counter]);
					
					
					$i++;
					$counter++;
				}
				echo "</tr>";
				$j++;
				}
				
			
			
			
		?>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
	</table>
</article>
