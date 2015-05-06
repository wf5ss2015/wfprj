<!--
    autor: Kris Klamser
    datum: 4.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. 280): Als Admin möchte ich alle Nutzer in einer Liste speichern können. (20 Pkt.)
-->
<html>
<head>
    <title>Nutzer speichern</title>   
</head>
<body> 
    <header>
        <h1>Nutzerliste</h1>
    </header>
    <form action="index.php?url=nutzerlisteDrucken/printUser" method="post"/>
    <div>
		<p>Im Folgenden sehen Sie eine Liste von allen Nutzern: </p>
		
			
        <?php
			if ($this->user_list){
				
				$table = new Table();
				$userInfo = array(
					"0" => "Nutzername",
					"1" => "Rolle",
					"2" => "E-Mail",
					"3" => "Straßenname",
					"4" => "Hausnummer",
					"5" => "PLZ",
					"6" => "Stadt",
					"7" => "Land");
				$table->table(array('table' =>$this->user_list, 'alias' => array($userInfo)));
				/*
				Alternativ ohne Table-Class:
				
				<table><tr>
				<th>Username</th> <th>Rolle</th> <th>E-Mail</th> <th>Strassenname</th> <th>Hausnummer</th> <th>PLZ</th> <th>Stadt</th> <th>Land</th> 
				</tr>
				foreach($this->user_list as $key => $value){
					echo "<tr>"; 
					echo "<td>"; echo htmlentities($value->nutzer_name); echo "</td>";
					echo "<td>"; echo htmlentities($value->rolle_bezeichnung); echo "</td>";
					echo "<td>"; echo htmlentities($value->email_name); echo "</td>";
					echo "<td>"; echo htmlentities($value->straßenname); echo "</td>";
					echo "<td>"; echo htmlentities($value->hausnummer); echo "</td>";
					echo "<td>"; echo htmlentities($value->plz); echo "</td>";
					echo "<td>"; echo htmlentities($value->stadt); echo "</td>";
					echo "<td>"; echo htmlentities($value->land); echo "</td>";
					echo "</tr>";
				}
				</table>*/
			} else{
				echo "Es ist ein Fehler aufgetretten.";
			}
		?>
    </div>
		<p>
			<?php
				echo '<input type="button" value="Zurück" onClick="history.back();">';
			?>
			<input type="submit" id="b1" value="Nutzerliste drucken"></a>
		</p>
    </form>
</body>
</html>