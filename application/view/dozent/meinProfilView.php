<?php
 /* ===============================================
 * Sprint: 4
 * @author: Damian Wysocki
 * Datum: 08.05.2015
 * User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können (Points 13)
 * Zeit insgesamt: 7
 * ===============================================*/

/**
 * @author Damian Wysocki
 *        
 *         Beschreibung: View um das Profil eines Dozenten anzuzeigen und zu ändern
 */
 ?>
 
<?php
/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/03  Beschreibung: View zur Anzeige des Profils
	* Zeitaufwand (in Stunden): 2
	* START SPRINT 04
	*/
?>
<article>

	<h2>Mein Profil</h2>
	</br>
	</br>

<?php if ($this->profil) { ?>

	<form>
		<table>
			<!--Nutzername-->
			<tr>
			<td><label >Nutzername</label></td>
			<td><label><?php echo htmlentities($this->profil->Nutzername)?></label></td>
			</tr>
			<!--Vorname-->
			<tr>
			<td><label>Vorname</label></td>
			<td><label><?php echo htmlentities($this->profil->Vorname)?></label></td>
			</tr>
			<!--Nachname-->
			<tr>
			<td><label>Nachname</label></td>
			<td><input type="text" name="Nachname"
				value="<?php echo htmlentities($this->profil->Nachname)?>"required></td>
			<td><input type="submit" name="nn" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</tr>
			
			<!--Straße-->
			<tr>
			<td><label>Straße</label></td>
			<td><input type="text" name="Straße" 
				value="<?php echo htmlentities($this->profil->Straße)?>"required></td>
			<td><input type="submit" name="str" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</tr>
			<!--Hausnummer-->
			<tr>
			<td><label>Hausnummer</label></td>
			<td><input type="text" name="Hausnummer"
				value="<?php echo htmlentities($this->profil->Hausnummer)?>" required></td>
			<td><input type="submit" name="hn" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</tr>
			<!--PLZ-->
			<tr>
			<td><label>PLZ</label></td>
			<td><input type="text" name="PLZ" 
				value="<?php echo htmlentities($this->profil->PLZ)?>" pattern="[0-9]{5}" required></td>
			<td><input type="submit" name="pl" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">	
			</tr>
			<!--Stadt-->
			<tr>
			<td><label>Stadt</label></td>
			<td><input type="text" name="Stadt" 
				value="<?php echo htmlentities($this->profil->Stadt)?>" required></td>
			<td><input type="submit" name="sta" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</tr>
			<!--Land-->
			<tr>
			<td><label>Land</label></td>
			<td><input type="text" name="Land" 
				value="<?php echo htmlentities($this->profil->Land)?>" required></td>
			<td><input type="submit" name="la" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">	
			</tr>
			<!--Telefonnummer-->
			<tr>
			<td><label>Telefonnummer</label></td>
			<td><input type="tel" name="Telefonnummer" 
				value="<?php echo htmlentities($this->profil->Telefonnummer)?>" required></td>
			<td><input type="submit" name="te" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</tr>
			<!--Email-->
			<tr>
			<td><label>Email</label></td>
			<td><input type="email" name="Email" 
				value="<?php echo htmlentities($this->profil->Email)?>" required></td>
			<td><input type="submit" name="em" value="Ändern" formaction="index.php?url=dozent/updateDozent" formmethod="post">
			</table>			
			</br>			
			</br>
	</form> 
	</br>
	
	<?php //HTML5 formaction: Seite mit aktuellen Werten neu laden ?>
	<form> <input type="submit" name="laden" value="Daten Neu Laden"
				formaction="index.php?url=dozent/meinProfil" formmethod="post"></form>
	
 </br>			
			</br>
 <?php }else{ ?>
	echo Kein Array vorhanden
<?php } ?>	

	<?php //Error Handling ?>
<?php $this->renderResponse(); ?>
</article>

<?php
/**-----------------------------------------------------------------------------------------
	* START SPRINT 04
	* @author: Damian Wysocki
	* User Story (Nr.: 390)  Als Dozent möchte ich mir mein Profil anzeigen und bearbeiten können  (Points 13)
	* Task: 390/03  Beschreibung: View zur Anzeige des Profils
	* Zeitaufwand (in Stunden): 2
	* START SPRINT 04
	**-----------------------------------------------------------------------------------------*/
?>