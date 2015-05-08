<!--
/**
* SPRINT 03
*
* @author: Renato Cabriolu
* @Matrikel:
* Datum: 04.05.2015
*
* User­Story (Nr. 20 ): Als Entwickler möchte ich eine einheitliche Optik und einen einheitlichen Aufbau der Webseiten haben. (Nacharbeit)   (13 Points)
* Zeit: 0.5
*/
-->

<!-- Individuelle menübar -->

<nav>
	<ul>
		<li><a href="index.php?url=index/index">Home</a></li>
		<li><a href="#">Veranstaltung</a>
			<ul>
				<li><a
					href="index.php?url=veranstaltungerweitern/veranstaltungErweitern">erweitern</a></li>
				<li><a href="index.php?url=veranstaltung/index">verwalten</a></li>
			</ul></li>
		<li><a href="#">Räume</a>
			<ul>
				<li><a href="index.php?url=raumAnlegen/raumAnlegen">Raum anlegen</a></li>
				<li><a href="index.php?url=raumZuweisen/erzeugeFormular1">Veranstaltung
						zuordnen</a></li>
				<li><a href="index.php?url=raumplan/erzeugeFormular1">Raumplan
						anzeigen</a></li>
			</ul></li>
		<li><a href="index.php?url=login/logout">Ausloggen</a></li>
		<li style="float: right;"><a href="index.php?url=login/index">Login</a>
		</li>

	</ul>
</nav>

<?php $this->renderResponse(); ?>




