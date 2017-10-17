<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 13/10/2017
 * Time: 10:15
 */


add_action( 'wp_enqueue_scripts', 'ajout_scripts' );
add_action( 'after_setup_theme', 'thumbnails_theme_support' );

function ajout_scripts() {


	wp_register_script('main_script', JS_URL . '/main.min.js', array('jquery'),'1.1', true);
	wp_enqueue_script('main_script');



	wp_register_style( 'main_style', CSS_URL . '/app.min.css' );
	wp_enqueue_style( 'main_style' );



	wp_register_style( 'google_font', 'https://fonts.googleapis.com/css?family=Alegreya+Sans|Alegreya+Sans+SC,300,400,500|Raleway,400,500,600,700' );
	wp_enqueue_style( 'google_font' );

}
function thumbnails_theme_support(){
	add_theme_support( 'post-thumbnails' );
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