<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

		<div class="content" id="main">
			<div id="content">
				<?php  
					print $innerContent;
				?>
			</div>
        </div>

<?php   $this->inc('elements/footer.php'); ?>