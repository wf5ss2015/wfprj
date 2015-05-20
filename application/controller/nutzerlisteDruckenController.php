<?php
/*
    autor: Kris Klamser
    datum: 19.5.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 04	
	zeitaufwand: 5
	user story (Nr. 280a): Als Admin möchte ich alle Nutzer in einer Liste speichern können. (20 Pkt.) 
*/


class nutzerlisteDruckenController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function nutzerlisteDrucken() {
		$this->View->render ( 'nutzerlistedrucken/nutzerliste', array (
				'user_list' => UserModel::getUserDataAll4 () 
		) );
	}
	public function printUser() {
		/*
			nutzt das TCPDF Tool im Ordner ../application/lib um eine PDF zu erstellen.
			Inhalt ist die Variable $html. 
		*/
		$timestamp = time();
		$date = date("d.m.Y",$timestamp);
		require_once('../application/lib/tcpdf/tcpdf.php');
		ob_start();
		$pdf = new TCPDF("L","mm","A4", true, "UTF-8", true);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Admin/Mitarbeiter");
		$pdf->SetMargins(25, 25, 25, true);
		$pdf->SetAutoPageBreak(true, 25);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false); 
		$pdf->SetFont('helvetica', '', 10); 
		$pdf->AddPage();
		
		// html code der auf der PDF angezeigt werden soll. Nutzerdaten werden aus der Datenbank ausgelesen und an Tabelle angefügt. 
		$html = 'Lehrveranstaltungsmanagementsystem, '.$date.'<br><h1>Nutzerliste</h1><br><table border="1" cellpadding="1"><tr align="center">
				<th><b>Nachname</b></th><th><b>Vorname</b></th><th><b>Nutzername</b></th><th><b>Rolle</b></th>
				<th><b>E-Mail</b></th><th><b>Straßenname</b></th><th><b>Haus-Nr.</b></th><th><b>PLZ</b></th><th><b>Stadt</b></th><th><b>Land</b></th>
				</tr>';
		$data = array ('user_list' => UserModel::getUserDataAll4 ()); 
		foreach ( $data as $key => $value ) {
				$this->{$key} = $value;
		}
		foreach($this->user_list as $key => $value){
			$html = $html.'<tr><td>'.htmlentities($value->nachname).'</td>';
			$html = $html.'<td>'.htmlentities($value->vorname).'</td>';
			$html = $html.'<td>'.htmlentities($value->nutzer_name).'</td>';
			$html = $html.'<td>'.htmlentities($value->rolle_bezeichnung).'</td>';
			$html = $html.'<td>'.htmlentities($value->email_name).'</td>';
			$html = $html.'<td>'.htmlentities($value->straßenname).'</td>';
			$html = $html.'<td>'.htmlentities($value->hausnummer).'</td>';
			$html = $html.'<td>'.htmlentities($value->plz).'</td>';
			$html = $html.'<td>'.htmlentities($value->stadt).'</td>';
			$html = $html.'<td>'.htmlentities($value->land).'</td>';
			$html = $html.'</tr>';
		}
		$html = $html.'</table>';
	
		$pdf->writeHTML ($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
		$pdf->lastPage();
		//Output der PDF 
		$pdf->Output('nutzerliste.pdf', 'I'); 
	}
}
?>