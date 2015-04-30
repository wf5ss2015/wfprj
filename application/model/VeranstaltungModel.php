<?php
/**
* SPRINT 03
*
* @author: Roland Schmid
* Datum: 29.04.2015
*
* User­Story (Nr. xx ):  .... (n Points)
* Zeit: m
*/


/**
 * @author Roland Schmid
 * Model für Veranstaltungen
 */
class VeranstaltungModel {
    /**
     * @author Kilian Kraus
     *
     * @param $user_name string Nutzername
     *
     */
     
    
    
    
    
//------------------ need work ---------------------------------------------------- 
    
   public function ausstattungEintragen($vid, $dbCon) {

  //POST-Inhalt auslesen
  $insertValues = "";
  $veranstaltungAusstattung = $_POST["veranstaltung_ausstattung"];

  // vorhandene Einträge löschen (für Veranstaltung aktualisieren
  //$deleteString = "delete from VeranstaltungBrauchtAusstattung where VeranstaltungID = " . $vid . ";";
  $deleteString = "delete from Veranstaltung_erfordert_Ausstattung where veranst_ID = " . $vid . ";";
  if($dbCon->query($deleteString)) {
	  $dbCon->commit();
  } else {
    echo "\nERROR: " . $dbCon->error;
  }
  
  
  $noOfRows = 0;
  
  // Plausibilität prüfen
  for($i = 0; $i < count($veranstaltungAusstattung); $i++) {
  //prüft, ob eingegebener Wert wirklich eine Zahl ist
    if(is_numeric($veranstaltungAusstattung[$i])) {
    
    //prüft, ob die angebenen Zahlen sinnvoll sind
      if($veranstaltungAusstattung[$i] < 100 && $veranstaltungAusstattung[$i] > 0) {
	$insertValues = $vid . ", " . ($i+1) . ", " . $veranstaltungAusstattung[$i];
	
	//insert für mysql vorbereiten
	$insertString = "INSERT INTO Veranstaltung_erfordert_Ausstattung"
			. " (veranst_ID, ausstattung_ID, anzahl)"
			. " VALUES (" . $insertValues . ");";

	if($dbCon->query($insertString)) {
	  $dbCon->commit();
	} else {
	  echo "\nERROR: " . $dbCon->error;
	}
	
      }
    }
  }
}


/* sprint 3 Anfang*/

/* 
 * prüft, ob die Eingabe ein int im Bereich [$min, $max] ist
 * 
 * von http://phpsecurity.readthedocs.org/en/latest/Input-Validation.html
 *  */
    
// 
public function checkIntegerInput($int, $min, $max) {
    if (is_string($int) && !ctype_digit($int)) {
        return false; // enthält Zeichen, die keine Ziffern sind
    }
    if (!is_int((int) $int)) {
        return false; // nicht-Integer oder größer PHP_MAX_INT
    }
    return ($int >= $min && $int <= $max);
} 




/*
 * @author Roland Schmid
 * 
 * gibt die ID der eingetragenen Veranstaltung zurück, sonst -1 
 * 
 *  */
public function veranstaltungAnlegen() {

  $valid = true;
  //Request::post('name')
  //altes Format: $bez 		= $_POST['veranstaltung_bezeichnung'];
  $bez 		= Request::post('veranstaltung_bezeichnung');
  $kurztext 	= Request::post('veranstaltung_kurztext');
  $credits 	= Request::post('veranstaltung_credits');
  $sws 		= Request::post('veranstaltung_sws');
  $maxNo 	= Request::post('veranstaltung_max_Teilnehmer');
  $art 		= Request::post('veranstaltung_veranstaltungsart');
  
  
  //Datenbankverbindung
  $database = new DatabaseFactoryMysql();

  
// TO-DO : Ausstattung löschen (inbes. für Änderungen)
  
  
  //einfache Prüfung, ob überall was drin steht
  if(strlen($bez) < 1)
	  $valid = false;
  if(strlen($kurztext) < 1)
	  $valid = false;
	  
	  
/* sprint 3 Anfang*/
  if(!($this->checkIntegerInput($maxNo, 1, 1000))) {
    $valid = false;
    /* TODO : Fehlermeldung ausgeben */
  }

/* sprint 3 Ende*/

  //wenn alle Prüfungen positiv, führe insert aus
  if($valid == true) {
  
  
    $insertString = "INSERT INTO Veranstaltung (`veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, "
		    . "`maxTeilnehmer`, `vArt_ID`) "
		    . "VALUES ('$bez', '$kurztext', '$credits', '$sws', '$maxNo', '$art');";


    
    if($database->insert($insertString)) {
        
    
        $vID = $database->insert_id;
//	    
//      TODO  //Ausstattung wird eingetragen
//        ausstattungEintragen($vID);
//   
        return $vID;
    } else {
        return -1;
    }
  }

}
    
 

    
    
    
    
    
    
    
    
    
    
//    public function veranstaltungAnlegen() {
//        
//  $valid = true;
//	
//  $bez 		= $_POST['veranstaltung_bezeichnung'];
//  $kurztext 	= $_POST['veranstaltung_kurztext'];
//  $credits 	= $_POST['veranstaltung_credits'];
//  $sws 		= $_POST['veranstaltung_sws'];
//  $maxNo 	= $_POST['veranstaltung_max_Teilnehmer'];
//  $art 		= $_POST['veranstaltung_veranstaltungsart'];
//  
//  //es fehlen: Ausstattung eintragen, und vorher Ausstattung löschen (inbes. für Änderungen)
//  
//  
//  //einfache Prüfung, ob überall was drin steht
//  if(strlen($bez) < 1)
//	  $valid = false;
//  if(strlen($kurztext) < 1)
//	  $valid = false;
//	  
//	  
///* sprint 3 Anfang*/
//
//  /*if(strlen($maxNo) < 1)
//	  $valid = false;
//*/	  
//  if(!checkIntegerInput($maxNo, 1, 1000)) {
//    $valid = false;
//    // TO-DO : Fehlermeldung ausgeben
//  }
//
///* sprint 3 Ende*/
//
//  //wenn alle Prüfungen positiv, führe insert aus
//  if($valid == true) {
//  
//  
//    $insertString = "INSERT INTO Veranstaltung (`veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, "
//		    . "`maxTeilnehmer`, `vArt_ID`) "
//		    . "VALUES ('$bez', '$kurztext', '$credits', '$sws', '$maxNo', '$art');";
//
//    if($dbCon->query($insertString)) {
//    
//      $vid = $dbCon->insert_id;
//	    
//      $dbCon->commit();
//      } else {
//	$vid = -1;
//      }
//
//    //Ausstattung wird eingetragen
//    ausstattungEintragen($vid, $dbCon);
//   
//    return $vid;
//  } else {
//    return -1;
//  }
//        
//        
//        
//        return $vID;
//    }
     


/* sprint 3 Ende */

     //gibt ein array zurück mit allen vorhandenen Veranstaltungen
     public function getAlleVeranstaltungen() {
       // query-String 
       $q = "SELECT VeranstaltungID, Bezeichnung, Kurztext, Credits, SWS, " 
	       . "max_Teilnehmer, Veranstaltungsart "
	       . "from Veranstaltung;";
	       
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
        $result = $this->abfrage($q);
        
        return $result;
    }
	
    //holt die veranstaltung mit id = $vID
    public function getVeranstaltung($vID) {
        
        $q = "SELECT VeranstaltungID, Bezeichnung, Kurztext, Credits, SWS, " 
           . "max_Teilnehmer, Veranstaltungsart "
           . "from Veranstaltung WHERE VeranstaltungID = " . $vID . " LIMIT 1;";
        
        $result = $this->abfrage($q);
        
        return $result;     
    }
    

    
    
    
    
    
//----------------------------------workses
    
    
    
    
    
    /*
     *  Holt alle Veranstaltungsarten aus der Datenbank
     */
    public function getVeranstaltungsarten() {
        //query-string
        $q = "SELECT vArt_ID, vArt_bezeichnung from Veranstaltungsart";
        
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
        $result = $this->abfrage($q);
        
        return $result;
    }
    
    
    
    /*
     *  Holt alle Ausstattungsgegenstände aus der Datenbank
     *      */
     public function getAusstattung() {
        //query-string
        $q = "SELECT ausstattung_ID, ausstattung_bezeichnung from Ausstattung";
     
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
        $result = $this->abfrage($q);
        
        return $result;
     }
     

    /*
     *  Liest alle Studiengaenge aus der Datenbank
     * 
     *      */
     public function getStudiengaenge() {
        //query-string
        $q = "select stg_ID, stg_bezeichnung, stgTyp_kuerzel from Studiengang "
             . "join Studiengangtyp on Studiengang.stgTyp_ID = Studiengangtyp.stgTyp_ID;";
	
        // erzeugt ein Resultset, benutzt dazu die Methode abfrage($q)
        $result = $this->abfrage($q);
        
        return $result;
     }
     
     private function abfrage($q) {
        //Datenbankverbindung
        $database = new DatabaseFactoryMysql();
	
        // erzeugt ein Resultset
        $result = $database->query($q);
        
        return $result;
     }
    
}
