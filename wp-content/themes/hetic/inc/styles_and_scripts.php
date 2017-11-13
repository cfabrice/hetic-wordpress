<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 13/10/2017
 * Time: 10:15
 */


add_action('wp_enqueue_scripts', 'ajout_scripts');
add_action('after_setup_theme', 'thumbnails_theme_support');

function ajout_scripts()
{


    wp_register_script('main_script', JS_URL . '/main.min.js', ['jquery'], '1.1', true);
    wp_enqueue_script('main_script');

    wp_register_script('vue_script', 'https://unpkg.com/vue');
    wp_enqueue_script('vue_script');

    wp_register_script('axios_script', 'https://unpkg.com/axios/dist/axios.min.js');
    wp_enqueue_script('axios_script');
    wp_register_script('moment_script', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment-with-locales.min.js');
    wp_enqueue_script('moment_script');

    wp_register_style('main_style', CSS_URL . '/app.min.css');
    wp_enqueue_style('main_style');
}

function wpb_add_google_fonts()
{

    wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Alegreya+Sans|Alegreya+Sans+SC|Cabin',
      false);
}

add_action('wp_enqueue_scripts', 'wpb_add_google_fonts');

function thumbnails_theme_support()
{
    add_theme_support('post-thumbnails');
}


function jr_menus()
{
    register_nav_menus([
      'header-menu-right' => 'Header menu right',
      'header-menu-left'  => 'Header menu left',
    ]);
}

function wpc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

add_filter('wp_handle_upload_prefilter', 'custom_upload_filter');

function process_images($results)
{
    if ($results['type'] === 'video/*') {
        $cmd = "ffmpeg -ss 4 -i " . $results . " -s 1920x1080 -frames:v 1 " . $results['name'] . ".jpg";
        exec($cmd, $thumb_stdout, $retval);
    }
}

add_action('wp_handle_upload', 'process_images');

add_filter('upload_mimes', 'wpc_mime_types');
add_action('init', 'jr_menus');

add_image_size('large', 700, '', true);
add_image_size('medium', 250, '', true);
add_image_size('small', 120, '', true);
add_image_size('custom-size', 1200, '', true);

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl()
{

    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
