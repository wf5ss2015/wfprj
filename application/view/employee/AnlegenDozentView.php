<?php
 /* ===============================================
 * Sprint: 6
 * @author: Damian Wysocki
 * Datum: 12.06.2015
 * User Story (Nr.: 550) Als Mitarbeiter möchte ich div. Nutzer anlegen können (8).
 * Zeit insgesamt: 10
 * ===============================================*/


/**-----------------------------------------------------------------------------------------
	* START SPRINT 06
	* @author: Damian Wysocki
	* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
	* Task: 550/01  Beschreibung: Maske zum Anlegen eines Dozenten
	* Zeitaufwand (in Stunden): 2
	* START SPRINT 06	
	*/
	    
		/**
		 *
		 * @author Damian Wysocki
		 *        
		 *         Maske zum Anlegen eines Dozenten
		 **/     
?>
<article>
	<h1>Ein Nutzerkonto für <b>"Dozenten"</b> anlegen</h1>
	</br>			
	</br>
	<a>Bitte <b>alle</b> folgenden Felder ausfüllen! </a>
	</br>			
	</br>
	
	<?php/* Javascript Funktionen zum generieren eines Nutzernamens und
		überprüfen der Password Felder auf Gleichheit*/?>
	<script> 
	function generateUserName(){
		if(document.form.username.value=='' && document.form.fname.value!='' && document.form.lname.value!='') {
				 var username = document.form.fname.value.substr(0,1) + document.form.lname.value.substr(0,49);
				 username = username.replace(/\s+/g, '');
				 username = username.replace(/\'+/g, '');
				 username = username.replace(/-+/g, '');
				 username = username.toLowerCase();
				 document.form.username.value = username;}
	}
	
	function checkPW(){
		if(document.form.pw2.value != document.form.pw1.value){
				 alert("Passwörter stimmen nicht überein");
				 document.form.pw2.value = "";
				 document.form.pw1.value = "";
				 document.form.pw1.focus();
				 }
	}
	</script>
	
	<?php// Formular zum Anlegen?>
     <form action="index.php?url=Employee/anlageDozent" name="form" method="post">
		<table>
			<?php//Titel?>
			<tr>
              <td><label>Titel</label></td>
              <td> 
				<select>
				 <option value="Dr.">Dr.</option>
				 <option value="Dipl.-Inf.">Dipl.-Inf.</option>
				 <option value="Dipl.-Ing.">Dipl.-Ing.</option>
				 <option value="Dipl.-Betriebsw.">Dipl.-Betriebsw.</option>
				 <option value="M.Sc.">M.Sc.</option>
				 <option value="B.Sc.">B.Sc.</option>
				</select> 
				</td>
			</tr>
			<?php//Vorname?>
			<tr>
              <td><label>Vorname</label></td>
              <td><input id="fname" name="vorname" required="required" type="text"></td>
			</tr>
			<?php//Nachname?>
			<tr>
              <td><label>Nachname</label></td>
              <td><input id="lname" name="nachname" required="required" type="text" onblur="generateUserName()"></td>
			</tr>
			<?php//Geschlecht?>
			<tr>
              <td><label>Geschlecht</label></td>
              <td><input name="geschlecht" required="required"  value="w" type="radio">
                    <span>
                         w
                    </span>
  
                    <input name="geschlecht" required="required"  value="m" type="radio">
                    <span>
                         m
                    </span></td>
			</tr>
			<?php//Telefonnummer?>
			<tr>
              <td><label>Telefonnummer</label></td>
              <td><input name="telefonnummer" required="required" type="text"></td>
			</tr>
            <?php//Straße?>
			<tr>
              <td><label>Straße</label></td>
              <td><input name="strasse" required="required" type="text"></td>
			</tr>
			<?php//Hausnummer?>
			<tr>
              <td><label>Hausnummer</label></td>
              <td><input name="hausnummer" required="required" type="text"></td>
			</tr>
			<?php//Land?>
			<tr>
              <td><label>Land</label></td>
              <td><input name="land" required="required" type="text"></td>
			</tr>
			<?php//Stadt?>
			<tr>
              <td><label>Stadt</label></td>
              <td><input name="stadt" required="required" type="text"></td>
			</tr>
			<?php//PLZ?>
			<tr>
              <td><label>PLZ</label></td>
              <td><input name="plz" required="required" type="text"></td>
			</tr>
			<?php//Email?>
			<tr>
              <td><label>Email</label></td>
              <td><input name="email" required="required" type="email"></td>
			</tr>
			<?php//Nutzername?>
			<tr>
              <td><label>Nutzername</label></td>
              <td><input id="username" name="nutzername" required="required" type="text"></td>
			  <td><label>(Falls Nutzer bereits vorhanden, wird eine fortlaufende numerische Ziffer angehängt!)</label></td>
			</tr>
			<?php//Passwort?>
			<tr>
              <td><label>Passwort</label></td>
              <td><input id="pw1" name="passwort" required="required" type="password"></td>
			</tr>
			<?php//Passwort wiederholen?>
			<tr>
              <td><label>Passwort wdh</label></td>
              <td><input id="pw2" name="passwort_widerholen" required="required" type="password" onblur="checkPW()"></td>
			</tr>
              <?php//Rolle?>
			 <input type="hidden" name="rolle" value= 2 />
		</table>
		<br>
		<input class="button" value="Dozent anlegen" type="submit">
     </form>
	 
 
</article>
<!-- sonst Fehlermeldung -->


<?php 
	/** ENDE SPRINT 06
		* @author: Damian Wysocki
		* User Story (Nr.: 550)  Als Mitarbeiter möchte ich div. Nutzer anlegen können 
		* Task: 550/01  Beschreibung: Maske zum Anlegen eines Dozenten
		* Zeitaufwand (in Stunden): 2
		* ENDE SPRINT 06
	**-----------------------------------------------------------------------------------------*/	?>
