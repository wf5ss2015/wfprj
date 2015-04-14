<!--
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.5
*/
-->
<!--TODO HTML5 umsetzen-->

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css" />
</head>

<body>
	<div ></div>
    <div class="wrapper">
        <ul  class="navigation">
            <li  >
                <a href="index.php?url=index/index">Start</a>
            </li>
				<?php if (!Session::userIsLoggedIn()) : ?>
				<li>
                <a href="index.php?url=login/index">Einloggen</a>
				</li>  
				<?php endif; ?>
				<?php if(Session::userIsLoggedIn()) : ?> 
				<li>
                <a href="index.php?url=login/logout">Ausloggen</a>
				</li>
				<?php endif;  ?>
 
        </ul>
