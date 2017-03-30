<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>


<!-- end of templatemo_site_title_bar_wrapper -->
		<div id="templatemo_content">
			<div class="section_w900">
				<?php 
					$a = new Area('Main');
					$a->display($c);
				?>
			</div>
			<div class="clear"> </div>
		</div>
<!-- end of content -->
<?php  $this->inc('elements/footer.php'); ?>