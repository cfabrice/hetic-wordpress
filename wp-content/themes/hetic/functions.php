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

