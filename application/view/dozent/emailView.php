<?php
/* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 11.05.2015
 * User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
 * Zeit insgesamt: 8
 * ===============================================*/

/**
 * @author Damian Wysocki
 *        
 *         Beschreibung: View um als Dozent eine Email zu versenden
 */
 ?>
 
 <?
	/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 380)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 390/01  Beschreibung: Email Maske anlegen
	* Zeitaufwand (in Stunden): 3
	* START SPRINT 04
	*/
?>
 <article>
		
		<h1>Email versenden</h1>
		</br>
		</br>

	<?php if ($this->profil){

	// PHP Fehlermeldungen (1 um das Formular zu testen) anzeigen.
	error_reporting(1);// (0/1)

	// Dateien hochladen
	// Verzeichnis
	$Verzeichnis = "uploads";

	// Die Größe (einer einzelnen) Datei die maximal
	// hoch geladen werden darf (in Bytes eintragen).
	$Maxgroesse = 1048576; // 1024 Bytes = 1 KB (1048576 Bytes = 1 MB) 
	// Umrechner: www.webbausteine.de/blog/tools/umrechner.php

	// Anzahl der maximalen Dateien die hoch geladen werden dürfen.
	$Maxdateien = 1;

	// Angabe des Datentypen (Mimetypen) der hoch geladen werden darf.
	$Datentyp = array(
	"png" => "image/png",
	"jpg" => "image/jpeg",
	"jpg" => "image/pjpeg",
	"jpeg" => "image/jpeg",
	"gif" => "image/gif",
	"txt" => "text/plain",
	"htm" => "text/html",
	"pdf" => "application/pdf",
	"zip" => "application/x-zip-compressed",
	);
	//print_r($_POST);
	
	// Ausgabe der Datentypen und Dateigröße formatieren
	$Dtype = implode(", ", array_unique(array_keys($Datentyp)));
	$Dsize = ($Maxgroesse >= 1048576) ? number_format(($Maxgroesse / 1024 / 1024), 1, ",", ".") .
	 " MB" : number_format(($Maxgroesse / 1024), 1, ",", ".") . " KB";
	
	// Kurs id speichern
	$kurs = $_POST['kurs'];
	
	$name = htmlentities($this->profil->Vorname.' '.$this->profil->Nachname);  // Name
	$email = isset($_POST["Email"]) ? strip_tags(trim($_POST["Email"])) : ""; // E-Mail
	$betreff = isset($_POST["betreff"]) ? strip_tags(trim($_POST["betreff"])) : ""; // Betreff
	$nachricht = isset($_POST["nachricht"]) ? strip_tags(trim($_POST["nachricht"])) : ""; // Nachricht

	// Benutzereingaben überprüfen
	$Fehler = array("File"=>"","email"=>"","betreff"=>"","nachricht"=>"",);
	if (isset($_POST["submit"])) {
	 $Fehler["email"] = strlen($_POST["email"]) < 1 ? " Bitte füllen Sie dieses Feld aus!" : "";
	 $Fehler["betreff"] = strlen($_POST["betreff"]) < 1 ? " Bitte füllen Sie dieses Feld aus!" : "";
	 $Fehler["nachricht"] = strlen($_POST["nachricht"]) < 1 ? " Bitte füllen Sie dieses Feld aus!" : "";

	 // Datei hochladen
	 $Files = "";
	 $Filename = "";
	 for ($I = 0; $I < count($_FILES["File"]["name"]); $I++) {
	  if ($I > $Maxdateien) break;
	  if ($_FILES["File"]["name"][$I] != "" && $_FILES["File"]["error"][$I] === UPLOAD_ERR_OK) {
	   $Array = explode(".", basename($_FILES["File"]["name"][$I]));
	   $Filename = substr(preg_replace("/[^a-z0-9_-]/", "", strtolower(strtr($Array[0], "äöüß", "aous"))), 0, 45);
	   if (file_exists($Verzeichnis . "/" . $Filename . "." . strtolower(end($Array)))) {
		$Filename .=  "_" . rand(1, 9999);
	   }
	   $Filename .= "." . strtolower(end($Array));
	   if (in_array($_FILES["File"]["type"][$I], $Datentyp)) {
		if ($_FILES["File"]["size"][$I] <= $Maxgroesse) {
		 move_uploaded_file($_FILES["File"]["tmp_name"][$I], $Verzeichnis . "/" . $Filename);
		 if (file_exists($Verzeichnis . "/" . $Filename)) {
		 $Files .= "http://" . $_SERVER["SERVER_NAME"] . "/" . $Verzeichnis . "/" . $Filename . ", ";
		 }
		 else {
		  $Fehler["File"] .= "<br>Beim hochladen der Datei &bdquo;" . $Filename . "&rdquo; ist leider ein Fehler aufgetreten!";
		 }
		}
		else {
		 $Fehler["File"] .= "<br>Die Datei &bdquo;" . $Filename . "&rdquo; ist leider zu groß!";
		}
	   }
	   else {
		$Fehler["File"] .= "<br>Die Datei &bdquo;" . $Filename . "&rdquo; hat ein ungültiges Dateiformat!";
	   }
	   echo $Verzeichnis;
	  }
	 }
	}

	// Formular erstellen
	$Formular = "
	<form action='index.php?url=Email/sendMailDozent' method='post' enctype='multipart/form-data'>
	<table id='tabelle'>

	 <tr>
	  <td>
	   <label for='Name'> Ihr Name:</label>
	  </td>
	  <td>
	   <input type='text' name='name' id='Name' value='" . $name . "' size='35' placeholder='Ihr Name' autofocus='autofocus'>
	  </td>
	 </tr>

	 <tr>
	  <td>
	   <label for='Email'>  Empfänger:</label>
	  </td>
	  <td>
	   <input type='text' name='email' id='Email' value='" . $email . "' size='35' required='required' placeholder='test@beispiel.com'>
	   <span class='pflichtfeld'>&#10034;<br> " . $Fehler["email"] . "</span>
	  </td>
	 </tr>

	 <tr>
	  <td>
	   <label for='Betreff'> Betreff:</label>
	  </td>
	  <td>
	   <input type='text' name='betreff' id='Betreff' value='" . $betreff . "' size='35' required='required' placeholder='Betreff'>
	   <span class='pflichtfeld'>&#10034;<br> " . $Fehler["betreff"] . "</span>
	  </td>
	 </tr>

	 <tr>
	  <td>
	   <label for='Nachricht'> Nachricht:</label>
	  </td>
	  <td>
	   <input type='text' name='nachricht' id='Nachricht' value='" . $nachricht . "' size='35' required='required' placeholder='Hallo'>
	   <span class='pflichtfeld'>&#10034;<br> " . $Fehler["nachricht"] . "</span>
	  </td>
	 </tr>

	 <tr>
	  <td>
	   <label for='Anhang'> Anhang: </label>
	  </td>
	  <td>
	   <input type='file' name='File[]' id='Anhang' size='20' multiple='multiple'>
	   <span class='pflichtfeld'>" . $Fehler["File"] . "</span>
	   <input class='button' type='reset' name='löschen' value='Anhang löschen'>
	   <br>
	   <small>Dateiformat: " . $Dtype . " - Dateigröße max.: " . $Dsize . " </small>
	  </td>
	 </tr>
	 <tr>
	  <th colspan='2'>
	   <br>
	   
	    <input type='hidden' name='id' value= '" . $kurs . "'/>
	   <input class='button' type='submit' name='submit' value='Email senden'>
	   
	  </th>
	 </tr>

	</table>

	<p>
	 <small>Bitte alle mit <span class='pflichtfeld'>&#10034;</span>
	 markierten Felder ausfüllen.</small>
	</p>

	</form>
	";

	// Formular ausgeben
	echo $Formular;

	 }else{ 
	 ?>	
	Kein Array vorhanden
	<?php } ?>	


			
	<form> <input class="button" type="submit" name="laden" value="Zurück Auswahl"
				formaction="index.php?url=Dozent/teilnehmerListe" formmethod="post">
			 <input type="hidden" name= "id" value= "<?php echo htmlentities($_POST['kurs']); ?>" />
	</form>
	
</article>
 <?
	/**-----------------------------------------------------------------------------------------
	* Ende SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich E-Mails an alle Teilnehmer einer Veranstaltung verschicken können (Points 13)
	* Task: 380/01  Beschreibung: Email Maske anlegen
	* Zeitaufwand (in Stunden): 3
	* Ende SPRINT 04
	**-----------------------------------------------------------------------------------------*/
?>
