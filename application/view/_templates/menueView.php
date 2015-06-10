<?php
/*
 * ===============================================
 * Sprint: 4
 * @author: Kilian Kraus
 * Datum: 19.05.2015
 * Zeitaufwand (in Stunden): 2.0
 * User Story Nr.: 480
 * User Story: Als Admin/Verwalter möchte ich Rechte vergeben können.
 * Task:  menue OOP 
 * ===============================================
 */	
 /**
 *
 * @author Kilian Kraus
 *         Klasse um das Menü zusammenzubauen.
 */
class menueView{
	/**
	 * @var menue Speichert im Moment alle Menüeinträge
	 *	Sollte mal noch in Datenbank umziehen um ordentliche Rechteverwaltung umzusetzen.
	 */
	private $menue;
	
	/**
	*
	* @author Kilian Kraus
	*         Konstruktor. Initialisiert den Array mit den Menüpunkten und ruft buildMenue() auf.
	*/
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
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil"
			),
			array(
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Stundenplan" => "#",
			"nach Fachsemester" => "stundenplan/erzeugeFormular",
			"individuell" => "stundenplan/stundenplan_individuell"),
			array(
			"Kurse" => "#",
			"Anmeldung" => "student/enrollClass",
			"Abmeldung" => "student/delistClass"),
			array(
			"Information" => "#",
			"Studienganginformationen anzeigen" => "information/information",
			"Notenspiegel anzeigen" => "zeugnis/zeugnis"),
			array(
			"Logout" => "login/logout")
		),
		// Dozent
		array (
			array(
			"Home" => "index/index"),
			array(
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil",
			"Email" => "Dozent/emailDozent"),
			array(
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Stundenplan" => "#",
			"nach Fachsemester" => "stundenplan/erzeugeFormular",
			"individuell" => "stundenplan/stundenplan_individuell"),
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
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil"
			),
			array(
			"Veranstaltung" => "#",
			"erweitern" => "veranstaltungerweitern/veranstaltungErweitern",
			"anlegen" => "veranstaltung/anlegenForm",
			"bearbeiten" => "veranstaltung/bearbeitenSelect"),
			array(
			"Räume" => "#",
			"anlegen" => "raumAnlegen/raumAnlegen",
			"Veranstaltungen zuordnen" => "raumZuweisen/erzeugeFormular1",
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Nutzer" => "#",
			"Nutzerliste drucken" => "nutzerlistedrucken/nutzerlistedrucken",
			"Rechte" => "Employee/selectUser"),
			array(
			"Studenten" => "#",
			"Notenliste bearbeiten" => "Employee/startNotenListe"),
			array(
			"Logout" => "login/logout")
		),
		// Tutor
		array (
			array(
			"Home" => "index/index"),
			array(
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil"
			),
			array(
			"Logout" => "login/logout")
		));

		if (Session::get('user_role')==0){
			$this->buildMenue(0);
		}else{
			$this->buildMenue(Session::get('user_role'));
		}
		
		
}

	/**
	 *
	 * @author Kilian Kraus
	 *        
	 * @param $role string
	 *        	Nutzername
	 *        	
	 * @return mixed Gibts false zurück, wenn Nutzer nicht besteht. Ansonsten Objekt mit den Nutzerdaten zurück.
	 */
	public function buildMenue($role){

	// bisschen zählen
	$countItems = count($this->menue[$role]);
	$count=0;

	// baut menü
	echo "<nav>";
	echo "<ul>";
	while($count<$countItems){
	foreach ( $this->menue [$role][$count] as $key => $value ) {
					$this->{$key} = $value;
					
	}
	$unter =count($this->menue [$role][$count]);
	$once=0;
	foreach ( $this->menue [$role][$count] as $key => $value ) {
			//ohne untermenüpunkte
			if ($unter <=1){
			echo "<li>";			
			echo "<a href=\"index.php?url="; 
			echo htmlentities($value); 
			echo "\">";
			echo htmlentities($key);
			echo "</a>";
			echo "</li>";	
			}
			//mit untermenüpunkte
			elseif($unter>1){
				// menüpunkt
				if($once==0){
					echo "<li>";			
					echo "<a href=\"index.php?url="; 
					echo htmlentities($value); 
					echo "\">";
					echo htmlentities($key);
					echo "</a>";
					echo "<ul>";
					$once++;
				}
				// untermenüpunkte
				elseif($once>0){
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


		
