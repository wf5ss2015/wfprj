<!--
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 0.5
 User Story Nr.: 270
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 Task: header erstellen
 ===============================================*/
-->
<!--TODO HTML5 umsetzen-->

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/style.css" />
</head>

<body>
	<div ></div>
    <div class="wrapper">
        <ul  class="navigation">
            <li  >
                <a href="index.php?url=index/index">Start</a>
            </li>
			<li>
                <a href="index.php?url=raumZuweisen/erzeugeFormular1">Raum einer Veranstaltung zuweisen</a>
            </li>
			<li>
                <a href="index.php?url=raumplan/erzeugeFormular1">Raumplan anzeigen</a>
            </li>
			<li>
				<a href="index.php?url=veranstaltungerweitern/veranstaltungErweitern">Start</a>
			</li>
			<li>
                <a href="index.php?url=login/logout">AusloggenMitarbeiter</a>
			</li>
        </ul>