<?php
/*===============================================
 Sprint: 3
 @author: Kilian Kraus
 Datum: 05.05.2015
 Zeitaufwand (in Stunden): 1.0
 User Story Nr.: 320
 User Story: Als Student möchte ich mich zu Veranstaltungen an- und abmelden können.
 Task: view erstellen
 ===============================================*/
?>			
		<?php $this->renderResponse(); ?>
			<header>
				<h1>Abmeldung bestätigen</h1>
				<p>(Angemeldet:"<?php echo Session::get('user_name')?>")</p>
			</header>
			<section>
				<article>
				<p>Möchten Sie sich wirklich von <?php echo $this->veranst_bezeichnung?> abmelden?</p>
				</article>
				<article>
					<form method="post" action="index.php?url=student/saveDelist">
						<input type="hidden" name="id" value="<?php echo htmlentities($this->id); ?>" />
						<input type="submit" value='ja' />
					</form>
 		
					<form method="post" action="index.php?url=student/delistClass">
						<input type="submit" value='nein' />
					</form>			
				</article>
			</section>