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
    
		public function __construct(){
			parent::__construct();
		}

		public function nutzerlisteDrucken(){
			$this->View->render('nutzerlistedrucken/nutzerliste', array('user_list' => UserModel::getUserDataAll4()));
		}
		
		public function printUser(){
			ob_start();
			include('../application/view/nutzerlistedrucken/nutzerliste.php');
			$content = ob_get_clean();
			// convert to PDF
			require_once('../application/lib/html2pdf/html2pdf.class.php');
			try
			{
				$html2pdf = new HTML2PDF('P', 'A4', 'fr');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
				$html2pdf->Output('nutzerliste.pdf');
			}
			catch(HTML2PDF_exception $e) {
				echo $e;
				exit;
			}
		}
	}
?>