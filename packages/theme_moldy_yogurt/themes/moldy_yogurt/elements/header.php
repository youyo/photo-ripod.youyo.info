<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!doctype html>
<html lang="<?php   echo LANGUAGE?>" class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Site Header Content //-->
	<link rel="stylesheet" href="<?php   echo $this->getThemePath()?>/reset.css" />
	<link rel="stylesheet" href="<?php   echo $this->getThemePath()?>/styles.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="<?php   echo $this->getStyleSheet('typography.css')?>" />

<?php 
	$cp = new Permissions($c);
	if ($cp->canWrite() || $cp->canAddSubContent() || $cp->canAdminPage()) {
	echo ('<style>#logo-wrapper {margin-top: 59px;}</style>');
	}

?>

<?php    Loader::element('header_required'); ?>

<script type="text/javascript" src="<?php  echo $this->getThemePath()?>/js/modernizr-1.5.min.js"></script>

</head>
<body>
  <div id="wrapper">
    <div id="logo-wrapper">
     <div id="logo">
		 <?php 
			$a = new GlobalArea('Site Name');
			$a->display();
		?>
	</div>

    </div>
    <div id="nav-wrapper">
      <div id="navigation">
		<?php 
			$a = new GlobalArea('Header Nav');
			$a->display();
		?>
      </div>
    </div>





<div id="ninesixty">
