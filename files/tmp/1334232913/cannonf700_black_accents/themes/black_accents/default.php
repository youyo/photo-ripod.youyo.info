<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php');
?>

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
			</div>
					<?php 
         	$lsb1 = new Area('Sidebar');
         	$lsb1->display($c);
         	?>
            </div>
		   </div>
		  </div>
		<!--end leftzone-->

	<div class="container-center">
		<div>
			<div class="bannerzone">
              <?php 
         	$header = new Area('Header');
         	$header->display($c);
         	?>
                <div class="insideworkzone">
                <?php 
         	$main = new Area('Main');
         	$main->display($c);
         	?>
                </div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="container-right">
	  <div class="rightzone">
        <div class="column1">
        	<?php 
         	$rb1 = new Area('Right_Sidebar');
         	$rb1->display($c);
         	?>				
            </div>
		  </div>
      <!--end right zone-->
	</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<?php 
$this->inc('elements/footer.php');
?>