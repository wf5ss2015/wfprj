<?php
/*===============================================
 Sprint: 2
 @author: Kilian Kraus
 Datum: 20.04.2015
 Zeitaufwand (in Stunden): 5.0
 User Story: Als Benutzer möchte ich mich mit richtigen Berechtigungen einloggen können.
 Task: view erstellen(dummy)
 ===============================================*/
?>
<!--TODO HTML5 umsetzen-->
<div class="container">

        <div class="table-wrapper">
            <div >
                <h2>Hallo "<?php echo Session::get('user_name')?>"</h2>	
			<?php if ($this->userlist) { ?>
            <table style="width: 100%" >
                <thead>
                <tr>
					<td>Nutzername</td>
                    <td>Passwort Hash</td>
					<td>Email</td>
                    <td>Rolle</td>
					<td>Letzter Login (nicht konvertiert in Datum)</td>
                    <td>Ändern</td>
                    <td>Löschen</td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->userlist as $key => $value) { ?>
                        <tr>
							<td><?= htmlentities($value->user_name);?></td>
							<td><?= htmlentities($value->user_password_hash);?></td>
                            <td><?= htmlentities($value->user_email); ?></td>
							<td><?= htmlentities($value->user_role); ?></td>
							<td><?= htmlentities($value->user_last_login_timestamp); ?></td>
							<td>toter link "Ändern"</td>
							<td>toter link2 "Löschen"</td>
						</tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php }else { ?>
                <div>Keine Nutzer in DB - Sinnlos, da wenn Eingeloggt mindestens einer in DB ist.</div>
            <?php } ?>				
            </div>
        </div>

</div>
