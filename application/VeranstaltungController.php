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
    public function index() {
        $this->View->render('veranstaltung/index');
    }
	
    
    /*
     * Diese Methode sammelt die Daten, die für die Anzeige des Formular
     * notwendig sind, mit dem eine neue Veranstaltung angelegt wird
     * 
     *      */
    public function anlegenForm() {
	
        $vModel = new VeranstaltungModel();

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
        $vModel = new VeranstaltungModel();
        
        //legt die neue Veranstaltung an und speichert die ID, unter 
        //der sie gespeichert wurde
       
        
        $vID = $vModel->veranstaltungAnlegen();
//echo "<br>dorrar_vid = $vID<br>";
//$veranstaltung;
        
        if($vID > 1) {
//echo "<br>dorrar_vid = $vID, hier im if<br>";
            //zusätzlich noch Ausstattung eintragen
            //TODO
            
            //hole Daten der eben eingetragenen Veranstaltung als ein Array aus Objekten
            $veranstaltung = $vModel->getVeranstaltung($vID);
//echo "veranstaltungen::: ";
//print_r($veranstaltung);
//echo "\ntype: " . print gettype($veranstaltung);
            // die angegebene Ausstattung muss noch eingetragen werden mit der vID
         //   $veranstaltung->ausstattungEintragen($vid);
          
            $this->View->render('veranstaltung/angelegt', array('veranstaltung' => $veranstaltung));
            
         } else {
             
             // TODO errer ausgeben
             
         }
       
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
