<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="<?php   echo LANGUAGE?>"> <![endif]-->
<!--[if IE 7 ]> <html class="ie ie7 no-js" lang="<?php   echo LANGUAGE?>"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8 no-js" lang="<?php   echo LANGUAGE?>"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9 no-js" lang="<?php   echo LANGUAGE?>"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="<?php   echo LANGUAGE?>"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="www-sitename-com" data-template-set="html5-reset">

<?php    Loader::element('header_required'); // makes Concrete5 edit bar show up ?> 

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="author" content="Your Name Here">
<meta name="Copyright" content="Copyright Your Name Here 2011. All Rights Reserved.">

<!-- Dublin Core Metadata : http://dublincore.org/ -->
<meta name="DC.title" content="Project Name">
<meta name="DC.subject" content="What you're about.">
<meta name="DC.creator" content="Who made this site.">

<!--  Mobile Viewport Fix
j.mp/mobileviewport & davidbcalhoun.com/2010/viewport-metatag 
device-width : Occupy full width of the screen in its current orientation
initial-scale = 1.0 retains dimensions instead of zooming out if page height > device height
maximum-scale = 1.0 retains dimensions instead of zooming in if page width < device width
-->
<!-- Uncomment to use; use thoughtfully!
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
-->

<!-- CSS: screen, mobile & print are all in the same file, main.css -->
<link rel="stylesheet" media="screen" href="<?php    echo $this->getStyleSheet('main.css')?>">
<link rel="stylesheet" media="screen" href="<?php    echo $this->getStyleSheet('typography.css')?>">
<!-- NOTE: The Concrete5 marketplace requires typography.css. You may delete it if you do not use it -->
	
<!-- all our JS is at the bottom of the page, except for Modernizr. -->
<script src="<?php    echo $this->getThemePath(); ?>/_/js/modernizr-1.7.min.js"></script>

<meta name="google-site-verification" content="">
<!-- Don't forget to set your site up: http://google.com/webmasters -->

<?php   
/*
* NOTE: footer.php includes a file for your custom Javascript
* The file is called functions.js and is located in the /_/js directory
* If you have no custom JS, you may delete lines 29-30 in /elements/footer.php
*/
?>