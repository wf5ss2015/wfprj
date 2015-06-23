<?php
/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				10.06.2015
	
	- User Story (Nr.370a):	Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	- User Story Punkte:	8
	- Task:					Funktion getVeranstaltungstermine_individuell() um den Übergabeparameter 
							rolle_ID erweitern und anpassen an die veränderte Tabellenstruktur.
	- Zeitaufwand:			1:30h
*/

/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student möchte ich mir meinen Stundenplan anzeigen können.
	- User Story Punkte:	13
	- Task:					Funktion getVeranstaltungstermine_individuell() im Model erstellen.
	- Zeitaufwand:			1h
	
	//////////
	
	- User Story (Nr. 410):	Als Dozent/Student möchte ich mir einen Stundenplan für Fachsemester anzeigen können.
	- User Story Punkte:	13
	- Task:					Funktionen getStudiengaenge(), getStudiengang(), getVeranstaltungstermine_fachsemester() 
							im Model erstellen.
	- Zeitaufwand:			2h
*/
?>	

<?php

class stundenplanModel 
{
	//liefert alle Studiengänge:
	public function getStudiengaenge()
	{
		$query = "SELECT stg_ID, stg_bezeichnung FROM Studiengang
					ORDER BY stg_bezeichnung;";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $vorlesungsraeume = $this->abfrage($query);
		
		return $vorlesungsraeume;
	}
	
	//liefert die Bezeichnung eines Studiengangs:
	public function getStudiengang($stg_ID)
	{
		$query = "SELECT stg_bezeichnung FROM Studiengang WHERE stg_ID = '$stg_ID'";
		
		//holt die Studiengang-Bezeichnung:
        $stg_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $stg_bezeichnung['stg_bezeichnung'];
	}
	
	//liefert den Name des angemeldeten Nutzers (Student oder Dozent)
	public function getName()
	{
		$nutzer_name = Session::get('user_name');
		$name = "";
		
		if(Session::get('user_role') == 1) //Student
		{
			$query = "SELECT n.vorname, n.nachname
							FROM Nutzer n 
								JOIN Student s ON (n.nutzer_name = s.nutzer_name)
							WHERE n.nutzer_name = '$nutzer_name';";
		
			//holt die selektierten Attribute des Nutzers:
			$nutzer = $this->abfrage($query)->fetch_assoc();
				
			//Name wird zusammengesetzt:
			$name = $nutzer['vorname']." ".$nutzer['nachname'];
		}
		else if(Session::get('user_role') == 2) //Dozent
		{
			$query = "SELECT n.vorname, n.nachname, n.geschlecht, doz.titel
							FROM Nutzer n 
								JOIN Dozent doz ON (n.nutzer_name = doz.nutzer_name)
							WHERE n.nutzer_name = '$nutzer_name';";
		
			//holt die selektierten Attribute des Nutzers:
			$nutzer = $this->abfrage($query)->fetch_assoc();
			
			//Herr oder Frau?
			if($nutzer['geschlecht'] == "w")
				$name = "Frau";
			else
				$name = "Herr";
				
			//Name wird zusammengesetzt:
			$name = $name." ".$nutzer['titel']." ".$nutzer['vorname']." ".$nutzer['nachname'];
		}
		
		return $name;
	}
	
	//gibt ein array zurück mit allen Veranstaltungsterminen eines Fachsemesters (nur Pflichtfächer!):
	public function getVeranstaltungstermine_fachsemester($studiengang, $fachsemester)
	{
		/*	ORDER BY: die Datensätze werden sortiert nach Stundenzeit und Wochentag, sodass später beim
			Anlegen der Tabelle im View die Veranstaltungstermine Reihe für Reihe im Stundenplan eingefügt werden
			können!
		*/
		$query = "SELECT vt.tag_ID, vt.stdZeit_ID, vt.raum_bezeichnung, v.veranst_ID, v.veranst_bezeichnung, v.veranst_kurztext, n.nachname
							FROM Veranstaltungstermin vt 
								JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
								LEFT JOIN Dozent doz ON (v.dozent_nutzer_name = doz.nutzer_name)
								LEFT JOIN Nutzer n ON (doz.nutzer_name = n.nutzer_name)
							WHERE shv.pflicht_im_Semester = '$fachsemester' AND shv.pflicht_im_Semester > 0
								AND shv.stg_ID = '$studiengang'
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		return $veranstaltungstermine;
	}
	
	//gibt ein array zurück mit allen Veranstaltungsterminen, an welchen der Student/Dozent angemeldet ist:
	public function getVeranstaltungstermine_individuell($nutzer_name, $rolle_ID)
	{
		$veranstaltungstermine;
		
		if($rolle_ID == 1) //Nutzer hat die Rolle Student
		{
			/*	ORDER BY: die Datensätze werden sortiert nach Stundenzeit und Wochentag, sodass später beim
				Anlegen der Tabelle im View die Veranstaltungstermine Reihe für Reihe im Stundenplan eingefügt werden
				können!
			*/
			$query = "SELECT vt.tag_ID, vt.stdZeit_ID, vt.raum_bezeichnung, v.veranst_kurztext, n.nachname, stg.stg_kurztext, shv.pflicht_im_Semester
							FROM Veranstaltungstermin vt
								JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Student_angemeldetAn_Veranstaltung sav ON (v.veranst_ID = sav.veranst_ID)
								LEFT JOIN Dozent doz ON (v.dozent_nutzer_name = doz.nutzer_name)
								LEFT JOIN Nutzer n ON (doz.nutzer_name = n.nutzer_name)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
								JOIN Studiengang stg ON (shv.stg_ID = stg.stg_ID)
							WHERE sav.student_nutzer_name = '$nutzer_name'
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
			// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
			$veranstaltungstermine = $this->abfrage($query);
			
		}
		else if($rolle_ID == 2) //Nutzer hat die Rolle Dozent
		{
			$query = "SELECT vt.tag_ID, vt.stdZeit_ID, vt.raum_bezeichnung, v.veranst_kurztext, stg.stg_kurztext, shv.pflicht_im_Semester
							FROM Veranstaltungstermin vt 
								JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
								JOIN Studiengang stg ON (shv.stg_ID = stg.stg_ID)
								JOIN Dozent doz ON (v.dozent_nutzer_name = doz.nutzer_name)
							WHERE v.dozent_nutzer_name = '$nutzer_name'
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
			// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
			$veranstaltungstermine = $this->abfrage($query);
		}
		
		return $veranstaltungstermine;
	}
	
	//gibt ein Resultset zurück:
	private function abfrage($query) 
	{
        //Datenbankverbindung
        $db = new DatabaseFactoryMysql();
		
		$stmt   = $db->prepare($query); 
		$stmt -> execute(); 
			
		$resultSet = $stmt -> get_result();
        return $resultSet;
    }
}

?>