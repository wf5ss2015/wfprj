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
				<h1>Kursübersicht</h1>
				<p>(Angemeldet:"<?php echo Session::get('user_name')?>")</p>
			</header>
			<section>
				<article>
				<p>Hier sehen Sie für Sie mögliche Kurse und können sich zu diesen anmelden.</p>
				</article>
				<article>
				<?php if ($this->listClass) {
					$table = new Table();
					$alias = array(
					"0" => "ID",
					"1" => "Veranstaltung",
					"2" => "Credits",
					"3" => "SWS",
					"4" => "Abmelden",);
					$alias = (object) $alias;
				
					$link = array(
					"Anmelden" => "index.php?url=student/verifyEnroll");
					$link = (object) $link;
					$table->table(array('table' =>$this->listClass, 'alias' => array($alias), 'link' => array($link)));
				}else { ?>
					kein array übergeben
				<?php } ?>				
				</article>
			</section>
