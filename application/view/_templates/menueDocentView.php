<!--
 /* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 25.04.2015
 * Zeitaufwand (in Stunden): xx
 * User Story (Nr.: )  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können
 * Task: xxx/xx
 */ ===============================================
-->

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
		<li><a href="index.php?url=index/index">Start</a></li>
		<!--
		/**
		*START SPRINT 04
		* @author: Damian Wysocki
		* User Story (Nr.: ): Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können
		* Task: xxx/xx
		* START SPRINT 04
		-->
		<li><a href="index.php?url=Dozent/meinProfilView">Mein Profil</a></li>
		<!--
		/**
		* ENDE SPRINT 04
		* User Story (Nr.: ): Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können
		* Task: xxx/xx
		* ENDE SPRINT 04
		-->
		<li><a href="index.php?url=raumplan/erzeugeFormular1">Raumplan
				anzeigen</a></li>
		<li><a href="index.php?url=Dozent/auswahlVorlesungView">Teilnehmerliste</a>
		</li>
		<li><a href="index.php?url=login/logout">Ausloggen</a></li>
	</ul>
</nav>
<?php $this->renderResponse(); ?>

