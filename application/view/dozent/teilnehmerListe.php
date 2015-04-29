<?php

?>
<!--TODO HTML5 umsetzen-->
<div class="container">

        <div class="table-wrapper">
		<?php $this->renderResponse(); ?>
            <div >
                
			<?php if ($this->teilnehmer) { ?>
			<h2>Teilnehmerliste </h2>	
            <table style="width: 100%" >
                <thead>
                <tr>
					<td><h3>Nutzername</h3></td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($this->teilnehmer as $key => $value) { ?>
                        <tr>
							<td><?= htmlentities($value->user_name);?></td>
							<td><?= htmlentities($value->veranst_bezeichnung)?></td>
						</tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php }else { ?>
                <div>Kkein array übergeben.</div>
            <?php } ?>				
            </div>
        </div>

</div>
