<?php
/*
* HS­Ulm, WF5, SS2015, Prof. Klippel, Wirtschaftsinformatik­Projekt
* Projekt: Lehrveranstaltungssoftware
* Name: Kilian Kraus
* Gruppe: 01
* Version: 1
* Datum: 08.04.2015
*
* User­Story (Nr. 20 ): Als Dozent möchte ich mich zur Verwaltung meiner Daten online einloggen können. (42 Points)
* Zeit: 0.2
*/
?><!--TODO HTML5 umsetzen-->
<div class="container">
    
        <div class="table-wrapper">
            <div class="login-box">
                <h2>Login here</h2>
                <form action="<?php echo Config::get('URL'); ?>login/login" method="post">
                    <input type="text" name="user_name" placeholder="Nutzername" required />
                    <input type="password" name="user_password" placeholder="Passwort" required />
                    <input type="submit" class="login-submit-button" value="Einloggen"/>
                </form>
            </div>
        </div>

</div>
