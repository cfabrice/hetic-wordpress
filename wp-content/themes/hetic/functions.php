<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 06/10/2017
 * Time: 14:08
 */

define( 'THEME_PATH' ,          get_template_directory()            );
//define( 'TEMPLATE_PATH' ,       THEME_PATH .    '/templates'        );

define( 'THEME_URL' ,           get_template_directory_uri()        );
define( 'CSS_URL' ,             THEME_URL .    '/assets/css'       );
define( 'IMAGES_URL' ,          THEME_URL .    '/assets/img'       );
define( 'JS_URL' ,              THEME_URL .    '/assets/js'      );
//define( 'FAVICONS_URL' ,        THEME_URL .    '/dist/favicon'      );
//define( 'ADMIN_IMAGES_URL' ,    IMAGES_URL .   '/admin'             );


foreach ( glob( THEME_PATH . "/inc/*.php" ) as $file ) {
	include_once $file;
}


function jr_menus() {
	register_nav_menus( array(
		'header-menu-right' => 'Header menu right',
		'header-menu-left' => 'Header menu left',
	) );
}

function wpc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'wpc_mime_types');
add_action( 'init', 'jr_menus' );

add_image_size( 'large', 700, '', true );
add_image_size( 'medium', 250, '', true );
add_image_size( 'small', 120, '', true );
add_image_size( 'custom-size', 1200, '', true );
