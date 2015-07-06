<?php
class schedule{
		public $vorlesung =array ();
		public $raum=array();
		public $dozent=array();
		public $semester=array();

		
		function __construct($vorlesung, $raum, $dozent, $semester){
			$this->vorlesung = $vorlesung;
			$this->raum = $raum;
			$this->dozent = $dozent;
			$this->semester = $semester;
		}
		
		
		function match ($obj){
		$vorlesung=$obj->vorlesung; //vorlesungen
		$raum=$obj->raum; // räume
		$dozent=$obj->dozent; // dozenten inkl. möglicher vorlesungen
		$semester=$obj->semester; // semester inkl. vorlesungen
		$scheduleMatrix[][][]=null;
		$numberOfSlots=42;
		$numberOfRooms=count($raum)-1;
		
		//print_r($dozent);

				
		// null ist frei
		for($i=0;$i<$numberOfSlots;$i++){
				$scheduleMatrix[$i][0][0]=$i;
			for($k=0;$k<count($raum);$k++){
				$scheduleMatrix[$i][$k]=null;

			}
		}
		
		//print_r($scheduleMatrix);
		$counter =0;
		while (!empty($vorlesung)){
				// nach 100 versuchen von vorne beginnen
				if($counter>=100){
					//echo "COUNTER TO BIG<br>";
					$vorlesung=$obj->vorlesung; //vorlesungen
					$scheduleMatrix[][][]=null;
					// null ist frei
					for($i=0;$i<$numberOfSlots;$i++){
							$scheduleMatrix[$i][0][0]=$i;
						for($k=0;$k<count($raum);$k++){
							$scheduleMatrix[$i][$k]=null;
						}
					}
				}
				$randomR=rand(0,$numberOfRooms);//zufälliger raum
				$randomS=rand(0,$numberOfSlots-1);//zufälliger slot
				//echo $randomS. "  <br>";
				$currentV=array_pop($vorlesung); //letzte vorlesung des arrays
				$currentD=array();// mögliche dozenten 
				$currentS; //das semester für eine vorlesung
				
				$var;
				// fügt currenD array mögliche dozenten hinzu
				foreach($dozent as $key=>$value ){
						/*echo "key1: ".$key. "<br>";
						echo "+++++<br>";*/
						$var=$key;
						//print_r($value);
						foreach($value as $key=>$value){
							/*echo "value hure: " . $value. "<br>";
							echo "currentV: " . $currentV . "<br>";
							echo "key: ".$key . "<br>";
							echo "<br>";*/
								if($currentV == $value){
								array_push($currentD, $var);
								//echo "got value hure: " . $value. "<br>";
								//print_r($currentD);
								//echo "<br>";
						}
						
						}
						//echo "------------------------<br>";
				}  
				
				//print_r($currentD);
				
				// wählt einen möglichen dozenten aus
				$selectedDozent=$currentD[rand(0,count($currentD)-1)];
				
				// wählt das semester aus welches zur vorlesung passt
				foreach($semester as $key=>$value ){
						if(in_array($currentV, $value)){
						//echo $key."<br>";
						$currentS=$key;					
						}
				}  
				
				//echo "----------------------------------------------------------------<br>";
				//echo "Slot: ".$randomS. " Raum: ". $randomR." Vorlesung: ".$currentV ." Dozent: ". $selectedDozent. " Semester: ". $currentS."<br>";
				
				//falls raum und zeit belegt sind
				if(isset($scheduleMatrix[$randomS][$randomR])){		
					$randomR=rand(0,$numberOfRooms);//zufälliger raum

					$randomS=rand(0,$numberOfSlots-1);//zufälliger slot	
					//echo $randomR;
					//echo $randomS;
					array_push($vorlesung, $currentV);
					$counter++;
					//echo "counter :".$counter."  ";
				}
				//falls dozent oder student keine zeit
				elseif(isset($scheduleMatrix[$randomS])){
					$belegtD=0;
					$belegtS=0;
					for($i=0;$i<count($raum);$i++){
						if(isset($scheduleMatrix[$randomS][$i])){
							if($scheduleMatrix[$randomS][$i][1]===$selectedDozent){
								$belegtD=1;
							}
							if($scheduleMatrix[$randomS][$i][0]===$currentS){
								$belegtS=1;
							}
						}
					}
					if($belegtD==0&&$belegtS==0){
							//echo "raum nicht belegt: ".$randomR;
							//echo " slot nicht belegt: ".$randomS."<br>";
						$scheduleMatrix[$randomS][$randomR]=
						array(
						$currentS,
						$selectedDozent,
						$raum[$randomR],
						$currentV);	
						$counter=0;
						//echo " counter :".$counter."  ";
						//print_r ($scheduleMatrix);
					}else{
						$randomR=rand(0,$numberOfRooms);//zufälliger raum
						$randomS=rand(0,$numberOfSlots-1);//zufälliger slot	
						array_push($vorlesung, $currentV);
						$counter++;
						//echo " counter :".$counter;
					}
					
				}
				// schreibt in schedule die veranstaltungen
				else{
				//echo "else: ".$randomR;
				//echo "else: ".$randomS;
				$scheduleMatrix[$randomS][$randomR]=
				array(
				$currentS,
				$selectedDozent,
				$raum[$randomR],
				$currentV);	
					$counter=0;
					//echo " counter :".$counter."  ";
				}
		} 
		//echo "<pre>";
		print_r($scheduleMatrix);
		//array_multisort($scheduleMatrix);
		return $scheduleMatrix;
		}	
}	
?>