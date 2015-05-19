
<?php
	
class menueView{
	
	private $menue;
	
	public function __construct() {	


		$this->menue= array(
		// Nicht angemeldet
		array (
			array(
			"Home" => "index/index", ),
			array(
			"Login" => "login/index")
		),
		// Student
		array (
			array(
			"Home" => "index/index"),
			array(
			"Raumplan" => "raumplan/erzeugeFormular1"),
			array(
			"Kursanmeldung" => "student/enrollClass"),
			array(
			"Kursabmeldung" => "student/delistClass"),
			array(
			"Logout" => "login/logout")
		),
		// Dozent
		array (
			array(
			"Home" => "index/index"),
			array(
			"Raumplan" => "raumplan/erzeugeFormular1"),
			array(
			"Teilnehmerliste" => "Dozent/auswahlVorlesung"),
			array(
			"Logout" => "login/logout")
		),
		// Mitarbeiter
		array (
			array(
			"Home" => "index/index"),
			array(
			"Veranstaltung" => "#",
			"erweitern" => "veranstaltungerweitern/veranstaltungErweitern",
			"anlegen" => "veranstaltung/anlegenForm",
			"bearbeiten" => "veranstaltung/bearbeitenSelect"),
			array(
			"Räume" => "#",
			"anlegen" => "raumAnlegen/raumAnlegen",
			"zuordnen" => "raumZuweisen/erzeugeFormular1",
			"Raumplan" => "raumplan/erzeugeFormular1"),
			array(
			"Nutzer" => "#",
			"Nutzerliste drucken" => "nutzerlistedrucken/nutzerlistedrucken",
			"Rechte" => "Employee/selectUser"),
			array(
			"Logout" => "login/logout")
		),
		// Tutor
		array (
			array(
			"Home" => "index/index"),
			array(
			"Logout" => "login/logout")
		));

		if (Session::get('user_role')==0){
			$this->buildMenue(0);
		}else{
			$this->buildMenue(Session::get('user_role'));
		}
		
		
}


	public function buildMenue($role){

	$countItems = count($this->menue[$role]);
	$count=0;


	echo "<nav>";
	echo "<ul>";
	while($count<$countItems){
	foreach ( $this->menue [$role][$count] as $key => $value ) {
					$this->{$key} = $value;
					
	}
	$unter =count($this->menue [$role][$count]);
	$once=0;
	foreach ( $this->menue [$role][$count] as $key => $value ) {
		
			if ($unter <=1){
			echo "<li>";			
			echo "<a href=\"index.php?url="; 
			echo htmlentities($value); 
			echo "\">";
			echo htmlentities($key);
			echo "</a>";
			echo "</li>";	
			}elseif($unter>1){
				if($once==0){
					echo "<li>";			
					echo "<a href=\"index.php?url="; 
					echo htmlentities($value); 
					echo "\">";
					echo htmlentities($key);
					echo "</a>";
					echo "<ul>";
					$once++;
				}elseif($once>0){
					echo "<li>";
					echo "<a href=\"index.php?url="; 
					echo htmlentities($value); 
					echo "\">";
					echo htmlentities($key);
					echo "</a>";
					echo "</li>";
					$once++;
					if($once==$unter){
						echo "</ul>";
						echo "</li>";
					}
				}else{	
				}
				
			}
		}
	$count++;
	}	
	echo "</ul>";
	echo "</nav>";
	}

}?>


		
