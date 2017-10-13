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



	wp_register_style( 'google_font', 'https://fonts.googleapis.com/css?family=Alegreya+Sans|Alegreya+Sans+SC|Raleway,400,500,600,700' );
	wp_enqueue_style( 'google_font' );

}
function thumbnails_theme_support(){
	add_theme_support( 'post-thumbnails' );
}