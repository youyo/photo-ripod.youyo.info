<?php    defined('C5_EXECUTE') or die(_("Access Denied.")); ?>       
		<nav>
			<?php       
				$a = new Area('Header Nav');
				$a->display($c); // main auto nav, embed this with http://pastie.org/2282530
			?>
		</nav>