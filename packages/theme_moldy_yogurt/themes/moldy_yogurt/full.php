<?php   defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); ?>

<div id="content-wrapper">
	<div id="full" class="full">
		<?php  
		if ($c->isEditMode()) {
				echo '<span class="area-size">';
				echo 'This area is 960 pixels wide';
				echo '</span>';
				};
			$a = new Area('Main');
			$a->display($c);
		?>
	</div>

</div>

<?php    $this->inc('elements/footer.php'); ?>



