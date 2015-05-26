<?php
/*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 400):	Als Dozent/Student m�chte ich mir meinen Stundenplan anzeigen k�nnen.
	- User Story Punkte:	13
	- Task:					Funktion getVeranstaltungstermine_individuell() im Model erstellen.
	- Zeitaufwand:			1h
	
	//////////
	
	- User Story (Nr. 410):	Als Dozent/Student m�chte ich mir einen Stundenplan f�r Fachsemester anzeigen k�nnen.
	- User Story Punkte:	13
	- Task:					Funktionen getStudiengaenge(), getStudiengang(), getVeranstaltungstermine_fachsemester() 
							im Model erstellen.
	- Zeitaufwand:			2h
*/
?>	

<?php

class stundenplanModel 
{
	//liefert alle Studieng�nge:
	public function getStudiengaenge()
	{
		$query = "SELECT stg_ID, stg_bezeichnung FROM Studiengang";
		
		// erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $vorlesungsraeume = $this->abfrage($query);
		
		return $vorlesungsraeume;
	}
	
	//liefert die Bezeichnung eines Studiengangs:
	public function getStudiengang($stg_ID)
	{
		$query = "SELECT stg_bezeichnung FROM Studiengang WHERE stg_ID = $stg_ID";
		
		//holt die Studiengang-Bezeichnung:
        $stg_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $stg_bezeichnung['stg_bezeichnung'];
	}
	
	//gibt ein array zur�ck mit allen Veranstaltungsterminen eines Fachsemesters (nur Pflichtf�cher!):
	public function getVeranstaltungstermine_fachsemester($studiengang, $fachsemester)
	{
		/*	ORDER BY: die Datens�tze werden sortiert nach Stundenzeit und Wochentag, sodass sp�ter beim
			Anlegen der Tabelle im View die Veranstaltungstermine Reihe f�r Reihe im Stundenplan eingef�gt werden
			k�nnen!
		*/
		$query = "SELECT vt.tag_ID, vt.stdZeit_ID, vt.raum_bezeichnung, v.veranst_bezeichnung 
							FROM Veranstaltungstermin vt JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
							WHERE shv.pflicht_im_Semester = '$fachsemester' AND shv.pflicht_im_Semester > 0
								AND shv.stg_ID = '$studiengang'
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		return $veranstaltungstermine;
	}
	
	//gibt ein array zur�ck mit allen Veranstaltungsterminen, an welchen der Student/Dozent angemeldet ist:
	public function getVeranstaltungstermine_individuell($nutzer_name)
	{
		/*	ORDER BY: die Datens�tze werden sortiert nach Stundenzeit und Wochentag, sodass sp�ter beim
			Anlegen der Tabelle im View die Veranstaltungstermine Reihe f�r Reihe im Stundenplan eingef�gt werden
			k�nnen!
		*/
		$query = "SELECT vt.tag_ID, vt.stdZeit_ID, vt.raum_bezeichnung, v.veranst_bezeichnung 
							FROM Veranstaltungstermin vt JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
								JOIN Nutzer_beteiligtAn_Veranstaltung nbv ON (v.veranst_ID = nbv.veranst_ID)
							WHERE nbv.nutzer_name = '$nutzer_name'
							ORDER BY vt.stdZeit_ID, vt.tag_ID;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungstermine = $this->abfrage($query);
		
		return $veranstaltungstermine;
	}
	
	//gibt ein Resultset zur�ck:
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