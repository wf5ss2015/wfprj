<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->

<?php
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
		$this->nutzerlisteDrucken();
		
		/*require_once('../application/lib/tcpdf/tcpdf.php');
		 
		$pdf = new TCPDF("P","mm","A4", true, "UTF-8",false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Mitarbeiter");

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false); // kann genutzt werden, um Seitenzahlen etc. einzupflegen
		$pdf->SetFont('times', 'BI', 20); // Schriftart festlegen
		// add a page
		$pdf->AddPage();

		// set some text to print
		$html = "Hello World";
		$pdf->writeHTML ($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
		$pdf->lastPage();
		$pdf->Output(); 
		*/
		// FPDF-Klasse und das Verzeichnis der FPDF-Schriftarten einbinden

include_once('../application/lib/tcpdf/tcpdf.php');

// unsere selbsterstellte Testklasse01 einbinden
include_once("Testklasse01.php");

// pdf erzeugen (aus unserer selbsterstellten Testklasse01)
$pdf = new Testklasse01();  

// pdf ausgeben (im Browser oder in Datei schreiben)
$pdf->Output();   // Ausgabe (wenn in Datei schreiben, dateiname in Klammer)

	}
}
?>