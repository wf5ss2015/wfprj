<?php

?>

<article>
	<h1>Stundenplan generieren</h1>

	<table class='stundenplan' border='1'>
		
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
		$slots=array("08:00-09:30", "09:50-11:20", "11:30-13:00", "14:00-15:30", "15:45-17:15", "17:25-18:55", "19:00-20:30");
			while ($j<7){
				$i=0;
				echo "<tr>";
				while($i<6){
					if($i==0){
						echo "<td class='content' style='text-align:center'>". $slots[$j]." </td>";
					}
					echo "<td >";
					$first=0;
					$empty=1;
		
					for($k=0;$k<(count($this->schedule[$counter]));$k++){

						if(isset($this->schedule[$counter][$k])){

							$empty=0;
							for($n=0;$n<count($this->schedule[$counter][$k]);$n++){
							
							if($n==3){
								foreach($this->lecture as $key => $value){
									if($value->veranst_id==$this->schedule[$counter][$k][$n]){
										echo $value->veranst_kurztext;
									}
								}
							}else{
								echo $this->schedule[$counter][$k][$n];
							}
							
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
					$i++;
					$counter++;
				}
				echo "</tr>";
				$j++;
				}
		?>
	</table>
	
	<table>
	<tr><td><form action="index.php?url=Employee/createSchedule" method="post">
	<input type="submit" class="button" style="margin-left:20px; margin-top:10px;" value="neu generieren">
	</form></td>
	<?php $str=serialize($this->schedule);?>
	<td><form action="index.php?url=Employee/saveSchedule" method="post">
	
	<input name="schedule" type="hidden" value='<?php echo $str;?>'>
	<input type="submit" class="button" style="margin-left:10px; margin-top:10px;" value="Stundenplan speichern">
	</form></td>
	</table>
	
	</article>
