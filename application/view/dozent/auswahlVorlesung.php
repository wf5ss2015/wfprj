<?php

?>
<!--TODO HTML5 umsetzen-->
<div class="container">

        <div class="table-wrapper">
		<?php $this->renderResponse(); ?>
            
			<?php if ($this->vorlesung) { ?>
			 <form action="index.php?url=Dozent/teilnehmerListe" method="post"/>
			<select name="id">
			<?php foreach($this->vorlesung as $key => $value) { ?>
			
			<option value="<?php echo htmlentities($value->veranst_ID);?>"><?php echo htmlentities($value->veranst_bezeichnung); ?></option>
			
			<?php } ?>
			</select>
	 		<input type="submit" value="weiter">
			</form>
			
            <?php }else { ?>
                <div>kein array übergeben</div>
            <?php } ?>				
            </div>
        </div>

</div>
