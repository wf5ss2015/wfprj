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
		/*function __construct (){
		$this->vorlesung = array (
		"VL_1",
		"VL_2",
		"VL_3",
		"VL_4",
		"VL_5",
		"VL_6",
		"VL_7",
		"VL_8",
		"VL_9",
		"VL_10",
		"VL_11",
		"VL_12",
		"VL_13",
		"VL_14",
		"VL_15",
		"VL_16",
		"VL_17",
		"VL_18",
		"VL_19",
		"VL_20",
		"VL_21",
		"VL_22",
		"VL_23",
		"VL_24",);
		$this->raum = array(
		"raum1",
		"raum2",
		"raum3",
		"raum4",
		"raum5");
		$this->dozent = array(
		"dozent1"=>array("VL_7","VL_8", "VL_9", "VL_4", "VL_5", "VL_6"),
		"dozent2"=>array("VL_1","VL_2", "VL_3", "VL_10", "VL_11", "VL_12"),
		"dozent3"=>array("VL_19","VL_20", "VL_21", "VL_16", "VL_17", "VL_18", "VL_24"),
		"dozent4"=>array("VL_13","VL_14", "VL_15", "VL_22", "VL_23", "VL_24"));
		$this->semester = array(
		"sem1"=>array("VL_1","VL_2", "VL_3", "VL_4", "VL_5", "VL_6"),
		"sem2"=>array("VL_7","VL_8", "VL_9", "VL_10", "VL_11", "VL_12"),
		"sem3"=>array("VL_13","VL_14", "VL_15", "VL_16", "VL_17", "VL_18"),
		"sem4"=>array("VL_19","VL_20", "VL_21", "VL_22", "VL_23", "VL_24"));
		print_r($this->dozent);
		print_r($this->semester);
		print_r($this->raum);
		print_r($this->vorlesung);
		}
		*/
		
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
				$randomR=rand(0,4);//zufälliger raum
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
		//array_multisort($scheduleMatrix);
		return $scheduleMatrix;
		}	
}	
?>