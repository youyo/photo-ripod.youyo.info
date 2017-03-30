<?php  defined('C5_EXECUTE') or die(_("Access Denied."));?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
       
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('main.css')?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />

<?php   Loader::element('header_required'); ?>

<?php  $cp = new Permissions($c);
if($cp->canAdminPage()){ ?>
	<style type="text/css">
		html > body{margin-top: 49px;}
	</style>
<?php  } ?>
</head>
<body>

<div class="preload-images">            <img src="<?php echo $this->getThemePath()?>/images/button-first_2.jpg">            <img src="<?php echo $this->getThemePath()?>/images/button_2.jpg">            <img src="<?php echo $this->getThemePath()?>/images/button-last_2.jpg"></div>

	<div id="wrapper">
        <div id="header">
		<div class="content">
			<div id="logo">
				<?php   
				$a = new GlobalArea('Site Name');
				$a->display();
				?>
			</div>
		</div>
        </div>
		
        <div id="nav">
		<div class="content">
	    <?php  
		$a = new GlobalArea('Header Nav');
		$a->display();
	    ?>
		</div>
        </div>