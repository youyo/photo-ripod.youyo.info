<?php     defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!doctype html>
<html lang="<?php   echo LANGUAGE?>" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">




	<link rel="stylesheet" href="<?php  echo $this->getThemePath()?>/styles.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />





<?php 
	$cp = new Permissions($c);
	if ($cp->canWrite() || $cp->canAddSubContent() || $cp->canAdminPage()) {
	echo ('<style>#templatemo_site_title_bar {margin: 50px auto 0;}</style>');
	}

?>



	<!--[if IE]>
	<link rel="stylesheet" href="<?php  echo $this->getThemePath()?>/ie.css" />
 <![endif]-->


<script type="text/javascript" src="<?php   echo $this->getThemePath()?>/js/modernizr-1.5.min.js"></script>

<?php     Loader::element('header_required'); ?>

</head>
	<body>
		<div id="templatemo_site_title_bar_wrapper">
			<div id="templatemo_site_title_bar">
				<div id="templatemo_menu">
						<?php 
							$a = new GlobalArea('Header Nav');
							$a->display();
						?>
				</div>
<!-- end of templatemo_menu -->
				<div class="site_title_left">
					<div id="site_title">
						<?php 
							$a = new GlobalArea('Site Name');
							$a->display();
						?>
					</div>
				</div>
				<div class="site_title_right">
<?php 
			$a = new Area('Slogan');
			$a->display($c);
			?>
				</div>
				<div class="clear">
				</div>
				<div id="search_box">
					<?php 
						$a = new GlobalArea('Search');
						$a->display();
					?>
				</div>
			</div>
<!-- end of templatemo_site_title_bar -->
		</div>