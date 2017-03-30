<?php    defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); // get header file ?>
</head>

<body>

<div class="wrapper"><!-- not needed? up to you: http://camendesign.com/code/developpeurs_sans_frontieres -->

	<?php  
      $u = new User();
     
      if ($u->isLoggedIn()) { ?>
        <div style="min-height:80px;"></div>
    <?php  } ?>


	<h1 id="logo"><!--
			--><a href="<?php    echo DIR_REL?>/"><?php    
				$block = Block::getByName('My_Site_Name');  
				if( $block && $block->bID ) $block->display();   
				else echo SITE;
			?></a><!--
		--></h1>

	<header>
            <?php    $this->inc('elements/nav.php'); // get nav.php ?>
    </header>

    <article>
        <?php      
            $a = new Area('Main');
            $a->display($c); // main editable region
        ?>
    </article> <!-- close 1st article -->

    <aside>
        <?php      
            $a = new Area('Sidebar');
            $a->display($c); // sidebar editable region
        ?>
    </aside> <!-- close aside -->

<?php       $this->inc('elements/footer.php'); // get footer.php ?>