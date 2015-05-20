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
?>

<article>
	<form action="index.php?url=login/login" method="post">
		<input type="text" name="user_name" placeholder="Nutzername" required />
		<input type="password" name="user_password" placeholder="Passwort"
			required /> <input class="button" type="submit" value="Login" />
	</form>
</article>


