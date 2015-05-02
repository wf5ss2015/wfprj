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
		<?php $this->renderResponse(); ?>
            <div >
                <h2>Hallo "<?php echo Session::get('user_name')?>"</h2>	
			
            </div>
        </div>

</div>
