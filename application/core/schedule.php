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
				
		// null ist frei
		for($i=0;$i<$numberOfSlots;$i++){
				$scheduleMatrix[$i][0][0]=$i;
			for($k=0;$k<count($raum);$k++){
				$scheduleMatrix[$i][$k]=null;

			}
		}

		$counter =0;
		while (!empty($vorlesung)){
				// nach 100 versuchen von vorne beginnen
				if($counter>=100){
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
				$currentV=array_pop($vorlesung); //letzte vorlesung des arrays
				$currentD=array();// mögliche dozenten 
				$currentS; //das semester für eine vorlesung
				
				$var;
				// fügt currenD array mögliche dozenten hinzu
				foreach($dozent as $key=>$value ){
						$var=$key;
						foreach($value as $key=>$value){
								if($currentV == $value){
								array_push($currentD, $var);
								}
						}
				}  

				// wählt einen möglichen dozenten aus
				$selectedDozent=$currentD[rand(0,count($currentD)-1)];
				
				// wählt das semester aus welches zur vorlesung passt
				foreach($semester as $key=>$value ){
						if(in_array($currentV, $value)){
						$currentS=$key;					
						}
				}  
		
				//falls raum und zeit belegt sind
				if(isset($scheduleMatrix[$randomS][$randomR])){		
					$randomR=rand(0,$numberOfRooms);//zufälliger raum
					$randomS=rand(0,$numberOfSlots-1);//zufälliger slot	
					array_push($vorlesung, $currentV);
					$counter++;
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
						$scheduleMatrix[$randomS][$randomR]=
						array(
						$currentS,
						$selectedDozent,
						$raum[$randomR],
						$currentV);	
						$counter=0;
					}else{
						$randomR=rand(0,$numberOfRooms);//zufälliger raum
						$randomS=rand(0,$numberOfSlots-1);//zufälliger slot	
						array_push($vorlesung, $currentV);
						$counter++;
					}
					
				}
				// schreibt in schedule die veranstaltungen
				else{
				$scheduleMatrix[$randomS][$randomR]=
				array(
				$currentS,
				$selectedDozent,
				$raum[$randomR],
				$currentV);	
					$counter=0;
				}
		} 
		return $scheduleMatrix;
		}	
}	
?>