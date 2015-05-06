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
<?php $this->renderResponse(); ?>
<div class="container">

        <div class="table-wrapper">
            <div >
                <h2>Hallo "<?php echo Session::get('user_name')?>"</h2>	
			<?php if ($this->userlist) {
				
				$table = new Table();
				
				echo "Standard";	
				// ohne alias
				$table->table(array('table' =>$this->userlist));
				
				echo "Mit Alias";	
				// mit alias
				$alias = array(
				"0" => "Nutzer",
				"1" => "Passwort",
				"2" => "Letzter Login",
				"3" => "Rolle");
				$alias = (object) $alias;
				$table->table(array('table' =>$this->userlist, 'alias' => array($alias)));
				
				echo "Mit Alias & Link bzw Action übergabe";	
				// mit alias & link
				$alias = array(
				"0" => "Nutzer",
				"1" => "Passwort",
				"2" => "Letzter Login",
				"3" => "Rolle",
				"4" => "Selbst ausloggen",
				"5" => "Gehe index");
				$alias = (object) $alias;
				
				// key=name des links - value=action
				$link = array(
				"Logout" => "index.php?url=login/logout",
				"Index" => "index.php?url=index");
				$link = (object) $link;
				$table->table(array('table' =>$this->userlist, 'alias' => array($alias), 'link' => array($link)));
            }else { ?>
                <div>kein array übergeben</div>
            <?php } ?>				
            </div>
        </div>

</div>
