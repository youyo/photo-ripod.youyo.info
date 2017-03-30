<?php  defined('C5_EXECUTE') or die(_("Access Denied."));?> 
		<div id="footer">
		<div class="content">
		<div id="footer-area">
	    <?php  
		$a = new Area('Footer');
                $a->display($c);
	    ?>
		</div>
			<!-- Please contact us on our website at concrete5studio.com if you want to remove the "design by concrete5studio" 
			You can purchase rebranding for this theme for $15 -->
		<div id="copyright">
		&copy; <?php  echo date('Y'),' ',SITE ?> - design by <a href="http://concrete5studio.com/" alt="concrete5 themes">concrete5studio</a> | 
			<?php  
				$u = new User();
				if ($u->isRegistered()) { ?>
					 <a href="<?php  echo $this->url('/login', 'logout')?>"><?php  echo t('Sign Out')?></a>
				<?php   } else { ?>
					<a href="<?php  echo $this->url('/login')?>"><?php  echo t('Sign In')?></a>
				<?php   } ?>
		</div>
		</div>
        </div>
		
    <?php   Loader::element('footer_required'); ?>
    </div>
</body>
</html>
