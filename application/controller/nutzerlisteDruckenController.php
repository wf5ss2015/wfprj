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
		require_once('../application/lib/tcpdf/tcpdf.php');
		ob_start();
		$pdf = new TCPDF("P","mm","A4", true, "UTF-8",false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("Mitarbeiter");

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false); // kann genutzt werden, um Seitenzahlen etc. einzupflegen
		$pdf->SetFont('times', 'BI', 20); // Schriftart festlegen
		// add a page
		$pdf->AddPage();

		// set some text to print
		$html = "";
		$pdf->writeHTML ($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='');
		$pdf->lastPage();
		$pdf->Output(); 
		$this->nutzerlisteDrucken();
	}
}
?>