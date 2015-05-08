<!--
/**
* SPRINT 03
*
* @author: Renato Cabriolu
* @Matrikel:
* Datum: 04.05.2015
*
* User­Story (Nr. 20 ): Als Entwickler möchte ich eine einheitliche Optik und einen einheitlichen Aufbau der Webseiten haben. (Nacharbeit)   (13 Points)
* Zeit: 1.5
*/
-->
<!--TODO HTML5 umsetzen--

	
<!-- einheitlicher Header Renato Cabriolu sprint -->
<!DOCTYPE HTML>
<html lang="de">
<head>
<title>Lehrveranstaltungs Software</title>
<meta charset="utf-8">
<meta name="description"
	content="Das wird die zukünftige lehrveranstaltunsseite">
<link rel="stylesheet"
	href="<?php echo Config::get('URL'); ?>public/css/styles.css">
</head>

<div class="wrapper">
	<header>
		<a style="float: left;" href="index.php?url=index/index" title="home">
			<img src="../public/css/Grafiken/hs_ulm_logo.png" width="133"
			height="77" alt="hsulm logo">
		</a> <a style=""><form action="#">
				<label for="Suchfeld"></label> <input type="search" name="suchfeld"
					id="suchfeld" size="20" maxlength="60" placeholder="Suchbegriff"> <input
					type="image" class="suchbutton"
					src="../public/css/Grafiken/icon_suche.gif">
			</form> </a>
	</header>