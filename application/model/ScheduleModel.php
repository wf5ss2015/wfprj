<?php


/**
 *
 * @author Kilian Kraus
 *         Model für den Nutzer. In diesem fall nur um Nutzerdaten anhand des Nutzernames zu bekommen.
 */
class ScheduleModel {
	/**
	 *
	 * @author Kilian Kraus
	 *        
	 * @param $user_name string
	 *        	Nutzername
	 *        	
	 * @return mixed Gibts false zurück, wenn Nutzer nicht besteht. Ansonsten Objekt mit den Nutzerdaten zurück.
	 */
	public function getLecture() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "select veranst_id, veranst_kurztext, SWS from veranstaltung;";
		$query = $database->prepare ( $sql );
		
		$query->execute ();
		
		return $query->fetchAll ();
	}
	
	public function getRoom() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "select raum_bezeichnung from raum";
		$query = $database->prepare ( $sql );
		
		$query->execute ();
		
		return $query->fetchAll();
	}
	
	public function getDocent() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "select * from dozent_berechtigtfuer_veranstaltung";
		$query = $database->prepare ( $sql );
		
		$query->execute ();
		
		return $query->fetchAll();
	}
	
	public function getSemester() {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "select studiengang.stg_id, studiengang_hat_veranstaltung.pflicht_im_Semester, stg_kurztext, studiengang_hat_veranstaltung.veranst_id, SWS
				from studiengang 
				join studiengang_hat_veranstaltung 
				join veranstaltung 
				where studiengang.stg_ID = studiengang_hat_veranstaltung.stg_ID  
				and veranstaltung.veranst_id = studiengang_hat_veranstaltung.veranst_id";
		$query = $database->prepare ( $sql );
		
		$query->execute ();
		
		return $query->fetchAll();
	}
	
	public function saveSchedule($schedule) {
		$database = DatabaseFactory::getFactory ()->getConnection ();
		
		$sql = "truncate table veranstaltungstermin";
		$query = $database->prepare ( $sql );
		
		$query->execute ();
		$countZeit=1;
		$countTag=1;
		for($i=0;$i<count($schedule);$i++){
			for($k=0;$k<count($schedule[$i]);$k++){
				
				if(isset($schedule[$i][$k])){
					echo "zeit: " . ($countZeit) . " tag: " . $countTag . "<br>";
						$sql = "insert into veranstaltungstermin values (:veranst_id, :tag_id, :stdZeit_id, :raum_bezeichnung);";
						$query = $database->prepare ( $sql );
						$query->execute ( array (
							':veranst_id' => $schedule[$i][$k][3], 'tag_id' => $countTag, 'stdZeit_id' => $countZeit, 'raum_bezeichnung' => $schedule[$i][$k][2]
						) );
				}
			
				
			}
			if($countZeit==7){
				$countZeit=0;
				$countTag++;
			}
			$countZeit++;
		}
		//print_r($schedule);
		
		
	}
}
