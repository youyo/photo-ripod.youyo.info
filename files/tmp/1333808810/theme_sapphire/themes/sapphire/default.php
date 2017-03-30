<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

		<div class="content" id="main">
			<div id="content-left">
				<?php  
			$a = new Area('Main');
					$a->display($c);
			?>
			</div>
			<div class="right-sidebar">
				<?php  
			$as = new Area('Sidebar');
			$as->display($c);
			?>
			</div>
        </div>

<?php   $this->inc('elements/footer.php'); ?>