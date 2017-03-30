	<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

	<div id="templatemo_footer_wrapper">
			<div id="templatemo_footer">
				<div class="section_w280">
					<div class="sub_content">
<?php 
			$a = new Area('Footer One');
			$a->display($c);
			?>
					</div>
				</div>
				<div class="section_w280">
<?php 
			$a = new Area('Sub Two');
			$a->display($c);
			?>
				</div>
				<div class="section_w280">
<?php 
			$a = new Area('Sub Three');
			$a->display($c);
			?>
				</div>
				<div class="clear">
				</div>
				<center>
					<p>
						Copyright &copy;
<?php    echo date('Y')?>
						<a href="<?php    echo DIR_REL?>/">
<?php    echo SITE?>
						</a>
						&bull; Built with Concrete5
						<a href="http://www.concrete5.org" title="concrete5 content management system">
							CMS
						</a>
						&bull;
						<a href="<?php    echo $this->url('/login')?>">
<?php    echo t('Sign In')?>
						</a>
					</p>
				</center>
			</div>
<!-- end of footer -->
		</div>
<?php     Loader::element('footer_required'); ?>
	</body>
</html>
