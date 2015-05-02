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
			<?php if ($this->userlist) {
				$table = new Table();
				
				// ohne alias
				$table->table(array('table' =>$this->userlist));
				echo "TEST";	
				// mit alias
				$alias = array(
				"0" => "Nutzer",
				"1" => "Passwort",
				"2" => "Letzter Login",
				"3" => "Rolle",);
				$alias = (object) $alias;
				$table->table(array('table' =>$this->userlist, 'alias' => array($alias)));
            }else { ?>
                <div>kein array übergeben</div>
            <?php } ?>				
            </div>
        </div>

</div>
