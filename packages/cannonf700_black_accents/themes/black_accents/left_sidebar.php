<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php');
?>

<body>

	<div class="container-left">
		<div class="leftzone">
			<div class="column1">
				<?php 
         		$sbnt = new Area('Sidebar_Nav_Title');
         		$sbnt->display($c);
         		?>		
                <div class="side_nav">
					<?php 
         	$sbn = new Area('Sidebar_Nav');
         	$sbn->setBlockLimit(1);
         	$sbn->display($c);
         	?>
			</div><!--end side_nav-->
				<?php 
         		$sb = new Area('Sidebar');
         		$sb->display($c);
         		?>				    
		       	 </div><!--end column1-->
	 	  </div><!--end leftzone-->
          </div><!--end container-left-->
  

<div class="leftpage-center">
	<div>
		<div class="leftpage-bannerzone">
              <?php 
         	$header = new Area('Header');
         	$header->display($c);
         	?>

                <div class="insideworkzone">
                <?php 
         	$main = new Area('Main');
         	$main->display($c);
         	?>
            </div><!--end insideworkzone-->
			</div><!--leftpage-bannerzone-->
			<div class="clear"></div>
		</div><!--end empty div-->
	</div><!--end leftpage-center-->
    <div class="clear"></div>
</div><!--end container-->
<?php 
$this->inc('elements/footer.php');
?>