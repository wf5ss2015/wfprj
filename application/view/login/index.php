<?php
/**
* SPRINT 01
*
* @author: Kilian Kraus
* @Matrikel:
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.2
*/
?><!--TODO HTML5 umsetzen-->
<!--<head>
	<title>Lehrveranstaltungs Software</title>
	<meta charset ="utf-8">	
	<meta name = "description" content = "Das wird die zukünftige lehrveranstaltunsseite">
	<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>public/css/main.css" />
	
</head>
<main>    
    	
	!-->
	
	<div class="content_right">
	<?php $this->renderResponse(); ?>
	<section>
                <h2>Login here</h2>
                <form action="index.php?url=login/login" method="post">
                    <input type="text" name="user_name" placeholder="Nutzername" required />
                    <input type="password" name="user_password" placeholder="Passwort" required />
                    <input type="submit" class="login-submit-button" value="Einloggen"/>
                </form>
		
	</section>
	</div>
	<!--</main>!-->
