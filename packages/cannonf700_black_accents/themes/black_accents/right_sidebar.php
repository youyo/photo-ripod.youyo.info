<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php');
?>

	        <div class="rightpage-center">
				<div>
					<div class="rightpage-bannerzone">
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
			</div><!--end rightpage-bannerzone-->
		</div><!--close empty div-->
        <div class="clear"></div>
	</div><!--end rightpage-center-->
    
	<div class="container-right">
	  <div class="rightzone">
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
	   		   </div><!--end right-zone-->
           	</div><!--end container-right-->
           <div class="clear"></div>				
	  </div><!--end container-->
<div class="clear"></div>
</div>
<div class="clear"></div>
<?php 
$this->inc('elements/footer.php');
?>