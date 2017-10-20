<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 06/10/2017
 * Time: 14:08
 */

define( 'THEME_PATH', get_template_directory()            );
//define( 'TEMPLATE_PATH' ,       THEME_PATH .    '/templates'        );

define( 'THEME_URL', get_template_directory_uri()        );
define( 'CSS_URL', THEME_URL .    '/assets/css'       );
define( 'IMAGES_URL', THEME_URL .    '/assets/img'       );
define( 'VIDEOS_URL', THEME_URL .    '/assets/video'       );
define( 'JS_URL', THEME_URL .    '/assets/js'      );
//define( 'FAVICONS_URL' ,        THEME_URL .    '/dist/favicon'      );
//define( 'ADMIN_IMAGES_URL' ,    IMAGES_URL .   '/admin'             );


foreach (glob( THEME_PATH . "/inc/*.php" ) as $file) {
    include_once $file;
}


// SECURITY
function wpb_remove_version()
{
    return '';
}
add_filter('the_generator', 'wpb_remove_version');

function remove_footer_admin()
{
    echo '<p>Made by P2020 at HETIC</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function no_wordpress_errors()
{
    return 'Something is wrong!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

remove_filter( 'authenticate', 'wp_authenticate_email_password', 20 );

function fb_filter_query($query, $error = true)
{
    if (is_search()) {
        $query->is_search = false;
        $query->query_vars[s] = false;
        $query->query[s] = false;
 
        // to error
        if ($error == true) {
            $query->is_404 = true;
        }
    }
}

function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);

function wpb_imagelink_setup()
{
    $image_set = get_option( 'image_default_link_type' );
     
    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

add_filter('xmlrpc_enabled', '__return_false');
 
add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
remove_action('welcome_panel', 'wp_welcome_panel');
