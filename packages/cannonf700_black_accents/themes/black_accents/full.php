<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php');
?>

	        <div class="fullpage-center">
		<div>
			<div class="fullpage-bannerzone">
			  <?php 
         	$header = new Area('Header');
         	$header->display($c);
         	?>
			  <div class="insideworkzone">
                <?php 
         	$main = new Area('Main');
         	$main->display($c);
         	?>
                </div>
			</div>
		  <div class="clear"></div>
		</div>
	</div>
	        <div class="clear"></div>
</div>
<div class="clear"></div>

<?php 
$this->inc('elements/footer.php');
?>