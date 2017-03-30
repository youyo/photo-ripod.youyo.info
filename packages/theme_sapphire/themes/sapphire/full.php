<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

		<div class="content" id="main">
			<div id="content">
				<?php  
			$a = new Area('Main');
					$a->display($c);
			?>
			</div>
        </div>

<?php   $this->inc('elements/footer.php'); ?>