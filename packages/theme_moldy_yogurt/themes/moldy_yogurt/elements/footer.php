<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>


</div>
<div class="clear">

</div>
      <div id="footer-wrapper">
      <div id="footer">

         <span class="powered-by"><a href="http://www.concrete5.org" title="<?php   echo t('concrete5 open source CMS')?>"><?php   echo t('concrete5 Content Management')?></a></span>&nbsp;&nbsp;
			&copy; <?php   echo date('Y')?> <a href="<?php   echo DIR_REL?>/"><?php   echo SITE?></a>.
			<?php   echo t('All rights reserved.')?>
			<?php  
			$u = new User();
			if ($u->isRegistered()) { ?>&nbsp;&nbsp;
				<?php  
				if (Config::get("ENABLE_USER_PROFILES")) {
					$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
				} else {
					$userName = $u->getUserName();
				}
				?>
				<span class="sign-in"><?php   echo t('Currently logged in as <span id="usrname">%s</span>.', $userName)?> <a href="<?php   echo $this->url('/login', 'logout')?>"><?php   echo t('Sign Out')?></a></span>
			<?php    } else { ?>
				<span class="sign-in"><a href="<?php   echo $this->url('/login')?>"><?php   echo t('Sign In to Edit this Site')?></a></span>
			<?php    } ?>

      </div>
    </div>


  </div>
<?php    Loader::element('footer_required'); ?>

</body>
</html>
