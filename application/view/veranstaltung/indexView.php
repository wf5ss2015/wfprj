<?php

/**
 * SPRINT 02
 *
 * @author : Roland Schmid
 * Datum: 19.4.2015
 *         
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ändern können.
 * Task: 	Seite mit Anzeige einer Veranstaltung und Feldern, um diese zu ändern. 
 * Nr:		210
 * Points:	13
 * Zeit: 	1
 * UNVOLLSTÄNDIG
 *
 */

/**
 * SPRINT 01
 *
 * @author: Roland Schmid
 * Datum: 8.4.2015
 *
 * User­ Story: Als Verwalter möchte ich Veranstaltungen anlegen können.
 * Nr:		120
 * Task: 	Maske zum Anlegen einer Veranstaltung erstellen
 * Points:	13 
 * Zeit: 	2
 *
 * User­ Story: Als Verwalter möchte ich Veranstaltungen ECTS vergeben können.
 * Nr:		121
 * Task:	Maske zur Angabe von ECTS erweitern
 * Points:	5 
 * Zeit: 	0.5
 *
 */

//Das hier ist nur eine Seite mit Verweisen auf die eigentlichen PHP-Seiten
?>

<article>
	<h1>Hier ist die Startseite für die Verwaltung von Veranstaltungen</h1>
	<ul>
		<li><a href="index.php?url=veranstaltung/anlegenForm">Veranstaltung
				anlegen</a></li>
<?PHP
/* Sprint 02 Anfang
 * Link eingefügt für bearbeiten
 */
?>
		<li><a href="index.php?url=veranstaltung/bearbeitenSelect">Veranstaltung
				bearbeiten</a></li>
<?PHP
/* Sprint 02 Ende
 */
?>
	</ul>
</article>


