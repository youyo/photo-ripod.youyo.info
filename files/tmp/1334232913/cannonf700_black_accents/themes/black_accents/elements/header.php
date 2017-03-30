<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<!-- Site Header Content //-->

<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('main.css')?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />
 
<?php 
Loader::element('header_required');
?>
 
</head>
<body>
<div id="container">
	<div class="logo">
		<a href="<?php  echo DIR_REL?>/"><?php  
				$block = Block::getByName('My_Site_Name');  
				if( $block && $block->bID ) $block->display();   
				else echo SITE;
			?></a></div>

	<div class="top-menuzone">
				<div class="mainmenu">
					<ul>
						<?php 
         	$menu = new Area('Header Nav');
         	$menu->display($c);
         	?>
					</ul>
				</div>
  	</div>
            <div class="clear"></div>