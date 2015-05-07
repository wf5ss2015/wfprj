<?php
/**
* SPRINT 02
*
* @author: Roland Schmid
* @Matrikel:
* Datum: 19.04.2015
*
* User­Story 130a: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
* 5 Points
* Zeit: 1
*/

/**
* SPRINT 03
*
* @author: Roland Schmid
* @Matrikel:
* Datum: 6.5.2015
*
* User­ Story 130b: Als Mitarbeiter möchte ich Veranstaltungen als Pflicht- und Wahlfach kategorisieren können. (Nacharbeit 2)
* 5 Points
* Zeit: 2
*
* User Story 340: Als Entwickler möchte ich im MVC-Pattern programmieren können
* 40
*
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

	/*
	 * steuert den Anlegen-Vorgang für neue Veranstaltung
	 * 
	 * */
    public function anlegen() {
	//neues Veranstaltungmodel anlegen
        $vModel = new VeranstaltungModel();
        
        //legt die neue Veranstaltung an und speichert die ID, unter 
        //der sie gespeichert wurde
       
        $vID = $vModel->veranstaltungAnlegen();
              
        if($vID > 1) {

            //zusätzlich noch Ausstattung eintragen
            //TODO
            
            //hole Daten der eben eingetragenen Veranstaltung als ein Array aus Objekten
            $veranstaltung = $vModel->getVeranstaltung($vID);
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
