<?php
/**
* SPRINT 02
*
* @author: Roland Schmid
* @Matrikel:
* Datum: 19.04.2015
*
* User­Story (Nr. xx ):  .... (n Points)
* Zeit: m
*/


/**
 * @author Roland Schmid
 * Das ist der Veranstaltung Controller. Steuert den Login Prozess.
 */
class VeranstaltungController extends Controller
{
    /**
     * @author Roland Schmid
	 * Erstellt ein Objekt des Controllers
     */
    public function __construct()
    {
        parent::__construct();	
    }

    /**
     * @author Roland Schmid
	 * Rendert "veranstaltung/index.php"
     */
    public function index()
    {
        $this->View->render('veranstaltung/index');
    }
	
    
     public function anlegenForm() {
	echo "<br>hier soll das Formular stehen<br>";
	
        /*Daten übers model holen und dann im View verarbeiten? im view eine Funktion mit etlichen params oder mit einem multi-array??*/
	
//$arr = array("foo" => "bar", "eat" => "shit", "destroy" => 'capitalizm');
        $vModel = new VeranstaltungModel;

        // holt die Veranstaltungsarten aus der Datenbank 
        $vArten = $vModel->getVeranstaltungsarten();

        // holt die Ausstattung aus der Datenbank
        $ausstattung = $vModel->getAusstattung();

        // holt die Studiengänge aus der Datenbank
        $studiengaenge = $vModel->getStudiengaenge();

        
        /* rendert die Seite
         * bekommt ein Array mit drei Subarrays übergeben, jeweils eins 
         * für die Veranstaltungsarten, für die Ausstattung und die Studiengänge
         */
        $this->View->render('veranstaltung/anlegenForm', array('vArten' => $vArten,
                                                               'ausstattung' => $ausstattung, 
                                                               'studiengaenge' => $studiengaenge));
        

    }

	
    public function anlegen() {
	//neues Veranstaltungmodel anlegen
        $vModel = new VeranstaltungModel;
        
        //legt die neue Veranstaltung an und speichert die ID, unter 
        //der sie gespeichert wurde
        $vID = -1;
       if($vModel->veranstaltungAnlegen()) {
         $database = new DatabaseFactoryMysql();

         $insertstring = "INSERT INTO Veranstaltung (`veranst_bezeichnung`, `veranst_kurztext`, `credits`, `SWS`, `maxTeilnehmer`, `vArt_ID`) VALUES ('Technische Grundlagen der Informatik', 'TEGR', '4', '4', '42', '16');";

         echo "im ControlleR: \n";
         echo $database->insert($insertstring);
         $vID = $database->insert_id;

         echo "\n\n last ID: " . $vID;
           
       } 
    
       $this->View->render('veranstaltung/anlegen', array('id' => $vID));
       
    }
	
	/*
	* rendert view um eine Veranstaltung auszuwählen, welche bearbeitet werden soll
	*/
	public function bearbeitenSelect()
    {
	    $this->View->render('veranstaltung/bearbeitenSelect', array(
            'veranstaltung' => VeranstaltungModel::getAlleVeranstaltungen()));
    }
	
	public function bearbeiten()
    {
    
	//do something im user model
        $this->View->render('veranstaltung/bearbeiten', array(
            'veranstaltung' => VeranstaltungModel::getVeranstaltung(Request::post('VeranstaltungID'))
        ));
    }

}
