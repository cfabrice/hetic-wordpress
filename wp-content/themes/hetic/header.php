<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

    <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="header">
    <div class="header--logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1417.3 1417.3"><path class="st0" d="M1253.2 751.2c-4.2-10-13.2-10.7-22.6-10.7 -19.2 0.1-38.1 3.7-57.1 5 -34.5 2.3-69.1 4.3-102.1 2.5 -49.9 1.7-97.8-2-145.8-7 -41.5-4.3-82.5-10.2-122.7-21.2 -21-5.7-39.6-16.4-42.5-40.5 -2.6-21.6 0.3-43.4 2.2-65.1 0.4-4.7 3.4-6.1 7.4-7.5 23.7-8.3 47.2-17 70.9-25.4 75.8-26.8 153.4-47.3 232-63.9 14.2-3 22.3-13.7 21.1-26 -1.7-17.4-12.6-28.7-28.5-28.3 -18.4 0.5-35.9 6.1-53.7 10.1 -72.7 16.4-144.1 36.6-213.5 63.9 -37.6 14.8-76.2 27-116.7 30.7 -36.2 3.3-72.3-1.6-107.9-8.2 -60.5-11.2-119.5-29.3-180.2-39.2 -23.9-3.9-48-7.3-72.4-6.1 -13.8 0.7-23.2 9.7-23.8 23.4 -1.1 22.7 8.8 33.3 31.6 33.2 28.6-0.2 56.6 4.8 84.6 9.9 5.2 1 8.3 2.7 6.7 8.2 -12 41.7-9.5 84.4-10 127 -0.2 13.6-4.5 26.4-11.7 38.5 -15.6 26-39.9 41.4-65.4 55.6 -26.9 15-56.6 23.4-85 34.8 -16.5 6.6-22.7 21.2-16.8 38.7 4.8 14.1 18.6 19.4 36.1 13.9 22.3-7.1 44-15.8 65.5-25.3 45.7-20.3 87.7-45.5 118-86.6 2.5-3.4 5.2-3.8 8.7-3.8 10.7 0 21.4-2.1 31.8-2.1 48.7 0.3 97-4.8 145.4-8.4 18.2-1.3 36.2-4.7 54.3-6.4 25.7-2.4 50.3-9.3 77 2.8 32.4 14.7 69.1 16.2 104.2 22.2 46.5 8 93.5 12.2 140.5 14.4 52.9 2.4 106 1.5 158.9-2.1 18.2-1.2 36.4-3.2 54.5-5.3 9.5-1.1 17.9-4.8 23.9-13C1257.5 773.5 1257.9 762.4 1253.2 751.2zM704.9 630.3c-3 23.9-10 47.6-5.2 72 1.2 6-3.6 4.8-6.4 5.2 -18.4 2.6-36.8 5.7-55.4 7.3 -44.5 3.9-88.9 8.4-133.7 8.3 -10.8 0-24.5 6.7-32 0.1 -7.6-6.8-1.9-21-2.6-31.9 -0.4-5.1-0.1-10.3-0.1-15.4 -1.1-24.8 1-49.3 4.9-73.7 1.1-6.7 2.4-7.2 8.6-5.8 30.2 6.7 60.3 13.7 90.8 19 37.1 6.4 74.4 13.3 112.4 7.3 4.2-0.7 8.5-0.1 12.8-0.1C704.6 622.3 705.6 624.3 704.9 630.3z"/><circle class="st1" cx="711.9" cy="701.9" r="665.4"/></svg>
    </div>
    <button class="header-burger header-burger">
        <span class="header-burger--line"></span>
        <span class="header-burger--line"></span>
        <span class="header-burger--line"></span>
    </button>
    <nav class="header-nav">
        <!-- <ul class="header-nav-list header-nav-list-left">
            <li><a href="#" class="active">home</a></li>
            <li><a href="#">news</a></li>
            <li><a href="#">projects</a></li>
            <li><a href="#">exhibitions</a></li>
            <li><a href="#">jr</a></li>
        </ul> -->
        <ul class="header-nav-list header-nav-list-left">
		    <?php wp_nav_menu(array(
			    'menu_class'     => 'fm',
			    'items_wrap'     => '%3$s',
			    'walker'         => new jr_Walker_Menu_Header_Left(),
			    'container'      => false,
			    'echo'           => true,
			    'theme_location' => 'header-menu-left',
		    )); ?>
        </ul>
        <ul class="header-nav-list header-nav-list-right">
		    <?php wp_nav_menu(array(
			    'menu_class'     => 'fm',
			    'items_wrap'     => '%3$s',
			    'walker'         => new jr_Walker_Menu_Header_Right(),
			    'container'      => false,
			    'echo'           => true,
			    'theme_location' => 'header-menu-right',
		    )); ?>
        </ul>
      <!--  <ul class="header-nav-list header-nav-list-right">
            <li><a href="#">Get Involved</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#"><img src="<?php echo IMAGES_URL ?>/lang-france.png" alt="lang fr"></a></li>
        </ul> -->
    </nav>
</header>