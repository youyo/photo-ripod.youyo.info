<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>


<!-- end of templatemo_site_title_bar_wrapper -->
		<div id="templatemo_content">
			<?php 
				print $innerContent;
			?>
		</div>
	<div class="clear"></div>
</div>
<!-- end of content -->
	<?php  $this->inc('elements/footer.php'); ?>