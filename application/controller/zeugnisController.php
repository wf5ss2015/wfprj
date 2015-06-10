<?php
/*
    autor: Kris Klamser
    datum: 08.06.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 5
	zeitaufwand: 
	user story 
*/

class zeugnisController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	public function zeugnis() {
		$current_user = Session::get('user_name');
		$this->View->render ( 'zeugnis/zeugnis', array (
				'noten_list' => NotenModel::getSpecificStudents2($current_user) 
		) );
	}
	
	public function printZeugnis() {
		/*
			nutzt das TCPDF Tool im Ordner ../application/lib um eine PDF zu erstellen.
			Inhalt ist die Variable $html. 
		*/
		$current_user = Session::get('user_name');
		$timestamp = time();
		$date = date("d.m.Y",$timestamp);
		require_once('../application/lib/tcpdf/tcpdf.php');
		ob_start();
		$pdf = new TCPDF("L","mm","A4", true, "UTF-8", true);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Student");
		$pdf->SetMargins(25, 25, 25, true);
		$pdf->SetAutoPageBreak(true, 25);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false); 
		$pdf->SetFont('helvetica', '', 10); 
		$pdf->AddPage();
		
		// html code der auf der PDF angezeigt werden soll. Nutzerdaten werden aus der Datenbank ausgelesen und an Tabelle angefügt. 
		$html = 'Lehrveranstaltungsmanagementsystem, '.$date.'<br><h1>Notenspiegel/Zeugnis</h1><br><table border="1" cellpadding="1"><tr align="center">
				<th><b>Veranstaltungsnummer</b></th><th><b>Veranstaltungsbezeichnung</b></th><th><b>Note</b></th></tr>';
		$data = array ('noten_list' => NotenModel::getSpecificStudents2($current_user)); 
		foreach ( $data as $key => $value ) {
				$this->{$key} = $value;
		}
		foreach($this->noten_list as $key => $value){
			$html = $html.'<tr><td>'.htmlentities($value->veranst_ID).'</td>';
			$html = $html.'<td>'.htmlentities($value->veranst_bezeichnung).'</td>';
			$html = $html.'<td>'.htmlentities($value->note).'</td>';
			$html = $html.'</tr>';
		}
		$html = $html.'</table>';
	
		$pdf->writeHTML ($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
		$pdf->lastPage();
		//Output der PDF 
		$pdf->Output('notenspiegel.pdf', 'I'); 
	}
}
?>