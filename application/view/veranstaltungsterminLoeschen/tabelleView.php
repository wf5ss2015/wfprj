<?php
/*	---------- SPRINT 5 ----------

	- Autor: 				Alexander Mayer
	- Datum: 				09.06.2015
	
	- User Story (Nr. 530):	Als Mitarbeiter möchte ich einen Veranstaltungstermin löschen können.
	- User Story Punkte:	5
	- Task:					veranstaltungsterminLoeschenView anlegen			
	- Zeitaufwand:			
	
	//////////
*/
?>	

<article>

<?php

	if ($this->veranstaltungstermine) 
	{ 

		/* 	Tabelle drucken mit alias & link
			generische Tabelle mit Linkauswahl von Kilian Kraus
			Tabelle mit "hidden input" ermöglicht die Übergabe der Veranstaltungs-ID
		*/ 
	
		$table = new Table ();
		$alias = array (
			"0" => "Studiengang",
			"1" => "Tag",
			"2" => "Zeit",
			"3" => "Veranstaltung",
			"4" => "Raum"
		);
		
		$alias = ( object ) $alias;
	
		// key=name des links - value=action
		$link = array (utf8_encode("löschen") => "index.php?url=veranstaltungsterminLoeschen/loescheVeranstaltungstermin");
	
		$link = (object)$link;
	
		$table->table ( array ( 'table' => $this->veranstaltungstermine, 'alias' => array ($alias ), 'link' => array ($link) ) );
    } 
	else 
	{
		echo "error";
	}
	
?>
	
</article>



