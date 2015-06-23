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
 /* Erweiterung des Menüs für Studenten
  * autor: Kris Klamser
  * Sprint: 5
  * datum: 9.6.2015 
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
			"Home" => "index/index", )
		),
		// Student
		array (
			array(
			"Home" => "index/index"),
			array(
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil",
			"Passwort ändern" => "#",
			),
			array(
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Stundenplan" => "#",
			"Semesterstundenplan" => "stundenplan/erzeugeFormular",
			"Studentenstundenplan" => "stundenplan/stundenplan_individuell"),
			array(
			"Kurse" => "#",
			"Anmeldung" => "student/enrollClass",
			"Abmeldung" => "student/delistClass"),
			// Start Erweiterung Klamser Sprint 5
			array(
			"Information" => "#",
			"Studienganginformationen anzeigen" => "information/information",
			"Notenspiegel anzeigen" => "zeugnis/zeugnis")
			//Ende Erweiterung Klamser Sprint 5
		),
		// Dozent
		array (
			array(
			"Home" => "index/index"),
			array(
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil",
			"Passwort ändern" => "#",
			"Email" => "Dozent/emailDozent"),
			array(
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Stundenplan" => "#",
			"Semesterstundenplan" => "stundenplan/erzeugeFormular",
			"Dozentenstundenplan" => "stundenplan/stundenplan_individuell"),
			array(
			"Teilnehmerliste" => "Dozent/auswahlVorlesung")
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
			"Veranstaltungstermine" => "#",
			"erstellen" => "raumZuweisen/erzeugeFormular1",
			"Übersicht nach Fachsemester" => "veranstaltungsterminUebersicht/erzeugeFormular"),
			array(
			"Räume" => "#",
			"anlegen" => "raumAnlegen/raumAnlegen",
			"Raumplan" => "raumplan/erzeugeFormular"),
			array(
			"Nutzer" => "#",
			"Anlegen - Student" => "Employee/zeigeStudentAnlage",
			"Anlegen - Mitarbeiter" => "Employee/zeigeMitarbeiterAnlage",
			"Anlegen - Dozent" => "Employee/zeigeDozentAnlage",
			"Passwort Verwaltung" => "#",
			"Nutzer bearbeiten" => "#",
			"Nutzer löschen" => "#",
			"Nutzerliste" => "nutzerlistedrucken/nutzerlistedrucken",
			"Rechte ändern" => "Employee/selectUser"),
			array(
			"Studenten" => "#",
			"Notenliste bearbeiten" => "Employee/startNotenListe")
		),
		// Tutor
		array (
			array(
			"Home" => "index/index"),
			array(
			"Mein Profil" => "#",
			"Bearbeiten" => "Dozent/meinProfil"
			)
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


		
