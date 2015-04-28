<!--
    autor: Kris Klamser
    datum: 5.4.2015
    projekt: lehrveranstaltungsmanagement
	sprint: 03	
	zeitaufwand: 
	user story (Nr. ): Als Mitarbeiter möchte ich Räume anlegen können. (20 Pkt.)
-->
<html>
<head>
    <title>Raum anlegen</title>   
</head>
<body> 
    <header>
        <h1>Raum anlegen</h1>
    </header>
    <form action="index.php?url=raumAnlegen/raumSelected" method="post"/>
    <div>
        <input type="radio" name="typ" id="vorlesungsraum" value="vorlesungsraum">Vorlesungsraum<br>
        <input type="radio" name="typ" id="buero" value="buero">B&uuml;ro<br>
        <input type="radio" name="typ" id="labor" value="labor">Labor<br>
        <input type="radio" name="typ" id="bibliothek" value="bibliothek">Bibliothek<br>
    </div>
    <p>
        <input type="submit" id="b1" value="weiter"></a>
    </p>
    </form>
</body>
</html>