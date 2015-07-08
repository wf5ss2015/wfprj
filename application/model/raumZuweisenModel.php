<?php 
 
 /*	---------- SPRINT 4 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				20.05.2015
	
	- User Story (Nr. 370):	Als Entwickler möchte ich die Teile aus den vorigen Sprints nachbessern.
	- User Story Punkte:	8
	- Task:					Bei Raum-Zuweisung Error-Handling betreiben und Response ausgeben.
	- Zeitaufwand:			2h
	
	//////////
	
	- User Story (Nr. 450):	Als Mitarbeiter möchte ich eine Veranstaltung einem Raum zuweisen unter 
							Berücksichtigung von Überschneidungen.
	- User Story Punkte:	8
	- Task:					Funktion veranstaltungZeitgleich() im Model stundenplanModel erstellen
	- Zeitaufwand:			2:30h
	
	---------- SPRINT 3 ----------
	
	- Autor:				Alexander Mayer
	- Datum: 				06.05.2015
	
	- User Story (Nr. 340): Als Entwickler möchte ich im MVC-Pattern programmieren können.
	- User Story Punkte:	40	
	- User Story Aufwand:	6h
	
	- Task: Model erstellen, indem User Stories aus den ersten beiden Sprints angepasst werden
*/
 
?> 

<?php

class raumZuweisenModel 
{
    
    //gibt ein array zurück mit allen vorhandenen Veranstaltungen:
    public function getVeranstaltungen() 
	{
		$query = "SELECT v.veranst_ID, v.veranst_bezeichnung, stg.stg_bezeichnung, stg.stg_kurztext, shv.pflicht_im_Semester
					FROM  Veranstaltung v 
						JOIN Studiengang_hat_Veranstaltung shv ON (v.veranst_ID = shv.veranst_ID)
						JOIN Studiengang stg ON (shv.stg_ID = stg.stg_ID)
					ORDER BY stg.stg_bezeichnung, shv.pflicht_im_Semester;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $veranstaltungen = $this->abfrage($query);
		
		return $veranstaltungen;
    }
	
	
	//gibt ein array zurück mit allen Wochentagen
    public function getWochentage() 
	{
		$query = "SELECT tag_ID, tag_bezeichnung FROM Wochentag;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $tage = $this->abfrage($query);
        
        return $tage;
    }
	
	
	//gibt ein array zurück mit allen Stundenzeiten
    public function getStundenzeiten() 
	{
       $query = "SELECT stdZeit_ID, stdZeit_von, stdZeit_bis FROM Stundenzeit;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $stdZeiten = $this->abfrage($query);
        
        return $stdZeiten;
    }
	
	//überprüft, ob eine Veranstaltung aus dem Fachsemester bereits zur ausgewählten Zeit stattfindet
	public function veranstaltungZeitgleich($veranst_ID, $wochentag_ID, $stdZeit_ID)
	{
		//Studiengänge, welche die ausgewählte Veranstaltung als Pflichtfach anbieten:
		$studiengaenge = $this->abfrage("SELECT stg_ID, pflicht_im_Semester FROM Studiengang_hat_Veranstaltung
											WHERE veranst_ID = '$veranst_ID' AND pflicht_im_Semester > 0");
											
		$zeitgleich = 0;
											
		foreach ($studiengaenge as $studiengang) 
		{
			$stg_ID = $studiengang['stg_ID'];
			$pflicht_im_Semester = $studiengang['pflicht_im_Semester'];
			
			//Wahlfächer ($pflicht_im_Semester = 0) bleiben bei Überschneidungs-Problematik unberücksichtigt!
			
			//Veranstaltungen im Fachsemester, welche zeitgleich zur ausgewählten Veranstaltung stattfinden
			$veranstaltungenZeitgleich = $this->abfrage(
									"SELECT * FROM Veranstaltungstermin vt 
										JOIN Studiengang_hat_Veranstaltung shv ON (vt.veranst_ID = shv.veranst_ID)
											WHERE vt.stdZeit_ID = '$stdZeit_ID' AND vt.tag_ID = '$wochentag_ID'
											AND shv.stg_ID = '$stg_ID' AND shv.pflicht_im_Semester = '$pflicht_im_Semester'
											AND shv.pflicht_im_Semester > 0;");
			
			if($veranstaltungenZeitgleich->num_rows > 0)
			{
				$zeitgleich = 1;
				break;
			}
		}
		
		return $zeitgleich;
	}
	
	//überprüft, ob der ausgewählten Veranstaltung bereits ein Dozent zugeordnet ist:
	public function dozentZugeordnet($veranst_ID)
	{
		$dozentZugeordnet = 0;
		
		//holt Nutzername des Dozenten der ausgewählten Veranstaltung 
		$veranstaltung = $this->abfrage(
			"SELECT dozent_nutzer_name FROM Veranstaltung WHERE veranst_ID = '$veranst_ID';")->fetch_assoc();
				
		if($veranstaltung['dozent_nutzer_name'] != NULL)
			$dozentZugeordnet = 1;
			
		return $dozentZugeordnet;
	}
	
	//überprüft, ob der zur Veranstaltung zugeordnete Dozent zur ausgewählten Zeit bereits eine andere Veranstaltung hält:
	public function dozentVerfuegbar($veranst_ID, $wochentag_ID, $stdZeit_ID)
	{
		$dozentVerfuegbar = 0;
		
		//Veranstaltungen, welche zur ausgewählten Zeit stattfinden und den Dozenten der ausgewählten Veranstaltung beanspruchen 
		$veranstaltungen = $this->abfrage(
			"SELECT * FROM Veranstaltungstermin vt 
			JOIN Veranstaltung v ON (vt.veranst_ID = v.veranst_ID)
			WHERE vt.tag_ID = '$wochentag_ID' AND vt.stdZeit_ID = '$stdZeit_ID' 
				AND v.dozent_nutzer_name = (SELECT dozent_nutzer_name FROM Veranstaltung WHERE veranst_ID = '$veranst_ID');");
				
		if(! $veranstaltungen->num_rows > 0)
			$dozentVerfuegbar = 1;
			
		return $dozentVerfuegbar;
	}
	
	//gibt ein array zurück mit allen verfügbaren Vorlesungsräumen:
    public function getVerfuegbareVorlesungsraeume($veranst_ID, $wochentag_ID, $stdZeit_ID) 
	{
		//alle Vorlesungsräume selektieren, welche zur ausgewählten Zeit noch nicht belegt sind:
		$query  = "SELECT raum_bezeichnung FROM Vorlesungsraum WHERE raum_bezeichnung NOT IN 
					(SELECT raum_bezeichnung FROM Veranstaltungstermin 
					WHERE stdZeit_ID = '$stdZeit_ID' AND tag_ID = '$wochentag_ID')
					ORDER BY raum_bezeichnung;"; 
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $result_raeume = $this->abfrage($query);
		
		$verfuegbareRaeume = array();
		$index = 0;
		
		/*	im array $verfuegbareRaeume werden nur die Räume aus dem Reusultset $result_raeume abgespeichert,
			wenn sie die erforderliche Ausstattung erfüllen, es muss also für jeden Vorlesungsraum in der
			while-Schleife die Ausstattung überprüft werden:
		*/
		while ($row = $result_raeume -> fetch_assoc()) 
		{
			$raum_bezeichnung = $row['raum_bezeichnung'];
			
			if($this->pruefeAusstattung_vorlesungsraum($raum_bezeichnung, $veranst_ID))
			{
				//Raum erfüllt Ausstattung, welche von der Veranstaltung erfordert wird:
				$verfuegbareRaeume[$index] = $row;
				$index++;
			}	
		}
		
        return $verfuegbareRaeume;
    }
	
	//gibt ein array zurück mit allen verfügbaren Laborräumen:
    public function getVerfuegbareLaborraeume($veranst_ID, $wochentag_ID, $stdZeit_ID) 
	{
       //alle Laborräume selektieren, welche zur ausgewählten Zeit noch nicht belegt sind:
		$query  = "SELECT lr.raum_bezeichnung, la.lArt_bezeichnung 
					   FROM Laborraum lr JOIN Laborart la ON (lr.lArt_ID = la.lArt_ID)
					   WHERE lr.raum_bezeichnung NOT IN 
							(SELECT raum_bezeichnung FROM Veranstaltungstermin 
							WHERE stdZeit_ID = '$stdZeit_ID' AND tag_ID = '$wochentag_ID')
							ORDER BY raum_bezeichnung;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($query)
        $result_raeume = $this->abfrage($query);
		
		$verfuegbareRaeume = array();
		$index = 0;
		
		/*	im array $verfuegbareRaeume werden nur die Räume aus dem Reusultset $result_raeume abgespeichert,
			wenn sie die erforderliche Ausstattung erfüllen, es muss also für jeden Vorlesungsraum in der
			while-Schleife die Ausstattung überprüft werden:
		*/
		while ($row = $result_raeume -> fetch_assoc()) 
		{
			$raum_bezeichnung = $row['raum_bezeichnung'];
			
			if($this->pruefeAusstattung_laborraum($raum_bezeichnung, $veranst_ID))
			{
				//Raum erfüllt Ausstattung, welche von der Veranstaltung erfordert wird:
				$verfuegbareRaeume[$index] = $row;
				$index++;
			}	
		}
		
        return $verfuegbareRaeume;
    }
	
	
	//legt einen neuen Veranstaltungstermin in der Tabelle Veranstaltungstermin an:
	public function veranstaltungsterminAnlegen($raum_bezeichnung, $veranst_ID, $wochentag_ID, $stdZeit_ID) 
	{
		//ausgewählter Raum der ausgewählten Veranstaltung zur ausgewählten Zeit zuweisen: 
			
		//Datenbankverbindung
		$db = new DatabaseFactoryMysql();
		$db -> autocommit(false);
		$db -> begin_transaction();
			
		$insert  = 'INSERT INTO Veranstaltungstermin (veranst_ID, stdZeit_ID, tag_ID, raum_bezeichnung) VALUES (?, ?, ?, ?);';
		$stmt  = $db -> prepare ($insert);
		$stmt -> bind_param('iiis', $veranst_ID, $stdZeit_ID, $wochentag_ID, $raum_bezeichnung);
		
		try
		{
			$stmt -> execute();
			$db -> commit();
			
			$meldung = "Veranstaltungstermin wurde erfolgreich angelegt mit den folgenden Parametern: 
						<ul>
							<li>Veranstaltung: ".$this->getVeranstaltung($veranst_ID)."</li>
							<li>Tag: ".$this->getTag($wochentag_ID)."</li>
							<li>Stundenzeit: ".$this->getStundenzeit($stdZeit_ID)."</li>
							<li>Raum: ".$raum_bezeichnung."</li>
						</ul>";
			
			Session::add('response_positive', $meldung);
		}
		catch (PDOException $e)
		{
			Session::add('response_negative', 'Es ist ein Fehler aufgetreten!'.$e);
			$db -> rollback();
		}
		
	}
	
	//liefert die Bezeichnung eines Studiengangs:
	public function getVeranstaltung($veranst_ID)
	{
		$query = "SELECT veranst_bezeichnung FROM Veranstaltung WHERE veranst_ID = $veranst_ID";
		
		//holt die Veranstaltungs-Bezeichnung:
        $veranst_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $veranst_bezeichnung['veranst_bezeichnung'];
	}
	
	//liefert den Tag:
	public function getTag($tag_ID)
	{
		$query = "SELECT tag_bezeichnung FROM Wochentag WHERE tag_ID = $tag_ID";
		
		//holt die Tag-Bezeichnung:
        $tag_bezeichnung = $this->abfrage($query)->fetch_assoc();
		
		return $tag_bezeichnung['tag_bezeichnung'];
	}
	
	//liefert die Stundenzeit:
	public function getStundenzeit($stdZeit_ID)
	{
		$query = "SELECT stdZeit_von, stdZeit_bis FROM Stundenzeit WHERE stdZeit_ID = $stdZeit_ID";
		
		//holt stdZeit_von und stdZeit_bis:
        $stundenzeit = $this->abfrage($query)->fetch_assoc();
		
		return $stundenzeit['stdZeit_von']." - ".$stundenzeit['stdZeit_bis'];
	}
    
	
    /*	wird in der Funktion getVerfuegbareVorlesungsraeume() aufgerufen und überprüft, ob
		der Vorlesungsraum die Ausstattung erfüllt, welche von der Veranstaltung erfordert wird
		(boolean wird zurückgegeben)
	*/
    private function pruefeAusstattung_vorlesungsraum($raum_bezeichnung, $veranst_ID)
	{
		$query  = 	"SELECT v.anzahl AS anzahl_erforderlich, vr.anzahl AS anzahl_inRaum, v.ausstattung_ID AS a_ID
							FROM  Veranstaltung_erfordert_Ausstattung v JOIN Vorlesungsraum_hat_Ausstattung vr 
								ON (v.ausstattung_ID = vr.ausstattung_ID)
							WHERE v.veranst_ID = '$veranst_ID' AND vr.raum_bezeichnung = '$raum_bezeichnung';"; 
		
		$result_ausstattung = $this->abfrage($query);
		
		$ausstattungOk = 1;
		
		//für jedes Ausstattungsmerkmal wird überprüft, ob es in erforderlicher Anzahl im Raum vorhanden ist
		while ($row = $result_ausstattung -> fetch_assoc())
		{
			$a_ID = $row['a_ID'];
			$anzahl_erforderlich = $row['anzahl_erforderlich'];
			$anzahl_inRaum = $row['anzahl_inRaum'];
			
			if($a_ID == 1) //Ausstattungsmerkmal Stuhl hat ausstattung_ID 1
			{
				if((($anzahl_inRaum - $anzahl_erforderlich)) > 20 OR ($anzahl_inRaum < $anzahl_erforderlich))
				{
					$ausstattungOk = 0;
					break;
				}
			}
			else if($a_ID == 2) //Ausstattungsmerkmal PC hat ausstattung_ID 2
			{
				if(($anzahl_erforderlich == 0 AND $anzahl_inRaum > 0) OR ($anzahl_inRaum < $anzahl_erforderlich))
				{
					$ausstattungOk = 0;
					break;
				}
			}
			else //gilt für restliche Ausstattungsmerkmale
			{
				if($anzahl_inRaum < $anzahl_erforderlich)
				{
					$ausstattungOk = 0;
					break;
				}	
			}
		}
		
		return $ausstattungOk;
	}
	
	
	/*	wird in der Funktion getVerfuegbareLaborraeume() aufgerufen und überprüft, ob
		der Vorlesungsraum die Ausstattung erfüllt, welche von der Veranstaltung erfordert wird
		(boolean wird zurückgegeben)
	*/
	private function pruefeAusstattung_laborraum($raum_bezeichnung, $veranst_ID)
	{
		$query  = 	"SELECT v.anzahl AS anzahl_erforderlich, lr.anzahl AS anzahl_inRaum, v.ausstattung_ID AS a_ID
							FROM  Veranstaltung_erfordert_Ausstattung v JOIN Laborraum_hat_Ausstattung lr 
								ON (v.ausstattung_ID = lr.ausstattung_ID)
							WHERE v.veranst_ID = '$veranst_ID' AND lr.raum_bezeichnung = '$raum_bezeichnung';"; 
		
		$result_ausstattung = $this->abfrage($query);
		
		$ausstattungOk = 1;
		
		//für jedes Ausstattungsmerkmal wird überprüft, ob es in erforderlicher Anzahl im Raum vorhanden ist
		while ($row = $result_ausstattung -> fetch_assoc())
		{
			$a_ID = $row['a_ID'];
			$anzahl_erforderlich = $row['anzahl_erforderlich'];
			$anzahl_inRaum = $row['anzahl_inRaum'];
			
			if($a_ID == 1) //Ausstattungsmerkmal Stuhl hat ausstattung_ID 1
			{
				if((($anzahl_inRaum - $anzahl_erforderlich)) > 20 OR ($anzahl_inRaum < $anzahl_erforderlich))
				{
					$ausstattungOk = 0;
					break;
				}
			}
			else if($a_ID == 2) //Ausstattungsmerkmal PC hat ausstattung_ID 2
			{
				if(($anzahl_erforderlich == 0 AND $anzahl_inRaum > 0) OR ($anzahl_inRaum < $anzahl_erforderlich))
				{
					$ausstattungOk = 0;
					break;
				}
			}
			else //gilt für restliche Ausstattungsmerkmale
			{
				if($anzahl_inRaum < $anzahl_erforderlich)
				{
					$ausstattungOk = 0;
					break;
				}	
			}
		}
		
		return $ausstattungOk;
	}
	 
	 
	//Funktion zur Datenabfrage, sodass nur an dieser Stelle die Verbindung zur DB hergestellt wird
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
