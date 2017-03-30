<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>



<!-- end of templatemo_site_title_bar_wrapper -->
		<div id="templatemo_content">
			<div class="section_w900">
				<div class="section_w400 float_l">
					<?php 
					$a = new Area('Main');
					$a->display($c);
					?>
				</div>
				<div class="section_w400 float_r">
					<?php 
					$a = new Area('Sidebar');
					$a->display($c);
					?>
				</div>
			</div>
			<div class="clear">
			</div>
			<div class="section_w900">
				<?php 
				$a = new Area('Full');
				$a->display($c);
				?>
<div class="clear"></div>
			</div>
			<div class="section_w260 float_l">
				<?php 
				$a = new Area('Sub One');
				$a->display($c);
				?>
			</div>
			<div class="section_w260 float_l margin_r60">
				<?php 
				$a = new Area('Sub Two');
				$a->display($c);
				?>
			</div>
			<div class="section_w260 float_l">
				<?php 
				$a = new Area('Sub Three');
				$a->display($c);
				?>
			</div>
		</div>
		<div class="clear">
		</div>
		</div>
<!-- end of content -->
		<?php  $this->inc('elements/footer.php'); ?>