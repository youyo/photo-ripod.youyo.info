<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
    <footer>
    
		<?php       
            $a = new Area('Footer Content');
            $a->display($c); // footer editable region
        ?> 
    
        <span class="powered-by"><a href="http://www.concrete5.org" title="<?php    echo t('concrete5 open source CMS')?>"><?php    echo t('concrete5 Content Management')?></a> &amp; <a href="http://html5reset.org"><?php    echo t('HTML5 Reset')?></a></span>
                    &copy; <?php    echo date('Y')?> <a href="<?php    echo DIR_REL?>/"><?php       echo SITE?></a>.
                    <?php    echo t('All rights reserved.')?>
                    <?php       
                    $u = new User();
                    if ($u->isRegistered()) { ?>
                        <?php        
                        if (Config::get("ENABLE_USER_PROFILES")) {
                            $userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
                        } else {
                            $userName = $u->getUserName();
                        }
                        ?>
                        <span class="sign-in"><?php    echo t('Currently logged in as <strong>%s</strong>.', $userName)?> <a href="<?php    echo $this->url('/login', 'logout')?>"><?php    echo t('Sign Out')?></a></span>
                    <?php    } else { ?>
                        <span class="sign-in"><a href="<?php    echo $this->url('/login')?>"><?php    echo t('Sign In to Edit this Site')?></a></span>
                    <?php    } ?>
    </footer> <!-- close footer -->
</div> <!-- close .wrapper -->

<!-- this is where we put our custom functions -->
<script src="<?php    echo $this->getThemePath(); ?>/_/js/functions.js"></script>

<?php    Loader::element('footer_required'); // Adds Google Analytics & gives the opportunity to output items into the footer ?>

</body>
</html>