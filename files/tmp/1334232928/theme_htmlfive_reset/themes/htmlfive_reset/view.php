<?php    defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); // get header file ?>
</head>

<body>

<div class="wrapper"><!-- not needed? up to you: http://camendesign.com/code/developpeurs_sans_frontieres -->

	<h1><a href="<?php    echo DIR_REL?>/">

			<?php      
				$block = Block::getByName('My_Site_Name');
				if( $block && $block->bID ) $block->display();
				else echo SITE; // display site title
			?></a>

	</h1>

	<header>
            <?php    $this->inc('elements/nav.php'); // get nav.php ?>
    </header>

    <article>
        <?php    print $innerContent; // required for view.php ?>
    </article> <!-- close 1st article -->

    <aside>
        <?php      
            $a = new Area('Sidebar');
            $a->display($c); // sidebar editable region
        ?>
    </aside> <!-- close aside -->

<?php       $this->inc('elements/footer.php'); // get footer.php ?>